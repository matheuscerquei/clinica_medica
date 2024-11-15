<?php 
require "classe_paciente.php";

$p = new paciente(null, null, null, null, null, null, null);
$id = $_GET['id'];

$excluido = $p->excluirAgenda($id);
session_start();
var_dump($excluido);
if($excluido){ //excluido com sucesso
$_SESSION['excluido'] = 1;
header("Location:form_lista.php");
}else{ // não excrudeo
$_SESSION['excluido'] = 2;
header("Location:form_lista.php");
}
?>