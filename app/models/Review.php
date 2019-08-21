<?php

namespace app\models;

use dbtools\Query;


class Review extends Model
{
    public function __construct($id)
    {
        $this->setData(
            Query::select("*", "reviews")
                ->where("page", $id)
                ->and("visible", "1")
                ->getResult()
        );

        $this->id = $this->data;
    }

    public static function initSome($from, $to, $args = [])
    {

    }
}