<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Modelo extends CI_Model
    {
        private $id_modelo;
        private $nome_modelo;
        private $marca_modelo;
        
        public function __construct(){
            parent::__construct();
        }

        public function get_id(){
            return $this -> id_modelo;
        }

        public function get_nome(){
            return $this -> nome_modelo;
        }
        
        public function get_marca(){
            return $this -> marca_modelo;
        }

        public function set_id($id){
            $this -> id_modelo = $id;
        }

        public function set_nome($nome){
            $this -> nome_modelo = $nome;
        }

        public function set_marca($marca){
            $this -> marca_modelo = $marca;
        }

        
    }
?>