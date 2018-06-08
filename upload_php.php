<?php
	require("header.php");
	if ($log=="nao") {
		return false;
	}else{
		$n = rand(999,1000000);
		if ($_FILES["file"]["error"]>0) {
			return false;
		}else{
			$video = "YouStream_Vídeo_".$n.$_FILES["file"]["name"];
			move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/".$video);
		}
		if ($_FILES["filethumb"]["error"]>0) {
			return false;
		}else{
			$img = "YouStream_Thumbnail_".$n.$_FILES["filethumb"]["name"];
			move_uploaded_file($_FILES["filethumb"]["tmp_name"], "uploads/".$img);
		}
		$titulo = $_POST["titulo"];
		$descricao = $_POST["descricao"];
		if ($titulo=="" || $descricao=="") {
			return false;
		}else{
			$insert = mysql_query("INSERT INTO videos (nome, descricao, local, imagem, user) VALUES ('$titulo','$descricao','$video','$img','$user_id')");
			if ($insert) {
				return true;
			}else{
				return false;
			}
		}
	}
?>