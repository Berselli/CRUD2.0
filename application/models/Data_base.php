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
        
        #region pegar modelos
        public function get_modelos(){
            try{
                $this->load->model('modelo');                

                $array_modelos = array();

                $query =  $this->db->select('*')->from('modelos')->get();

                if ($query)
                {
                    foreach ($query->result() as $row){

                        $obj_modelo = new Modelo();

                        $obj_modelo -> set_id($row-> id_modelo);
                        $obj_modelo -> set_nome($row-> nome_modelo);
                        $obj_modelo -> set_marca($row-> marca_modelo);

                        $array_modelos[] = $obj_modelo;
                    }

                    return $array_modelos;
                    
                } else{
                    return false;
                }

            } catch(Exception $e){
                return false;
            }
        }
        #endregion

        #region cadastrar carro

        public function cadastrar_carro($modelo_carro, $ano_carro, $placa_carro, $cor_carro){
            try{
                $data = array('modelo_carro' => $modelo_carro, 'ano_carro' => $ano_carro, 
                'placa_carro' => $placa_carro, 'cor_carro' => $cor_carro);
                $str = $this->db->insert('carro', $data);
                return true;
            }catch(Exception $e){
                return false;
            }
        }

        #endregion

        #region pegar carros
        public function get_carros(){
            try{
                $this->load->model('carro');                

                $array_carros = array();

                $query =  $this->db->select('id_carro, modelo.nome_modelo, ano_carro, placa_carro, locatario_carro, cor_carro ')->from('carro')
                ->join('modelo', 'modelo.id_modelo = carro.modelo_carro')->get();

                if ($query)
                {
                    foreach ($query->result() as $row){

                        $obj_carro = new Carro();

                        $obj_carro -> set_id($row-> id_carro);
                        $obj_carro -> set_modelo($row-> nome_modelo);
                        $obj_carro -> set_ano($row-> ano_carro);
                        $obj_carro -> set_placa($row-> placa_carro);
                        $obj_carro -> set_locatario($row-> locatario_carro);
                        $obj_carro -> set_cor($row-> cor_carro);

                        $array_carros[] = $obj_carro;
                    }

                    return $array_carros;
                    
                } else{
                    return false;
                }

            } catch(Exception $e){
                return false;
            }
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