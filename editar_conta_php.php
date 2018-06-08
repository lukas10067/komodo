<?php
	require("header.php");
	if ($log=="nao") {
		return false;
	}else{
		$n = rand(999,1000000);
		if ($_FILES["capa"]["error"]>0) {
			$capa = $get_info["capa"];
		}else{
			$capa = "YouStream_Foto_de_fundo_".$n.$_FILES["capa"]["name"];
			move_uploaded_file($_FILES["capa"]["tmp_name"], "uploads/".$capa);
		}
		if ($_FILES["file"]["error"]>0) {
			$img = $get_info["imagem"];
		}else{
			$img = "YouStream_Foto_".$n.$_FILES["file"]["name"];
			move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/".$img);
		}
		$password = sha1(sha1(sha1(sha1(md5(md5(sha1(md5(strrev(md5(sha1(strrev($_POST["password"]))))))))))));
		$nome = $_POST["nome"];
		if ($_POST["password"]=="" || $password==$get_info["password"]) {
			$password=$get_info["password"];
		}
		if ($_POST["nome"]=="" || $nome==$get_info["nome"]) {
			$nome=$get_info["nome"];
		}
		$insert = mysql_query("UPDATE users SET nome='$nome', password='$password', imagem='$img', capa='$capa' WHERE id='$user_id'");
		if ($insert) {
			return true;
		}else{
			return false;
		}
	}
?>