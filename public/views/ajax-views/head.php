<?php
/**
 * Этот скрипт - шапка для любого вида,
 * вызванного посредством ajax
 */

// Объявляем константу, в которой хранится корень проекта
define("HOMEDIR", "../../../");
// Далее подключаем php-скрипт для быстрого подключения других скриптов
require_once HOMEDIR . "config/loading.php";

// (объявляем псевдоним для пространства имён быстрого подключения скриптов)
use loading as l;

// Указываем папку, в которой хранятся все скрипты
l\configurepaths(HOMEDIR);
// Далее констатируем исключения из путей до классов
define("PATHS", (l\loadconfig("paths")));
// и подключаем автозагрузку классов
l\loadconfig("autoload");

// (теперь мы можем обращаться к классам,
// поэтому сразу импортируем все классы, которые нам нужны)
use app\controllers\{Controller, FactoryControllers};
use app\models\FactoryModels;

// Смотрим, какие сериализованные объекты нам пришли:
if (isset($_POST['serialized']))
{
    $current = $_POST['serialized'];
    // если есть контроллеры, запихиваем каждый из них
    // в многомерный массив под своим ключом, предварительно десериализуя их
    if (isset($current['controllers']))
    {
        $controllers = $current['controllers'];
        $unserialized = [];
        // (контроллеры, использующие паттерн 'Singleton')
        if (isset($controllers['single']))
        {
            $single = $controllers['single'];

            foreach ($single as $name => $controller)
            {
                $unserialized[Controller::SINGLE][$name] = unserialize(
                    str_replace("\\n", "\n",
                        htmlspecialchars_decode($controller)
                    )
                );
            }
        }
        // (контроллеры, для которых необходимо каждый раз создавать новый объект)
        // Примечание: возможно, если я не сделаю поиск таких контроллеров по параметрам,
        // то их хранение и передача в сериализованном виде будет бессмысленна
        if (isset($controllers['updating']))
        {
            $updating = $controllers['updating'];

            foreach ($updating as $name => $controller)
            {
                $unserialized[Controller::UPDATING][$name] = unserialize(
                    str_replace("\\n", "\n",
                        htmlspecialchars_decode($controller)
                    )
                );
            }
        }

        // Передаём массив с десериализованными контроллерами в их фабрику
        FactoryControllers::setUnserializedControllers($unserialized);
    }

    // То же самое с моделями:
    if (isset($current['models']))
    {
        $models = $current['models'];
        $unserialized = [];
        // (модели, имеющие ID (название переменной говорит само за себя))
        if ($withID = $models['withID'])
        {
            foreach ($withID as $name => $model)
            {
                $unserialized[$name] = unserialize(
                    str_replace("\\n", "\n",
                        htmlspecialchars_decode($model)
                    )
                );
            }
        }
        // (модели без ID (название, опять же, говорит само за себя))
        if (isset($models['withoutID']))
        {
            $withoutID = $models['withoutID'];

            foreach ($withoutID as $name => $model)
            {
                $unserialized['withoutID'][$name] = unserialize(
                    str_replace("\\n", "\n",
                        htmlspecialchars_decode($model)
                    )
                );
            }
        }

        // Передаём десериализованные модели в их фабрику
        FactoryModels::setUnserializedModels($unserialized);
    }
}