<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $nama
 * @property integer $proyek_id
 *
 * @property ContactInfo[] $contactInfos
 * @property Proyek $proyek
 * @property Pesan[] $pesans
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proyek_id'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['proyek_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proyek::className(), 'targetAttribute' => ['proyek_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'proyek_id' => 'Proyek ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactInfos()
    {
        return $this->hasMany(ContactInfo::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyek()
    {
        return $this->hasOne(Proyek::className(), ['id' => 'proyek_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesans()
    {
        return $this->hasMany(Pesan::className(), ['customer_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }
}
