<?php
	include("db.php");
	if (isset($_COOKIE["login"]) && isset($_COOKIE["login2"])) {
		$user_id = $_COOKIE["id"];
		$email = $_COOKIE["login"];
		$password = $_COOKIE["login2"];
		$verificar = mysql_query("SELECT * FROM users WHERE email='$email' AND password='$password'");
		if (mysql_num_rows($verificar)>=1) {
			$log = "sim";
		}else{
			$log = "nao";
		}
	}else{
		$log = "nao";
	}
	//Começo do código
	if (!isset($_GET["id"])) {
		echo "<script>location.href='index.php'</script>";
	}else{
		$id = mysql_real_escape_string($_GET["id"]);
		$verificar = mysql_query("SELECT * FROM videos WHERE id='$id'");
		if (mysql_num_rows($verificar)<=0) {
			echo "<script>location.href='index.php'</script>";
		}
	}
	$info = mysql_fetch_assoc($verificar);

	if (isset($_GET["comentar"]) && $log="sim") {
		$texto = htmlspecialchars($_POST["texto"]);
		$texto = mysql_real_escape_string($texto);
		if ($texto!="") {
			$insert = mysql_query("INSERT INTO comentarios (user,video,texto) VALUES ('$user_id','$id','$texto')");
			if ($insert) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
?>

	<strong>Comentários</strong><br /><br />
	<?php
		$get_comments = mysql_query("SELECT * FROM comentarios WHERE video='$id' ORDER BY id DESC");
		if (mysql_num_rows($get_comments)>=1) {
			while ($comment = mysql_fetch_assoc($get_comments)) {
				$user = $comment["user"];
				$get_user = mysql_query("SELECT * FROM users WHERE id='$user'");
				$user = mysql_fetch_assoc($get_user);
				?>
				<hr>
				<div class="position">
				<p style="text-align: left;"><a href="conta.php?id=<?php echo $user["id"];?>"><strong><?php echo $user["nome"]; ?> disse:</strong></a> <?php echo $comment["texto"]; ?></p>
				</div>
				<?php
			}
		}else{
			echo "<h3>Não há comentários a apresentar</h3>";
		}
	?>
