<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\rest\Controller;

class SettingController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
         ];
    return $behaviors;
    }
}
