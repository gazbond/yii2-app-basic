<?php namespace app\commands;

use yii\console\Controller;
use app\models\UserElastic;
use app\models\User;
use app\components\ElasticBehaviour;
use Yii;

/**
 * Regenerate elasticsearch indexes.
 *
 * @package app\commands
 */
class ReindexController extends Controller
{
    /**
     * Run all.
     * @param int $numb
     */
    public function actionIndex($numb = 100)
    {
        $this->actionUser($numb);
    }

    /**
     * Run User.
     *
     * @param int $numb
     */
    public function actionUser($numb = 100)
    {
        /** @var yii\elasticsearch\Command $command */
        $command = Yii::$app->elasticsearch->createCommand();

        // Delete and re-create index
        $command->deleteIndex(UserElastic::index());
        $command->createIndex(UserElastic::index());

        // Set index mappings
        $mapping = UserElastic::mapping();
        $command->setMapping(UserElastic::index(), UserElastic::type(), $mapping);

        // Load models and reinsert
        $results = User::find();
        foreach($results->each($numb) as $result) {
            /** @var  ElasticBehaviour $result */
            $result->reinsert();
        }
    }
} 