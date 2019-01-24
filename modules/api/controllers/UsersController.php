<?php namespace app\modules\api\controllers;

use app\components\BaseApiController;
use app\models\UserElastic;
use Yii;

class UsersController extends BaseApiController
{
    public $modelClass = 'app\models\User';
    public $elasticClass = 'app\models\UserElastic';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['options'],
                    'roles' => ['?']
                ],
                [
                    'allow' => true,
                    'actions' => ['index', 'view', 'me'],
                    'roles' => ['@']
                ],
                [
                    'allow' => true,
                    'actions' => ['update', 'create', 'delete'],
                    'roles' => ['admin']
                ]
            ]
        ];
        $behaviors['verbFilter']['actions']['me'] = [
            'GET',
            'HEAD'
        ];
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
     * @return array|null|\app\models\UserElastic
     */
    public function actionMe()
    {
        return UserElastic::findOne(Yii::$app->user->id);
    }
}
