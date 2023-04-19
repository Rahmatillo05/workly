<?php

namespace app\components\tools;

class StatusSetter extends \yii\base\Widget
{

    const ACTIVE = 10;
    const IN_ACTIVE = 9;
    const FAILED = 0;

    public static function statusSet($status = self::FAILED)
    {
        if ($status == self::ACTIVE){
            return '<span class="badge bg-label-success me-1">Completed</span>';
        } elseif($status == self::IN_ACTIVE){
            return  '<span class="badge bg-label-warning me-1">Pending</span>';
        }
        return '<span class="badge bg-label-danger me-1">Failed</span>';
    }

}