<?php

namespace common\models;

use Yii;
use johnitvn\userplus\base\models\UserAccounts;

/**
 * This is the model class for table "proyecto_usuario_asignar".
 *
 * @property integer $id
 * @property integer $usuario_id
 * @property integer $proyecto_especifica
 * @property integer $estatus
 *
 * @property ProyectoPedido[] $proyectoPedidos
 * @property UserAccounts $usuario
 * @property ProyectoAccionEspecifica $proyectoEspecifica
 */
class ProyectoUsuarioAsignar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_usuario_asignar';
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
            [['usuario_id', 'proyecto_id', 'accion_especifica_id', 'estatus'], 'required'],
            [['usuario_id', 'proyecto_id', 'accion_especifica_id', 'estatus'], 'integer'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'proyecto_id' => 'Proyecto',
            'accion_especifica_id' => 'Acción Específica',
            'estatus' => 'Estatus',
            'nombreProyecto' => 'Proyecto',
            'nombreEspecifica' => 'Acción Específica',
            'nombreUsuario' => 'Usuario',
            'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoPedidos()
    {
        return $this->hasMany(ProyectoPedido::className(), ['asignado' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'usuario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'proyecto_id']);
    }

    /**
     * El nombre del proyecto.
     * @return null | string Nombre del proyecto
     */
    public function getNombreProyecto()
    {
        if($this->proyecto == null)
        {
            return null;
        }

        return $this->proyecto->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoEspecifica()
    {
        return $this->hasOne(ProyectoAccionEspecifica::className(), ['id' => 'accion_especifica_id']);
    }

    /**
     * @return string
     */
    public function getNombreEspecifica()
    {
        if($this->proyectoEspecifica == null)
        {
            return null;
        }

        return $this->proyectoEspecifica->nombre;
    }

    /**
     * @return string
     */
    public function getNombreUsuario()
    {
        if($this->usuario_id == null)
        {
            return null;
        }

        return $this->usuario->username;
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
     * Verificar el estatus de aprobacion del proyecto.
     * @return int Aprobacion
     */
    public function getAprobado()
    {
        return $this->proyectoEspecifica->idProyecto->aprobado;
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
