<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_primario extends CI_Controller {

        #region index
	public function index()
	{       
                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->library('session');
                $data['page_title'] = 'Home';
                $this->load->view('header', $data);
                $this->load->view('home');
                $this->load->view('footer');
        }
        #endregion

        #region pagina de login de usuário
        public function para_entrar(){
                $data['page_title'] = 'Entrar';
                $this->load->view('cadastro_usuario', $data);
        }
        #endregion

        #region pagina de cadastro de carro
        public function cadastro_carro(){

                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->model('modelo');
                $this->load->model('data_base');
                $this->load->library('session');

                $obj_usuario = $this->session->userdata('usuario');

                if($obj_usuario){
                        if($obj_usuario -> is_admin()){

                                $objDataBase = new Data_base();        
                                $objDataBase -> open();        
                                $modelo_array = $objDataBase -> get_modelos();

                                $this->session->set_userdata('modelo_array', $modelo_array);

                                $data['page_title'] = 'Cadastro de Carros';
                                $this->load->view('header', $data);
                                $this->load->view('cadastro_carro');
                                $this->load->view('footer');
        
                        }else{
                                $this-> index();
                        }                        
                }else{
                        $this -> index();
                }
                                
        }
        #endregion

        #region função de cadastro de carro
        public function cadastrar_carro(){

                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->model('data_base');
                $this->load->library('session');

                $modelo_carro = $this->input->post('modelo_carro');
                $ano_carro = $this->input->post('ano_carro');
                $placa_carro = $this->input->post('placa_carro');
                $cor_carro = $this->input->post('cor_carro');
                
                $obj_usuario = $this->session->userdata('usuario');

                if($obj_usuario){
                        if($obj_usuario -> is_admin()){
                                if( ($modelo_carro !== '') && (!is_null($modelo_carro) ) && ($ano_carro !== '') && (!is_null($ano_carro) ) 
                                && ($placa_carro !== '') && (!is_null($placa_carro) ) && ($cor_carro !== '') && (!is_null($placa_carro)) ){
                                        $objDataBase = new Data_base();
                
                                        $objDataBase -> open();
                
                                        $valor_retorno = $objDataBase -> cadastrar_carro($modelo_carro, $ano_carro, $placa_carro, $cor_carro);
                                        if($valor_retorno){
                                                $this-> disponibilidade_carros();                        
                                        }else{
                                                $this-> cadastro_carro();
                                        }
                                }else{
                                        $this-> cadastro_carro();
                                }  
                        }else{
                                $this-> index();
                        }
                }else{
                        $this-> index();
                }

                              
        }
        #endregion

        #region função de login de usuário cada usuário tem uma sessão de 15min
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
                        $this->session->mark_as_temp('usuario', 900);
                        $this -> index();                
                }else{
                        $this->session->set_userdata('usuario', false);                        
                        $this -> para_entrar();
                }               
        }
        #endregion

        #region função para registrar novo usuário
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
                                $this -> index();
                        } else {
                                $this -> para_entrar();
                        }

                } else{
                        $this -> para_entrar();
                }                			
        }
        #endregion

        #region alugar carro
        public function alugar_carro(){

                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->library('session');
                $this->load->model('data_base');
                
                $objDataBase = new Data_base();
                $objDataBase -> open();
                
                $obj_usuario = $this->session->userdata('usuario');

                if($obj_usuario){
                        $id_carro = $this->input->post('id_carro');
                        if($id_carro === '' || is_null($id_carro) ){
                                $this -> index();
                        }else{
                                $id_usuario = $obj_usuario -> get_id();                
                                $valor_retorno = $objDataBase -> alugar_carro($id_usuario, $id_carro);
                                if($valor_retorno){
                                        $this-> meus_carros();
                                }else{
                                        $this-> aluguel();
                                }
                        }

                }else{
                        $this -> index();
                }         
        }                
        #endregion

        #region devolver carro
        public function devolver_carro(){

                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->library('session');
                $this->load->model('data_base');
                
                $id_carro = $this->input->post('id_carro');
                $locacao_carro = $this->input->post('locacao_carro');
                $obj_usuario = $this->session->userdata('usuario');
                $id_usuario = $obj_usuario -> get_id();

                if( !(is_null($id_carro)) && !(is_null($locacao_carro)) && $obj_usuario){

                        $objDataBase = new Data_base();
                        $objDataBase -> open();
                                
                        $valor_retorno = $objDataBase -> devolver_carro($id_usuario, $id_carro, $locacao_carro);
                        if($valor_retorno){
                                $this-> meus_carros();
                        }else{
                                $this-> meus_carros();
                        }
                }else{
                        $this -> index();
                }
        }                
        #endregion

        #region logout de usuário
        public function usuario_sair(){
                $this->load->library('session');
                $this->session->unset_userdata('usuario');
                $this->session->unset_userdata('carro');
                $this->session->sess_destroy();
                $this->index();
        }
        #endregion

        #region carros do usuário
        public function meus_carros(){

                $this->load->model('data_base');
                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->library('session');

                $objDataBase = new Data_base();

                $objDataBase -> open();

                $obj_usuario = $this->session->userdata('usuario');
                if($obj_usuario){

                        $id_usuario = $obj_usuario -> get_id();
                        $carros_array = $objDataBase -> get_meus_carros($id_usuario);

                        $this->session->set_userdata('carros_array', $carros_array);

                        $data['page_title'] = 'Meus Carros';
                        $this->load->view('header', $data);
                        $this->load->view('meus_carros');
                        $this->load->view('footer');
                        
                }else{
                        $this -> index();
                }
                   
        }
        #endregion

        #region pagina de aluguel de carros
        public function aluguel(){

                $this->load->model('data_base');
                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->library('session');

                $objDataBase = new Data_base();
                $objDataBase -> open();

                $carros_array = $objDataBase -> get_carros_nao_locados();                

                $this->session->set_userdata('carros_array', $carros_array);
                
                $data['page_title'] = 'Aluguel';
                $this->load->view('header', $data);
                $this->load->view('aluguel');
                $this->load->view('footer');               
                	
        }
        #endregion

        #region pagina de disponibilidade de carros
        public function disponibilidade_carros(){

                $this->load->model('data_base');
                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->library('session');

                $objDataBase = new Data_base();
                $objDataBase -> open();

                $carros_array = $objDataBase -> get_carros();

                $this->session->set_userdata('carros_array', $carros_array);
                
                $data['page_title'] = 'Disponibilidade';
                $this->load->view('header', $data);
                $this->load->view('disponibilidade_carros');
                $this->load->view('footer');          
        }
        #endregion

        #region pagina de alteração de dados do carro
        public function alterar_carro(){

                $this->load->model('data_base');
                $this->load->model('carro');
                $this->load->model('usuario');
                $this->load->library('session');

                $id_carro = $this->input->post('id_carro');
                if( !is_null($id_carro) ){

                        $objDataBase = new Data_base();
                        $objDataBase -> open();

                        $obj_carro = $objDataBase -> get_carro_by_id($id_carro);

                        $this->session->set_userdata('carro', $obj_carro);
                        
                        $data['page_title'] = 'Alterar';
                        $this->load->view('header', $data);
                        $this->load->view('alterar_carro');
                        $this->load->view('footer');
                }else{
                        $this -> index();
                }
        }
        #endregion

        public function update_carro(){

                $this->load->model('data_base');

                $id_carro = $this->input->post('id_carro');
                $placa_carro = $this->input->post('placa_carro');
                $cor_carro = $this->input->post('cor_carro');

                if( !is_null($id_carro) && $id_carro !== '' && !is_null($placa_carro) 
                && $placa_carro !== '' && !is_null($cor_carro) && $cor_carro !== ''){
                        $objDataBase = new Data_base();
                        $objDataBase -> open();

                        $objDataBase -> update_carro($id_carro, $placa_carro, $cor_carro);

                        $this -> disponibilidade_carros();
                }

        }

        public function deletar_carro(){

                $this->load->model('data_base');

                $id_carro = $this->input->post('id_carro');

                if( !is_null($id_carro) && $id_carro !== ''){

                        $objDataBase = new Data_base();
                        $objDataBase -> open();

                        $objDataBase -> deletar_carro($id_carro);

                        $this -> disponibilidade_carros();
                }else{
                        $this -> disponibilidade_carros();
                }

        }




}
