<?php
error_reporting(0);
	// $conectar = mysql_connect("mysql.hostinger.com.br","u965532692_komod","O/![l~8HmUYTA4e#m") or die("Impossível ligar ao servidor");
	// $db = mysql_select_db("u965532692_komod",$conectar) or die("Impossível ligar à base de dados");
    $conectar = mysql_connect("localhost","root","") or die("Impossível ligar ao servidor");
	$db = mysql_select_db("lukas_teste",$conectar) or die("Impossível ligar à base de dados");
	//O/![l~8HmUYTA4e#m
?>
<!DOCTYPE html>
<html>
<head>
	<title>Komodo</title>
	 <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
	 <!-- <link href="http://vjs.zencdn.net/5.19.2/video-js.css" rel="stylesheet"> -->
	<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
	<script src="js/configuracao_ajax.js"></script>
	 <link href="css/estilo.css" rel="stylesheet">
	 <link rel="stylesheet" href="css/default.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
</head>
</html>