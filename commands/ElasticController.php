<?php namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use Yii;

/**
 * Command for generating Elastic Model class file **helpers** (work in progress)
 * Reads existing Model class as template.
 *
 * Class ElasticController
 * @package app\commands
 */
class ElasticController extends Controller
{
    /**
     * @var string
     */
    private $modelsNamespace = 'app\models\\';

    /**
     * @var string
     */
    private $outputPath = '';

    /**
     * Set outputPath.
     */
    public function init()
    {
        parent::init();

        $this->outputPath = Yii::$app->basePath . '/models/';
    }

    /**
     * Read ActiveRecord ($model).
     * And write attributes to file app/models/$model as comments and mapping array.
     *
     * @param $model
     * @return int
     */
    public function actionIndex($model)
    {
        /** @var yii\db\ActiveRecord $modelObject */
        $modelObject = Yii::createObject($this->modelsNamespace . $model);

        /** @var yii\db\TableSchema $tableSchema */
        $tableSchema = $modelObject->getTableSchema();
        $names = $tableSchema->getColumnNames();

        // PHP types => Elastic types
        $typesLookup = [
            'string' => 'text',
            'text' => 'text',
            'boolean' => 'boolean',
            'integer' => 'long',
            'float' => 'float',
            'decimal' => 'float',
            'datetime' => 'date',
            'timestamp' => 'date',
            'time' => 'date',
            'date' => 'date',
            /*
            'char' => '',
            'bigint' => '',
            'smallint' => '',
            'binary' => '',
            'money' => '',
             */
        ];

        // Create [] of attribute names => type (int, float, string etc.)
        $namesTypes = [
            'dynamic' => 'strict',
            'properties' => []
        ];
        // And concat comment
        $namesComment = "/**\n";
        foreach ($names as $name) {
            $col = $tableSchema->getColumn($name);
            $namesTypes['properties'][$name] = [
                'type' => $typesLookup[$col->type]
            ];
            $namesComment .= " * @property " . $col->type . " \t" . $name . "\n";
        }
        $namesComment .= " */\n";

        // Write array and comment to file
        $file = $this->var_export($namesTypes, true);
        file_put_contents($this->outputPath . $model, $namesComment . $file);

        return ExitCode::OK;
    }

    /**
     * var_export with new style array syntax []
     *
     * @param $expression
     * @param bool $return
     * @return mixed|string
     */
    private function var_export($expression, $return = false) {
        $export = var_export($expression, true);
        $export = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $export);
        $array = preg_split("/\r\n|\n|\r/", $export);
        $array = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [null, ']$1', ' => ['], $array);
        $export = join(PHP_EOL, array_filter(["["] + $array));
        if ((bool)$return) return $export; else echo $export;
    }
}
