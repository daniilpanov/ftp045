<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ru">
<head>
    <title>mail</title>
    <style type="text/css">
    table
    {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }

    a
    {
        color: #2E66BD;
        text-decoration: none;
    }
    body
    {
        color: #041D56;
    }
    -->
    </style>
</head>
<body bgcolor="#Ffffff">


<?php

$name = $_POST['name'];
$mail = $_POST['mail'];
$nachricht = $_POST['nachricht'];


if($mail != "")
{
    $name = htmlspecialchars_decode($name);
    $nachricht = htmlspecialchars_decode($nachricht);

	$mailtext = "from: $name, Email: $mail, Message: $nachricht<br> ";
	$absender = "From:$mail";

	/*echo"<br>mitteilung:$mailtext<br>$absender";*/
	mail("memonik@inbox.ru","from Panoff-Design Internet-Seite(Copy)",$mailtext,$absender);
	mail("russian_house@mail.ru","from Panoff-Design Internet-Seite",$mailtext,$absender);
	mail("mariekiss@mail.ru","from Panoff-Design Internet-Seite",$mailtext,$absender);

	echo "<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#041D56'><br><br><p align='center'>&#1042;&#1072;&#1096;&#1077; &#1089;&#1086;&#1086;&#1073;&#1097;&#1077;&#1085;&#1080;&#1077; &#1091;&#1089;&#1087;&#1077;&#1096;&#1085;&#1086; &#1086;&#1090;&#1087;&#1088;&#1072;&#1074;&#1083;&#1077;&#1085;&#1086;<br />
&#1052;&#1099; &#1089;&#1074;&#1103;&#1078;&#1077;&#1084;&#1089;&#1103; &#1089; &#1042;&#1072;&#1084;&#1080;  &#1074; &#1073;&#1083;&#1080;&#1078;&#1072;&#1081;&#1096;&#1077;&#1077; &#1074;&#1088;&#1077;&#1084;&#1103;.<br><a href='contact.html'>&#1054;&#1073;&#1088;&#1072;&#1090;&#1085;&#1086;...</a> </p>

</span>";
}
else
{
    echo "<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#041D56'><p align='center'><br><br><br>&#1047;&#1072;&#1087;&#1086;&#1083;&#1085;&#1080;&#1090;&#1077; &#1087;&#1086;&#1078;&#1072;&#1083;&#1091;&#1081;&#1089;&#1090;&#1072; &#1087;&#1086;&#1083;&#1077; &quot;Email&quot;!!!</p></span><br><br>";
    echo "<p align='center'><a href='contact.html'>&#1054;&#1073;&#1088;&#1072;&#1090;&#1085;&#1086;...</a></p>";
}
?>

</body>
</html>