<?php
include("header.php");

//pega a variavel via post
$email = $_POST['email'];
//busca no db o usuario com o email 
$result = mysql_query("SELECT * FROM `users` WHERE email='$email'");
//conta quantos tem
$num_rows = mysql_num_rows($result);
//se tiver  + de 1 cadastrado
if($num_rows=='1'){
	//faz um while para vc coloar os dados nas variavels
	while($Row_email = mysql_fetch_array($result)){
		$rowemail = $Row_email['email'];
		$rowsenha = $Row_email['senha'];
		}
		
//enviar um email para variavel email juntamente com a variável senha;
$mensage ="Você solicitou a recuperação de senhha confira seu dados.";
$mensage .="E-mail= " . $rowemail;
$mensage .="Senha:" . $rowsenha;
mail($rowemail, "Ampola Comunicações, recuperação de senha", $mensage);

echo"<script>alert(Sua senha foi enviada para o e-mail indicado.),window.open('recuperar_senha_enviado.php','_self')</script>";


}else{
	
	
	echo"<script>alert('E-mail não cadastrado em nosso sistema'),window.open('recuperar_senha.php','_self')</script>";
	
}


?>