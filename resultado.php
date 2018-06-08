<?php
	include("header.php");
	$get_videos = mysql_query("SELECT * FROM videos ORDER BY visualizacoes DESC");
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		h1{
			width: 100%;
			padding: 20px 10px;
			text-align: center;
			color: #1C7293;
		}
		#erro{
			color: #444;
			width: 100%;
			padding: 50px 20px;
			text-align: center;
		}
		#video{
			width: 200px;
			min-height: 200px;
			display: inline-block;
			margin-left: 20px;
			margin-bottom: 20px;
			text-align: center;
			border: 1px solid #CCC;
		}
		#video img{
			width: 100%;
			height: 125px;
			object-fit: cover;
			cursor: pointer;
		}
		#video h3{
			width: 100%;
			padding: 5px 10px;
			text-align: justify;
			cursor: pointer;
		}
		#video p{
			margin-top: 10px;
			width: 95%;
			text-align: right;
			font-size: 10pt;
			font-weight: bold;
			color: #666;
		}
	</style>
</head>
<body>
	<h1>Os vídeos mais populares</h1>
	<br /><br />
	<div style="text-align: center;">
		<?php
			if (mysql_num_rows($get_videos)<=0) {
				echo '<h3 id="erro">Ups! Não há conteúdo para mostrar...</h3>';
			}else{
				while ($video=mysql_fetch_assoc($get_videos)) {
					$user = $video["user"];
                    $query = $_GET['search'];

         	        $query = htmlspecialchars($query);
         	        $query = mysql_real_escape_string($query);

         	        $get_result = "SELECT * FROM videos WHERE (`nome` LIKE '%".$query."%')";
         	        $mysql_result = mysql_query($get_result);

					$get_user = mysql_query("SELECT * FROM users WHERE id='$user'");
					$user_info = mysql_fetch_assoc($get_user);
					$nome = $user_info["nome"];

					if (mysql_num_rows($mysql_result) == 1){

         		while ($resultado = mysql_fetch_assoc($mysql_result)) {

         			echo '<div id="video">
						<img onclick="location.href = "video.php?id='.$video["id"].'" src="uploads/'.$video['imagem'].'" />
						<h3 onclick="location.href = "video.php?id='.$video["id"].'">'.$video["nome"].'</h3>
						<p>Publicado por <i style="cursor: pointer;" onclick="location.href = "conta.php?id='.$user.'">'.$nome.'</i></p>
					</div>';
				}
			}
					?>

					<?php
				}
				echo '<h3 id="erro">YouStream, '.date("Y").' - Todos os direitos reservados</h3>';
			}

		?>
	</div>
</body>
</html>