<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Usuario extends CI_Model
    {
        private $id_usuario;
        private $nome_usuario;
        private $senha_usuario;
        private $email_usuario;
        private $admin_usuario;

        
        public function __construct(){
            parent::__construct();
        }

        public function get_id(){
            return $this -> id_usuario;
        }

        public function get_nome(){
            return $this -> nome_usuario;
        }

        public function get_senha(){
            return $this -> senha_usuario;
        }

        public function get_email(){
            return $this -> email_usuario;
        }

        public function is_admin(){
            return $this -> admin_usuario;
        }

        public function set_id($id){
            $this -> id_usuario = $id;
        }

        public function set_nome($nome){
            $this -> nome_usuario = $nome;
        }

        public function set_senha($senha){
            $this -> senha_usuario =$senha;
        }

        public function set_email($email){
            $this -> email_usuario =$email;
        }

        public function set_admin($admin){
            $this -> admin_usuario = $admin;
        }

        
    }
?>