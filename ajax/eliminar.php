<?php
    // Importar as classes necessarias
    require_once("classes/mysql-pdo.php");
    require_once("classes/item.php");
    try
    {
        /* Verificar si foi passado o id por POST*/
        if(isset($_POST["id"]))
        {
            // Receber o id do POST para o vector form_data
            $form_data = array(
                ':id'   => $_POST["id"]
            );
            // Criar a consulta SQL para alterar uma fila com segundo os parametros, atencao que nao foi passado os parametros id e nome
            $query = "delete from t_item where id = :id";
            // Criar um objecto da classe MySQLPDO para criar uma conexao ao servidor MySQL
            $mysqlPDO = new MySQLPDO();
            // Preparar a consulta 
            $statement = $mysqlPDO->getConnection()->prepare($query);
            // Executar a consulta passando o array de parametros 
            $statement->execute($form_data);
            // Verificar si alterou alguma fila, em caso de que foi alterada devolver 1
            if ($statement->rowCount())
            {
                $data = array
                (
                    "data" => array('result' => '1')
                );
            } 
            // Em caso contrario devolver Nenhuma fila alterada
            else
            {
                $data = array
                (
                    "data" => array('result' => 'Nenhuma fila alterada!')
                );
            }
        }
        else
        {
            $data = array
            (
                "data" => array('result' => 'Parametro id necessario em falta!')
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
    // Converter o vector data para json
    echo json_encode($data);
?>