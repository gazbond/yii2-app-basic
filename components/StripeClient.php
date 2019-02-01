<?php namespace app\components;

use yii\authclient\OAuth2;
use Yii;
use yii\helpers\Json;

class StripeClient extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://connect.stripe.com/oauth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://connect.stripe.com/oauth/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.stripe.com';

    /**
     * @inheritdoc
     */
    public $scope = 'read_write';

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'stripe';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Stripe';
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $token = $this->getAccessToken();
        return [
            'id' => $token->params['stripe_user_id'],
            'provider' => 'stripe',
            'data' => Json::encode($token)
        ];
    }
} 