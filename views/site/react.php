<?php

use yii\web\View;

/* @var $this yii\web\View */
/* @var $identity yii\web\IdentityInterface */

$this->title = 'React';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/dist/shim.js', [
    'position' => View::POS_END
]);

$this->registerJsFile('@web/dist/index.js', [
    'position' => View::POS_END
]);
?>

<div id="react-app-root">Loading...</div>
