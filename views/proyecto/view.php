<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\tabs\TabsX; //plugin
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Contenido de TABS
$datos_basicos = Yii::$app->controller->renderPartial('_datos-basicos',[
    'model' => $model,
    'estrategico' => $estrategico,
    'nacional' => $nacional,
    'historico' => $historico,
    'localizacion' => $localizacion,
]);
$alcanceImpacto = 
    '<p>'.
    Html::a('Agregar', ['proyecto-alcance/create', 'proyecto' => $model->id], ['class' => 'btn btn-primary']).
    '</p>'.
    '<div class="well">No hay datos.</div>'
;
$accionesEspecificas = 
    '<p>'.
    Html::a('Agregar', ['proyecto-accion-especifica/create', 'proyecto' => $model->id], ['class' => 'btn btn-primary']).
    '</p>'.
    '<div class="well">No hay datos.</div>'
;
$distribucionPresupuestaria = 
    '<p>'.
    Html::a('Agregar', ['proyecto-dsitribucion-presupuestaria/create', 'proyecto' => $model->id], ['class' => 'btn btn-primary']).
    '</p>'.
    '<div class="well">No hay datos.</div>'
;
$fuenteFinanciamiento = 
    '<p>'.
    Html::a('Agregar', ['proyecto-fuente-financiamiento/create', 'proyecto' => $model->id], ['class' => 'btn btn-primary']).
    '</p>'.
    '<div class="well">No hay datos.</div>'
;

?>
<div class="proyecto-view">

    <h1>Proyecto #<?= Html::encode($this->title) ?></h1>

    <!-- TABS -->
    <?= TabsX::widget([
        'options' => [
            'class' => 'nav-justified',
        ],
        'items' => [
            [
                'label' => 'Datos Básicos',
                'content' =>$datos_basicos,
                'active' => true,
            ],
            [
                'label' => 'Alcance e Impacto',
                'content' => $alcanceImpacto,
                'linkOptions' => [
                    'data-url' => $model->alcance == null ? '' : Url::to(['proyecto-alcance/view', 'id' => $model->alcance->id]),
                ],
            ],
            [
                'label' => 'Acciones Específicas',
                'content' => $accionesEspecificas,
                'linkOptions' => [
                    'data-url' => '',
                ],
            ],
            [
                'label' => 'Distribución Presupuestaria',
                'content' => $distribucionPresupuestaria,
                'linkOptions' => [
                    'data-url' => '',
                ],
            ],
            [
                'label' => 'Fuentes de Financiamiento',
                'content' => $fuenteFinanciamiento,
                'linkOptions' => [
                    'data-url' => '',
                ],
            ],
        ]
    ]) ?>
    
    

</div>

<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>