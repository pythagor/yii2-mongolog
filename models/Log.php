<?php

namespace pythagor\mongolog\models;

use Yii;
use pythagor\mongolog\Module;
use yii\mongodb\ActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class Log extends ActiveRecord
{
    public static function getDb()
    {
        $module = Module::getInstance();
        return $module->db_log;
    }

    public static function collectionName()
    {
        $module = Module::getInstance();
        return $module->logCollection;
    }

    public function attributes()
    {
        return [
            '_id',
            'route',
            'user_id',
            'ip',
            'datetime',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['route'],
                ],
                'value' => function($event) {
                    return Yii::$app->requestedRoute;
                }
            ],
            [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['user_id'],
                ],
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['ip'],
                ],
                'value' => function($event) {
                    return Yii::$app->getRequest()->getUserIP();
                }
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['datetime'],
                ],
            ],
        ];
    }
} 
