<?php

namespace backend\models;

use Yii;
use common\models\Pais;
use common\models\Estados;
use common\models\Municipio;
use common\models\Parroquia;
use common\models\AccionCentralizadaVariableProgramacion;

/**
 * This is the model class for table "localizacion_acc_variable".
 *
 * @property integer $id
 * @property integer $id_variable
 * @property integer $id_pais
 * @property integer $id_estado
 * @property integer $id_municipio
 * @property integer $id_parroquia
 *
 * @property Estados $idEstado
 * @property AccionCentralizadaVariables $idVariable
 * @property Municipio $idMunicipio
 * @property Pais $idPais
 * @property Parroquia $idParroquia
 */
class LocalizacionAccVariable extends \yii\db\ActiveRecord
{


     //Escenarios
    const SCENARIO_INTERNACIONAL = 'Internacional';
    const SCENARIO_NACIONAL = 'Nacional';
    const SCENARIO_ESTADAL = 'Estadal';
    const SCENARIO_MUNICIPAL = 'Municipal';
    const SCENARIO_PARROQUIAL = 'Parroquial';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'localizacion_acc_variable';
    }


     public function scenarios()
    {
        return [
            self::SCENARIO_INTERNACIONAL => ['id_variable', 'id_pais'],
            self::SCENARIO_NACIONAL => ['id_variable', 'id_pais'],
            self::SCENARIO_ESTADAL => ['id_variable', 'id_pais', 'id_estado'],
            self::SCENARIO_MUNICIPAL => ['id_variable', 'id_pais', 'id_estado', 'id_municipio'],
            self::SCENARIO_PARROQUIAL => ['id_variable', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'],
        ];
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_variable', 'id_pais'], 'required'],
            [['id_variable', 'id_pais'], 'integer'],

             //Escenarios
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_INTERNACIONAL],
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_NACIONAL],
            [[ 'id_pais'], 'com_nacional', 'on' => self::SCENARIO_NACIONAL],
            [[ 'id_estado'], 'com_estado', 'on' => self::SCENARIO_ESTADAL],
            [['id_proyecto', 'id_pais', 'id_estado'], 'required', 'on' => self::SCENARIO_ESTADAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio'], 'required', 'on' => self::SCENARIO_MUNICIPAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'required', 'on' => self::SCENARIO_PARROQUIAL],
        ];
    }


    /**
     * rules para escenario nacional
     * @param int $idpais
     * @return bool
     */
    function com_nacional($idpais)
    {
    if($this->isNewRecord)
    {
    $existe=LocalizacionAccVariable::find()->where(['id_variable' => $this->id_variable])->One();
    if($existe!=null && $this->idVariable->nombre_variable!=null)
    {
    $this->addError($idpais, "Error, Ya Se Agregó a Venezuela");
    }
    }

    }

    /**
     * rules para escenario estado
     * @param int $estado
     * @return bool
     */
    function com_estado($estado){

    if($this->isNewRecord)
    {
    $existe=LocalizacionAccVariable::find()->where(['id_variable' => $this->id_variable])->andWhere(['id_estado' => $this->id_estado])->One();
    
    if($existe!=null)
    {
    $this->addError($estado, "Error, Ya Se Agregó Este Estado");
    }
    }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_variable' => 'Id Variable',
            'id_pais' => 'Id Pais',
            'id_estado' => 'Id Estado',
            'id_municipio' => 'Id Municipio',
            'id_parroquia' => 'Id Parroquia',
            'nombrePais' => 'Pais',
            'nombreVariable' => 'Nombre Variable',
            'nombreEstado' => 'Estado'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado()
    {
        return $this->hasOne(Estados::className(), ['id' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVariable()
    {
        return $this->hasOne(AccionCentralizadaVariables::className(), ['id' => 'id_variable']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['id' => 'id_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPais()
    {
        return $this->hasOne(Pais::className(), ['id' => 'id_pais']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['id' => 'id_parroquia']);
    }


    /**
     * mostrasr nombre de la variable
     * @return string
     */
    public function getNombreVariable()
    {
        return $this->idVariable->nombre_variable;
    }

    /**
     * mostrasr nombre del pais
     * @return string
     */
     public function getNombrePais()
    {
        return $this->idPais->nombre;
    }

    /**
     * mostrasr nombre del estado
     * @return string
     */
    public function getNombreEstado()
    {
        if($this->idEstado == null)
        {
            return null;
        }

        return $this->idEstado->nombre;
    }


    /**
     * mostrar si ya existe una ejecucion
     * @return bool
     */
    public function getObtener_Ejecucion(){
    
    $programacion_ejecucion=AccionCentralizadaVariableProgramacion::find()
    ->innerjoin('accion_centralizada_variable_ejecucion','accion_centralizada_variable_programacion.id=accion_centralizada_variable_ejecucion.id_programacion')
    ->where(['accion_centralizada_variable_programacion.id_localizacion' => $this->id])->one();

    if($programacion_ejecucion==NULL){
        return false;
    }else{
        return true;
    }
        

    }












}
