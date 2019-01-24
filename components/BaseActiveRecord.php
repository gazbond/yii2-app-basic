<?php namespace app\components;

use yii\db\ActiveRecord;

/**
 * Class BaseActiveRecord.
 *
 * @package app\components
 */
class BaseActiveRecord extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => function () {
                    return date("Y-m-d H:i:s");
                },
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    }

    /**
     * @param $propName
     * @return bool
     */
    public function isPropertySet($propName)
    {
        if (isset($this->$propName) && $this->$propName !== '') {
            return true;
        }
        return false;
    }
} 