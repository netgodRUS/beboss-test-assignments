<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p><strong>Email:</strong> <?= $model->email ?></p>
<p><strong>Full Name:</strong> <?= $model->fullName ?></p>
<p><strong>Registration Date:</strong> <?= Yii::$app->formatter->asDate($model->created_at) ?></p>

<?= Html::a('Edit Profile', ['user/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

