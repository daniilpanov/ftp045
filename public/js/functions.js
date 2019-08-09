//
function Brand()
{
    //
    if (!new.target)
    {
        return new Brand();
    }

    //
    this.brand = {
        canvas: null, img: null, prop: 0
    };

    //
    this.createBrand = (function ()
    {
        //
        brand.canvas = document.createElement("canvas");
        brand.img = new Image();
        brand.img.alt = "Panoff дизайн&reg;";
        //
        $("#brand").append(brand.canvas);
    });

    //
    this.drawBrand = (function ()
    {
        //
        var w = brand.img.width;
        var h = brand.img.height;
        //
        if (brand.prop === undefined)
        {
            brand.prop = h / w
        }
        //
        var prop = brand.prop;

        //
        brand.canvas.width
            = brand.img.width
            = brand.parentElement.offsetWidth;
        this.brand.canvas.height
            = brand.img.height
            = Math.floor(brand.img.width * prop);

        //
        var context = brand.canvas.getContext("2d");
        context.drawImage(brand.img, 0, 0, brand.img.width, brand.img.height);
    });

    var drawing = this.drawBrand;

    //
    this.setOnload = (function (next)
    {
        //
        brand.img.onload = (function ()
        {
            drawing();
            next();
        });
        //
        brand.img.src = "res/images/brand.jpg";
    });

    //
    this.setRepaint = (function (next)
    {
        //
        window.onresize = (function ()
        {
            drawing();
            next();
        });
    });
}

function Main(brand_data)
{
    if (!new.target)
    {
        return new Main(brand_data);
    }

    this.brand = brand_data;
    this.sidebar = $("main #sidebar");
    this.another = $("main #sidebar #another");

    this.alignSidebar = (function ()
    {
        var px,
            x = brand.canvas.offsetLeft + 10,
            y = brand.img.height - 1;

        var context = brand.canvas.getContext("2d");

        while ((px = context.getImageData(x, y, 1, 1).data))
        {
            if (px[0] !== 4 || px[1] !== 8 || px[2] !== 56 || px[3] !== 255)
            {
                break;
            }
            x++;
        }

        this.sidebar.width(x + 2);

        var another = this.another;

        function alignAnother()
        {

        }

        alignAnother();
    });

    this.alignContent = (function ()
    {

    });
}