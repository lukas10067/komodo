<?php
	require("db.php");
	if (!isset($_GET["id"])) {
		echo "<script>location.href='index.php'</script>";
	}else{
		$id = mysql_real_escape_string($_GET["id"]);
		$verificar = mysql_query("SELECT * FROM users WHERE id='$id'");
		if (mysql_num_rows($verificar)<=0) {
			echo "<script>location.href='index.php'</script>";
		}
		if (isset($_COOKIE["login"]) && isset($_COOKIE["login2"])) {
			$user_id = $_COOKIE["id"];
			$email = $_COOKIE["login"];
			$password = $_COOKIE["login2"];
			$verificar = mysql_query("SELECT * FROM users WHERE email='$email' AND password='$password'");
			if (mysql_num_rows($verificar)<1) {
				echo "<script>location.href='index.php'</script>";
			}else{
				$log = "sim";
			}
		}
	}
	$info = mysql_fetch_assoc($verificar);
	$count = mysql_query("SELECT * FROM inscritos WHERE conta='$id'");
?>
<!DOCTYPE html>
<html>
<body>
	<?php
		$get = mysql_query("SELECT * FROM inscritos WHERE user='$user_id' AND conta='$id'");
		if (isset($_GET["sub"]) && $id==$user_id) {
			return false;
		}elseif (isset($_GET["sub"]) && mysql_num_rows($get)<=0) {
			$sub = mysql_query("INSERT INTO inscritos (user,conta) VALUES ('$user_id','$id')");
			if ($sub) {
				return true;
			}
		}elseif (isset($_GET["sub"]) && mysql_num_rows($get)>0) {
			$sub = mysql_query("DELETE FROM inscritos WHERE user='$user_id' AND conta='$id'");
			if ($sub) {
				return true;
			}
		}elseif (isset($_GET["sub"])) {
			return false;
		}elseif ($id==$user_id) {
			?>
			<button id="insc">Editar a minha conta (<?php echo mysql_num_rows($count); ?> Inscritos)</button>
			<?php
		}elseif ($log=="nao") {
			?>
			<button id="insc" onclick="logar();"><?php echo mysql_num_rows($count); ?> Inscritos</button>
			<?php
		}elseif (mysql_num_rows($get)>0) {
			?>
			<button id="insc" onclick="subscrever()">Inscrito (<?php echo mysql_num_rows($count); ?> Inscritos)</button>
			<?php
		}else{
			?>
			<button id="insc" onclick="subscrever()">Inscrever-ser (<?php echo mysql_num_rows($count); ?> Inscritos)</button>
			<?php
		}
	?>
</html>