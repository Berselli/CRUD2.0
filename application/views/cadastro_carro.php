<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->library('session');
?>


<div class="container_center_left">
    <form action="<?php echo base_url('index.php/controller_primario/cadastrar_carro')?>"  method="post">
        <label>Modelo do Carro:</label>
        <select class="form-control" id="exampleSelect1" name="modelo_carro">
            <?php
                foreach ($modelo_array as $modelo) {
                    echo '<option value ='. $modelo -> get_id() .' >'. $modelo -> get_nome() .'</option>';
                }
            ?>
        </select> <br>
        <label>Ano do Carro:</label>
        <input type="text" class="form-control" placeholder="Ano do Carro" name="ano_carro"> <br>
        <label>Placa do Carro:</label>
        <input type="text" class="form-control" placeholder="Placa do Carro" name="placa_carro"> <br>
        <label>Cor do Carro:</label>
        <input type="text" class="form-control" placeholder="Cor do Carro" name="cor_carro"> <br>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>