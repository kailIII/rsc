<?php

namespace frontend\controllers;

use Yii;
use app\models\MaterialesServicios;
use app\models\MaterialesServiciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\PartidaPartida;
use app\models\PartidaGenerica;
use app\models\PartidaEspecifica;
use app\models\PartidaSubEspecifica;
use app\models\UnidadMedida;
use app\models\Presentacion;

/**
 * MaterialesServiciosController implements the CRUD actions for MaterialesServicios model.
 */
class MaterialesServiciosController extends \common\controllers\BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all MaterialesServicios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialesServiciosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaterialesServicios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MaterialesServicios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MaterialesServicios();
        //Desplegables
        $unidad_medida = UnidadMedida::find()->all();
        $presentacion = Presentacion::find()->all();
        //autocompletar
        $sub_especfica = PartidaSubEspecifica::find()
            ->select(['nombre as value', 'id as id'])
            ->asArray()
            ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'sub_especfica' => $sub_especfica,
                'unidad_medida' => $unidad_medida,
                'presentacion' => $presentacion
            ]);
        }
    }

    /**
     * Updates an existing MaterialesServicios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //Desplegables
        $unidad_medida = UnidadMedida::find()->all();
        $presentacion = Presentacion::find()->all();
        //autocompletar
        $sub_especfica = PartidaSubEspecifica::find()
            ->select(['nombre as value', 'id as id'])
            ->asArray()
            ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'sub_especfica' => $sub_especfica,
                'unidad_medida' => $unidad_medida,
                'presentacion' => $presentacion
            ]);
        }
    }

    /**
     * Deletes an existing MaterialesServicios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MaterialesServicios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MaterialesServicios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MaterialesServicios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
