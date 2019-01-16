<?php namespace app\modules\api\components;

use yii\rest\ActiveController;
use sizeg\jwt\JwtHttpBearerAuth;

class BaseController extends ActiveController
{
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
} 