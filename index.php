<?php
define(
    "HOMEDIR",
    (str_replace("\\", "/", __DIR__) . "/")
);

require_once "config/loading.php";

use loading as l;

define("PATHS", (l\loadconfig("paths")));

l\loadconfig("autoload");
?>

<!doctype html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="Keywords" content="St. Petersburg, Санкт-Петербург, Питер, Design, interior, Interieur, интерьер, дизайн, квартира, загородный дом, кафе, бар, клуб, бассейн, аквариум, эскиз, портфолио, portfolio, недвижимость, ремонт, гостиная, столовая, детская, ванная, туалет, спальня, кабинет, Homepage, Kontakt, consulting, мебель, дверь, кафе, скатерть, декорирование, столовое белье, чехлы, шторы, мебель, лестницы, предметы интерьера из натурального дерева, скатерти для ресторанов, напероны, дорожки, салфетки ">

	<meta name="Publisher" content="ООО «Русский Дом МЛК», mddesign-foto">
	<meta name="Content-language" content="ru">
	<script type="text/JavaScript">
		<!--
		function MM_swapImgRestore() { //v3.0
			var i, x,
                a = document.MM_sr;
			for (
			    i = 0;
			    a && i < a.length
                && (x = a[i])
                && x.oSrc;
			    i++
            )
            {
                x.src = x.oSrc;
            }
		}

		function MM_preloadImages() { //v3.0
			var d = document;

			if (d.images)
			{
			    if (!d.MM_p)
                {
                    d.MM_p = [];
                }

				var i, j = d.MM_p.length,
                    a = this.arguments;
			    for (i = 0; i < a.length; i++)
                {
                    if (a[i].indexOf("#") !== 0)
                    {
                        d.MM_p[j] = new Image;
                        d.MM_p[j++].src = a[i];
                    }
                }
            }
		}

		function MM_findObj(n) { //v4.01
			var p, i, x, d = document;

			if((p = n.indexOf("?")) > 0 && parent.frames.length)
			{
				d = parent.frames[n.substring(p + 1)].document;
				n = n.substring(0, p);
			}

			if(!(x = d[n]) && d.all)
            {
                x = d.all[n];
            }
			for (i = 0; !x && i < d.forms.length; i++)
            {
                x = d.forms[i][n];
            }
			for(i = 0; !x && d.layers && i < d.layers.length; i++)
            {
                x = MM_findObj(n,d.layers[i].document);
            }
			if(!x && d.getElementById)
            {
                x = d.getElementById(n);
            }

			return x;
		}

		function MM_swapImage() { //v3.0
			var i,
                j = 0,
                x,
                a = this.arguments;
			document.MM_sr = [];
			for(i = 0; i < (a.length - 2); i += 3)
            {
                if ((x = MM_findObj(a[i])) != null)
                {
                    document.MM_sr[j++] = x;
                    if(!x.oSrc)
                    {
                        x.oSrc = x.src;
                    }
                    x.src = a[i + 2];
                }
            }
		}
		//-->
	</script>

    <title>Группа компаний «СЕВИРИНА»: home.</title>

    <?php
    l\linkframework("frameworks/bootstrap/css/", "css");
    l\linkframework("frameworks/bootstrap/js/", "js");
    l\linkframework("frameworks/jquery/", "js");
    l\linkcss("style");
    l\includescript("script");
    ?>
</head>
<body class="container-fluid" onLoad="new MM_preloadImages('images/indexa_02.gif','images/indexa_03.gif','images/indexa_04.gif')">
<!--
Top Image
    <img src="res/images/indexn_01.gif" width="1002" height="154" alt="">
Main Content:
    <table align="center" width="99%" cellspacing="3" cellpadding="3" border="0">
        <tr align="left" valign="top">
            <td width="50">&nbsp;</td>
            <td align="left">
                <h5>
                    <i>Купили квартиру или дом?<br> Решили обновить свое жилье? Или дизайн офиса уже устарел? </i>
                </h5>
                <h1>ВАМ СЮДА!</h1>
                Вас посетила идея  открыть стильное кафе,<br /> модный клуб или роскошный ресторан - тогда <br />
                <b>Вам снова СЮДА!</b>
                <br /><br />
                <ul>
                    <li><b>Дизайн интерьера</b> (нашей марки Panoff-дизайн):
                        <ul>
                            <li>дизайн квартирн</li>
                            <li>дизайн загородных домов</li>
                            <li>дизайн ресторанов</li>
                            <li>o	кафе и клубов.</li>
                        </ul><br />
                        <li><b>авторский надзор </b></li>
                        <li>
                            <b>
                                <span style="color: #990000; ">
                                    изготовление мебели, лестниц и других предметов интерьера из натурального дерева
                                </span>
                            </b>
                        </li>
                        <li><b>декорирование, столовое белье, чехлы, шторы</b></li><br />
                    </ul>
                <br>
                <i> С уважением, коллектив компании «Русский Дом МЛК».</i>
                <br>
            </td>
            <td width="50">&nbsp;</td>
        </tr>
    </table>
end Main Content
Top Products:
    <img src="res/images/index_10.gif" alt="">
    <br><br>
    <div id="top-products">
        <br>
        <h4><b>ТОВАРЫ ДНЯ:</b></h4>
        <img src="res/images/ggguuu.jpg" alt="">
        <br><br>
        <i>Состаренная дверь и сундук</i>
        <br><br>
    </div>
end Top Products
-->
<header>
    <?php
    l\loadphp("header")
    ?>
</header>

<main>
    <?php
    l\loadphp("main");
    ?>
</main>

<footer>
    <?php
    l\loadphp("footer");
    ?>
</footer>
</body>
</html>