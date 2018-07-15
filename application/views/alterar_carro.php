<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->library('session');
?>


<div class="container_center_left">
    <form action="<?php echo base_url('index.php/controller_primario/cadastrar_carro')?>"  method="post">
        <label>Modelo do Carro:</label>
        <input type="text" class="form-control" disabled placeholder="Modelo do Carro" name="ano_carro"> <br>
        <label>Ano do Carro:</label>
        <input type="text" class="form-control" disabled placeholder="Ano do Carro" name="ano_carro"> <br>
        <label>Placa do Carro:</label>
        <input type="text" class="form-control" placeholder="Placa do Carro" name="placa_carro"> <br>
        <label>Cor do Carro:</label>
        <input type="text" class="form-control" placeholder="Cor do Carro" name="cor_carro"> <br>
        <button type="submit" class="btn btn-primary">Alterar</button>
        <button type="submit" class="btn btn-danger">Deletar</button>
    </form>
</div>