<?php
    // Importar as classes necessarias
    require_once("classes/mysql-pdo.php");
    require_once("classes/item.php");
    try
    {
        /* Verificar si foi passado o id e nome nome por POST, pois nesse caso de alteracao o ficheiro e' opcional */
        if(isset($_POST["id"]) && isset($_POST["nome"]))
        {
            // Receber o nome do POST para o vector form_data
            $form_data = array(
                ':id'   => $_POST["id"],
                ':nome' => $_POST["nome"]
            );
            if(isset($_FILES['file']['tmp_name'])){
                // Receber o ficheiro do FILES porque nao pode ser passado como parametro da consulta SQL
                $ficheiro = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                // Criar a consulta SQL para alterar uma fila com segundo os parametros, atencao que nao foi passado os parametros id e nome
                $query = "UPDATE t_item SET nome = :nome, ficheiro = '".$ficheiro."' where id = :id";
            }
            else{
                // Criar a consulta SQL para alterar uma fila com segundo os parametros, atencao que nao foi passado os parametros id e nome
                $query = "UPDATE t_item SET nome = :nome where id = :id";
            }
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
                "data" => array('result' => 'Parametros nome e ficheiro necessarios em falta!')
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