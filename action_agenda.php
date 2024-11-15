<?php
require "classe_paciente.php";
session_start();

$especialidade = $_POST['especialidadeSelect'];
$dataHora = $_POST['dataHora'];

$id_paciente = $_SESSION['ultimo_cadastro']['ID_paciente'];
$p = new paciente(null, null, null, null, null, null, null);
$agendar = $p->agendar($id_paciente, $especialidade, $dataHora);

if ($agendar) { // cadastrado com sucesso
    $_SESSION['cadastrado'] = 2; // para a mensagem de agendado com sucesso
    header("Location:form_cadastro.php");
}else{
    $_SESSION['cadastrado'] = 3; // erro no agendamento
    header("Location:form_agenda.php");
}
