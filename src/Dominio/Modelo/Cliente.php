<?php 

    namespace Dede\Comercial\Dominio\Modelo;

    use DateTimeInterface;

    class Cliente extends Pessoa
    {
        private $renda;

        public function __construct($id,  $nome,  $dataNascimento,  $endereco,  $renda)
        {
            parent::__construct($id, $nome, $dataNascimento, $endereco);
            $this->renda = $renda;
        }

        public function getRenda()
        {
            return $this->renda;
        }

        public function getEndereco()
        {
            return $this->endereco;
        }

        public function setRenda($renda)
        {
            $this->renda = $renda;
        }

        public function setDesconto()
        {
            $this->desconto = 0.05;
        }

        public function __toString(): string
        {
            return  "<p>Nome :  " .$this->nome .
                    "<br>Idade: " .$this->idade() . " anos" .
                    "<br>Nasc:  " .$this->getDataNascimento()->format('d/m/Y') . 
                    "<br>End:   " .$this->endereco->getNomeLogradouro() . ", " .
                    $this->endereco->getNumero() .
                    "<br>Renda" . number_format($this->renda, 2, ',' , '.') . 
                    "</p>";
        }

    }