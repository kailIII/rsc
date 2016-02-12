<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ac_ac_espec".
 *
 * @property integer $id
 * @property integer $id_ac_centr
 * @property string $cod_ac_espe
 * @property string $nombre
 *
 * @property AccionCentralizada $idAcCentr
 * @property AcVariable[] $acVariables
 */
class AcAcEspec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ac_ac_espec';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ac_centr', 'cod_ac_espe', 'nombre'], 'required'],
            [['id_ac_centr'], 'integer'],
            [['nombre'], 'string'],
            [['cod_ac_espe'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ac_centr' => 'Id Accion Centralizada',
            'cod_ac_espe' => 'Cod. Accion Especifica',
            'nombre' => 'Nombre Accion Especifica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcCentr()
    {
        return $this->hasOne(AccionCentralizada::className(), ['id' => 'id_ac_centr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVariables()
    {
        return $this->hasMany(AcVariable::className(), ['id_ac_esp' => 'id']);
    }
}