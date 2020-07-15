<?php
    // Importar as classes necessarias
    require_once("classes/mysql-pdo.php");
    require_once("classes/item.php");
    try {
        // Select all itens
        $query = "
                select count(i.id) as total
                from t_item i
                ";
        // Criar um objecto da classe MySQLPDO para criar uma conexao ao servidor MySQL
        $mysqlPDO = new MySQLPDO();
        // Preparar a consulta 
        $statement = $mysqlPDO->getConnection()->prepare($query);
        // Executar a consulta SQL sem parametros
        $statement->execute();
        // Obter a fila afectada
        $row = $statement->fetch();
        $total = $row["total"];
        $data = array
        (
            "data" => array('total' => $total)
        );
    }
    catch (PDOException $e) 
    {
        $data = array
        (
            "data" => array('result' => "Error message: " . $e->getMessage())
        );
    }
    // Convert data[] to json
    echo json_encode($data);
?>