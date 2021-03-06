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
            try{
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
            }catch(Exception $e){
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

                $query =  $this->db->select('*')->from('modelo')->get();

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

        #region pegar carros não locados
        public function get_carros_nao_locados(){
            try{
                $this->load->model('carro');                

                $array_carros = array();

                $query =  $this->db->select('id_carro, modelo.nome_modelo, ano_carro, placa_carro, locatario_carro, cor_carro, locacao_carro')->from('carro')
                ->join('modelo', 'modelo.id_modelo = carro.modelo_carro')->group_start()->where('locatario_carro = ')->or_where('locatario_carro', 0)->group_end()->get();

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
                        $obj_carro -> set_locacao($row-> locacao_carro);

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

        #region pegar todos carros
        public function get_carros(){
            try{
                $this->load->model('carro');                

                $array_carros = array();

                $query =  $this->db->select('id_carro, modelo.nome_modelo, ano_carro, placa_carro, locatario_carro, cor_carro, locacao_carro')->from('carro')
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
                        $obj_carro -> set_locacao($row-> locacao_carro);

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

        #region pegar meus carros
        public function get_meus_carros($id_usuario){
            try{
                $this->load->model('carro');                

                $array_carros = array();

                $query =  $this->db->select('id_carro, modelo.nome_modelo, ano_carro, placa_carro, locatario_carro, cor_carro, locacao_carro ')->from('carro')
                ->join('modelo', 'modelo.id_modelo = carro.modelo_carro')->where('locatario_carro', $id_usuario )->get();

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
                        $obj_carro -> set_locacao($row-> locacao_carro);

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

        #region pegar carro pela id
        public function get_carro_by_id($id_carro){
            try{
                $this->load->model('carro');                

                $array_carros = array();

                $query =  $this->db->select('id_carro, modelo.nome_modelo, ano_carro, placa_carro, locatario_carro, cor_carro, locacao_carro')->from('carro')
                ->join('modelo', 'modelo.id_modelo = carro.modelo_carro')->where('id_carro', $id_carro)->get();

                $row = $query->row();

            if (isset($row))
            {
                $obj_carro = new Carro();

                $obj_carro -> set_id($row-> id_carro);
                $obj_carro -> set_modelo($row-> nome_modelo);
                $obj_carro -> set_ano($row-> ano_carro);
                $obj_carro -> set_placa($row-> placa_carro);
                $obj_carro -> set_locatario($row-> locatario_carro);
                $obj_carro -> set_cor($row-> cor_carro);
                $obj_carro -> set_locacao($row-> locacao_carro);

                return $obj_carro;
            }

            } catch(Exception $e){
                return false;
            }
        }
        #endregion

        #region alugar carro
        public function alugar_carro($id_usuario, $id_carro){
            try{
                $data = array('locatario_historico_locacao' => $id_usuario, 'carro_historico_locacao' => $id_carro, 
                'data_locacao_historico_locacao' => date('Y-m-d'));
                $str = $this->db->insert('historico_locacao', $data);
                $insert_id = $this->db->insert_id();


                $data = array(
                    'locatario_carro' => $id_usuario,
                    'locacao_carro' => $insert_id
                );                
                $this->db->where('id_carro', $id_carro);
                $this->db->update('carro', $data);
                return true;
            }catch(Exception $e){
                return false;
            }
        }
        #endregion

        #region devolver carro
        public function devolver_carro($id_usuario, $id_carro, $locacao_carro){
            try{

                $data = array(
                    'data_devolucao_historico_locacao' => date('Y-m-d')
                );
                $this->db->where('id_historico_locacao', $locacao_carro);
                $this->db->where('carro_historico_locacao', $id_carro);
                $this->db->where('locatario_historico_locacao', $id_usuario);
                $this->db->update('historico_locacao', $data);

                $data = array(
                    'locatario_carro' => '',
                    'locacao_carro' => ''
                );                
                $this->db->where('id_carro', $id_carro);
                $this->db->update('carro', $data);

                return true;
            }catch(Exception $e){
                return false;
            }
        }
        #endregion
        
        #region deletar carro
        public function deletar_carro($id_carro){
            try{
                $this->db->where('id_carro', $id_carro);
                $this->db->delete('carro');
                return true;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion

        #region update carro
        public function update_carro($id_carro, $placa_carro, $cor_carro){
            try{
                $data = array(
                    'placa_carro' => $placa_carro,
                    'cor_carro' => $cor_carro
                );
                
                $this->db->where('id_carro', $id_carro);
                $this->db->update('carro', $data);
                return true;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion
    
        #region pegar historico de locações
        public function get_historico_locacao(){
            try{
                $this->load->model('historico_locacao');                

                $array_historico = array();

                $query =  $this->db->select("id_historico_locacao, usuario.nome_usuario, usuario.sobrenome_usuario, modelo.nome_modelo,
                 DATE_FORMAT(data_locacao_historico_locacao, '%d-%m-%Y')as data_loca,
                  DATE_FORMAT(data_devolucao_historico_locacao, '%d-%m-%Y')as data_dev")->from('historico_locacao')
                ->join('usuario', 'usuario.id_usuario = historico_locacao.locatario_historico_locacao', 'inner')
                ->join('carro', 'carro.id_carro = historico_locacao.carro_historico_locacao','inner')
                ->join('modelo', 'modelo.id_modelo = carro.modelo_carro')->get();

                if ($query)
                {
                    foreach ($query->result() as $row){

                        $obj_historico = new Historico_locacao();

                        $obj_historico -> set_id($row-> id_historico_locacao);
                        $obj_historico -> set_locatario($row-> nome_usuario . ' ' . $row-> sobrenome_usuario);
                        $obj_historico -> set_carro($row-> nome_modelo);
                        $obj_historico -> set_data_locacao($row-> data_loca);
                        $obj_historico -> set_data_devolucao($row-> data_dev);

                        $array_historico[] = $obj_historico;
                    }

                    return $array_historico;
                    
                } else{
                    return false;
                }

            } catch(Exception $e){
                return false;
            }
        }
        #endregion
    }