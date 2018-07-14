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
        
        public function aluguel(){
                $data['page_title'] = 'Aluguel';
                $this->load->view('header', $data);
                $this->load->view('aluguel');
                $this->load->view('footer');
        }

        public function to_login(){
                $data['page_title'] = 'Log in';
                $this->load->view('cadastro_usuario', $data);
        }

        public function user_login(){
                $this->load->view('header');
                $this->load->view('aluguel');
                $this->load->view('footer');
        }


}
