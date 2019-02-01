<?php namespace app\controllers;

use app\components\Utils;
use dektrium\user\controllers\SecurityController as BaseController;
use yii\web\Response;
use Yii;

class SecurityController extends BaseController
{
    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        if($action->id === 'logout') {
            Yii::$app->request->enableCsrfValidation = false;
        };
        return parent::beforeAction($action);
    }

    /**
     * Displays the login page.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        Yii::$app->user->setReturnUrl(Yii::$app->request->getQueryParam('returnUrl'));
        return parent::actionLogin();
    }
}
