<?php

namespace app\controllers;

use app\models\FactoryModels;
use dbtools\Query;


class Pages extends Controller
{
    private $max_id;
    private $current_id = 1;

    public function __construct()
    {
        $each_id = Query::select("id", "pages")->orderBy("id")->getResult();

        $this->max_id = end($each_id)['id'];

        $this->models
            = FactoryModels
            ::createModelsByAllID(
                "Page", "pages",
                $this->max_id, "position"
            );
    }

    public static function getType(): string
    {
        return parent::SINGLE;
    }

    public function setCurrentID(int $id)
    {

    }

    public function getDataForView(string $viewname, $params=[])
    {
        $data = [];
        $id = (isset($params['id'])) ? $params['id'] : $this->current_id;

        switch ($viewname)
        {
            case "menu":
                $data = $this->getData(null, ["id", "name", "type"]);
                break;
            case "content":
                $data = $this->getData($id, "content");
                break;
        }

        return $data;
    }
}