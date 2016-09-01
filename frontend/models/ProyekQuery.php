<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Proyek]].
 *
 * @see Proyek
 */
class ProyekQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Proyek[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Proyek|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
