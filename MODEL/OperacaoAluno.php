<?php
    require_once '../MODEL/Database.php';
    require_once '../CONTROLLER/Aluno.php';

    class OperacaoAluno {

        function mensagem($mensagem){
            echo "<script>alert('" . $mensagem . "')</script>";
        }

        function buscarAluno($idAluno){
            $sqlBuscar = "SELECT * FROM aluno WHERE id_aluno = ". $idAluno;

            try{
                $pst = Database::conexao()->query($sqlBuscar);
                
                if(!($pst->rowCount() === 1)){
                    mensagem('Nenhum registro encotrado!');
                    exit();
                }
                
                $aluno = new aluno();
                while($row = $pst->fetch()){
                    $aluno->setNome($row['nome_aluno']);
                    $aluno->setTel($row['tel_aluno']);
                    $aluno->setStatus($row['status']);
                }
                return $aluno;

            }catch(PDOException $ex){
                echo "Erro: " .  $ex;
            }
        }
        
        function atualizarAluno(Aluno $aluno){
            $sqlAtualizar = "UPDATE aluno SET nome_aluno = ?, tel_aluno = ?, status = ? "
                    . "WHERE id_aluno = ?";
            
            try {
                $pst = Database::conexao()->prepare($sqlAtualizar);
                
                $pst->bindValue(1, $aluno->getNome(), PDO::PARAM_STR);
                $pst->bindValue(2, $aluno->getTel(), PDO::PARAM_INT);
                $pst->bindValue(3, $aluno->getStatus(), PDO::PARAM_STR);
                $pst->bindValue(4, $aluno->getIdAluno(), PDO::PARAM_INT);

                $pst->execute();

                if($pst->rowCount() === 1){
                    mensagem('Aluno atualizado com sucesso!');
                }else{
                    mensagem('Erro, aluno não foi encontrado!');
                }
                
            } catch (PDOException $ex) {
                echo "Erro: " .  $ex;
            }
        }
        
        function excluirAluno($idAluno){
            $sqlExcluir = "DELETE FROM aluno WHERE id_aluno = ".$idAluno;

            try{
                $pst = Database::conexao()->prepare($sqlExcluir);
                $pst->execute();

                if($pst->rowCount() === 1){
                    mensagem('Aluno excluído com sucesso!');
                }else{
                    mensagem('Erro, o ID não foi encontrado!');
                }
            }catch(PDOException $ex){
                echo "Erro: " .  $ex;
            }

        }

        function salvarAluno(Aluno $dados){
            $sqlSalvar='insert into aluno (nome_aluno, tel_aluno, status) values (?,?,?)';
            
            try{
                $pst = Database::conexao()->prepare($sqlSalvar);

                $pst->bindValue(1, $dados->getNome(), PDO::PARAM_STR);
                $pst->bindValue(2, $dados->getTel(), PDO::PARAM_INT);
                $pst->bindValue(3, $dados->getStatus(), PDO::PARAM_STR);
                $pst->execute();
                if($pst->rowCount() === 1){
                    mensagem('Aluno cadastrado com sucesso!');
                }else{
                    mensagem('Erro, aluno não foi não encontrado!');
                }
                
            }catch(PDOException $ex){
                echo "Erro: " .  $ex;
            }

        }   
    }