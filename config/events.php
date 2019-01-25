<?php

use dektrium\user\controllers\SecurityController;
use yii\base\Event;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use yii\helpers\Url;

Event::on(SecurityController::class, SecurityController::EVENT_AFTER_LOGIN, function (Event $e) {

    $expires = new DateTime();
    $expires->modify(Yii::$app->params['token-expiry']);

    /** @var app\models\User $user */
    $user = Yii::$app->user->identity;
    $signer = new Sha256();
    /** @var Lcobucci\JWT\Token $token */
    $token = Yii::$app->jwt->getBuilder()
        ->setIssuer(Url::home(true))
        ->setAudience(Url::home(true))
        ->setIssuedAt(time())
        ->setExpiration($expires->getTimestamp())
        ->set('user_id', $user->id)
        ->sign($signer, Yii::$app->jwt->key)
        ->getToken();
    $token = (string) $token;

    // Set as header
    Yii::$app->response->headers->add('Authorization', $token);

    // Set unencrypted cookie
    setcookie('Authorization', $token, $expires->getTimestamp(), '/');
});

Event::on(SecurityController::class, SecurityController::EVENT_AFTER_LOGOUT, function (Event $e) {

    // Remove cookie
    setcookie('Authorization','',time()-1, '/');
});
