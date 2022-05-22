<?php
    require_once 'autoload.php';
    
    use Dede\Comercial\Infraestrutura\Persistencia\CriadorConexao;
    use Dede\Comercial\Infraestrutura\Repositorio\PdoRepositorioProduto;
    
    
    use Dede\Comercial\Infraestrutura\Repositorio\PdoRepositorioCliente;
    
    
    use Dede\Comercial\Dominio\Modelo\Endereco;
    use Dede\Comercial\Dominio\Modelo\Pessoa;
    use Dede\Comercial\Dominio\Modelo\Produto;
    use Dede\Comercial\Dominio\Modelo\Cliente;

    
//$pessoa1 = new Pessoa("Edson", 10);
//$pessoa2 = new Pessoa("Andre", 40);


echo "<pre>";
    $reposProduto1 = new PdoRepositorioProduto(CriadorConexao::criarConexao());


    var_dump($reposProduto1);
    
    $produto2 = new Produto(NULL, "Drone", 200);
    var_dump($produto2);
    // $produto3 = new Produto(NULL, "J6 Samsumg", 500);
    // $produto4 = new Produto(NULL, "double", 2000);
    // $produto5 = new Produto(NULL, "Pc positivo", 3500);
    // $produto6 = new Produto(NULL, "PS5", 100);
    // $produto7 = new Produto(NULL, "Fone de ouvido", 9999);

    //$reposProduto1->salvar($produto2);
    // $reposProduto1->salvar($produto4);
    // $reposProduto1->salvar($produto5);
    // $reposProduto1->salvar($produto6);
    // $reposProduto1->salvar($produto7);

    //$reposProduto1->todosProdutos();
    //var_dump($conexao);
    //var_dump($produto1);

    // $reposCliente1 = new PdoRepositorioCliente(CriadorConexao::criarConexao());
    // $endereco1 = new Endereco(
    //     NULL,
    //     "AP", "Macapá",
    //     "Av. da Cidade", "100", "Centro",
    //     "68900-000", NULL);

    // $cliente1 = new Cliente(NULL, "Maria Maia", new DateTimeImmutable("1954-12-01"), $endereco1, 2000.00);
    // $reposCliente1->salvar($cliente1);

echo "</pre>";