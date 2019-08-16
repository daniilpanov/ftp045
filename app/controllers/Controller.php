<?php

namespace app\controllers;

use app\models\Model;


abstract class Controller
{
    const SINGLE = "S", UPDATING = "F";

    public abstract static function getType(): string;

    /** @var Model[] $models */
    protected $models = [];

    public function getData($id=null, $item=null, $where=null, $key=null)
    {
        if ($key !== null)
            $models = &$this->models[$key];
        else
            $models = &$this->models;

        if ($id !== null)
        {
            foreach ($models as $model)
            {
                if ($id == $model->getID())
                {
                    return ($item !== null)
                        ? (is_array($item))
                            ? $this->getSelectedData($model, $item)
                            : $model->get($item)
                        : $model->getData();
                }
            }
        }
        else
        {
            $data = [];

            foreach ($this->models as $model)
            {
                $data[$model->getID()]
                    = ($item !== null)
                    ? (is_array($item))
                        ? $this->getSelectedData($model, $item)
                        : $model->get($item)
                    : $model->getData();
            }

            return $data;
        }

        return null;
    }

    private function getSelectedData(Model $model, array $items)
    {
        $data = [];

        foreach ($items as $item)
            $data[$item] = $model->get($item);

        return $data;
    }

    public abstract function getDataForView(string $viewname, $params=[]);
}