<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PesanPerproyek]].
 *
 * @see PesanPerproyek
 */
class PesanPerproyekQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PesanPerproyek[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PesanPerproyek|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
