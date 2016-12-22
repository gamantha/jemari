<?php

namespace app\modules\attendance\models;

/**
 * This is the ActiveQuery class for [[KeyValueMap]].
 *
 * @see KeyValueMap
 */
class KeyValueMapQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return KeyValueMap[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return KeyValueMap|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
