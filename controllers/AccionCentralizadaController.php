<?php
namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use app\models\AccionCentralizada;
use app\models\AccionCentralizadaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use app\models\UploadForm;
/**
 * AccionCentralizadaController implements the CRUD actions for AccionCentralizada model.
 */
class AccionCentralizadaController extends Controller
{
    public function behaviors()
    {
         return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                    'bulk-estatusactivo' => ['post'],
                    'bulk-estatusdesactivar' => ['post'],
                    
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule,$action)
                        {
                            $controller = Yii::$app->controller->id;
                            $action = Yii:: $app->controller->action->id;                    
                            $route = "$controller/$action";
                            if(\Yii::$app->user->can($route))
                            {
                                return true;
                            }
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all AccionCentralizada models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccionCentralizadaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccionCentralizada model.
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
     * Creates a new AccionCentralizada model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccionCentralizada();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AccionCentralizada model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AccionCentralizada model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   
         $request = Yii::$app->request;
        $this->findModel($id)->delete();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true];    
        }else{

        return $this->redirect(['index']);
    }

}
    /**
     * Finds the AccionCentralizada model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccionCentralizada the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccionCentralizada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }





public function actionImportar()
    {
        $request = Yii::$app->request;
        $modelo = new UploadForm();

        if($request->isPost)
        {
            $archivo = file($_FILES['UploadForm']['tmp_name']['importFile']);
            $mensaje="";
            $transaccion = AccionCentralizada::getDb()->beginTransaction();

            try
            {
                foreach ($archivo as $llave => $valor) 
                {
                    $exploded = explode(';', str_replace("'", '',$valor));

                    $ue = AccionCentralizada::find()
                        ->where(['codigo_accion' => $exploded[0]])
                        ->orwhere(['codigo_accion_sne'=>$exploded[1]])
                        ->one();

                    if($ue == null)
                    {
                        
                    $ue = new AccionCentralizada;
                   
                    }else{
                        $mensaje="Accion Ya Existe: Codigo Accion:".$exploded[0]." SNE:".$exploded[1];
                        $ue="";
                    }

                    $ue->codigo_accion= $exploded[0];
                    $ue->codigo_accion_sne=$exploded[1];
                    $ue->nombre_accion = $exploded[2];
                    $ue->estatus = 0;
                    $ue->save();

                   
                }
                
                $transaccion->commit();

                Yii::$app->session->setFlash('importado', '<div class="alert alert-success">Registros importados exitosamente.</div>');
                return $this->refresh();

            }catch(\Exception $e){
                $transaccion->rollBack();
                Yii::$app->session->setFlash('importado', '<div class="alert alert-danger">'.$mensaje.'</div>');
            }
                        
        }

        return $this->render('importar', [
            'modelo' => $modelo,
        ]);
    }



 public function actionToggleActivo($id) {
        $model = $this->findModel($id);

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model != null && $model->toggleActivo()) {
            return ['forceClose' => true, 'forceReload' => true];
        } else {
            return [
                'title' => 'Ocurrió un error.',
                'content' => '<span class="text-danger">No se pudo realizar la operación. Error desconocido</span>',
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
            ];
            return;
        }
    }



public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        
        
        foreach ($pks as $key) {
            
        
        //$model=AcAcEspec::findAll(json_decode($key));
            $model=$this->findModel($key);
            $model->delete();
        
        
        }
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true]; 
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['/accion_centralizada/index']);
        }
       
    }



    public function actionBulkEstatusactivo()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        
        
        foreach ($pks as $key) {
            
        
        //$model=AcAcEspec::findAll(json_decode($key));
            $model=$this->findModel($key);
            //$model->delete();
            $model->activar();
        
        
        }
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true]; 
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['/accion_centralizada/index']);
        }
       
    }



    public function actionBulkEstatusdesactivo()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        
        
        foreach ($pks as $key) {
            
        
        //$model=AcAcEspec::findAll(json_decode($key));
            $model=$this->findModel($key);
            //$model->delete();
            $model->desactivar();
        
        
        }
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true]; 
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['/accion_centralizada/index']);
        }
       
    }







}
