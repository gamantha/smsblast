<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_account".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $bank_name
 * @property string $virtual_account_number
 *
 * @property Customer $customer
 */
class BankAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'bank_name', 'virtual_account_number'], 'required'],
            [['customer_id'], 'integer'],
            [['bank_name', 'virtual_account_number'], 'string', 'max' => 255],
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
            'bank_name' => 'Bank Name',
            'virtual_account_number' => 'Virtual Account Number',
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
     * @return BankAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BankAccountQuery(get_called_class());
    }
}
