<?php

class AuthenticateCest
{
    public function checkMeIsAuthenticated(ApiTester $I)
    {
        $I->amGoingTo('post login credentials');
        $I->sendPOST('/api/security/login', [
            'login' => 'root',
            'password' => 'password'
        ]);
        $I->seeHttpHeader('Authorization');
        $token = $I->grabHttpHeader('Authorization');
        $I->amGoingTo('use token to access api');
        $I->amBearerAuthenticated($token);
        $I->sendGET('/api/users/me');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'username' => 'root'
        ]);
    }
}
