<?php

namespace Dede\Comercial\Dominio\Modelo;



class Pessoa
{
    private $nome;
    private $idade;

    public function __construct($nome,$idade)
    {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->validaIdade($idade);
    }
    public function getNome(){
        return $this->nome;
    }
    
    public function getIdade(){
        return $this->idade;
    }

    //sets

    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setIdade($idade){
        $this->idade = $idade;
    }

    public function validaIdade($idade){
        if ($this->idade >= 0 && $this->idade <120) {
            $this->idade = $idade;
        } else {
            return "Idade nao valida";
            exit();
        }
    }
}
