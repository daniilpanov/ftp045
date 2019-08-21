//
//
function changeTitle(title)
{
    $("title").html("Дизайн студия «Panoff design»: " + title);
}
//
function returnErrorMessage(href)
{
    return "<span class='btn btn-danger error'>"
           + "An error threw after trying to go to page on address "
           + "<span class='addr'>" + href + "</span>"
           + "</span>";
}

//
function htmlSpecialChars(html)
{
    return html.replace(/&/g, "&amp;")
               .replace(/</g, "&lt;")
               .replace(/>/g, "&gt;")
               .replace(/"/g, "&quot;")
               .replace(/'/g, "&#039;")
               .replace(/\\/g, "&#92;")
               /*.replace(/\t/g, "&#92;t")
               .replace(/\n/g, "&#92;n")*/;
}

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

//
function Main(brand_data)
{
    //
    if (!new.target)
    {
        return new Main(brand_data);
    }

    //
    this.brand = brand_data; //
    this.main = $("main"); //
    //
    this.left_sidebar = $("main #left-sidebar");
    this.another = $("main #left_sidebar #another");
    this.content = $("main #content");
    this.right_sidebar = $("main #right-sidebar");
    this.right_sidebar_content = $("main #right-sidebar #right-sidebar-content");

    //
    if (this.main.height() < this.left_sidebar.height())
    {
        this.main.height(this.left_sidebar.height() + 25);
    }
    //
    this.alignLeftSidebar = (async function ()
    {
        //
        var px,
            x = brand.canvas.offsetLeft + 10,
            y = brand.img.height - 1;
        //
        var context = brand.canvas.getContext("2d");
        //
        while ((px = context.getImageData(x, y, 1, 1).data))
        {
            if (px[0] !== 4 || px[1] !== 8 || px[2] !== 56 || px[3] !== 255)
            {
                break;
            }
            x++;
        }
        //
        this.left_sidebar.width(x + 5);

        /*var another = this.another;

        function alignAnother()
        {

        }

        alignAnother();*/
    });

    //
    this.alignContent = (async function ()
    {
        //
        var content = this.content,
            main = this.main;
        //
        var width = window.innerWidth - 10;
        //
        width = width - this.left_sidebar.width() - 63;
        content.width(width);

        //
        var ch = content.height(), mh = main.height();

        //
        if (ch < mh)
        {
            content.height(mh);
        }
        else
        {
            main.height(ch);
        }
    });

    //
    this.alignRightSidebar = (async function ()
    {
        //
        var content = this.content,
            right_sidebar = this.right_sidebar,
            right_sidebar_content = this.right_sidebar_content;

        //
        if (!right_sidebar_content.html().trim())
        {
            right_sidebar.remove();
            return;
        }

        //
        var width = content.width() - right_sidebar.width() - 40;
        content.width(width);
    });
}

//
function BindMenu()
{
    //
    if (!new.target)
    {
        return new BindMenu();
    }

    /*this.controllers =
    {
        single: $("#controllers #S input:hidden"),
        updating: $("#controllers #F input:hidden")
    };
    this.models =
    {
        withoutID: $("#models #withoutID input:hidden"),
        withID: $("#models #withID input:hidden")
    };
    this.serialized = ()(this.controllers, this.models);*/

    //
    function getPagesData(elem)
    {
        //
        var item,
            data = [],
            items = elem.children();
        //
        for (let i = 0; i < items.length; i++)
        {
            //
            switch (items[i].tagName)
            {
                //
                case "DIV":
                    //
                    item = $(items[i]);
                    data[item.attr("aria-roledescription")] = getPagesData(item);
                    break;
                //
                case "INPUT":
                    //
                    item = $(items[i]);
                    data[item.attr("name")] = item.attr("value");
                    break;
            }
        }

        return data;
    }

    //
    this.pages = getPagesData($("#pages"));

    //
    this.content = $("main #content");
    this.left_menu = $("main #left-sidebar #menu");
    this.right_menu = $("main #right-sidebar #right-sidebar-content");

    //
    this.bindLeftMenu = (function ()
    {
        //
        var content = this.content,
            pages = this.pages,
            menu = this.left_menu,
            //
            links = menu.find("a[aria-roledescription='section']");
        //var serialized = this.serialized;

        //
        links.click(function ()
        {
            //
            var href = this.toString(), //
                get = href.split("?")[1], //
                id = get.split("=")[1]; //

            /*var objects = (function (serialized)
            {
                return serialized;
            })(serialized);*/

            //
            $.ajax({
                //
                type: "post",
                //
                data: {
                    //serialized: objects,
                    page: {
                        id: id,
                        title: pages[id]['title'],
                        content: pages[id]['content']
                    }
                },
                //
                url: "http://localhost/ftp045/public/views/ajax-views/content.php",
                //
                success: (function (html)
                {
                    //
                    content.html(html);
                    //
                    window.history.pushState({}, "", href);
                }),
                //
                error: (function ()
                {
                    content.html(returnErrorMessage(href));
                })
            });

            //
            return false;
        });
    });

    //
    this.bindRightMenu = (function ()
    {
        //var menu = this.right_menu;
    });
}