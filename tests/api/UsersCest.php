<?php

use yii\helpers\Json;
use app\components\Utils;

class UsersCest
{
    public function _before(ApiTester $I)
    {
        $I->sendPOST('/api/security/login', [
            'login' => 'root',
            'password' => 'password'
        ]);
        $token = $I->grabHttpHeader('Authorization');
        $I->amBearerAuthenticated($token);
    }

    public function checkSearchingUsers(ApiTester $I)
    {
        $I->sendGET('/api/users/index');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $response = Json::decode($I->grabResponse(), false);
        Utils::log($response);
    }

    public function checkSearchingUsersWithQueryParams(ApiTester $I)
    {
        $I->sendGET('/api/users/index', [
            'query' => 'gazbond'
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $response = Json::decode($I->grabResponse(), false);
        Utils::log($response);
    }
}
