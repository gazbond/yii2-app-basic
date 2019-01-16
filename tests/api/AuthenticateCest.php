<?php

use yii\helpers\Url;

class AuthenticateCest
{
    private $token;

    public function _before(ApiTester $I)
    {

    }

    // tests
    public function checkMeIsAuthenticated(ApiTester $I)
    {
        $I->amGoingTo('POST login credentials');
        $I->sendPOST(Url::toRoute('/api/security/login'), [
            'login' => 'root',
            'password' => 'password'
        ]);
        $I->seeHttpHeader('Authorization');
        $this->token = $I->grabHttpHeader('Authorization');
        $I->amGoingTo('use token to access api');
        $I->sendGET(Url::toRoute('/api/users/me'));
    }
}
