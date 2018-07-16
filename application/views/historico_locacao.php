<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->model('historico_locacao');
    $this->load->library('session');
    $historico_array = $this->session->userdata('historico_array');
?>

<div class="big-big" >

    <div class="container-center-big">
        <table class="table table-hover table-responsive-auto ">
            <thead>
                <tr class="table-active">
                    <th scope="col">Locatario</th>
                    <th scope="col">Carro Alugado</th>
                    <th scope="col">Data de Locação</th>
                    <th scope="col">Data de Devolução</th>            
                </tr>
            </thead>
            <tbody>
                <?php
                if(!(is_null($historico_array) && $historico_array !== '')){
                    foreach ($historico_array as $locacao) {
                        echo '<tr> <td "> <input type="hidden" name = "id_carro" value="' . $locacao ->get_locatario() . '">' . $locacao ->get_locatario() . '</td>';
                        echo '<td "> <input type="hidden" name = "modelo_carro" value="' . $locacao ->get_carro() . '">' . $locacao ->get_carro() . '</td>';
                        echo '<td "> <input type="hidden" name = "ano_carro" value="' . $locacao ->get_data_locacao() . '">' . $locacao ->get_data_locacao() . '</td>';
                        echo '<td "> <input type="hidden" name = "placa_carro" value="' . $locacao ->get_data_devolucao() . '">' . $locacao ->get_data_devolucao() . '</td> </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
        $this->session->unset_userdata('historico_array');
    ?>