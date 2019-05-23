<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ContactInfo]].
 *
 * @see ContactInfo
 */
class ContactInfoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ContactInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ContactInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
