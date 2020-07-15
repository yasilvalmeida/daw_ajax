<?php
    // Importar as classes necessarias
    require_once("classes/mysql-pdo.php");
    require_once("classes/item.php");
    // Verificar si esta consultar SQL para mostrar os itens necessita dos parametros offset e limit
    if(isset($_POST["offset"]) && isset($_POST["limit"]))
    {
        try
        {
            // Passar os parametros offset e limit num vetor como parametros da consulta SQL
            $form_data = array(
                ':offset' => $_POST["offset"] - 1,
                ':limit'  => $_POST["limit"]
            );
            // Criar a consulta SQL para mostrar todos itens segundo o offset e limit como parametros a serem passados posteriormente
            $query = "
                    select i.id, i.nome, i.ficheiro
                    from t_item i
                    order by i.nome asc
                    limit :offset, :limit"
                    ;
            // Criar um objecto da classe MySQLPDO para criar uma conexao ao servidor MySQL
            $mysqlPDO = new MySQLPDO();
            // Preparar a consulta 
            $statement = $mysqlPDO->getConnection()->prepare($query);
            // Executar a consulta passando o array de parametros inteiros
            $statement->bindValue(':limit', $form_data[':limit'], PDO::PARAM_INT);
            $statement->bindValue(':offset', $form_data[':offset']*$form_data[':limit'], PDO::PARAM_INT);
            $statement->execute();
            // Obter todas as filas afectadas num vector associativo
            $rows = $statement->fetchAll();
            // Foreach pelas filas afectas
            foreach ($rows as $row) 
            {
                // Create a Item object
                $item = new Item($row);
                //Create datatable row
                $tmp_data[] = array
                (
                    $item->getId(),
                    $item->getNome(),
                    $item->getFicheiro()
                );
            }
            // Export into DataTable json format if there's any record in $tmp_data
            $data = array
            (
                "data" => array()
            );
            if(isset($tmp_data) && count($tmp_data) > 0)
            {
                $data = array
                (
                    "data" => $tmp_data
                );
            }
        }
        catch (PDOException $e) 
        {
            $data = array
            (
                "data" => array('result' => "Error message: " . $e->getMessage())
            );
        }
    }
    else{
        $data = array
        (
            "data" => array('result' => "Parametros offset e limit necessarios estao em falta!")
        );
    }
    // Converter vector data para json
    echo json_encode($data);
?>