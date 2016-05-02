<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accion_centralizada".
 *
 * @property integer $id
 * @property string $codigo_accion
 * @property string $codigo_accion_sne
 * @property string $nombre_accion
 * @property integer $estatus
 * @property integer $aprobado
 * @property string $fecha_inicio
 * @property string $fecha_fin
 *
 * @property AcVariable[] $acVariables
 */
class AccionCentralizada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada';
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
            [['codigo_accion', 'codigo_accion_sne'],'unique'],
            [['aprobado'], 'integer'],
            [['codigo_accion', 'codigo_accion_sne', 'nombre_accion', 'estatus', 'fecha_inicio', 'fecha_fin'], 'required'],
            //[['fecha_inicio', 'fecha_fin'], 'date', 'format'=>'Y-m-d'],
            //['fecha_inicio', 'compare', 'compareAttribute'=>'fecha_fin','operator'=>'<', 'message'=>'Fecha Inicial Debe Ser Menor A Fecha Final'],
            [['codigo_accion', 'codigo_accion_sne'], 'string', 'max' => 45],
            ['fecha_inicio', 'formato_fecha'],
            ['fecha_fin', 'formato_fecha'],
        ];
    }


    /**
     * @param string $attribute
     * @param array $params
     */
    public function formato_fecha($attribute,$params)
    {

        switch ($attribute) {
            case 'fecha_inicio':
                
            if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->fecha_inicio))
                    {
                        $this->addError($attribute, "El Formato De Fecha Debe Ser 'dd/mm/yyyy' ");
                        //$mensaje="El Formato De Fecha Debe Ser 'dd/mm/yyyy' ";
                    }else{
                      
                      

                      $date = explode('/', $this->fecha_inicio);
                      $this->fecha_inicio=$date[2]."/".$date[1]."/".$date[0];
                      
                      //validando rango
                      $date = explode('/', $this->fecha_fin);
                      $fecha2=$date[2]."/".$date[1]."/".$date[0];
                      $fecha1 = new \DateTime($this->fecha_inicio);
                      $fecha2 = new \DateTime($fecha2);
                    if($fecha1>$fecha2)
                        $this->addError($attribute, "Fecha Inicio Debe Ser Menor A Fecha Fin ");

                    }


                break;

                case  'fecha_fin':

                if(!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->fecha_fin))
            {
                         $this->addError($attribute, "El Formato De Fecha Debe Ser 'dd/mm/yyyy' ");
                        
                    }else{
                      $date = explode('/', $this->fecha_fin);
                      $this->fecha_fin=$date[2]."/".$date[1]."/".$date[0];
                     
                      
                    }

            break;
            default:
            
                break;
        }
  
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo_accion' => 'Codigo Accion',
            'codigo_accion_sne' => 'Codigo Accion SNE',
            'nombre_accion' => 'Nombre Accion',
            'estatus' => 'Estatus',
            'aprobado' => 'Aprobado',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
             'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVariables()
    {
        return $this->hasMany(AcVariable::className(), ['id_ac' => 'id']);
    }

        public   function getnombreEstatus(){
                              return ($this->estatus == 1)? 'Activo':'Inactivo';
                      }





        public function desactivar()
    {
        $this->estatus = 0;
        $this->save(false);
    }

     /**
     * Colocar estatus en 1 "Activo"
     */
     public function activar()
     {
        $this->estatus = 1;
        $this->save(false);
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

      public function toggleAprobado()
     {
        if($this->aprobado == 1)
        {
            $this->aprobado = 0;
        }
        else
        {
            $this->aprobado = 1;
        }
         //solo en caso de modelos q tengan fecha
        $this->fecha_inicio = date_create($this->fecha_inicio);
        $this->fecha_fin = date_create($this->fecha_fin);

        $this->fecha_inicio=date_format($this->fecha_inicio, 'd/m/Y');
        $this->fecha_fin=date_format($this->fecha_fin, 'd/m/Y');
        
        $this->save();

        
        

        return true;
     }

     public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            //Cambiar el formato de las fechas
            $formato = 'd/m/Y';
            $inicio = date_create_from_format($formato,$this->fecha_inicio);
            $fin = date_create_from_format($formato,$this->fecha_fin);

            if($inicio != false)
            {
                $this->fecha_inicio = date_format($inicio,'Y-m-d');
            }
            
            if($fin != false) 
            {
                $this->fecha_fin = date_format($fin,'Y-m-d');
            }
            
            return true;
        } else {
            return false;
        }
    }

}
