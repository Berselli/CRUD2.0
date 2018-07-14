<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_primario extends CI_Controller {

	public function index()
	{       
                $data['page_title'] = 'Home';
                $this->load->view('header', $data);
                $this->load->view('home');
                $this->load->view('footer');
        }

        public function para_entrar(){
                $data['page_title'] = 'Log in';
                $this->load->view('cadastro_usuario', $data);
        }


        public function usuario_entrar(){

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

                $this->load->model('data_base');

                $nome_usuario = $this->input->post('nome_usuario');
                $sobrenome_usuario = $this->input->post('sobrenome_usuario');
                $senha_usuario = $this->input->post('senha_usuario');
                $email_usuario = $this->input->post('email_usuario');

                if( ($nome_usuario !== '') && ($sobrenome_usuario !== '') && ($senha_usuario !== '') && ($email_usuario !== '') ){

                        $objDataBase = new Data_base();

                        $objDataBase -> open();

                        $valueReturn = $objDataBase -> cadastrar_usuario($nome_usuario, $sobrenome_usuario, $senha_usuario, $email_usuario);
                        $objDataBase -> close();
                        if($valueReturn){
                                //$this -> user_login();
                                echo 'usuario cadastrado';
                        } else {
                                $this -> index();
                        }

                } else{
                        $this -> para_entrar();
                }
                			
        }

        public function usuario_sair(){
                $this->session->unset_userdata('usuario');
                $this->session->sess_destroy();
                $this->index();
        }

        public function aluguel(){
                $this->load->model('data_base');

                $objDataBase = new Data_base();

                $objDataBase -> open();

                $valueReturnCars = $objDataBase -> getCars();

                $valueReturnModelos = $objDataBase -> getModelos();

                $data['page_title'] = 'Aluguel';
                $data['car_array'] = $valueReturnCars;
                $data['modelos_array'] = $valueReturnModelos;
                $this->load->view('header', $data);
                $this->load->view('aluguel');
                $this->load->view('footer');		
        }


}
