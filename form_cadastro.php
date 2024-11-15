<?php

session_start(); // Inicie a sessão
// Verifica o se o cadastra foi bem sucedido, retornado pelo action
$cadastrado = isset($_SESSION['cadastrado']) ? $_SESSION['cadastrado'] : null;
session_destroy();
// Calcula a data mínima (18 anos atrás), impede a entrada de menores de 18 anos
$dataMinima = date('Y-m-d', strtotime('-18 years'));
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
  <div class="container-fluid border border-3 rounded p-5 shadow" style="border: rgba(255, 0, 0, .5); background-color:rgba(5, 79, 119, 0.8);backdrop-filter: blur(10px);">
    <form action="action_cadastro.php" method="post" class="row justify-content-evenly">
      <h1 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;" class="text-center">
        CADASTRAR PACIENTE</h1>
      <div class="mb-2 w-75">
        <label for="nomeInput">Nome</label>
        <input type="text" name="nomeInput" class="form-control" maxlength="50" placeholder="Nome" required>
      </div>
      <div class="mb-2 w-75">
        <label for="emailInput">Email</label>
        <input type="email" name="emailInput" class="form-control" maxlength="30" placeholder="Email" required>
      </div>
      <div class="mb-2 w-75">
        <label for="enderecoInput">Endereço</label>
        <input type="text" name="enderecoInput" class="form-control" maxlength="30" placeholder="Endereço" required>
      </div>
      <div class="mb-2 d-flex justify-content-around">
        <div class="col-4 w-25 ">
          <label for="generoSelect">Gênero</label>
          <select name="generoSelect" id="sexoSelect" class="form-control" required>
            <option value="" disabled selected>Selecione...</option>
            <option value="MASCULINO">Masculino</option>
            <option value="FEMININO">Feminino</option>
            <option value="OUTRO">Outro</option>
          </select>
        </div>
        <div class="col-4 w-25">
          <label for="dataInput">Data nascimento</label>
          <input type="date" name="dataInput" class="form-control" max="<?= $dataMinima ?>" required>
          <small> Mínimo 18 anos.</small>
        </div>
      </div>
      <div class="mb-2 w-75">
        <label for="telefoneInput">Telefone</label>
        <input type="text" class="form-control" name="telefoneInput" id="telefoneInput" minlength="13"
          placeholder="XX XXXXX-XXXX" required>
        <br>
      </div>
      <input type="submit" class="button w-75" value="SALVAR">
        <a href="form_lista.php" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
        Ver lista de agendamentos</a>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script>

  </script>

  <script>
    function formatarTelefone(telefone) {
      telefone = telefone.replace(/\D/g, '');

      if (telefone.length <= 2) {
        return `${telefone}`;
      } else if (telefone.length <= 7) {
        return `${telefone.slice(0, 2)} ${telefone.slice(2)}`;
      } else {
        return `${telefone.slice(0, 2)} ${telefone.slice(2, 7)}-${telefone.slice(7, 11)}`;
      }
    }
    document.getElementById('telefoneInput').addEventListener('input', function() {
      this.value = formatarTelefone(this.value);
    });
  </script>
  <script>
    // Alerta de paciente cadastrado com sucesso
    document.addEventListener('DOMContentLoaded', function() {
      var cadastrado = <?= json_encode($cadastrado)?> ?? null;

      if (cadastrado == 0) {
        alert('ERRO: PACIENTE JÁ CADASTRADO TENTE NOVAMENTE (｡>﹏<｡)');
      };
    });
  </script>
</body>

</html>