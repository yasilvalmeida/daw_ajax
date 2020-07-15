<?php
    // Classe MySQL PDO para realizar uma conexao mysql via PDO
    class MySQLPDO
    {
        private $connection;
        private $hostname;
        private $database;
        private $username;
        private $password;
        /* 
        Este constructor atribui as variaveis globais com informacoes necessarias e chama a funcao para criar uma  
        conexao ao servidor de base de dados
        */
        function __construct()
        {
            $this->hostname = "localhost";
            $this->database = "daw_db";
            $this->username = "daw_sa";
            $this->password = "Daw*2020@";
            $this->database_connection();
        }
        /* Esta funcao cria uma conexao ao servidor mysql */
        function database_connection()
        {
            try
            {
                $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);     
            }
            catch(PDOException $e)
            {
                echo "Connexao falhada: ".$e->getMessage();
            }
        }
        // Devolve a conexao mysql via PDO 
        function getConnection()
        {
            return $this->connection;
        }
    }
?>
