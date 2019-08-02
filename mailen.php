<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>mail</title>


<STYLE TYPE="text/css">
table{
font-family:Arial, Helvetica, sans-serif;
font-size:12px}

a{
color:#2E66BD;
text-decoration:none;}
body{
color:#041D56;
}
-->
</STYLE>
</head>
<body bgcolor="#Ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >


<?php

$name=$HTTP_POST_VARS['name'];

$mail=$HTTP_POST_VARS['mail'];
$nachricht=$HTTP_POST_VARS['nachricht'];


if($mail!="")
{ 
$name=str_replace("&#1092;", "f",$name);
$name=str_replace("&#1099;", "y",$name);
$name=str_replace("&#1074;", "v",$name);
$name=str_replace("&#1072;", "a",$name);
$name=str_replace("&#1087;", "p",$name);
$name=str_replace("&#1088;", "r",$name);
$name=str_replace("&#1086;", "o",$name);
$name=str_replace("&#1083;", "a",$name);
$name=str_replace("&#1072;", "l",$name);
$name=str_replace("&#1076;", "d",$name);
$name=str_replace("&#1078;", "zh",$name);
$name=str_replace("&#1101;", "e",$name);
$name=str_replace("&#1093;", "ch",$name);
$name=str_replace("&#1079;", "z",$name);
$name=str_replace("&#1097;", "tsch",$name);
$name=str_replace("&#1096;", "sh",$name);
$name=str_replace("&#1075;", "g",$name);
$name=str_replace("&#1085;", "n",$name);
$name=str_replace("&#1077;", "e",$name);
$name=str_replace("&#1082;", "k",$name);
$name=str_replace("&#1091;", "u",$name);
$name=str_replace("&#1094;", "ts",$name);
$name=str_replace("&#1081;", "j",$name);
$name=str_replace("&#1103;", "ja",$name);
$name=str_replace("&#1095;", "ch",$name);
$name=str_replace("&#1089;", "s",$name);
$name=str_replace("&#1084;", "m",$name);
$name=str_replace("&#1080;", "i",$name);
$name=str_replace("&#1090;", "t",$name);
$name=str_replace("&#1100;", "'",$name);
$name=str_replace("&#1073;", "b",$name);
$name=str_replace("&#1073;", "ju",$name);
$name=str_replace("&#1105;", "jo",$name);
$name=str_replace("&#1098;", "'",$name);
$name=str_replace("&#1071;", "Ja",$name);
$name=str_replace("&#1063;", "Ch",$name);
$name=str_replace("&#1057;", "S",$name);
$name=str_replace("&#1052;", "M",$name);
$name=str_replace("&#1048;", "I",$name);
$name=str_replace("&#1058;", "T",$name);
$name=str_replace("&#1041;", "B",$name);
$name=str_replace("&#1025;", "Jo",$name);
$name=str_replace("&#1069;", "E",$name);
$name=str_replace("&#1046;", "Zh",$name);
$name=str_replace("&#1044;", "D",$name);
$name=str_replace("&#1051;", "L",$name);
$name=str_replace("&#1054;", "O",$name);
$name=str_replace("&#1056;", "R",$name);
$name=str_replace("&#1055;", "P",$name);
$name=str_replace("&#1040;", "A",$name);
$name=str_replace("&#1042;", "V",$name);
$name=str_replace("&#1067;", "Y",$name);
$name=str_replace("&#1060;", "F",$name);
$name=str_replace("&#1061;", "Ch",$name);
$name=str_replace("&#1047;", "Z",$name);
$name=str_replace("&#1065;", "Tsch",$name);
$name=str_replace("&#1064;", "Sh",$name);
$name=str_replace("&#1043;", "G",$name);
$name=str_replace("&#1053;", "N",$name);
$name=str_replace("&#1045;", "E",$name);
$name=str_replace("&#1050;", "K",$name);
$name=str_replace("&#1059;", "U",$name);
$name=str_replace("&#1062;", "Ts",$name);
$name=str_replace("&#1049;", "J",$name);

$nachricht=str_replace("&#1092;", "f",$nachricht);
$nachricht=str_replace("&#1099;", "y",$nachricht);
$nachrichte=str_replace("&#1074;", "v",$nachricht);
$nachricht=str_replace("&#1072;", "a",$nachricht);
$nachricht=str_replace("&#1087;", "p",$nachricht);
$nachricht=str_replace("&#1088;", "r",$nachricht);
$nachricht=str_replace("&#1086;", "o",$nachricht);
$nachricht=str_replace("&#1083;", "a",$nachricht);
$nachricht=str_replace("&#1072;", "l",$nachricht);
$nachricht=str_replace("&#1076;", "d",$nachricht);
$nachricht=str_replace("&#1078;", "zh",$nachricht);
$nachricht=str_replace("&#1101;", "e",$nachricht);
$nachricht=str_replace("&#1093;", "ch",$nachricht);
$nachricht=str_replace("&#1079;", "z",$nachricht);
$nachricht=str_replace("&#1097;", "tsch",$nachricht);
$nachricht=str_replace("&#1096;", "sh",$nachricht);
$nachricht=str_replace("&#1075;", "g",$nachricht);
$nachricht=str_replace("&#1085;", "n",$nachricht);
$nachricht=str_replace("&#1077;", "e",$nachricht);
$nachricht=str_replace("&#1082;", "k",$nachricht);
$nachricht=str_replace("&#1091;", "u",$nachricht);
$nachricht=str_replace("&#1094;", "ts",$nachricht);
$nachricht=str_replace("&#1081;", "j",$nachricht);
$nachricht=str_replace("&#1103;", "ja",$nachricht);
$nachricht=str_replace("&#1095;", "ch",$nachricht);
$nachricht=str_replace("&#1089;", "s",$nachricht);
$nachricht=str_replace("&#1084;", "m",$nachricht);
$nachricht=str_replace("&#1080;", "i",$nachricht);
$nachricht=str_replace("&#1090;", "t",$nachricht);
$nachricht=str_replace("&#1100;", "'",$nachricht);
$nachrichte=str_replace("&#1073;", "b",$nachricht);
$nachricht=str_replace("&#1073;", "ju",$nachricht);
$nachricht=str_replace("&#1105;", "jo",$nachricht);
$nachricht=str_replace("&#1098;", "'",$nachricht);
$nachricht=str_replace("&#1071;", "Ja",$nachricht);
$nachricht=str_replace("&#1063;", "Ch",$nachricht);
$nachricht=str_replace("&#1057;", "S",$nachrichte);
$nachricht=str_replace("&#1052;", "M",$nachricht);
$nachricht=str_replace("&#1048;", "I",$nachricht);
$nachricht=str_replace("&#1058;", "T",$nachricht);
$nachricht=str_replace("&#1041;", "B",$nachricht);
$nachricht=str_replace("&#1025;", "Jo",$nachricht);
$nachricht=str_replace("&#1069;", "E",$nachricht);
$nachricht=str_replace("&#1046;", "Zh",$nachricht);
$nachricht=str_replace("&#1044;", "D",$nachricht);
$nachricht=str_replace("&#1051;", "L",$nachricht);
$nachricht=str_replace("&#1054;", "O",$nachricht);
$nachricht=str_replace("&#1056;", "R",$nachricht);
$nachricht=str_replace("&#1055;", "P",$nachricht);
$nachricht=str_replace("&#1040;", "A",$nachricht);
$nachricht=str_replace("&#1042;", "V",$nachricht);
$nachricht=str_replace("&#1067;", "Y",$nachricht);
$nachricht=str_replace("&#1060;", "F",$nachricht);
$nachricht=str_replace("&#1061;", "Ch",$nachricht);
$nachricht=str_replace("&#1047;", "Z",$nachricht);
$nachricht=str_replace("&#1065;", "Tsch",$nachricht);
$nachricht=str_replace("&#1064;", "Sh",$nachricht);
$nachricht=str_replace("&#1043;", "G",$nachricht);
$nachricht=str_replace("&#1053;", "N",$nachricht);
$nachrichte=str_replace("&#1045;", "E",$nachricht);
$nachricht=str_replace("&#1050;", "K",$nachricht);
$nachricht=str_replace("&#1059;", "U",$nachricht);
$nachricht=str_replace("&#1062;", "Ts",$nachricht);
$nachricht=str_replace("&#1049;", "J",$nachricht);


	$mailtext="from: $name, Email: $mail, Message: $nachricht<br> ";
	
	$absender="From:";
	$absender.=$mail;
	/*echo"<br>mitteilung:$mailtext<br>$absender";*/
	mail("memonik@inbox.ru","from Panoff-Design Internet-Seite(Copy)",$mailtext,$absender);
	mail("russian_house@mail.ru","from Panoff-Design Internet-Seite",$mailtext,$absender);
	mail("mariekiss@mail.ru","from Panoff-Design Internet-Seite",$mailtext,$absender);
	print("<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#041D56'><br><br><p align='center'>&#1042;&#1072;&#1096;&#1077; &#1089;&#1086;&#1086;&#1073;&#1097;&#1077;&#1085;&#1080;&#1077; &#1091;&#1089;&#1087;&#1077;&#1096;&#1085;&#1086; &#1086;&#1090;&#1087;&#1088;&#1072;&#1074;&#1083;&#1077;&#1085;&#1086;<br />
&#1052;&#1099; &#1089;&#1074;&#1103;&#1078;&#1077;&#1084;&#1089;&#1103; &#1089; &#1042;&#1072;&#1084;&#1080;  &#1074; &#1073;&#1083;&#1080;&#1078;&#1072;&#1081;&#1096;&#1077;&#1077; &#1074;&#1088;&#1077;&#1084;&#1103;.<br><a href='contact.html'>&#1054;&#1073;&#1088;&#1072;&#1090;&#1085;&#1086;...</a> </p>

</span>");
}
else
{
print("<span style='font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#041D56'><p align='center'><br><br><br>&#1047;&#1072;&#1087;&#1086;&#1083;&#1085;&#1080;&#1090;&#1077; &#1087;&#1086;&#1078;&#1072;&#1083;&#1091;&#1081;&#1089;&#1090;&#1072; &#1087;&#1086;&#1083;&#1077; &quot;Email&quot;!!!</p></span><br><br>");
print("<p align='center'><a href='contact.html'>&#1054;&#1073;&#1088;&#1072;&#1090;&#1085;&#1086;...</a></p>");
}
?>

</body>
</html>