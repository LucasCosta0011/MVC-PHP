<?php
    include '../CONTROLLER/OperacaoAluno.php';
    include_once '../MODEL/Aluno.php';
    include '../CONTROLLER/Utilidades.php';

    if(isset($_POST['salvar'])){
        
        handleClickBtnSalvar();

    }else if(isset($_POST['excluir'])){

        handleClickBtnExcluir();

    }else if(isset($_POST['alterar'])){

        handleClickBtnAlterar();

    }else if(isset($_POST['buscar'])){

        handleClickBtnBuscar();

    }
    function mensagem($mensagem){
        echo "<script>alert('" . $mensagem . "')</script>";
    }

    function getCampos(){
        $campos = [

            $_POST['idAluno'],
            $_POST['nome'],
            $_POST['tel'],
            $_POST['status']

        ];
        return $campos;
    }

    function handleClickBtnSalvar(){

        $utilidades = new Utilidades();
        if($utilidades->verificaCampos(getCampos())){
            mensagem('Por favor, preencha todos os campos!');
        }else{

            try {
                // Colocando dados na instância da classe (objeto)
                $dadosAluno = new Aluno();
                $dadosAluno->setNome($_POST['nome']);
                $dadosAluno->setTel($_POST['tel']);
                $dadosAluno->setStatus($_POST['status']);
    
                // Controlador
                $opAluno = new OperacaoAluno();
                $opAluno->salvarAluno($dadosAluno);
            } catch (PDOException $ex) {
                echo "Erro: " . $ex;
            }
        }  
    }

    function handleClickBtnExcluir(){

        if($_POST['idAluno'] === ''){
            mensagem('Por favor, preencha o ID!');
        }else{

            try {

                $opAluno = new OperacaoAluno();
                $opAluno->excluirAluno($_POST['idAluno']);
                
            } catch (PDOException $ex) {
                echo "Erro: " . $ex;
            }
        }
    }

    function handleClickBtnAlterar(){

        $utilidades = new Utilidades();

        if($utilidades->verificaCampos(getCampos())){
            mensagem('Por favor, preencha todos os campos!');
        }else{

            try {
                $aluno = new Aluno();
                $aluno->setNome($_POST['nome']);
                $aluno->setTel($_POST['tel']);
                $aluno->setStatus($_POST['status']);
                $aluno->setIdAluno($_POST['idAluno']);
    
                $opAluno = new OperacaoAluno();
                $opAluno->atualizarAluno($aluno);
            } catch (PDOException $ex) {
                echo "Erro: " . $ex;
            }
        }
    }

    function handleClickBtnBuscar(){
        if($_POST['idAluno'] === ''){
            mensagem('Por favor, preencha o ID!');
        }else{
            try {
                $opAluno = new OperacaoAluno();
                $retornoAluno = $opAluno->buscarAluno($_POST['idAluno']);
                echo $retornoAluno->getNome() . '</br>';
                echo $retornoAluno->getTel() . '</br>';
                echo $retornoAluno->getStatus();
            } catch (PDOException $ex) {
                echo "Erro: " . $ex;
            }
        } 
    }