function tmp(controllers, models)
{
    function eachInputToJSON(input_collection)
    {
        if (input_collection.length > 0)
        {
            var string = "{";

            $.each(input_collection, function (key, value)
            {
                string += '"' + $(value).attr("name")
                          + '": "' + htmlSpecialChars($(value).attr("value"))
                          + '", ';
            });

            string = string.substring(0, string.length - 2) + "}";

            return string;
        }
        else
        {
            return null;
        }
    }

    var json_controllers_single
            = eachInputToJSON(controllers.single),
        json_controllers_updating
            = eachInputToJSON(controllers.updating),
        json_models_withID
            = eachInputToJSON(models.withID),
        json_models_withoutID
            = eachInputToJSON(models.withoutID);

    try
    {
        var data = {};

        if (
            json_controllers_single !== null
            || json_controllers_updating !== null
        )
        {
            data.controllers = {};

            if (json_controllers_single !== null)
            {
                data.controllers.single = JSON.parse(json_controllers_single);
            }

            if (json_controllers_updating !== null)
            {
                data.controllers.updating = JSON.parse(json_controllers_updating);
            }
        }

        if (
            json_models_withID !== null
            || json_models_withoutID !== null
        )
        {
            data.models = {};

            if (json_models_withID !== null)
            {
                data.models.withID = JSON.parse(json_models_withID);
            }

            if (json_models_withoutID !== null)
            {
                data.models.withoutID = JSON.parse(json_models_withoutID);
            }
        }

        return data;
    }
    catch (e)
    {
        alert(e.toString());
        return {};
    }
}