<?php 

namespace Dede\Comercial\Infraestrutura\Persistencia;

use Pdo;

class CriadorConexao
{
    public static function criarConexao(): PDO //Static para evitar que seja aberta varias instancias de banco
    {
        try {
            //Variaveis de Conexao ao banco de Dados
            $pdo = new PDO(
                'mysql:host=127.0.0.1;dbname=db_comercial',
                'root',
                ''
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            echo 'ERRO ' .$e->getMessage();
        }
    }
}