<?php

use yii\helpers\Url;

class LoginCest
{
    public function ensureThatLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/user/security/login'));
        $I->see('Sign in');
        $I->amGoingTo('try to login with correct credentials');
        $I->fillField('input[name="login-form[login]"]', 'root');
        $I->fillField('input[name="login-form[password]"]', 'password');
        $I->click('button[type=submit]');
        $I->wait(2);
        $I->see('root');
        $I->amGoingTo('try to logout');
        $I->click('root');
        $I->click('Logout');
        $I->wait(2);
        $I->see('Congratulations!');
    }
}
