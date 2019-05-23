<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Pesan]].
 *
 * @see Pesan
 */
class PesanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Pesan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Pesan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
