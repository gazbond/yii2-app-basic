<?php namespace app\modules\api\controllers;

use dektrium\user\controllers\SecurityController as BaseController;
use dektrium\user\models\LoginForm;
use yii\helpers\Json;
use yii\web\HttpException;
use Yii;

class SecurityController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }

    /**
     * @var string
     */
    public $defaultAction = 'login';

    /**
     * @inheritdoc
     */
    public function actionLogin()
    {
        /** @var LoginForm $model */
        $model = Yii::createObject(LoginForm::class);
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        $postData = Yii::$app->getRequest()->post();
        $modelData = [
            'login-form' => [
                'login' => isset($postData['login']) ? $postData['login'] : '',
                'password' => isset($postData['password']) ? $postData['login'] : ''
            ]
        ];

        if ($model->load($modelData) && $model->login()) {
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
        }

        //return implode(' ', $model->getErrorSummary(false));
        return Json::encode($model->getErrorSummary(false));
    }

    /**
     * @inheritdoc
     */
    public function actionLogout()
    {
        throw new HttpException(404);
    }
}
