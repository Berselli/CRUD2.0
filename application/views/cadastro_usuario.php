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
                    <a class="nav-link active show" data-toggle="tab-login" href="#login">LOG IN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab-singup" href="#singup">SING UP</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active show" id="login" data-toggle="pane-login">                
                    <form action="<?php echo base_url('index.php/controller_primario/user_login')?>"  method="post">
                        <div class="form-group"><br>
                            <input type="text" class="form-control" placeholder="Username" name="user_name"> <br>
                            <input type="password" class="form-control" placeholder="Password" name="user_password"><br>
                            <button type="submit" class="btn btn-info">Login</button>
                            <button type="submit" class="btn btn-info" formaction=" <?php echo base_url('index.php/controller_primario/index') ?> ">Voltar</button>
                        </div>
                    </form>       
                </div>
                <div class="tab-pane fade" id="singup" data-toggle="pane-singup">
                    <form action="<?php echo base_url('index.php/controller_primario/user_singup')?>" method="post">
                        <div class="form-group"><br>
                            <input type="text" class="form-control" placeholder="Username" name="user_name"> <br>
                            <input type="password" class="form-control" placeholder="Password" name="user_password"> <br>
                            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="user_email"><br>
                            <button type="submit" class="btn btn-info">Sing Up</button>
                            <button type="submit" class="btn btn-info" formaction=" <?php echo base_url('index.php/controller_primario/index') ?> ">Voltar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('assets/login.js')?>"></script>
    </body>
</html>