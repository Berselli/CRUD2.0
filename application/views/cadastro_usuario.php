<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>        
        <meta charset="UTF-8">
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap_login.css')?>">
    </head>
    <body>
        <div class="jumbotron-login container-login">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active show" data-toggle="tab-login" href="#login">ENTRAR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab-singup" href="#singup">REGISTRAR-SE</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active show" id="login" data-toggle="pane-login">                
                    <form action="<?php echo base_url('index.php/controller_primario/usuario_entrar')?>"  method="post">
                        <div class="form-group"><br>
                            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="E-mail" name="email_usuario"><br>                           
                            <input type="password" class="form-control" placeholder="Senha" name="senha_usuario"><br>
                            <button type="submit" class="btn btn-info">Entrar</button>
                            <button type="submit" class="btn btn-info" formaction=" <?php echo base_url('index.php/controller_primario/index') ?> ">Voltar</button>
                        </div>
                    </form>       
                </div>
                <div class="tab-pane fade" id="singup" data-toggle="pane-singup">
                    <form action="<?php echo base_url('index.php/controller_primario/usuario_registro')?>" method="post">
                        <div class="form-group"><br>
                            <input type="text" class="form-control" placeholder="Nome" name="nome_usuario"> <br>
                            <input type="text" class="form-control" placeholder="Sobrenome" name="sobrenome_usuario"> <br>
                            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="E-mail" name="email_usuario"><br>
                            <input type="password" class="form-control" placeholder="Senha" name="senha_usuario"><br>                            
                            <button type="submit" class="btn btn-info">Registrar-se</button>
                            <button type="submit" class="btn btn-info" formaction=" <?php echo base_url('index.php/controller_primario/index') ?> ">Voltar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('assets/login.js')?>"></script>
    </body>
</html>