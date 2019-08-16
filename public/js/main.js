//
$(document).ready(function ()
{
    //
    var brand = Brand();
    //
    brand.createBrand();
    //
    var brand_data = brand.brand,
        onload = (function ()
        {
            //
            var main = Main(brand_data);
            main.alignLeftSidebar();
            main.alignContent();
            main.alignRightSidebar();
        });
    //
    brand.setOnload(onload);
    brand.setRepaint(onload);

    //
    var bind_menu = BindMenu();

    bind_menu.bindLeftMenu();
    bind_menu.bindRightMenu();
});