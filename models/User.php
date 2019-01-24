<?php namespace app\models;

use dektrium\user\models\User as BaseUser;
use OutOfBoundsException;
use Lcobucci\JWT\Token;
use Yii;

class User extends BaseUser
{
    /**
     * JWT identity handling.
     *
     * @param Token $token
     * @param null $type
     * @return \yii\web\IdentityInterface
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        try {
            $id = $token->getClaim('user_id');
            $user = self::findOne($id);
            return $user;

        } catch (OutOfBoundsException $e) {
            Yii::warning("Invalid JWT provided: " . $e->getMessage(), 'jwt');
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $dataMap = UserElastic::dataMap();
        $behaviors = parent::behaviors();
        $behaviors['elasticsearch'] = [
            'class' => 'app\components\ElasticBehaviour',
            'mode' => 'model',
            'elasticClass' => UserElastic::class,
            'dataMap' => $dataMap
        ];
        return $behaviors;
    }
}
