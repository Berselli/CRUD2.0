<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    $this->load->library('session');
    $obj_carro = $this->session->userdata('carro');

?>

<div class="big-big" >
    <div class="container_center_left">
        <form action="<?php echo base_url('index.php/controller_primario/update_carro');?>"  method="post">
            <input type="hidden" name = "id_carro" value= " <?php echo $obj_carro -> get_id(); ?> ">
            <label>Modelo do Carro:</label>
            <input type="text" class="form-control" disabled placeholder="Modelo do Carro" name="ano_carro" <?php echo 'value ="'. $obj_carro -> get_modelo() .'" '; ?> <br>
            <label>Ano do Carro:</label>
            <input type="text" class="form-control" disabled placeholder="Ano do Carro" name="ano_carro" <?php echo 'value ="'. $obj_carro -> get_ano() .'" '; ?> > <br>
            <label>Placa do Carro:</label>
            <input type="text" class="form-control" placeholder="Placa do Carro" name="placa_carro" <?php echo 'value ="'. $obj_carro -> get_placa() .'" '; ?> > <br>
            <label>Cor do Carro:</label>
            <input type="text" class="form-control" placeholder="Cor do Carro" name="cor_carro" <?php echo 'value ="'. $obj_carro -> get_cor() .'" '; ?> > <br>
            <button type="submit" class="btn btn-primary">Alterar</button>
            <button type="submit" class="btn btn-danger" formaction=" <?php echo base_url('index.php/controller_primario/deletar_carro'); ?>" >Deletar</button>
        </form>
    </div>

<?php
    $this->session->unset_userdata('carro');
?>