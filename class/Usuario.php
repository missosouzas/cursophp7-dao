<?php

Class Usuario{

private $idusuario;
private $deslogin;
private $dessenha;
private $dtcadastro;


public function getIdusuario()
{
    return $this->idusuario;
}

public function setIdusuario($idusuario)
{
    return $this->idusuario = $idusuario;
}


public function getDeslogin()
{
    return $this->deslogin;
}

public function setDeslogin($deslogin)
{
    return $this->deslogin = $deslogin;
}




public function getDessenha()
{
    return $this->dessenha;
}

public function setDessenha($dessenha)
{
    return $this->dessenha = $dessenha;
}



public function getDtcadastro()
{
    return $this->dtcadastro;
}

public function setDtcadastro($dtcadastro)
{
    return $this->dtcadastro = $dtcadastro;
}


public function loadById($id){

	$sql = new Sql();
	$results = $sql->select("SELECT * FROM tb_usuarios Where idusuario = :ID", array(
 		":ID" =>$id
		));

	if (count($results)>0){

		$this->setData($results[0]);
	}

}

public function login($login, $password){

	$sql = new Sql();
	$results = $sql->select("SELECT * FROM tb_usuarios Where deslogin = :LOGIN AND dessenha= :PASSWORD", array(
 		":LOGIN" =>$login,
 		":PASSWORD" =>$password
		));

	if (count($results)>0){

		$row = $results[0];

		$this->setData($results[0]);

	} else{

		throw new  Exception("Login e ou senha inválidos.");
		
	}

}

public function setData($data){

	    $this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));

}

public function insert(){

	$sql	= new Sql();

	$results =  $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
	':LOGIN'=>$this->getDeslogin(),
	':PASSWORD'=>$this->getDessenha()
		));

	if (count($results)>0){

		$this->setData($results[0]);
	}

}

public function update($login, $password){

	$this->setDeslogin($login);
	$this->setDessenha($password);

	$sql	= new Sql();

	$sql->query("UPDATE tb_usuarios SET deslogin= :LOGIN, dessenha= :PASSWORD where idusuario= :ID",array(
	':LOGIN'=>$this->getDeslogin(),
	':PASSWORD'=>$this->getDessenha(),
	':ID'=> $this->getIdusuario()
	));

	
}

public function delete(){
	
	$sql	= new Sql();

	$sql->query("DELETE FROM tb_usuarios  where idusuario= :ID",array(
	':ID'=> $this->getIdusuario()
	));
	$this->setIdusuario(0);
	$this->setDeslogin("");
	$this->setDessenha("");
	$this->setDtcadastro(new DateTime());


	
}
public function __construct($login = "",$password = ""){

	$this->setDeslogin($login);
	$this->setDessenha($password);

}

public static function getList(){

	$sql	= new Sql();

	return $sql->select("SELECT * FROM tb_usuarios  ORDER BY deslogin");

}
public static function search($login){

	$sql	= new Sql();

	return $sql->select("SELECT * FROM tb_usuarios  where deslogin like :SEARCH ORDER BY deslogin",array(':SEARCH'=>"%".$login."%"));

}

public function __toString(){

	return json_encode(array(
		"idusuario" => $this->getIdusuario(), 
        "deslogin" => $this->getDeslogin(), 
        "dessenha" => $this->getDessenha(), 
        "dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
		));
}



}



?>