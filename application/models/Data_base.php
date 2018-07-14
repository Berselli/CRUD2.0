<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Data_base extends CI_Model{


        #region cadastro de usuario
        public function cadastrar_usuario($nome_usuario, $sobrenome_usuario, $senha_usuario, $email_usuario){
            try{
                $data = array('nome_usuario' => $nome_usuario, 'sobrenome_usuario' => $sobrenome_usuario, 
                'senha_usuario' => $senha_usuario, 'email_usuario' => $email_usuario);
                $str = $this->db->insert('usuario', $data);
                return true;
            }catch(Exception $e){
                return false;
            }
        }
        #endregion

        #region login de usuario
        public function usuario_entar($email_usuario, $senha_usuario){

            $this->load->model('usuario');

            $obj_usuario = new Usuario();

            $query =  $this->db->select('*')->from('usuario')->where('senha_usuario', $senha_usuario)->where('email_usuario', $email_usuario)->get();
            $row = $query->row();            

            if (isset($row))
            {
                $obj_usuario -> set_id($row-> id_usuario);
                $obj_usuario -> set_nome($row-> nome_usuario);
                $obj_usuario -> set_sobrenome($row-> sobrenome_usuario);
                $obj_usuario -> set_email($row-> email_usuario);
                $obj_usuario -> set_senha($row-> senha_usuario);                
                $obj_usuario -> set_admin($row-> admin_usuario);
                
                return $obj_usuario;
            } else{
                return false;
            }
        }
        #endregion

        #region open connection
        public function open(){
            $this->load->database();
        }
        #endregion

        #region close connection
        public function close(){
            $this->db->close();
        }
        #endregion
        
        #region create new car
        public function createNewCar($car_model, $car_year, $car_plate, $car_color){
            if(is_null($car_model) || is_null($car_year) || is_null($car_plate) || is_null($car_color)){
                return null;
            }
            try{
                $data = array('car_model' => $car_model, 'car_year' => $car_year, 'car_plate' => $car_plate, 'car_color' => $car_color);
                $str = $this->db->insert('car', $data);
                return $str;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion

        public function getCars(){
            try{
                $query =  $this->db->select('*')->from('car')->get();
                $valueReturn = array();
                if ($query)
                {
                    foreach ($query->result() as $row)
                    {
                        $this->load->model('carro');

                        $objCarro = new Carro();

                        $objCarro -> setId( $row->car_id );
                        $objCarro -> setDescricao( $row->car_descricao) ;
                        $objCarro -> setModelo( $row->car_modelo_id) ;
                        $objCarro -> setAno($row->car_ano);
                        $objCarro -> setAlugado($row->car_alugado);
                        $objCarro -> setCor($row->car_cor);

                        $valueReturn[] = $objCarro;
                    }                    

                    return $valueReturn;
                }
                return null;
            }catch(Exception $e){
                return null;
            }
        }

        public function getModelos(){
            try{
                $query =  $this->db->select('*')->from('modelo')->get();
                $valueReturn = array();
                $carReturn = array();
                if ($query)
                {
                    foreach ($query->result() as $row)
                    {
                        $modelo_id = $row->modelo_id;
                        $modelo_descricao = $row->modelo_descricao;

                        $modeloReturn['modelo_id'] = $modelo_id;
                        $modeloReturn['modelo_descricao'] = $modelo_descricao;

                        $valueReturn[] = $modeloReturn;
                    }                    

                    return $valueReturn;
                }
                return null;
            }catch(Exception $e){
                return null;
            }
        }
        
        #region delete car
        public function deleteCar($car_id){
            try{
                $this->db->where('car_id', $car_id);
                $this->db->delete('car');
                return true;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion

        #region update car
        public function updateCar($car_id, $car_model, $car_year, $car_plate, $car_color){
            try{
                $data = array(
                    'car_model' => $car_model,
                    'car_year' => $car_year,
                    'car_plate' => $car_plate,
                    'car_color' => $car_color
                );
                
                $this->db->where('car_id', $car_id);
                $this->db->update('car', $data);
                return true;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion
    }