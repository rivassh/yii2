<?php

namespace app\controllers;

use yii\rest\ActiveController;

class AuthController extends ActiveController
{
    public $modelClass = 'app\models\UserRefreshToken';


    public function actionCreate()
    {
        exit('1111');
    }
}
