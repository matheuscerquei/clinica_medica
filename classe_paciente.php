<?php
require "configPDO.php";
class paciente
{
    private $ID_paciente;
    private $nome;
    private $data_nascimento;
    private $email;
    private $telefone;
    private $endereco;
    private $genero;

    function __construct($ID_paciente, $nome, $data_nascimento, $email, $telefone, $endereco, $genero)
    {
        $this->ID_paciente = $ID_paciente;
        $this->nome = htmlspecialchars($nome);
        $this->data_nascimento = htmlspecialchars($data_nascimento);
        $this->email = htmlspecialchars($email);
        $this->telefone = htmlspecialchars($telefone);
        $this->endereco = htmlspecialchars($endereco);
        $this->genero = htmlspecialchars($genero);
    }

    function cadastrar(paciente $p)
    {
        $c = new config();
        $pdo = $c->getPDO();

        // consulta se o paciente já foi cadastrado
        $sql = $pdo->prepare("SELECT * FROM paciente WHERE email = :email");
        $sql->bindValue(':email', $p->email);
        $sql->execute();

        if ($sql->rowCount() == 0) { // não encontrou o email no cadastro, então cadastra o paciente
            $sql = $pdo->prepare("INSERT INTO paciente (nome, data_nascimento, email, telefone, endereco, genero) VALUES (:nome, :data_nascimento, :email, :telefone, :endereco, :genero)");
            $sql->bindValue(':nome', $p->nome);
            $sql->bindValue(':data_nascimento', $p->data_nascimento);
            $sql->bindValue(':email', $p->email);
            $sql->bindValue(':telefone', $p->telefone);
            $sql->bindValue(':endereco', $p->endereco);
            $sql->bindValue(':genero', $p->genero);

            if ($sql->execute()) {
                // se true retorna o ultimo registro cadastrado
                $sql = $pdo->query("SELECT * FROM paciente ORDER BY ID_paciente DESC LIMIT 1");
                return  $sql->fetch(PDO::FETCH_ASSOC);
            } else {
                // algo deu ruim
                return false;
            }
        } else {
            // paciente já cadastrado 
            return false;
        }
    }
    function agendar($ID_paciente, $especialidade, $data_consulta)
    { //agendar a consulta
        $c = new config();
        $pdo = $c->getPDO();

        $sql = $pdo->prepare("INSERT INTO consulta (ID_FK_paciente, especialidade, data_consulta) VALUES (:ID_FK, :especialidade, :data_consulta)");
        $sql->bindValue(':ID_FK', $ID_paciente);
        $sql->bindValue(':especialidade', $especialidade);
        $sql->bindValue(':data_consulta', $data_consulta);

        if ($sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function retornaAgenda()
    {
        // retorna todos os agendamentos cadastrados
        $c = new config();
        $pdo = $c->getPDO();

        $sql = $pdo->query("SELECT * FROM agenda"); // select na view agenda
        $sql->execute();
        if ($sql->rowCount() > 0) { // retorna a lista cadastrada
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else { // algo deu ruim
            return false;
        }
    }

    function excluirAgenda($id)
    {
        $c = new config();
        $pdo = $c->getPDO();

        $sql = $pdo->prepare("DELETE FROM consulta WHERE ID_consulta = :ID");
        $sql->bindValue(':ID', $id);

        if ($sql->execute()) {
            // escluido com sucesso 
            return true;
        } else{
            // deu ruim
            return false;
        }
    }
}
