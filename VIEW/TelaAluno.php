<?php
    
    include '../CONTROLLER/OperacaoAluno.php';
    include_once '../MODEL/Aluno.php';

    // Recebendo os dados
    $idAluno = $_POST['idAluno'];
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
    $status = $_POST['status'];

    if(isset($_POST['salvar'])){
        
        try {
            // Colocando dados na instância da classe (objeto)
            $dadosAluno = new Aluno();
            $dadosAluno->setNome($nome);
            $dadosAluno->setTel($tel);
            $dadosAluno->setStatus($status);

            // Controlador
            $opAluno = new OperacaoAluno();
            $opAluno->salvarAluno($dadosAluno);
        } catch (PDOException $ex) {
            echo "Erro: " . $ex;
        }

    }else if(isset($_POST['excluir'])){

        try {
            $opAluno = new OperacaoAluno();
            $opAluno->excluirAluno($idAluno);
        } catch (PDOException $ex) {
            echo "Erro: " . $ex;
        }

    }else if(isset($_POST['alterar'])){

        try {
            $aluno = new Aluno();
            $aluno->setNome($nome);
            $aluno->setTel($tel);
            $aluno->setStatus($status);
            $aluno->setIdAluno($idAluno);

            $opAluno = new OperacaoAluno();
            $opAluno->atualizarAluno($aluno);
        } catch (PDOException $ex) {
            echo "Erro: " . $ex;
        }

    }else if(isset($_POST['buscar'])){

        try {
            $opAluno = new OperacaoAluno();
            $retornoAluno = $opAluno->buscarAluno($idAluno);
            echo $retornoAluno->getNome() . '</br>';
            echo $retornoAluno->getTel() . '</br>';
            echo $retornoAluno->getStatus();
        } catch (PDOException $ex) {
            echo "Erro: " . $ex;
        }

    }

    