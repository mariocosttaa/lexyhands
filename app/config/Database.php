<?php

namespace App\Config;

use PDO;
use PDOException;



class Database 
{
    private static $instance;
    // A configuração do banco de dados será atribuída via construtor
    private $host;
    private $database;
    private $username;
    private $password;
    private $port;

    // Construtor da classe, definindo as configurações a partir do $_ENV
    public function __construct()
    {
        // Carregar variáveis de ambiente (se necessário) asdda
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../'); // Caminho correto para a raiz do projeto
        $dotenv->load();

        // Definindo as configurações do banco de dados a partir de variáveis de ambiente
        $this->host = $_ENV['DB_HOST']; // Valor padrão se a variável não existir
        $this->database = $_ENV['DB_NAME']; // Valor padrão se a variável não existir
        $this->username = $_ENV['DB_USER']; // Se não existir, ficará vazio
        $this->password = $_ENV['DB_PASSWORD']; // Se não existir, ficará vazio
        $this->port = $_ENV['DB_PORT'] ?? 3306; // Porta padrão MySQL
    }

    // Método para retornar a instância da conexão
    public static function conn() 
    {
        // Verifica se a instância já foi criada, se não, cria uma nova conexão
        if (!isset(self::$instance)) {
            $database = new self(); // Cria uma nova instância da classe Database
            $dsn = "mysql:host={$database->host};dbname={$database->database};port={$database->port}";

            try {
                // Criando a conexão PDO
                self::$instance = new PDO($dsn, $database->username, $database->password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                // Em caso de erro, exibe a mensagem de erro
                self::handleError('Erro ao conectar ao banco de dados: ' . $e->getMessage());
            }
        }

        // Retorna a instância da conexão
        return self::$instance;
    }

    // Método privado para tratamento de erros
    private static function handleError(string $message): void
    {
        echo $message; // Exibe a mensagem de erro
        exit(); // Encerra a execução do script
    }
}
