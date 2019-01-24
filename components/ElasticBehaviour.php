<?php namespace app\components;

use borales\behaviors\elasticsearch\Behavior;
use yii\base\Event;
use Yii;

/**
 * Class ElasticBehaviour.
 *
 * @package app\components
 */
class ElasticBehaviour extends Behavior
{
    /**
     * @inheritdoc
     */
    public function insert(Event $event, $data = null)
    {
        $data = $data ? $data : $this->getProcessedData();
        if ($this->mode == self::MODE_COMMAND) {
            $this->db()->createCommand()
                ->insert($this->elasticIndex, $this->elasticType, $data, $this->getPK());
        } else {
            /** @var yii\elasticsearch\ActiveRecord $model */
            $model = Yii::createObject($this->elasticClass);
            // Parent was doing this wrong
            $model->setAttributes($data, false);
            // Set elastic pk to database pk
            $model->setPrimaryKey($this->getPK());
            $model->save();
        }
    }

    /**
     * Added because insert() seems to fire an event.
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function reinsert()
    {
        /** @var yii\elasticsearch\ActiveRecord $model */
        $model = Yii::createObject($this->elasticClass);
        $model->setAttributes($this->getProcessedData(), false);
        // Set elastic pk to database pk
        $model->setPrimaryKey($this->getPK());
        $model->save();
    }
} 