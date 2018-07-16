<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Historico_locacao extends CI_Model
    {
        #region atributos
        private $id_locacao;
        private $locatario_locacao;
        private $carro_locacao;
        private $data_locacao;
        private $data_devolucao;
        #endregion

        
        public function __construct(){
            parent::__construct();
        }

        #region getters
        public function get_id(){
            return $this -> id_locacao;
        }

        public function get_locatario(){
            return $this -> locatario_locacao;
        }

        public function get_carro(){
            return $this -> carro_locacao;
        }

        public function get_data_locacao(){
            return $this -> data_locacao;
        }

        public function get_data_devolucao(){
            return $this -> data_devolucao;
        }
        #endregion

        #region setters
        public function set_id($id){
            $this -> id_locacao = $id;
        }

        public function set_locatario($locatario){
            $this -> locatario_locacao = $locatario;
        }

        public function set_carro($carro){
            $this -> carro_locacao = $carro;
        }

        public function set_data_locacao($data){
            $this -> data_locacao = $data;
        }

        public function set_data_devolucao($data){
            $this -> data_devolucao = $data;
        }
        #endregion

    }
?>