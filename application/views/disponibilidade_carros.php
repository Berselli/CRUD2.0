<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->model('usuario');
    $this->load->library('session');
    $obj_usuario = $this->session->userdata('usuario');
    $carros_array= $this->session->userdata('carros_array');
?>

<div class="big-big" >
    <div class="container-center-big">
        <table class="table table-hover table-responsive-auto ">
            <thead>
                <tr class="table-active">
                    <th scope="col">#</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Placa</th>
                    <th scope="col">Cor</th>
                    <th scope="col">Disponibiliade</th>
                    <th scope="col">Alterar informações do Carro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counterCars = 0;
                if(!(is_null($carros_array) && $car_array !== '')){
                    foreach ($carros_array as $carro) {
                            $disponibilidade = '';
                            $carro -> is_locado() ? $disponibilidade = 'Carro Locado' : $disponibilidade = 'Carro no Pátio';
                            echo '<form action="'. base_url('index.php/controller_primario/alugar_carro') .'" method="post" ><tr name = "car_'. (++$counterCars) .'">';
                            echo '<td "> <input type="hidden" name = "id_carro" value="' . $carro ->get_id() . '">' . $carro ->get_id() . '</td>';
                            echo '<td "> <input type="hidden" name = "modelo_carro" value="' . $carro ->get_modelo() . '">' . $carro ->get_modelo() . '</td>';
                            echo '<td "> <input type="hidden" name = "ano_carro" value="' . $carro ->get_ano() . '">' . $carro ->get_ano() . '</td>';
                            echo '<td "> <input type="hidden" name = "placa_carro" value="' . $carro ->get_placa() . '">' . $carro ->get_placa() . '</td>';
                            echo '<td "> <input type="hidden" name = "cor_carro" value="' . $carro ->get_cor() . '">' . $carro ->get_cor() . '</td>';
                            echo '<input type="hidden" name = "locatario_carro" value="' . $carro ->get_locatario() . '">';
                            echo '<td "> <input type="hidden" name = "disponibilidade" >' . $disponibilidade . '</td>';
                            if($carro -> is_locado()){
                                echo '<td> <button type="button" class="btn btn-danger disabled" formaction="/">Alterar</button>
                                    </td> </tr> </form>';
                            }else{
                                echo '<td> <button type="submit" class="btn btn-danger" formaction="'. base_url('index.php/controller_primario/alterar_carro') .' ">Alterar</button>
                                    </td> </tr> </form>';
                            }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>