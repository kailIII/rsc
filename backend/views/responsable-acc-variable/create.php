<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResponsableAccVariable */

$this->title = 'Crear Responsable De Variable';
$this->params['breadcrumbs'][] = ['label' => 'Responsable Acc Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responsable-acc-variable-create">
 <?php if (!Yii::$app->request->isAjax){ ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
