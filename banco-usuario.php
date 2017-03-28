<?php
/* No meu caso, eu preferi criar um banco de dados em outro host apenas com o acesso para o sistema, por isso está sendo utilizado
o "conecta-db-usuario" */
require_once("conecta-db-usuario.php");
function buscaUsuario($conexao, $email, $senha) {
	$senhaMd5 = md5($senha);
	$email = mysqli_real_escape_string($conexao, $email);
	$query = "SELECT * FROM usuarios WHERE email='{$email}' AND senha='{$senhaMd5}'";
	$resultado = mysqli_query($conexao, $query);
	$usuario = mysqli_fetch_assoc($resultado);
	return $usuario;
}
