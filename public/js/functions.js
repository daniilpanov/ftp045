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
    this.main = $("main");
    this.left_sidebar = $("main #left-sidebar");
    this.another = $("main #left_sidebar #another");
    this.content = $("main #content");
    this.right_sidebar = $("main #right-sidebar");
    this.right_sidebar_content = $("main #right-sidebar #right-sidebar-content");

    if (this.main.height() < this.left_sidebar.height())
    {
        this.main.height(this.left_sidebar.height() + 25);
    }

    this.alignLeftSidebar = (function ()
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

        this.left_sidebar.width(x + 2);

        /*var another = this.another;

        function alignAnother()
        {

        }

        alignAnother();*/
    });

    this.alignContent = (function ()
    {
        var content = this.content;
        var main = this.main;

        var width = window.innerWidth - 10;
        width = width - this.left_sidebar.width() - 43;
        content.width(width);

        var ch = content.height(), mh = main.height();

        if (ch < mh)
        {
            content.height(mh);
        }
        else
        {
            main.height(ch);
        }
    });

    this.alignRightSidebar = (function ()
    {
        var content = this.content;
        var right_sidebar = this.right_sidebar;
        var right_sidebar_content = this.right_sidebar_content;

        if (!right_sidebar_content.html().trim())
        {
            right_sidebar.remove();
            return;
        }

        var width = content.width() - right_sidebar.width() - 40;
        content.width(width);
    });
}

function BindMenu()
{
    if (!new.target)
    {
        return new BindMenu();
    }

    this.content = $("main #content");
    this.left_menu = $("main #left-sidebar #menu");
    this.right_menu = $("main #right-sidebar #right-sidebar-content");

    this.bindLeftMenu = (function ()
    {
        var content = this.content;
        var menu = this.left_menu;
        var links = menu.find("a[aria-roledescription='section']");

        links.click(function ()
        {
            var it = $(this);
            var href = it.attr("href");
            var all_get = href.split("?")[1];
            var get_items = all_get.split("&");
            var get_items_pair = (function (items)
            {
                var pairs = '{';

                for (let i = 0; i < items.length; i++)
                {
                    var pair = items[i].split("=");
                    pairs += '"' + pair[0] + '": "' + pair[1] + '", ';
                }

                pairs = pairs.substring(0, pairs.length - 2);
                pairs += "}";

                return JSON.parse(pairs);
            })(get_items);

            $.ajax({
                type: "get",
                data: get_items_pair,
                url: "http://localhost/ftp045/public/views/ajax-views/content.php",
                success: (function (html)
                {
                    content.html(html);
                }),
                error: (function ()
                {
                    alert("Error!");
                })
            });

            return false;
        });
    });

    this.bindRightMenu = (function ()
    {
        var menu = this.right_menu;
    });
}