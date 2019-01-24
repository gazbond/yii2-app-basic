<?php namespace app\models;

use app\components\BaseElasticRecord;

/**
 * @property integer 	id
 * @property string 	username
 * @property string 	email
 * @property string 	auth_key
 * @property integer 	confirmed_at
 * @property string 	unconfirmed_email
 * @property integer 	blocked_at
 * @property string 	registration_ip
 * @property integer 	created_at
 * @property integer 	updated_at
 * @property integer 	flags
 * @property integer 	last_login_at
 */
class UserElastic extends BaseElasticRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return parent::rules();
    }

    /**
     * @return array
     */
    public function search()
    {
        $query = [

        ];

        if($this->isPropertySet('query')) {
            $query = [
                'match' => [
                    'username' => $this->query
                ]
            ];
        }

        return static::find()->query($query)
            ->offset($this->calculateFrom())
            ->limit($this->size)
            ->all();
    }

    /**
     * @return string
     */
    public static function index()
    {
        return 'users';
    }

    /**
     * @return string
     */
    public static function type()
    {
        return 'user';
    }

    /**
     * Generated via elastic console command.
     *
     * @return array This model's mapping
     */
    public static function mapping()
    {
        return [
            static::type() => [
                'dynamic' => 'strict',
                'properties' => [
                    'id' => [
                        'type' => 'long',
                    ],
                    'username' => [
                        'type' => 'text',
                    ],
                    'email' => [
                        'type' => 'text',
                    ],
                    'auth_key' => [
                        'type' => 'text',
                    ],
                    'confirmed_at' => [
                        'type' => 'long',
                    ],
                    'unconfirmed_email' => [
                        'type' => 'text',
                    ],
                    'blocked_at' => [
                        'type' => 'long',
                    ],
                    'registration_ip' => [
                        'type' => 'text',
                    ],
                    'created_at' => [
                        'type' => 'long',
                    ],
                    'updated_at' => [
                        'type' => 'long',
                    ],
                    'flags' => [
                        'type' => 'long',
                    ],
                    'last_login_at' => [
                        'type' => 'long',
                    ],
                ],
            ]
        ];
    }
}