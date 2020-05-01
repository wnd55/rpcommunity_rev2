<?php
namespace frontend\widgets\grid;

use yii\widgets\DetailView;

class MetersDataDetailView extends DetailView
{

    protected function normalizeAttributes()
    {
        parent::normalizeAttributes();

        foreach ($this->attributes as $i => $attribute) {
            if ($attribute['value'] === null || $attribute['value'] === '' || $attribute['value'] === 0)
                unset($this->attributes[$i]);
        }
    }





}