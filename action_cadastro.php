<?php
require "classe_paciente.php";
session_start();

$nome = $_POST['nomeInput'];
$data = $_POST['dataInput'];
$email = $_POST['emailInput'];
$telefone = $_POST['telefoneInput'];
$endereco = $_POST['enderecoInput'];
$genero = $_POST['generoSelect'];

$telefone = filter_var($telefone, FILTER_SANITIZE_NUMBER_INT); //remove os caracteres que não são números
$telefone = str_replace("-", "", $telefone);
$p = new paciente(null, $nome, $data, $email, $telefone, $endereco, $genero);
$ultimo = $p->cadastrar($p); // retorna false ou esse registro de paciente cadastrado

if ($ultimo != false) { // cadastrado com sucesso
    $_SESSION['cadastrado'] = 1;
    $_SESSION['ultimo_cadastro'] = $ultimo; // ultimo registro do paciente cadastrado com id
    header("Location:form_agenda.php");
} else {
    $_SESSION['cadastrado'] = 0;
    header("Location:form_cadastro.php");
}
