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
            main.alignSidebar();
        });
    //
    brand.setOnload(onload);
    brand.setRepaint(onload);
});