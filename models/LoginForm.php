<?php

namespace app\models;

use nyx\components\http\userAgent\UserAgentParser;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if (Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                return $this->loginHistorySave($this->getUser()->id, LoginHistory::STATUS_SUCCESS);
            }
        }
        return $this->loginHistorySave($this->getUser()->id, LoginHistory::STATUS_FAILED);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    private function loginHistorySave(int $id, $status): bool
    {
        $user_agent = UserAgentParser::parse();
        $history = new LoginHistory();
        $history->user_id = $id;
        $history->device = $user_agent->browser . " - " . $user_agent->platform;
        $history->location = $this->userLocation();
        $history->ip = Yii::$app->request->userIP;
        $history->created_at = time();
        $history->status = $status;
        if ($history->status === LoginHistory::STATUS_SUCCESS) {
            return $history->save();
        } else {
            $history->save();
            return false;
        }
    }

    private function userLocation(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = false;
        }
        $ip_info = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
        $country = $ip_info['geoplugin_countryName'];
        $city = $ip_info['geoplugin_city'];
        if ($city && $country) {
            return $city . " - " . $country;
        } else {
            return "Undefined location";
        }
    }
}
