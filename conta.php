<?php
	include("header.php");
	if (!isset($_GET["id"])) {
		echo "<script>location.href='index.php'</script>";
	}else{
		$id = mysql_real_escape_string($_GET["id"]);
		$verificar = mysql_query("SELECT * FROM users WHERE id='$id'");
		if (mysql_num_rows($verificar)<=0) {
			echo "<script>location.href='index.php'</script>";
		}
	}
	$info = mysql_fetch_assoc($verificar);
	$count = mysql_query("SELECT * FROM `inscritos` WHERE conta='$id'");
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body{
			background-color: #444;
			text-align: center;
		}
		#capa{
			width: 100%;
			height: 100vh;
			object-fit: cover;
			position: fixed;
			top: 0;
			left: 0;
			z-index: -999;
			filter: blur(20px);
		}
		#imagem{
			display: block;
			margin: auto;
			margin-top: 50px;
			width: 200px;
			height: 200px;
			object-fit: cover;
			border-radius: 100%;
		}
		#nome{
			display: block;
			margin: auto;
			width: 90%;
			text-align: center;
			color: #FFF;
			padding: 20px 0px;
		}
		#erro{
			color: #FFF;
			width: 100%;
			padding: 50px 20px;
			text-align: center;
		}
		#video{
			width: 365px;
			min-height: 200px;
			display: inline-block;
			margin-left: 20px;
			margin-bottom: 20px;
			text-align: center;
			border: none;
			border-radius: 0.3em;
			background-color: #F9F9F9;
		}
		#video img{
			width: 100%;
			height: 125px;
			object-fit: cover;
			cursor: pointer;
			transition: linear 0.5s;
		}
		#video img:hover{
			filter: blur(5px);
			transition: linear 0.5s;
		}
		#video h3{
			width: 100%;
			padding: 20px 10px;
			text-align: justify;
			cursor: pointer;
		}
		#insc{
			display: block;
			margin: auto;
			padding: 7px 13px;
			color: #FFF;
			font-weight: bold;
			background-color: #f83771;
			cursor: pointer;
			border-radius: 0.3em;
			border: none;
			margin-bottom: 50px;
			transition: linear 0.5s;
		}
		#insc:hover{
			background-color: transparent;
			cursor: pointer;
			border-radius: 0;
			border: thin solid #fff;
			margin-bottom: 50px;
			transition: linear 0.5s;
		}
		#loading{
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100vh;
			text-align: center;
			display: none;
			background-color: transparent;
		}
		#cor{
			position: absolute;
			width: 100%;
			height: 100vh;
			background-color: #000;
			opacity: 0.9;
			z-index: -1;
		}
		#loading p{
			color: #FFF;
			font-size: 36px;
			font-weight: bold;
			padding-top: 50vh;
		}
	</style>
</head>
<body>
	<div id="loading">
		<div id="cor"></div>
		<p>Processando dados ....</p>
	</div>
	<img src="uploads/<?php echo $info['capa']; ?>" id="capa">
	<img src="uploads/<?php echo $info['imagem']; ?>" id="imagem">
	<h1 id="nome"><?php echo $info['nome']; ?></h1>
	<div id="content">
	<?php
		$get = mysql_query("SELECT * FROM `inscritos` WHERE user='$user_id' AND conta='$id'");
		if ($id==$user_id) {
			?>
			<button id="insc" onclick="location.href = 'editar_conta.php'">Editar minha conta (<?php echo mysql_num_rows($count); ?> Inscritos)</button>
			<?php
		}elseif ($log=="nao") {
			?>
			<button id="insc" onclick="logar();"><?php echo mysql_num_rows($count); ?> inscritos</button>
			<?php
		}elseif (mysql_num_rows($get)>0) {
			?>
			<button id="insc" onclick="subscrever()">Inscrito (<?php echo mysql_num_rows($count); ?> inscritos)</button>
			<?php
		}else{
			?>
			<button id="insc" onclick="subscrever()">Inscrever-se (<?php echo mysql_num_rows($count); ?> inscritos)</button>
			<?php
		}
		echo "</div>";
		$get_videos = mysql_query("SELECT * FROM `videos` WHERE user='$id' ORDER BY id DESC");
		if (mysql_num_rows($get_videos)<=0) {
			echo '<h3 id="erro">Ops! Não há conteúdo para mostrar...</h3>';
		}else{
			while ($video=mysql_fetch_assoc($get_videos)) {
				$user = $video["user"];
				$get_user = mysql_query("SELECT * FROM `users` WHERE id='$user'");
				$user_info = mysql_fetch_assoc($get_user);
				$nome = $user_info["nome"];
				?>
				<div id="video" onclick="location.href = 'video.php?id=<?php echo $video["id"]; ?>'">
					<img src="uploads/<?php echo $video['imagem']; ?>" />
					<h3><?php echo $video["nome"]; ?></h3>
				</div>
				<?php
			}
			echo '<h3 id="erro">Komodo, '.date("Y").' - Todos os direitos reservados</h3>';
		}
	?>
	<script type="text/javascript">
		function subscrever(){
			$.ajax({
				url: 'subscrever.php?id=<?php echo $id; ?>&sub',
				cache: false,
				beforeSend: function(){
					$('#loading').fadeIn("fast");
				},
				complete: function(){
					$('#loading').fadeOut("slow");
				},
				success: function(){
					$.ajax({
					url: 'subscrever.php?id=<?php echo $id; ?>',
					cache: false,
					beforeSend: function(){
						$('#loading').fadeIn("fast");
					},
					complete: function(){
						$('#loading').fadeOut("slow");
					},
					success: function(data){
						$('#content').html(data);
					}
				});
				}
			});
		}
	</script>
</html>