<?php
	include("header.php");
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
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body{
			background-color: #444;
		}
		#fundo{
			width: 100%;
			height: 100vh;
			object-fit: cover;
			position: fixed;
			top: 0;
			left: 0;
			z-index: -999;
			filter: blur(20px);
		}
		video{
			display: block;
			margin: auto;
			max-width: 100%;
			max-height: 70vh;
			background-color: #222;
			border-bottom-left-radius: 0.5em;
			border-bottom-right-radius: 0.5em;
		}
		h1{
			display: block;
			margin: auto;
			width: 30%;
			text-align: left;
			font-weight: bold;
			padding: 10px 10px;
			color: #FFF;
		}
		#desc{
			display: block;
			margin: auto;
			width: 60%;
			padding: 20px 25px;
			background-color: #F9F9F9;
			border-radius: 0.3em;
			color: #333;
			margin-bottom: 30px;
		}
		h1 i{
			font-size: 12pt;
		}
		.autoExpand{  
        display:block;
        box-sizing: padding-box;
        overflow:hidden;

        padding:10px;
        width:250px;
        font-size:14px;
        margin:50px auto;
        border-radius:6px;
        box-shadow:2px 2px 8px rgba(0,0,0,.3);
        border:0;
        }
		#comentarios{
			display: block;
			margin: auto;
			width: 60%;
			padding: 20px 25px;
			background-color: #F9F9F9;
			border-radius: 0.3em;
			color: #333;
			margin-bottom: 40px;
		}
		#comentarios p{
			/*border-top: 1px solid #CCC;*/
			padding-top: 10px;
			margin-bottom: 10px;
		}
		#comentarios textarea{
			display: block;
			margin: auto;
			width: 400px;
			height: 70px;
			resize: none;
			padding: 5px 7px;
			border-radius: 0.2em;
			margin-bottom: 5px;
		}
		#comentarios h3{
			color: #444;
			width: 100%;
			padding: 50px 20px;
			text-align: center;
		}
		#comentarios input{
			display: block;
			margin: auto;
			width: 400px;
			padding-top: 7px;
			padding-bottom: 7px;
			border-radius: 0.2em;
			margin-bottom: 10px;
			border: none;
			cursor: pointer;
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
		.float{
			float: left;
			text-align: left;
		}
		.position{
			width: 100%;
			height: auto;
			float: left;
		}
		.position p a{
			color: #fd3873;
			text-decoration: none;
			text-align: left;
		}
		.get_title{
			width: 74%;
			margin: 0 auto;
		}
		.get_title h1{
			text-align: center;
		}
	</style>
	<script>
		// Applied globally on all textareas with the "autoExpand" class
$(document)
    .one('focus.autoExpand', 'textarea.autoExpand', function(){
        var savedValue = this.value;
        this.value = '';
        this.baseScrollHeight = this.scrollHeight;
        this.value = savedValue;
    })
    .on('input.autoExpand', 'textarea.autoExpand', function(){
        var minRows = this.getAttribute('data-min-rows')|0, rows;
        this.rows = minRows;
        rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 17);
        this.rows = minRows + rows;
    });
autosize(document.getElementById("note"));
	</script>
</head>
<body>
<center>
	<div id="loading">
		<div id="cor"></div>
		<p>Processando ....</p>
	</div>
	<img src="uploads/<?php echo $info["imagem"]; ?>" id="fundo">
	<video id="my-video" class="video-js" controls preload="auto" poster="MY_VIDEO_POSTER.jpg" data-setup="{}" width="1000" height="565">
		<source src="uploads/<?php echo $info['local']; ?>" type="video/mp4">
		O seu browser não suporta leitura de vídeos...
	</video>
	<!-- <h1><?php //echo $info['nome']; ?> <i>(<?php //echo $info['visualizacoes']; ?> visualizações)</i><p></p></h1> -->
	<div class="get_title" id="get_thumbs">
	    <h1><?php echo $info['nome']; ?></h1>
	</div>
	<p id="desc"><strong>Descrição do vídeo</strong><br /><br /><span class="float"><?php echo $info['descricao']; ?></span></p>
	<div id="comentarios">
		<strong></strong>
		<?php
			if ($log=="sim") {
				?><form method="POST" name="comentar"><textarea class='autoExpand' id="noventa" rows='3' name="texto" maxlength="500"  data-min-rows='3' placeholder='Descrição'></textarea><input type="submit" name="comentar" value="Comentar"></form><?php
			}
			echo '<div id="comentario">';
			$get_comments = mysql_query("SELECT * FROM comentarios WHERE video='$id' ORDER BY id DESC");
			if (mysql_num_rows($get_comments)>=1) {
				while ($comment = mysql_fetch_assoc($get_comments)) {
					$user = $comment["user"];
					$get_user = mysql_query("SELECT * FROM users WHERE id='$user'");
					$user = mysql_fetch_assoc($get_user);
					?>
					<hr>
					<div class="position">
					<p><a href="conta.php?id=<?php echo $user["id"];?>"><strong><?php echo $user["nome"]; ?> disse:</strong></a> <?php echo $comment["texto"]; ?></p>
					</div>
					<?php
				}
			}else{
				echo "<h3>Não há comentários a apresentar</h3>";
			}
			echo "</div>";
		?>
	</div>
	<script type="text/javascript">
		var interval = setInterval(function(){
			$.ajax({
				url: 'comentarios.php?id=<?php echo $id ?>',
				success: function(data){
					$('#comentario').html(data);
				},
				cache: false
			});
		}, 3000);
		$("form[name='comentar']").submit(function(e){
			var formData = new FormData($(this)[0]);
			$.ajax({
				url: 'comentarios.php?id=<?php echo $id ?>&comentar',
				type: "POST",
				data: formData,
				async: false,
				beforeSend: function(){
					$('#loading').fadeIn("fast");
				},
				success: function(){
					$.ajax({
						url: 'comentarios.php?id=<?php echo $id ?>',
						beforeSend: function(){
							$('#loading').fadeIn("fast");
						},
						success: function(data){
							$('#comentario').html(data);
							$('#loading').fadeOut("fast");
						},
						cache: false
					});
				},
				cache: false,
				contentType: false,
	            processData: false
			});
			e.preventDefault();
		});
	</script>
	<script src="http://vjs.zencdn.net/5.19.2/video.js"></script>

</center>
</body>
</html>