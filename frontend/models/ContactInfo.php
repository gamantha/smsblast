<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact_info".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $sms
 * @property string $email
 * @property string $address
 *
 * @property Customer $customer
 */
class ContactInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id'], 'integer'],
            [['sms', 'email', 'address'], 'string', 'max' => 255],
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
            'sms' => 'Sms',
            'email' => 'Email',
            'address' => 'Address',
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
     * @return ContactInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactInfoQuery(get_called_class());
    }
}
