<?php
    namespace Dede\Comercial\Dominio\Modelo;
    
    require_once './autoload.php';

    use DateTimeInterface;

    class Funcionario extends Pessoa implements Autenticar
    {

        private string $cargo;
        private float  $salario;
        private string $senha;

        public function __construct(?int $id, string $nome, DateTimeInterface $dataNascimento, Endereco $endereco, string $cargo, float $salario)
        {
            parent::__construct($id, $nome, $dataNascimento, $endereco);
            $this->cargo   = $cargo;
            $this->salario = $salario;
        }
        // GETTERs
        public function getCargo(): string
        {
            return $this->cargo;
        }

        public function getSalario(): float
        {
            return $this->salario;
        }
        // SETTERs
        public function setCargo(string $cargo): void
        {
            $this->cargo = $cargo;
        }

        public function setSalario(float $salario): void
        {
            $this->salario = $salario;
        }

        // IMPLEMENTAÇÃO DO MÉTODO ABSTRATO setDesconto()
        public function setDesconto(): void
        {
            $this->desconto = 0.10;
        }
        // SOBRESCREVER ou sobrescrita
        public function __toString(): string
        {
            return "<p>Nome : " .$this->nome .
                   "<br>Idade: " . $this->idade() . " anos" .
                   "<br>Nasc.: " . $this->getDataNascimento()->format('d/m/Y') .
                   "<br>End. : " . $this->endereco->getNomeLogradouro() . ", " .
                   $this->endereco->getNumero() . " - " . $this->endereco->getBairro() .
                   "<br>Cargo: " . $this->cargo .
                   "<br>Salário R$ " . number_format($this->salario, 2, ',', '.') .
                   "</p>";
        }

        public function login($nome, $senha): void
        {
            if ($this->nome === $nome && $this->senha === $senha ) {
                echo "<p>[ LOGIN: Usuário ". $this->nome ." autenticado com sucesso! ]</p>";
            } else {
                echo "<p>[ Erro! Usuário ou senha incorreta. ]</p>";
            }
        }

        public function setSenha(string $senha): void
        {
            $this->senha = $senha;
        }

    }
