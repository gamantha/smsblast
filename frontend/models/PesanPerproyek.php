<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pesan_perproyek".
 *
 * @property integer $id
 * @property integer $proyek_id
 * @property string $isi_pesan
 * @property string $status
 *
 * @property Proyek $proyek
 */
class PesanPerproyek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pesan_perproyek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proyek_id'], 'integer'],
            [['isi_pesan', 'status'], 'string'],
            [['proyek_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proyek::className(), 'targetAttribute' => ['proyek_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'proyek_id' => Yii::t('app', 'Proyek ID'),
            'isi_pesan' => Yii::t('app', 'Isi Pesan'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyek()
    {
        return $this->hasOne(Proyek::className(), ['id' => 'proyek_id']);
    }

    /**
     * @inheritdoc
     * @return PesanPerproyekQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PesanPerproyekQuery(get_called_class());
    }
}
