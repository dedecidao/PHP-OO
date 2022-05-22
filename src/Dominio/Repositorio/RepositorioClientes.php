<?php 

    namespace Dede\Comercial\Dominio\Repositorio;

    use Dede\Comercial\Dominio\Modelo\Cliente; //Atualizado


    interface RepositorioClientes
    {
        public function todosClientes(): array;
        public function salvar(Cliente $cliente): bool;
        public function ler(Cliente $cliente): array;
        public function delete(Cliente $cliente): bool;
    }