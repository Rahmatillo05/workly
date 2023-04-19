<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "login_history".
 *
 * @property int $id
 * @property int $user_id
 * @property string $device
 * @property string $location
 * @property string $ip
 * @property int|null $status
 * @property int|null $created_at
 *
 * @property User $user
 */
class LoginHistory extends \yii\db\ActiveRecord
{
    const STATUS_SUCCESS = 10;
    const STATUS_FAILED = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'login_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'device', 'location', 'ip'], 'required'],
            [['user_id', 'status', 'created_at'], 'integer'],
            [['device', 'location', 'ip'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'device' => 'Device',
            'location' => 'Location',
            'ip' => 'Ip',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
