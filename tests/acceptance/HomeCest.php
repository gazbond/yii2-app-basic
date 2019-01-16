<?php

use yii\helpers\Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));        
        $I->see('Congratulations!');
        $I->seeLink('React');
        $I->click('React');
        $I->wait(2);
        $I->see('Home route');
    }
}
