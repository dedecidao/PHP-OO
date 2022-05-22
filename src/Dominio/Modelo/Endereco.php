<?php

    namespace Dede\Comercial\Dominio\Modelo;
    
    require_once './autoload.php';

    class Endereco
    {
        use AcessoAtributos;
        private $idendereco; // ADICIONEI
        private $uf;
        private $cidade;
        private $nomeLogradouro;
        private $numero;
        private $bairro;
        private $cep;
        private $idCliente;
        //private ?int   $idFuncionario;
        
        public function __construct(?int $idendereco, string $uf, string $cidade, string $nomeLogradouro, string $numero, string $bairro, string $cep, ?int $idCliente)
        {
            $this->idendereco     = $idendereco;
            $this->uf             = $uf;
            $this->cidade         = $cidade;
            $this->nomeLogradouro = $nomeLogradouro;
            $this->numero         = $numero;
            $this->bairro         = $bairro;
            $this->cep            = $cep;
            $this->idCliente      = $idCliente;
            //$this->idFuncionario  = $idFuncionario;
        }
        
        // GETTERs
        public function getId(): ?int
        {
            return $this->idendereco;
        }

        public function getUf(): string
        {
            return $this->uf;
        }

        public function getCidade(): string
        {
            return $this->cidade;
        }

        public function getNomeLogradouro(): string
        {
            return $this->nomeLogradouro;
        }

        public function getNumero(): string
        {
            return $this->numero;
        }

        public function getBairro(): string
        {
            return $this->bairro;
        }

        public function getCep(): string
        {
            return $this->cep;
        }

        public function getIdCliente(): ?int
        {
            return $this->idCliente;
        }

        public function getIdFuncionario(): ?int
        {
            return $this->idFuncionario;
        }

        // SETTERs
        public function setId(int $id): void
        {
            $this->idendereco = $id;
        }

        public function setUf(string $uf): void
        {
            $this->uf = $uf;
        }

        public function setCidade(string $cidade): void
        {
            $this->cidade = $cidade;
        }

        public function setNomeLogradouro(string $nomeLogradouro): void
        {
            $this->nomeLogradouro = $nomeLogradouro;
        }

        public function setNumero(string $numero): void
        {
            $this->numero = $numero;
        }

        public function setBairro(string $bairro): void
        {
            $this->bairro = $bairro;
        }

        public function setCep(string $cep): void
        {
            $this->cep = $cep;
        }

        public function setIdCliente(int $idCliente): void
        {
            $this->idCliente = $idCliente;
        }
        /*
        public function setIdFuncionario(int $idFuncionario): void
        {
            $this->idFuncionario = $idFuncionario;
        }
        */
        // MÉTODOS ESPECÍFICOS
        public function __toString(): string
        {
            return "{$this->nomeLogradouro} , nº 
                    {$this->numero} - 
                    Bairro {$this->bairro} - 
                    {$this->cidade}-{$this->uf} | 
                    {$this->cep}";
        }

    }
