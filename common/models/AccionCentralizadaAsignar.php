<?php

namespace common\models;
//use frontend\models\AcEspUej;

use Yii;
use johnitvn\userplus\base\models\UserAccounts;

/**
 * This is the model class for table "accion_centralizada_asignar".
 *
 * @property integer $id
 * @property integer $usuario
 * @property integer $accion_especifica_ue
 * @property integer $estatus
 *
 * @property UserAccounts $usuario0
 * @property AcEspUej $accion_especifica_ue0
 * @property accion_centralizada_ac_especifica_uej
 */
class AccionCentralizadaAsignar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada_asignar';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'accion_especifica_ue', 'estatus'], 'required'],
            [['usuario',  'estatus'], 'integer'],
            ['usuario', 'unique', 'targetAttribute' => ['usuario', 'accion_especifica_ue'], 'message' => 'Error, Este usuario ya fue asignado a esta acción-unidad'],
            //[['usuario','accion_especifica_ue'], 'unique', 'targetAttribute' => ['estatus'], 'message' => 'Error, Este usuario ya fue asignado a esta acción-unidad'],

        ];
    }

    /* public function verificar_repetido($attribute){

        if($this->usuario)
             $this->addError($attribute, 'Error, Necesita Cargar Al Menos Una Cantidad Positiva En Uno De Los Meses');

    }*/


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario' => 'Usuario',
            'accion_especifica_ue' => 'ID Acción-Unidad',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus'
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getAccionCentralizada()
    {
        $nombre= $this->accion_especifica_ue0->idAccionEspecifica->idAcCentr->nombre_accion;
        return $nombre;
    }
    public function getAccionEspecifica()
    {
        return $this->accion_especifica_ue0->idAccionEspecifica->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'usuario']);
    }

    public function getaccion_centralizada_ac_especifica_uej(){

         return $this->hasOne(AcEspUej::className(), ['id' => 'accion_especifica_ue']);

    }

    public function getAccion_especifica_ue0()
    {
        return $this->hasOne(AcEspUej::className(), ['id' => 'accion_especifica_ue']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    

    /**
     * @return string
     */
    public function getNombreUsuario()
    {
        if($this->usuario0 == null)
        {
            return null;
        }

        return $this->usuario0->username;
    }

    /**
     * @return string
     */
    public function getNombreUe()
    {   
        if($this->accion_especifica_ue0->idUe->nombre == null)
        {
            return null;
        }

        return $this->accion_especifica_ue0->idUe->nombre;
    }

    /**
     * @return string
     */
    public function getNombreAe()
    {
        if($this->accion_especifica_ue0->idAccionEspecifica->nombre == null)
        {
            return null;
        }

        return $this->accion_especifica_ue0->idAccionEspecifica->nombre;;
    }

    /**
     * @return string
     */
    public function getNombreEstatus()
    {
        
        if($this->estatus === 1)
        {
            return 'Activo';
        }

        return 'Inactivo';

    }

    /**
     * Colocar estatus en 0 "Inactivo"
     */
    public function desactivar()
    {
        $this->estatus = 0;
        $this->save();
        
    }

     /**
     * Colocar estatus en 1 "Activo"
     */
     public function activar()
     {
        $this->estatus = 1;
        $this->save();
     }

     /**
      * Activar o desactivar
      */
     public function toggleActivo()
     {
        if($this->estatus == 1)
        {
            $this->desactivar();
        }
        else
        {
            $this->activar();
        }

        return true;
     }

     public function requerimiento_pendiente($user){

        $model=AccionCentralizadaAsignar::find()->where(['usuario' => $user])->All();
        
        if($model!=null){
        $bandera=0;
        foreach ($model as $key => $value) {
        if($value->accion_centralizada_ac_especifica_uej->aprobado==0){
            return true;
        }
        }//fin del for
        return false;
    }//fin del if
    }

    



}
