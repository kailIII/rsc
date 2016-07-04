<?php

namespace common\models;

use Yii;
use johnitvn\userplus\base\models\UserAccounts;

/**
 * This is the model class for table "proyecto_asignar".
 *
 * @property integer $id
 * @property integer $usuario
 * @property integer $unidad_ejecutora
 * @property integer $accion_especifica
 * @property integer $estatus
 *
 * @property UserAccounts $usuario0
 * @property UnidadEjecutora $unidadEjecutora
 * @property ProyectoAccionEspecifica $accionEspecifica
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
            [['usuario', 'unidad_ejecutora', 'accion_especifica', 'estatus'], 'required'],
            [['usuario', 'unidad_ejecutora', 'accion_especifica', 'estatus'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario' => 'Usuario',
            'unidad_ejecutora' => 'Unidad Ejecutora',
            'accion_especifica' => 'Accion Especifica',
            'estatus' => 'Estatus',
            'nombreUe' => 'Unidad Ejecutora',
            'nombreAe' => 'Acción Específica',
            'nombreEstatus' => 'Estatus'
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getAccionCentralizada()
    {
        $nombre= $this->accionEspecifica->idAcCentr->nombre_accion;
        return $nombre;//$this->hasOne(AcAcEspec::className(), ['id' => 'accion_especifica']);
    }
    public function getAccionEspecifica()
    {
        return $this->hasOne(AcAcEspec::className(), ['id' => 'accion_especifica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadEjecutora()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'unidad_ejecutora']);
    }

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
        if($this->unidadEjecutora == null)
        {
            return null;
        }

        return $this->unidadEjecutora->nombre;
    }

    /**
     * @return string
     */
    public function getNombreAe()
    {
        if($this->accionEspecifica == null)
        {
            return null;
        }

        return $this->accionEspecifica->nombre;
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
}
