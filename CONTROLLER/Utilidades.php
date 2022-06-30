<?php
  class Utilidades{
    function verificaCampos(Array $campos){
      $temCampoVazio = false;
        for($i = 0; $i < count($campos); $i++){
            if($campos[$i] === ''){
                $temCampoVazio = true;
                break;
            }
        }
        return $temCampoVazio;
    }
  }