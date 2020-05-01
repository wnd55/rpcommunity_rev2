<?php

namespace frontend\widgets\grid;

use yii\grid\DataColumn;
use yii\grid\GridView;

class MetersDataColumn extends DataColumn

{



    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content === 0) {

            unset($grid);

        }
    }


}