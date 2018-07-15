<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Carro extends CI_Model
    {
        private $id_carro;
        private $modelo_carro;
        private $ano_carro;
        private $placa_carro;
        private $locatario_carro;
        private $cor_carro;

        
        public function __construct(){
            parent::__construct();
        }

        public function get_id(){
            return $this -> id_carro;
        }

        public function get_modelo(){
            return $this -> modelo_carro;
        }

        public function get_ano(){
            return $this -> ano_carro;
        }

        public function get_placa(){
            return $this -> placa_carro;
        }

        public function get_locatario(){
            return $this -> locatario_carro;
        }

        public function get_cor(){
            return $this -> cor_carro;
        }

        public function is_locado(){
            if( !(is_null($this -> locatario_carro)) && $this -> locatario_carro !== '' ){
                return true;
            }else{
                return false;
            }
        }

        public function set_id($id){
            $this -> id_carro = $id;
        }

        public function set_modelo($modelo){
            $this -> modelo_carro = $modelo;
        }

        public function set_ano($ano){
            $this -> ano_carro = $ano;
        }

        public function set_placa($placa){
            $this -> placa_carro = $placa;
        }

        public function set_locatario($locatario){
            $this -> locatario_carro = $locatario;
        }

        public function set_cor($cor){
            $this -> cor_carro = $cor;
        }

    }
?>