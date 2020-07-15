<?php
    // Classe Item
    class Item implements JsonSerializable
    {
        protected $id;
        protected $nome;
        protected $ficheiro;
        /* O constructor cria um objecto Item a partir de um array associativo */
        function __construct(array $data)
        {
            $this->id       = $data['id'];
            $this->nome     = $data['nome'];
            $this->ficheiro = $data['ficheiro'];            
        }
        // Devolver Id
        function getId()
        {
            return $this->id;
        }
        // Devolver Nome
        function getNome()
        {
            return $this->nome;
        }
        // Devolver Ficheiro
        function getFicheiro()
        {
            return '<img src="data:image/jpeg;base64,'.base64_encode($this->ficheiro).'" style="display: block; margin-left: auto; margin-right: auto; width: 75%; height: 150px" />';
        }
        // Converter objecto para JSON
        public function jsonSerialize()
        {
            return get_object_vars($this);
        }
    }
?>
