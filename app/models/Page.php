<?php

namespace app\models;


use dbtools\Query;

class Page extends Model
{
    public function __construct($id)
    {
        $this->setData(Query::select("*", "pages")->where("id", $id)->getResult());
    }
}