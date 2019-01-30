<?php
/*
 * Yii2 Ide Helper
 * https://github.com/takashiki/yii2-ide-helper
 */

class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication
     */
    public static $app;
}

/**
 * @property yii\caching\FileCache $cache
 * @property yii2mod\settings\components\Settings $settings
 * @property dektrium\rbac\components\DbManager $authManager
 * @property yii\db\Connection $db
 * @property yii\elasticsearch\Connection $elasticsearch
 * @property yii\swiftmailer\Mailer $mailer
 * @property sizeg\jwt\Jwt $jwt
 * @property yii\web\Session $session
 * @property Mis\IdeHelper\IdeHelper $ideHelper
 */
abstract class BaseApplication extends \yii\base\Application {}