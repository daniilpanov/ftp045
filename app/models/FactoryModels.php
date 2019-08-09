<?php

namespace app\models;


class FactoryModels
{
    private static $models;

    public static function createModel(string $modelname, $params=[])
    {
        try
        {
            $reflection = new \ReflectionClass(
                "\\app\\models\\" . $modelname
            );

            $model = $reflection->newInstanceArgs($params);

            if ($id = $model->getID())
            {
                self::$models[$modelname][$model->getID()] = $model;
            }
            else
            {
                self::$models[$modelname]['withoutID'][] = $model;
            }

            return $model;
        }
        catch (\ReflectionException $e)
        {
            return null;
        }
    }

    public static function createModelByID(string $modelname, $id)
    {
        $model_namespace = "\\app\\models\\" . $modelname;
        return self::$models[$modelname][$id] = new $model_namespace($id);
    }

    public static function search(string $modelname, $id=null): self
    {
        return new self($modelname, $id);
    }

    private $params = [];
    private $name = "";
    private $id = null;

    private function __construct(string $modelname, $id)
    {
        $this->name = $modelname;
        $this->id = $id;
    }

    public function set($key, $value): self
    {
        $this->params[$key] = $value;

        return $this;
    }

    public function __call($name, $args)
    {
        if (
            !method_exists($this, $name)
            && count($args) == 1
        )
        {
            return $this->set(mb_strtolower($name), $args[0]);
        }
    }

    public function getModel()
    {
        if (isset(self::$models[$this->name]))
        {
            $needle_models = &self::$models[$this->name];

            if ($this->id === null)
            {
                $models = &$needle_models['withoutID'];

                foreach ($models as $model)
                {
                    if ($model->check($this->params))
                    {
                        return $model;
                    }
                }
            }
            elseif (isset($needle_models[$this->id]))
            {
                if (($model = &$needle_models[$this->id])->check($this->params))
                {
                    return $model;
                }
            }
        }

        return null;
    }
}