<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use machour\yii2\notifications\widgets\NotificationsWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script type="text/javascript">
    
    function feedback(id){

      $.getJSON('/rsc/backend/web/index.php?r=feedback/find&id='+id, function(data)
      {
        $("#modalContent").html('<img src="'+ data.img +'" />');
        $("#mensaje").html('<p align="center">'+ data.mensaje +'</p>');
        $('#grading-sys-modal').modal('show');


      });
        
    }
    </script>
</head>
<?php
    NotificationsWidget::widget([
        'theme' => NotificationsWidget::THEME_GROWL,
        'pollInterval' => 10000,
        'clientOptions' => [
            'location' => 'es',
        ],
        'counters' => [
            '.notifications-header-count',
            '.notifications-icon-count'
        ],
        'listSelector' => '#notifications',
        //Template para las notificaciones
        'listItemTemplate' => '
            <div class="row">
                <div class="col-xs-10">
                    <div class="title">{title}</div>
                    <small>{description}</small>
                    <div class="timeago">
                        <div class="notification-timeago">{timeago}</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="actions pull-right">
                        <span class="notification-seen fa fa-check" title="Marcar como visto"></span>
                        <span class="notification-delete fa fa-close" title="Eliminar notificación"></span>
                    </div>
                </div>
            </div>'
        
    ]);
?>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Roraima',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    /**
     * Iconos del menu
     */
    $icons=[
        'inicio'=>'<span class="glyphicon glyphicon-home" aria-hidden="true"></span>',
        'proyecto'=>'<span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span>',
        'acc'=>'<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>',
        'config'=>'<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>',
        'entrar'=>'<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>',
        'salir'=>'<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>',
        'pedido'=>'<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>',
        'asignar'=>'<span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>',
        'variable' =>'<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>',
    ];
    /*
     * Widget del menu
     */
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels'=>false,
        'items' => require(__DIR__.'/_items.php'),
    ]);

    NavBar::end();
    ?>
    <div class="container">
        <!-- Miga de pan o Hilo de Ariadna -->
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Inicio', 'url' => ['/site/index']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MINPPPST <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php
  yii\bootstrap\Modal::begin([
    'id'=>'grading-sys-modal', 
    'header' => '<h2>Detalle de la Observaci&oacute;n</h2>',
    'size' => 'modal-lg',
    'closeButton' => ['id' => 'close-button'],
    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]),
  ]);
   echo 
    "
        <div id='modalContent' style='overflow: scroll';>
            <img id='imgFromScript' style='max-width: auto;' src='#'  alt=''/>
        </div>
        <h3><p align='center'>Observaci&oacute;n</p></h3>
        <div id='mensaje'></div>
    ";
   yii\bootstrap\Modal::end();
?>
