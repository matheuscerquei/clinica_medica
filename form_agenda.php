<?php
session_start();
$cadastrado = isset($_SESSION['cadastrado']) ? $_SESSION['cadastrado'] : null;

if (isset($_GET['link'])) { // caso o paciente já esteja cadastrado
    $jaCadastrado = $_GET['link'];
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Augusto Mizu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-png" href="./imgens/icon_navegador2.png">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="margin-left: 25%; margin-right: 25%; margin-top: 10%" background="bg3.jpg">
    <a href="form_cadastro.php" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
        voltar ao cadastro</a>
    <div class="container-fluid border border-3 rounded p-5 shadow" style="border: rgba(255, 0, 0, .5); background-color:rgba(5, 79, 119, 0.8);backdrop-filter: blur(10px);">
        <form action="action_agenda.php" method="post" class="row justify-content-around">
            <h1 class="text-center">AGENDAR CONSULTA</h1>
            <small class="text-center">AGENDE UMA CONSULTA PARA O PACIENTE</small>
            <div class="col-10">
                <div class="mb-2 w-75">
                    <br>
                    <label for="nomePaciente">Nome do paciente</label>
                    <input type="text" class="form-control text-body-secondary" name="pacienteInput" value="<?= $_SESSION['ultimo_cadastro']['nome'] ?>" disabled>
                </div>
                <div class="mb-2 w-50">
                    <label for="especialidadeSelect">Especialidade</label>
                    <select name="especialidadeSelect" id="especialidadeSelect" class="form-control" required>
                        <option value="" disabled selected>Selecione uma especialidade...</option>
                        <option value="CARDIOLOGIA">Cardiologia</option>
                        <option value="DERMATOLOGIA">Dermatologia</option>
                        <option value="ENDOCRINOLOGIA">Endocrinologia</option>
                        <option value="NEUROLOGIA">Neurologia</option>
                        <option value="ORTOPEDIA">Ortopedia</option>
                        <option value="ONCOLOGIA">Oncologia</option>
                        <option value="GASTROENTEROLOGIA">Gastroenterologia</option>
                        <option value="PNEUMOLOGIA">Pneumologia</option>
                        <option value="REUMATOLOGIA">Reumatologia</option>
                        <option value="PSIQUIATRIA">Psiquiatria</option>
                        <option value="UROLOGIA">Urologia</option>
                        <option value="GINECOLOGIA">Ginecologia</option>
                        <option value="OFTALMOLOGIA">Oftalmologia</option>
                    </select>
                </div>
                <div class="mb-2 w-50">
                    <label for="dataHora" class="form-label">Data e Hora</label>
                    <input type="datetime-local" class="form-control" id="dataHora" name="dataHora" min="<?= date('Y-m-d\TH:i') ?>" required>
                </div>
                <br>
            </div>
            <input type="submit" class="button w-75" value="SALVAR">
        </form>
        <a href="form_agendamento.php" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
       Ver lista de agendamentos</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        // Alerta de paciente cadastrado com sucesso
        document.addEventListener('DOMContentLoaded', function() {
            var cadastrado = <?php echo json_encode($cadastrado); ?> ?? null;

            if (cadastrado == 1) {
                alert('PACIENTE CADASTRADO COM SUCESSO!! (*^_^*)');
            }else if(cadastrado == 2){
                alert('AGENDAMENTO CADASTRADO COM SUCESSO!! (*^_^*)');
            }else if (cadastrado == 3){
                alert('ERRO: FALHA NO AGENDAMENTO TENTE NOVAMENTE (｡>﹏<｡)');
            }
            <?php $_SESSION['cadastrado'] = null ?>
        });
    </script>
</body>

</html>