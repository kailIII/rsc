<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\AccionCentralizadaVariableEjecucion;

/**
 * AccionCentralizadaVariableEjecucionSearch represents the model behind the search form about `app\models\AccionCentralizadaVariableEjecucion`.
 */
class AccionCentralizadaVariableEjecucionSearch extends AccionCentralizadaVariableEjecucion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_programacion', 'id_usuario', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'], 'integer'],
            [['fecha'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AccionCentralizadaVariableEjecucion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_programacion' => $this->id_programacion,
            'id_usuario' => $this->id_usuario,
            'fecha' => $this->fecha,
            'enero' => $this->enero,
            'febrero' => $this->febrero,
            'marzo' => $this->marzo,
            'abril' => $this->abril,
            'mayo' => $this->mayo,
            'junio' => $this->junio,
            'julio' => $this->julio,
            'agosto' => $this->agosto,
            'septiembre' => $this->septiembre,
            'octubre' => $this->octubre,
            'noviembre' => $this->noviembre,
            'diciembre' => $this->diciembre,
        ]);

        return $dataProvider;
    }
}
