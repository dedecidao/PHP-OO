<?php 

    namespace Dede\Comercial\Dominio\Modelo;

    class Produto 
    {
        private  $idProduto;
        private  $nomeProduto;
        private  $precoProduto;
            //Params Construct
        public function __construct(
            ?int    $idProduto,
            string  $nomeProduto,
            float   $precoProduto
            )
        {
            $this->idProduto    = $idProduto;
            $this->nomeProduto  = $nomeProduto;
            $this->precoProduto = $precoProduto;
        }

        // Getters
        public function getIdProduto() 
        {
            return $this->idProduto;
        }
        public function getProduto(): string
        {
            return $this->nomeProduto;
        }
        public function getPreco(): float 
        {
            return $this->precoProduto;
        }

        
        // Setters
        public function setIdProduto(int $id): void 
        {
            $this->idProduto = $id;    
        }
        public function setProduto(string $nome): void 
        {
            $this->nomeProduto = $nome;
        }
        public function setPreco(float $preco): void 
        {
            $this->precoProduto = $preco;
        }
    }
