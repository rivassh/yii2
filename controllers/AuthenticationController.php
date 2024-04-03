<?php

namespace backend\controllers;

use common\models\User;
use Lcobucci\JWT\Signer\Key\InMemory;
use Yii;
use yii\rest\ActiveController;
use yii\rest\Controller;

class AuthenticationController extends Controller
{
    public function actionLogin()
    {
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner();

        $time = time();
        // Authenticate the user
        $user = User::findOne(['username' => \Yii::$app->request->post('username')]);
    if ($user && $user->validatePassword(\Yii::$app->request->post('password'))) {
        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
        $key = InMemory::file(\Yii::$app->basePath.'/config/ca.pem');
        $jwt = \Yii::$app->jwt->getBuilder()
            ->issuedBy('http://api.payab.local') // Configures the issuer (iss claim)
            ->permittedFor('http://api.payab.local') // Configures the audience (aud claim)
//            ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
        ->issuedAt((new \DateTimeImmutable())->setTimestamp(time())) // Configures the time that the token was issue (iat claim)
        ->expiresAt((new \DateTimeImmutable())->setTimestamp(time() + 3600)) // Configures the expiration time of the token (exp claim)
        ->identifiedBy('uid', $user->id); // Configures a new claim, called "uid"
//            ->sign($signer, 'secret_key') // creates a signature using "secret_key"
        $token= $jwt->getToken($signer, $key); // Retrieves the generated token

        return ['token' => $token->payload()];
    } else {
        dd($user->validatePassword(\Yii::$app->request->post('password')));

        throw new \yii\web\UnauthorizedHttpException('Unauthorized');
    }
}

}
