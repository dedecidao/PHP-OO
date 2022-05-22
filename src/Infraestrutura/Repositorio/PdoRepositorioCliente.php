<?php

    namespace Dede\Comercial\Infraestrutura\Repositorio;
    
    use Dede\Comercial\Dominio\Modelo\Cliente;
    use Dede\Comercial\Dominio\Repositorio\RepositorioClientes;
    
    use Dede\Comercial\Dominio\Modelo\Endereco; // ADICIONE
    use DateTimeImmutable; // ADICIONE
    
    use PDO;

    class PdoRepositorioCliente implements RepositorioClientes
    {
        private $conexao;

        public function __construct(PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        public function todosClientes(): array
        {
            $sqlConsulta = "SELECT * FROM cliente";
            $stmt = $this->conexao->query($sqlConsulta);

            return $this->hidratarListaClientes($stmt);
        }

        public function todosClientesComEndereco(): array
        {
            $sqlConsulta = "SELECT * FROM cliente JOIN endereco ON id = idCliente";
            $stmt = $this->conexao->query($sqlConsulta);
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $listaCliente = [];

            foreach($resultado as $linha) {
                if(!array_key_exists($linha['id'], $listaCliente)) {
                    $listaCliente[$linha['id']] = new Cliente(
                        $linha['id'],
                        $linha['nome'],
                        new DateTimeImmutable($linha['dataNascimento']),
                        new Endereco(NULL, "", "", "", "", "", "", NULL),
                        $linha['renda']);
                } // fim if
                
                $endereco = new Endereco(
                    $linha['idendereco'],
                    $linha['uf'],
                    $linha['cidade'],
                    $linha['nomeLogradouro'],
                    $linha['numero'],
                    $linha['bairro'],
                    $linha['cep'],
                    $linha['idCliente']);

                    $listaCliente[$linha['id']]->setEndereco($endereco);

                } // fim foreach
            
            return $listaCliente;
        }

        public function salvar(Cliente $cliente): bool
        {
            if ($cliente->getId() === null) {
                return $this->createCliente($cliente);
            }

            return $this->updateCliente($cliente);
        }

        private function createCliente(Cliente $cliente): bool
        {
            $sqlInsert = "INSERT INTO cliente (nome, dataNascimento, renda) VALUES (:nome, :datanasc, :renda);";
            $stmt = $this->conexao->prepare($sqlInsert);
            $stmt->bindValue(':nome', $cliente->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(':datanasc', $cliente->getDataNascimento()->format('Y-m-d'));
            $stmt->bindValue(':renda', $cliente->getRenda(), PDO::PARAM_STR);
            $sucesso = $stmt->execute();
            
            if ($sucesso) {
                $cliente->setId($this->conexao->lastInsertId());
                $this->criaEndereco($cliente->getEndereco(), $cliente); // CRIAR ENDERECO NO BB
            }

            return $sucesso;
        }

        public function ler(Cliente $cliente): array
        {
            $sqlConsulta = "SELECT * FROM cliente WHERE id = :id;";
            $stmt = $this->conexao->prepare($sqlConsulta);
            $stmt->bindValue(':id', $cliente->getId(), PDO::PARAM_INT);
            $stmt->execute();

            return $this->hidratarListaClientes($stmt);
        }

        public function updateCliente(Cliente $cliente): bool
        {
            $sqlUpdate = "UPDATE cliente SET nome = :nome, dataNascimento = :datanasc, renda = :renda WHERE id = :id;";
            $stmt = $this->conexao->prepare($sqlUpdate);
            $stmt->bindValue(':nome', $cliente->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(':datanasc', $cliente->getDataNascimento()->format('Y-m-d'));
            $stmt->bindValue(':renda', $cliente->getRenda(), PDO::PARAM_STR);
            
            $stmt->bindValue(':id', $cliente->getId(), PDO::PARAM_INT);

            return $stmt->execute();
        }

        public function delete(Cliente $cliente): bool
        {
            $stmt = $this->conexao->prepare('DELETE FROM cliente WHERE id = ?;');
            $stmt->bindValue(1, $cliente->getId(), PDO::PARAM_INT);

            return $stmt->execute();
        }

        // CRIAR ENDERECO
        public function criaEndereco(Endereco $endereco, Cliente $cliente): bool
        {
            $idCliente = $cliente->getId();
            $sqlInsert = "INSERT INTO endereco (uf, cidade, nomeLogradouro, numero, bairro, cep, idCliente) VALUES (:uf, :cidade, :nomeLogradouro, :numero, :bairro, :cep, :idCliente);";

            $stmt = $this->conexao->prepare($sqlInsert);
            
            $stmt->bindValue(':uf', $endereco->getUf(), PDO::PARAM_STR);
            $stmt->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR);
            $stmt->bindValue(':nomeLogradouro', $endereco->getNomeLogradouro(), PDO::PARAM_STR);
            $stmt->bindValue('numero', $endereco->getNumero(), PDO::PARAM_STR);
            $stmt->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
            $stmt->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR);
            
            $stmt->bindValue(':idCliente', $idCliente, PDO::PARAM_INT); // USO AQUI O idCliente

            $sucesso = $stmt->execute();
            
            if ($sucesso) {
                $endereco->setId($this->conexao->lastInsertId());
            }

            return $sucesso;
                          
        }

        public function atualizaEndereco(Endereco $endereco, Cliente $cliente): bool
        {
            $idCliente = $cliente->getId();
            $sqlUpdate = "UPDATE endereco SET uf = :uf, cidade = :cidade, nomeLogradouro = :nomeLogradouro, numero = :numero, bairro = :bairro, cep = :cep WHERE idendereco = :idCliente;";
            $stmt = $this->conexao->prepare($sqlUpdate);
            $stmt->bindValue(':uf', $endereco->getUf(), PDO::PARAM_STR);
            $stmt->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR);
            $stmt->bindValue(':nomeLogradouro', $endereco->getNomeLogradouro(), PDO::PARAM_STR);
            $stmt->bindValue('numero', $endereco->getNumero(), PDO::PARAM_STR);
            $stmt->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
            $stmt->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR);
            
            $stmt->bindValue(':idCliente', $idCliente, PDO::PARAM_INT);

            return $stmt->execute();
        }

        // HIDRATAR OS DADOS
        public function hidratarListaClientes(\PDOStatement $stmt): array
        {
            $listaDadosClientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $listaClientes = [];

            foreach ($listaDadosClientes as $dadosCliente) {
                $cliente = new Cliente (
                    $dadosCliente['id'],
                    $dadosCliente['nome'],
                    new DateTimeImmutable($dadosCliente['dataNascimento']),
                    new Endereco(NULL, "", "", "", "", "", "", NULL),
                    $dadosCliente['renda'],
                );

                $this->preencheEndereco($cliente);

                $listaClientes[] = $cliente;

            }

            return $listaClientes;

        }

        private function preencheEndereco(Cliente $cliente): void
        {
            $sqlConsulta = "SELECT * FROM endereco WHERE idendereco = ?;";
            $stmt = $this->conexao->prepare($sqlConsulta);
            $stmt->bindValue(1, $cliente->getId(), PDO::PARAM_INT);
            $stmt->execute();

            $listaDeEnderecos = $stmt->fetchAll();

            foreach($listaDeEnderecos as $endereco) {
                $endereco = new Endereco(
                    $endereco['idendereco'],
                    $endereco['uf'],
                    $endereco['cidade'],
                    $endereco['nomeLogradouro'],
                    $endereco['numero'],
                    $endereco['bairro'],
                    $endereco['cep'],
                    $endereco['idCliente']);
            }

        } // fim preencheEndereco

    } // fim class
