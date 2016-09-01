<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pesan".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $isi_pesan
 * @property string $status
 *
 * @property Customer $customer
 */
class Pesan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pesan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id'], 'integer'],
            [['status'], 'string'],
            [['isi_pesan'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'isi_pesan' => 'Isi Pesan',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    
    

    /**
     * @inheritdoc
     * @return PesanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PesanQuery(get_called_class());
    }
}
