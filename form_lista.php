<?php
require "classe_paciente.php";
$p = new paciente(null, null, null, null, null, null, null);
$lista = [];

$lista = $p->retornaAgenda();
session_start();
$excluido = isset($_SESSION['excluido']) ? $_SESSION['excluido'] : null;
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Augusto Mizu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-png" href="./imgens/icon_navegador2.png">
    <link rel="stylesheet" href="style.css">
    <title>Lista de cadastros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="margin-left: 20%; margin-right: 20%; margin-top: 10%" background="bg3.jpg">
    <a href="form_cadastro.php" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
        voltar ao cadastro</a>
    <div class="container-fluid border border-3 rounded p-4 shadow" style="border: rgba(255, 0, 0, .5); background-color:rgba(5, 79, 119, 0.8);backdrop-filter: blur(10px);">
        <form action="#" method="post" class="row justify-content-around ">
            <h1 class="text-center">Lista de agendamentos</h1>
            <table class="table table-bordered table-sm table-hover table-responsive text-center">
                <thead>
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Gênero</th>
                        <th>Especialidade</th>
                        <th>Data da Consulta</th>
                        <th class="table-danger">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $pl) : ?>
                        <tr>
                            <td><?= $pl["ID_paciente"] ?></td>
                            <td><?= $pl["nome"] ?></td>
                            <td><?= $pl["telefone"] ?></td>
                            <td><?= $pl["genero"] ?></td>
                            <td><?= $pl["especialidade"] ?></td>
                            <td><?= $pl["data_consulta"] ?></td>
                            <td><a href="#" onclick='confirmarExclusao(<?= $pl["ID_consulta"] ?>)'>Excluir</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        ////////// caixa para corfirmar exclusão
        function confirmarExclusao(id) {
            const confirmacao = confirm("Você tem certeza que deseja excluir este agendamento? (ㆆ_ㆆ)");
            if (confirmacao) {
                // Redireciona para o script de exclusão com confirmação
                window.location.href = `action_excluir.php?id=${id}&confirmar=true`;
            }
        }
    </script>
     <script>
        // Alerta de paciente cadastrado com sucesso
        document.addEventListener('DOMContentLoaded', function() {
            var excluido = <?php echo json_encode($excluido); ?> ?? null;

            if (excluido == 1) {
                alert('AGENDAMENTO EXCLUIDO COM SUCESSO!! (*^_^*)');
            }else if(excluido == 2){
                alert('ERRO: TENTE NOVAMENTE (｡>﹏<｡)');
            }
            <?php $_SESSION['excluido'] = null ?>
        });
    </script>
</body>

</html>