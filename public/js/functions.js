//
function createBrand()
{
    //
    var canvas = document.createElement("canvas");
    //
    var img_w, img_h, prop = null;
    //
    function drawBrand()
    {
        //
        img_w = img.width;
        img_h = img.height;
        //
        if (prop === null)
        {
            prop = img_h / img_w;
        }

        //
        canvas.width = img.width = canvas.parentElement.offsetWidth;
        canvas.height = img.height = Math.floor(img.width * prop);

        //
        var context = canvas.getContext("2d");
        context.drawImage(img, 0, 0, img.width, img.height);
    }

    function alignMenu()
    {
        //
        var px, x = canvas.offsetLeft + 10, y = img.height - 1;
        //
        while ((px = canvas.getContext("2d").getImageData(x, y, 1, 1).data))
        {
            if (px[0] !== 4 || px[1] !== 8 || px[2] !== 56)
            {
                break;
            }
            x++;
        }
        //
        $("#sidebar #menu").width(x + 2);
    }

    function init()
    {
        drawBrand();
        alignMenu();
    }

    //
    var img = new Image();
    img.alt = "Panoff дизайн &reg;";
    //
    img.onload = init;
    //
    img.src = "res/images/brand.jpg";
    //
    window.onresize = init;
    //
    document.getElementById("brand").appendChild(canvas);

    return canvas;
}

/*
function alignMain(canvas)
{
    function alignSidebar()
    {
        function alignMenu()
        {

        }
    }

    function alignContent()
    {

    }
}*/
