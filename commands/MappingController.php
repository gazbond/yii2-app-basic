<?php namespace app\commands;

use yii\console\Controller;
use Yii;
use app\models\UserElastic;

/**
 * Execute elasticsearch mapping configurations.
 *
 * @package app\commands
 */
class MappingController extends Controller
{
    /**
     * Run all.
     */
    public function actionIndex()
    {
        $this->actionUser();
    }

    /**
     * Run User.
     */
    public function actionUser()
    {
        /** @var yii\elasticsearch\Command $command */
        $command = Yii::$app->elasticsearch->createCommand();

        // Delete and re-create index
        $command->deleteIndex(UserElastic::index());
        $command->createIndex(UserElastic::index());

        // Set index mappings
        $mapping = UserElastic::mapping();
        $command->setMapping(UserElastic::index(), UserElastic::type(), $mapping);
    }
} 