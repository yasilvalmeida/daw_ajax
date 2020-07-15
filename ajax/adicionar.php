<?php
    // Importar as classes necessarias
    require_once("classes/mysql-pdo.php");
    require_once("classes/item.php");
    try
    {
        /* Verificar si foi passado o nome por POST e si foi subido um ficheiro */
        if(isset($_POST["nome"]) && isset($_FILES['file']['tmp_name']))
        {
            // Receber o nome do POST para o vector form_data
            $form_data = array(
                ':nome'     => $_POST["nome"]
            );
            // Receber o ficheiro do FILES porque nao pode ser passado como parametro da consulta SQL
            $ficheiro = addslashes(file_get_contents($_FILES['file']['tmp_name']));
            // Criar um objecto da classe MySQLPDO para criar uma conexao ao servidor MySQL
            $mysqlPDO = new MySQLPDO();
            // Criar a consulta SQL para inserir uma fila com segundo os parametros, atencao que nao foi passado o parametro nome
            $query=	"INSERT INTO t_item(nome, ficheiro) VALUES(:nome, '".$ficheiro."')";
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
    // Converter vector data para json
    echo json_encode($data);
?>