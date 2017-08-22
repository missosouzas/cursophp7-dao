<?php

require_once("config.php");

//////////////////////////////////////////////
/*carrega um usuario */
//$root = new Usuario();

//$root->loadbyId(5);

//echo $root;

////////////////////////////////////////
/*carrega uma lista de uusarios */

//$lista = Usuario::getList();

//echo json_encode($lista);

//carrega uma lista de uusarios buscando pelo login

//$search = Usuario::search("s");

//echo json_encode($search);

////////////////////////
/*carrega usuario usando o login e a senha */

//$usuario = new Usuario();
//$usuario->login("jose","123123123"); 

//echo $usuario;

/////////////////////////////
/*criando um novo usuario */
//$aluno = new Usuario("aluno","@senhanova");
//$aluno->insert();

//echo $aluno;

/////////////////////////////
/*alterar um usuario */

//$usuario = new Usuario();
//$usuario->loadbyId(10);

//$usuario->update("Marlon", "888777");

//echo $usuario;


/////////////////////////////

$usuario = new Usuario();
$usuario->loadbyId(8);
$usuario->delete();

echo $usuario;




?>