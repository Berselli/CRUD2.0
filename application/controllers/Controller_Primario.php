<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_primario extends CI_Controller {

	public function index()
	{       
                $this->load->model('usuario');
                $this->load->library('session');
                $data['page_title'] = 'Home';
                $this->load->view('header', $data);
                $this->load->view('home');
                $this->load->view('footer');
        }

        public function para_entrar(){
                $data['page_title'] = 'Entrar';
                $this->load->view('cadastro_usuario', $data);
        }

        public function cadastro_carro(){

                $this->load->model('usuario');
                $this->load->model('modelo');
                $this->load->model('data_base');
                $this->load->library('session');

                $obj_usuario = $this->session->userdata('usuario');
                if($obj_usuario -> is_admin()){
                        $objDataBase = new Data_base();

                        $objDataBase -> open();

                        $modelo_array = $objDataBase -> get_modelos();

                        $data['page_title'] = 'Cadastro de Carros';
                        $data['modelo_array'] = $modelo_array;
                        $this->load->view('header', $data);
                        $this->load->view('cadastro_carro');
                        $this->load->view('footer');

                }else{
                        $this-> index();
                }

                
        }

        public function cadastrar_carro(){

                $this->load->model('usuario');
                $this->load->model('data_base');
                $this->load->library('session');

                $modelo_carro = $this->input->post('modelo_carro');
                $ano_carro = $this->input->post('ano_carro');
                $placa_carro = $this->input->post('placa_carro');
                $cor_carro = $this->input->post('cor_carro');               

                if( ($modelo_carro !== '') && ($ano_carro !== '') && ($placa_carro !== '') && ($cor_carro !== '') ){
                                $objDataBase = new Data_base();

                        $objDataBase -> open();

                        $valor_retorno = $objDataBase -> cadastrar_carro($modelo_carro, $ano_carro, $placa_carro, $cor_carro);
                        if($valor_retorno){
                                $this-> aluguel();                        
                        }else{
                                $this-> cadastro_carro();
                        }
                }else{
                        $this-> cadastro_carro();
                }
                
        }


        public function usuario_entrar(){

                $this->load->library('session');
                $this->load->model('data_base');

                $objDataBase = new Data_base();

                $objDataBase -> open();

                $email_usuario = $this->input->post('email_usuario');
                $senha_usuario = $this->input->post('senha_usuario');

                $obj_usuario = $objDataBase -> usuario_entar($email_usuario, $senha_usuario);

                $objDataBase -> close();
                
                if($obj_usuario){
                        $this->session->set_userdata('usuario', $obj_usuario);                                
                }else{
                        $this->session->set_userdata('usuario', false);
                }

                $this -> index();
        }

        public function usuario_registro(){

                $this->load->library('session');
                $this->load->model('data_base');

                $nome_usuario = $this->input->post('nome_usuario');
                $sobrenome_usuario = $this->input->post('sobrenome_usuario');
                $senha_usuario = $this->input->post('senha_usuario');
                $email_usuario = $this->input->post('email_usuario');

                if( ($nome_usuario !== '') && ($sobrenome_usuario !== '') && ($senha_usuario !== '') && ($email_usuario !== '') ){

                        $objDataBase = new Data_base();

                        $objDataBase -> open();

                        $valor_retorno = $objDataBase -> cadastrar_usuario($nome_usuario, $sobrenome_usuario, $senha_usuario, $email_usuario);
                        $objDataBase -> close();
                        if($valor_retorno){
                                //$this -> user_login();
                                echo 'usuario cadastrado';
                        } else {
                                $this -> index();
                        }

                } else{
                        $this -> para_entrar();
                }
                			
        }

        #region alugar carro
        public function alugar_carro(){

                $this->load->model('usuario');
                $this->load->library('session');
                $this->load->model('data_base');
                
                $objDataBase = new Data_base();

                $objDataBase -> open();

                //validar e verificar entradas

                $id_carro = $this->input->post('column_1');
                $obj_usuario = $this->session->userdata('usuario');
                $id_usuario = $obj_usuario -> get_id();                
                $valor_retorno = $objDataBase -> alugar_carro($id_usuario, $id_carro);
                if($valor_retorno){
                        $this-> meus_carros();
                }else{
                        $this-> aluguel();
                }

        }                
        #endregion

        #region devolver carro
        public function devolver_carro(){

                $this->load->model('usuario');
                $this->load->library('session');
                $this->load->model('data_base');
                
                //validar e verificar entradas

                $objDataBase = new Data_base();

                $objDataBase -> open();

                $id_carro = $this->input->post('column_1');
                $locacao_carro = $this->input->post('column_7');
                $obj_usuario = $this->session->userdata('usuario');
                $id_usuario = $obj_usuario -> get_id();                
                $valor_retorno = $objDataBase -> devolver_carro($id_usuario, $id_carro, $locacao_carro);
                if($valor_retorno){
                        $this-> meus_carros();
                }else{
                        $this-> meus_carros();
                }

        }                
        #endregion

        public function usuario_sair(){
                $this->load->library('session');
                $this->session->unset_userdata('usuario');
                $this->session->sess_destroy();
                $this->index();
        }

        public function meus_carros(){

                $this->load->model('data_base');
                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->library('session');

                $objDataBase = new Data_base();

                $objDataBase -> open();

                $obj_usuario = $this->session->userdata('usuario');
                if( is_null($obj_usuario) || !$obj_usuario){
                        $this -> index();
                }else{
                        $id_usuario = $obj_usuario -> get_id();

                        $carros_array = $objDataBase -> get_meus_carros($id_usuario);

                        $data['page_title'] = 'Meus Carros';
                        $data['carros_array'] = $carros_array;
                        $this->load->view('header', $data);
                        $this->load->view('meus_carros');
                        $this->load->view('footer');
                }
                   
        }

        public function aluguel(){

                $this->load->model('data_base');

                $this->load->model('carro');

                $objDataBase = new Data_base();

                $objDataBase -> open();

                $carros_array = $objDataBase -> get_carros();

                $this->load->model('usuario');

                $this->load->library('session');
                
                $data['page_title'] = 'Aluguel';
                $data['carros_array'] = $carros_array;
                $this->load->view('header', $data);
                $this->load->view('aluguel');
                $this->load->view('footer');               
                
                	
        }


}
