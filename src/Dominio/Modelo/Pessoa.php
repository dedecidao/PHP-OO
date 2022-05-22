<?php

namespace Dede\Comercial\Dominio\Modelo;

require_once './autoload.php';

use DateTimeInterface;


abstract class Pessoa
{
    use AcessoAtributos;
    protected $id;
    protected $nome;
    protected $dataNascimento; // (Type datetimeInterface)
    protected $endereco; //Associacao / Agregacao da Classe Pessoa com Endereco
    protected $desconto;
    private static $numDePessoas = 0;




    public function __construct($id, $nome, $dataNascimento, $endereco)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->dataNascimento = $dataNascimento;
        $this->endereco = $endereco;

        //$this->setDesconto(); // Definindo o desconto
        self::$numDePessoas++;
       
    }

    public function __destruct()
    {
        self::$numDePessoas--;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setDataNascimento(DateTimeInterface $dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public static function getNumDePessoas()
    {
        return self::$numDePessoas;
    }


    public function idade(): int
    {
        return $this->getDataNascimento()
            ->diff(new \DateTimeImmutable())
            ->y;
    }

    protected abstract function setDesconto();

    public function getDesconto(): float
    {
        return $this->desconto;
    }

    // SET E GET ENDERECO
    public function setEndereco(Endereco $endereco): void
    {
        $this->endereco = $endereco;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public abstract function __toString(): string;     
}
