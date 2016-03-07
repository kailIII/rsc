<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\BulkButtonWidget;
use johnitvn\ajaxcrud\CrudAsset;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionCentralizadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizadas';
$this->params['breadcrumbs'][] = $this->title;
//Iconos



$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'importar'=>'<span class="glyphicon glyphicon-import" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
CrudAsset::register($this);
?>
<div class="accion-centralizada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
       
        
    
<div id="ajaxCrudDatatable">
    <?= GridView::widget([
        'id'=>'crud-datatable',
         'pjax'=>true,
          'pjaxSettings' => [
            'options' => [
                'id' => 'especifica-pjax',
            ],],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
        'class' => 'kartik\grid\CheckboxColumn',

        'width' => '20px',
    ],
            ['class' => 'kartik\grid\SerialColumn'],

        
            'codigo_accion',
            'codigo_accion_sne',
            'nombre_accion',
            'fecha_inicio',
            'fecha_fin',


            [
    'class' => '\kartik\grid\DataColumn',
        'width' => '50px',
        'attribute' => 'estatus',
        
        'value' => function ($model) {$url= Url::to(['accion-centralizada/toggle-activo', 'id' => $model->id]);
            if ($model->estatus == 1) {

                
                return Html::a($model->nombreEstatus, ['/accion-centralizada/toggle-activo', 'id' => $model->id],[
                            /*'class' => 'btn btn-xs btn-success btn-block',
                             'role' => 'modal-remote',
                            
                            //'data-pjax' => true,
                            
                            'pjax-container'=>'especifica-pjax',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'id' => 'bulk-status',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
                            'data-request-method' => 'post',
                            'data-pjax' => '0',
                          */'class' => 'btn btn-xs btn-success btn-block',
                            'onclick' => "
                                if (confirm('¿Está seguro que desea Desactivar este elemento?')) {
                                $.ajax('$url', {
                                type: 'POST'
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                ",
                                
                

                            ]);
            } else { 
                return Html::a($model->nombreEstatus, ['/accion-centralizada/toggle-activo', 'id' => $model->id],
                           
                             [
                            'class' => 'btn btn-xs btn-warning btn-block',
                            'onclick' => "
                                if (confirm('¿Está seguro que desea activar este elemento?')) {
                                $.ajax('$url', {
                                type: 'POST'
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                ",
                                
                ]);
            }
        },
         'format' => 'raw'

         ],

            ['class' => 'kartik\grid\ActionColumn',
            'dropdown' => false,
                    'vAlign'=>'middle',
                    'urlCreator' => function($action, $model, $key, $index) { 
                            return Url::to([$action,'id'=>$key]);
                    },
             'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                                      'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                      'data-request-method'=>'post',
                                      'data-toggle'=>'tooltip',
                                      'data-confirm-title'=>'Are you sure?',
                                      'data-confirm-message'=>'Are you sure want to delete this item',
                                      'class' => 'text-danger'], 
            ],
        ],




          'toolbar'=> [
                [ 
                'content'=>                  
                    Html::a($icons['crear'].' Crear Accion Centralizada', ['create'], ['class' => 'btn btn-success']).
                    '{toggleData}'.
                    '{export}'.
                    Html::a($icons['importar'].' Importar', ['importar'],
                    ['title'=> 'Importar Acciones Centralizadas','class'=>'btn btn-default'])
                ],
            ],     

        'panel' => [
             

            'type' => 'info', 
            'heading' => '<i class="glyphicon glyphicon-list"></i> Proyecto Accion Especificas listing',
            'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
            'after'=>BulkButtonWidget::widget([
                            'buttons'=>
                            
                                Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Eliminar',
                                ["bulkEstatus"] ,
                                
                                ['class' => "btn btn-danger btn-xs",
                                'onclick' => "
                                 var HotId = $(\"#crud-datatable\").yiiGridView(\"getSelectedRows\");
                                    
                                    if(HotId==''){
                                        alert('Error, Debe Seleccionar Algun Elemento');
                                        return false;
                                    }
                                if (confirm('¿Está seguro que desea Eliminar este elemento?(Se Borrará Todos Los Elementos Asociados A El)')) {
                                   
                                $.ajax({
                                type: 'POST',
                                url : \"index.php?r=accion-centralizada/bulk-delete\",
                                data : {pks: HotId},
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                "
                                ]).' '.
                                 Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Desactivar',
                                ["bulkEstatus"] ,
                                
                                ['class' => "btn btn-warning btn-xs",
                                'onclick' => "
                                 var HotId = $(\"#crud-datatable\").yiiGridView(\"getSelectedRows\");
                                    
                                    if(HotId==''){
                                        alert('Error, Debe Seleccionar Algun Elemento');
                                        return false;
                                    }
                                if (confirm('¿Está seguro que desea Desactivar este elemento?')) {
                                   
                                $.ajax({
                                type: 'POST',
                                url : \"index.php?r=accion-centralizada/bulk-estatusdesactivo\",
                                data : {pks: HotId},
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                "
                                ]).' '.
                                Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Activar',
                                ["bulkEstatus"] ,
                                
                                ['class' => 'btn btn-success btn-xs',
                                'onclick' => "
                                 var HotId = $(\"#crud-datatable\").yiiGridView(\"getSelectedRows\");
                                    
                                    if(HotId==''){
                                        alert('Error, Debe Seleccionar Algun Elemento');
                                        return false;
                                    }
                                if (confirm('¿Está seguro que desea Activar este elemento?')) {
                                   
                                $.ajax({
                                type: 'POST',
                                url : \"index.php?r=accion-centralizada/bulk-estatusactivo\",
                                data : {pks: HotId},
                                }).done(function(data) {
                                $.pjax.reload({container: '#especifica-pjax'});
                                });
                                }
                                return false;
                                "]),
                                ]).                        
                        '<div class="clearfix"></div>',
            ]

    ]); ?>

</div>
<div class="btn-group">
        <?= Html::a($icons['volver'].' Volver', ['site/configuracion'], ['class' => 'btn btn-primary']) ?>
    </div>

</div>
<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
