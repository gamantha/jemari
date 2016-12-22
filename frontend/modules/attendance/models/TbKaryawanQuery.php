<?php

namespace app\modules\attendance\models;

/**
 * This is the ActiveQuery class for [[TbKaryawan]].
 *
 * @see TbKaryawan
 */
class TbKaryawanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TbKaryawan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TbKaryawan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
