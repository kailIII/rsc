<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\web\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AccionCentralizadaVariableEjecucionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Variables Por Región';
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizadas Variables Asignadas', 'url' => ['variables']];
$this->params['breadcrumbs'][] = $this->title;
$icons=[
  'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
?>
<div class="accion-centralizada-variable-ejecucion-variable">

    <h1><?= Html::encode($this->title) ?></h1>
   

    
    <?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $model,
       // 'filterModel' => $searchModel,
        'columns' => [
           
            [
             'attribute'=>'nombre',
             
             'contentOptions' => 
                [
                'style'=>'max-width: 250px;  word-wrap: break-word;
                white-space: normal;'
                ],

             'format' => 'raw',
             
             ],
             [
             'attribute' => 'nombre_estado',
             'label'=>'Estado',
              'contentOptions'=>['style'=>'word-wrap:break-word; width:220px;'],

             'format' => 'raw',
             'value'=>function ($data) {
                    
                return Html::a($data['nombre_estados'], ['accion-centralizada-variable-ejecucion/create', 'id' =>$data['id_variable'], 'id_localizacion' => $data['id']]);
                        
                       
                 },
             ],
            
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['variables'], ['class' => 'btn btn-primary']) ?>        
</div>