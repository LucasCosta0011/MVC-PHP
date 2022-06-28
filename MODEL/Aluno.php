<?php 
    class Aluno {
    
        private $idAluno;
        private $nome;
        private $tel;
        private $status;
        
        public function getIdAluno(){
            return $this->idAluno; 
        }

        public function getNome(){
            return $this->nome; 
        }
        
        public function getTel(){
            return $this->tel;
        }
        
        public function getStatus(){
            return $this->status;
        }
        
        public function setIdAluno($idAluno){
            $this->idAluno = $idAluno;
        }

        public function setNome($nome): void{
            $this->nome = $nome;
        }
        
        public function setTel($tel): void{
            $this->tel = $tel;
        }
        
        public function setStatus($status): void{
            $this->status = $status;
        }
    }
    