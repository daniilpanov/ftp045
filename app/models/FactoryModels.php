<?php

namespace app\models;


use dbtools\Query;

class FactoryModels
{
    // Все модели
    private static $models;

    /**
     * @return mixed
     */
    public static function getModels()
    {
        return self::$models;
    }

    /**
     * Создание моделей
     * @param string $modelname
     * @param array|mixed $params
     * @return Model|null
     */
    public static function createModel(string $modelname, $params=[])
    {
        // Пробуем создать объект для реализации рефлексий для модели
        try
        {
            // Создаём
            $reflection = new \ReflectionClass(
                "\\app\\models\\" . $modelname
            );

            // С помощью рекурсии создаём объект модели и передаём аргументы в конструктор
            $model = $reflection->newInstanceArgs($params);
            // Если у модели есть ID
            if ($id = $model->getID())
            {
                // помещаем её в массив с моделями такого же типа с ID в качестве ключа
                self::$models[$modelname][$model->getID()] = $model;
            }
            // Иначе
            else
            {
                // помещаем её в массив моделей такого же типа, но без ID
                self::$models['withoutID'][$modelname][] = $model;
            }

            // Возвращаем модель
            return $model;
        }
        // Если не получилось - возвращаем null
        catch (\ReflectionException $e)
        {
            return null;
        }
    }

    /**
     * Создание модели и передача в её конструктор только ID
     * @param string $modelname
     * @param $id
     * @return Model
     */
    public static function createModelByID(string $modelname, $id)
    {
        $model_namespace = "\\app\\models\\" . $modelname;
        return self::$models[$modelname][$id] = new $model_namespace($id);
    }

    /**
     * Создание ряда моделей.
     * Модель создаётся, без вызова конструктора,
     * далее посылается запрос в БД, запрашивающий
     * все поля из указанной таблицы, где id меньше, или равно указанному.
     * Далее полю c ID созданной модели рефлексивно присваивается
     * значение из ответа от БД, а после полю 'data' созданной модели
     * присваивается весь ответ от БД.
     *
     * @param string $modelname
     * @param string $table
     * @param int $max_id
     * @param string|null $order_by
     * @param string $how
     * @return Model[]|null
     */
    public static function createModelsByAllID(
        string $modelname, string $table, int $max_id,
        $order_by=null, $how="asc"
    )
    {
        // Пробуем
        try
        {
            // создать класс для реализации рефлексии
            $ref = new \ReflectionClass("\\app\\models\\" . $modelname);
            // Если всё получилось - идём дальше!
            // Вот и запрос к БД:
            // сначала формируем его,
            $data = Query::select("*", $table)->where("id", $max_id, "<=");
            // (если нужно сортировать строки ответа, добавляем это в запрос)
            if ($order_by !== null)
            {
                $data->orderBy($order_by, $how);
            }
            // и получаем уже обработанный ответ
            $data = $data->getResult();
            // Далее объявляем массив моделей, которые хотим создать,
            $models = [];
            // а также создаём ссылку на элемен массива
            // (ссылка на массив в массиве), где хранятся все модели,
            // имеющие ID
            $models_data = &self::$models[$modelname];

            // В цикле перебираем ответ от БД.
            // И в каждой итерации этого цикла мы:
            foreach ($data as $datum)
            {
                $id = $datum['id'];
                // создаём объект без вызова конструктора,
                $instance = $ref->newInstanceWithoutConstructor();
                // получаем поле 'id',
                $property = $ref->getProperty("id");
                // делаем его доступным,
                $property->setAccessible(true);
                // устанавливаем нужный ID
                $property->setValue($instance, $id);
                // и задаём значение полю 'data',
                $instance->setData($datum);

                // и наконец, записываем объект в массив с моделями,
                // которые мы создаём в этом методе,
                // и в массив со всеми моделями, имеющими ID
                $models[$id] = $models_data[$id] = $instance;
            }

            return $models;
        }
        // Если при вызове какого-либо рефлексионного метода произошла ошибка,
        catch (\ReflectionException $e)
        {
            // возвращаем пустой результат
            return null;
        }
    }

    /**
     * Поиск моделей (возвращается объект этого класса,
     * далее вызываются методы для того, чтобы задать параметры поиска)
     * @param string $modelname
     * @param null $id
     * @return FactoryModels
     */
    public static function search(string $modelname, $id=null): self
    {
        return new self($modelname, $id);
    }

    // Параметры поиска:
    private $id = null; // ID модели,
    private $name = ""; // название модели
    private $params = []; // И прочие параметры

    /**
     * В конструкторе указываются два параметра:
     * название и ID (ID можно не указывать)
     * FactoryModels constructor.
     * @param string $modelname
     * @param int|mixed $id
     */
    private final function __construct(string $modelname, $id)
    {
        $this->name = $modelname;
        $this->id = $id;
    }

    /**
     * Метод для добавления дополнительных параметров
     * @param int|mixed $key
     * @param mixed $value
     * @return FactoryModels
     */
    public final function set($key, $value): self
    {
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * Метод, вызывающий 'set'
     * (магический метод __call вызывается,
     * когда у объекта явно вызывается любой из его методов)
     * Здесь метод __call смотрит, существует ли вызванный метод:
     * если нет, то этот метод вызывает 'set' и передаёт ему в гачестве
     * ключа имя несуществующего метода, который должен был быть вызван,
     * а в качестве значения - один аргумент,
     * который должен быть передан несуществующему методу.
     * @param string $name
     * @param array|mixed $args
     * @return FactoryModels
     */
    public final function __call($name, $args)
    {
        if (
            !method_exists($this, $name)
            && count($args) == 1
        )
        {
            return $this->set(mb_strtolower($name), $args[0]);
        }
    }

    /**
     * Метод, ищущий модель по папраметрам,
     * указанным посредством вызова метода __call
     * (как было описано выше)
     * @return Model|null
     */
    public final function getModel()
    {
        $needle_models = ($this->id === null)
            ? self::$models['withoutID']
            : self::$models;

        if (isset($needle_models[$this->name]))
        {
            $models = &$needle_models[$this->name];

            if ($this->id === null)
            {
                foreach ($models as $model)
                {
                    if ($model->check($this->params))
                    {
                        return $model;
                    }
                }
            }
            elseif (isset($models[$this->id]))
            {
                if (($model = &$models[$this->id])->check($this->params))
                {
                    return $model;
                }
            }
        }

        return null;
    }

    public static function printSerializedModels()
    {
        echo "\n<div id='models'>\n";

        echo "\t<div id='withoutID'>\n";

        $models = self::$models['withoutID'];
        foreach ($models as $name => $model)
        {
            $serialized_model = serialize($model);
            echo "\t\t<input type='hidden' name='$name' value='$serialized_model'>\n";
        }

        echo "\t</div>\n\n";

        echo "\t<div id='withID'>";

        $models = self::$models;
        unset($models['withoutID']);

        foreach ($models as $name => $model)
        {
            $serialized_model = serialize($model);
            echo "\t\t<input type='hidden' name='$name' value='$serialized_model'>\n";
        }

        echo "\t</div>\n";

        echo "</div>\n";
    }
}