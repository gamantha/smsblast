<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyek".
 *
 * @property integer $id
 * @property string $nama_proyek
 *
 * @property Customer[] $customers
 */
class Proyek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_proyek'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_proyek' => 'Nama Proyek',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['proyek_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProyekQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProyekQuery(get_called_class());
    }
}
