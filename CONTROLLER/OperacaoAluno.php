<?php
    class OperacaoAluno {
        function buscarAluno($idAluno){
            $sqlBuscar = "SELECT * FROM aluno WHERE id_aluno = ". $idAluno;

            try{
                include '../CONTROLLER/Connection.php';
                $pst = $conn->query($sqlBuscar);
                
                if(!($pst->rowCount() === 1)){
                    echo "<script>alert('Nenhum registro encotrado!')</script>";
                    exit();
                }
                
                include_once '../MODEL/Aluno.php';
                $aluno = new aluno();
                while($row = $pst->fetch()){
                    $aluno->setNome($row['nome_aluno']);
                    $aluno->setTel($row['tel_aluno']);
                    $aluno->setStatus($row['status']);
                }
                return $aluno;
            }catch(PDOException $ex){
                echo $ex;
            }
        }
        
        function atualizarAluno(Aluno $aluno){
            $sqlAtualizar = "UPDATE aluno SET nome_aluno = ?, tel_aluno = ?, status = ? "
                    . "WHERE id_aluno = ?";
            
            try {
                include '../CONTROLLER/Connection.php';
                $pst = $conn->prepare($sqlAtualizar);
                
                $pst->bindValue(1, $aluno->getNome(), PDO::PARAM_STR);
                $pst->bindValue(2, $aluno->getTel(), PDO::PARAM_INT);
                $pst->bindValue(3, $aluno->getStatus(), PDO::PARAM_STR);
                $pst->bindValue(4, $aluno->getIdAluno(), PDO::PARAM_INT);
                
                if($pst->execute() == 1){
                    echo "<script>alert('Aluno atualizado com sucesso!')</script>";
                }else{
                    echo "<script>alert('Erro, aluno não foi atualizado!')</script>";
                }
                
            } catch (PDOException $ex) {
                echo "Erro: " . $ex;
            }
        }
        
        function excluirAluno($idAluno){
            $sqlExcluir = "DELETE FROM aluno WHERE id_aluno = ".$idAluno;
            
            try{
                include '../CONTROLLER/Connection.php';
                $pst = $conn->prepare($sqlExcluir);
                if($pst->execute() == 1){
                    echo "<script>alert('Aluno excluído com sucesso!')</script>";
                }else{
                    echo "<script>alert('Erro, aluno não foi excluído!')</script>";
                }
            }catch(PDOException $ex){
                echo "Erro: ". $ex;
            }
        }

        function salvarAluno(Aluno $dados){
            $sqlSalvar='insert into aluno (nome_aluno, tel_aluno, status) values (?,?,?)';
            
            try{
                include '../CONTROLLER/Connection.php';
                $pst = $conn->prepare($sqlSalvar);

                $pst->bindValue(1, $dados->getNome(), PDO::PARAM_STR);
                $pst->bindValue(2, $dados->getTel(), PDO::PARAM_INT);
                $pst->bindValue(3, $dados->getStatus(), PDO::PARAM_STR);
                if($pst->execute() == 1){
                    echo "<script>alert('Aluno cadastrado com sucesso!')</script>";
                }else{
                    echo "<script>alert('Erro, aluno não foi cadastrado!')</script>";
                }
                
            }catch(PDOException $ex){
                echo "Erro: ".$ex;
            }
        }   
    }