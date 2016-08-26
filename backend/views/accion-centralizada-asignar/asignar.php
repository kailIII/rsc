<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;

$this->title = 'Asignar';
$this->params['breadcrumbs'][] = ['label' => 'Asignar Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
DepDropAsset::register($this);

//Iconos
$icons=[   
    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];

?>

<div class="accion-centralizada-asignar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-transfer"></i> Asignar', ['create', 'usuario' => $usuario->id],
                    ['role'=>'modal-remote','title'=> 'Accion Centralizada - Asignar','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['','usuario'=>$usuario->id],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<h4><i class="glyphicon glyphicon-user"></i> '.$usuario->username.'</h4>',
                'before'=>'<em>*Aquí van datos del usuario*</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar',
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Are you sure?',
                                    'data-confirm-message'=>'Are you sure want to delete this item'
                                ]).' '.
                            Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Desactivar',
                            ["bulk-desactivar"] ,
                            [
                                "class"=>"btn btn-warning btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'¿Está seguro?',
                                'data-confirm-message'=>'¿Está seguro que desea desactivar los elementos seleccionados?'
                            ]).' '.
                        Html::a('<i class="glyphicon glyphicon-ok-circle"></i>&nbsp; Activar',
                            ["bulk-activar"] ,
                            [
                                "class"=>"btn btn-success btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'¿Está seguro?',
                                'data-confirm-message'=>'¿Está seguro que desea activar los elementos seleccionados?'
                            ]),
                        ]).                       
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['index'], ['class' => 'btn btn-primary']) ?>        
</div>