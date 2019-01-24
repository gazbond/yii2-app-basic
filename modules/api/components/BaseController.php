<?php namespace app\modules\api\components;

use yii\rest\ActiveController;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\web\NotFoundHttpException;
use Yii;
use app\components\BaseElasticRecord;

/**
 * Class BaseController.
 *
 * @package app\modules\api\components
 */
class BaseController extends ActiveController
{
    /**
     * @var string
     */
    public $elasticClass = null;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class
        ];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        return $actions;
    }

    /**
     * @return array
     */
    public function actionIndex()
    {
        /** @var BaseElasticRecord $model */
        $model = Yii::createObject($this->elasticClass, [
            'scenario' => 'search'
        ]);
        $params = Yii::$app->request->queryParams;
        $model->setAttributes($params);
        return $model->search();
    }

    /**
     * @param $id
     * @return array|mixed|null|\yii\elasticsearch\ActiveRecord|static
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        /** @var BaseElasticRecord $modelClass */
        $modelClass = $this->elasticClass;
        $result = $modelClass::findOne($id);
        if($result === null) {
            throw new NotFoundHttpException();
        }
        return $result;
    }
}