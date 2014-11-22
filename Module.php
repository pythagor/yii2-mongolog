<?php

namespace pythagor\mongolog;

use Yii;
use pythagor\mongolog\models\Log;
use yii\web\Application;

class Module extends \yii\base\Module
{
    public $logCollection;

    public function init()
    {
        parent::init();

        if (Yii::$app instanceof Application) {
            Yii::$app->on(Application::EVENT_AFTER_REQUEST, [$this, 'makeLog']);
        }
    }

    public function makeLog($event)
    {
        $log = new Log();
        $log->save();
    }
}
