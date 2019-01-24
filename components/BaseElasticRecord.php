<?php namespace app\components;

use yii\elasticsearch\ActiveRecord;

/**
 * Class BaseElasticRecord.
 *
 * @package app\components
 */
class BaseElasticRecord extends ActiveRecord
{
    /**
     * @var string
     */
    public $query = null;

    /**
     * @var string
     */
    public $type = null;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var int
     */
    public $size = 50;

    /**
     * @return int
     */
    protected function calculateFrom()
    {
        return (($this->page) * $this->size) - $this->size;
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['query', 'type', 'page', 'size', 'sort'], 'safe', 'on' => ['search']]
        ];
    }

    /**
     * @return array
     */
    public function search()
    {
        return [];
    }

    /**
     * @return array
     */
    public static function mapping()
    {
        return [
            static::type() => [

            ]
        ];
    }

    /**
     * @var array
     */
    protected static $propsMap = null;

    /**
     * @return array
     */
    public static function propsMap() {

        if (static::$propsMap === null) {
            $mappings = static::mapping();
            $mappings = $mappings[static::type()]['properties'];
            static::$propsMap = [];
            foreach($mappings as $prop => &$val) {
                static::$propsMap[] .= $prop;
            }
        }
        return static::$propsMap;
    }

    /**
     * @var array
     */
    protected static $dataMap = null;

    /**
     * @return array
     */
    public static function dataMap()
    {
        if (static::$dataMap === null) {
            $mappings = static::propsMap();
            static::$dataMap = [];
            foreach($mappings as $prop) {
                static::$dataMap[$prop] = $prop;
            }
        }
        return static::$dataMap;
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return static::propsMap();
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return static::propsMap();
    }
} 