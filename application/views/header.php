<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $user_is_logged = $this->session->userdata('user');
    $user_is_admin = $this->session->userdata('admin');
    //echo $user_is_logged === null;
    //echo $user_is_admin === null;

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.css')?>">
        <title><?php echo $page_title; ?></title>
    </head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-logo" href="<?php echo base_url('index.php/controller_primario/index')?>"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02" data-js="navbar-menu" >
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url('index.php/controller_primario/aluguel')?>">ALUGUEL DE CARROS<span class="sr-only">(current)</span></a>
                    </li>
                    
                    <?php
                        if( (!(is_null($user_is_logged) ) || $user_is_logged === true) && $user_is_admin === true){
                            echo '<li class="nav-item active">
                                <a class="nav-link" href="#">CADASTRO DE CARROS<span class="sr-only">(current)</span></a>
                            </li>';
                            echo '<li class="nav-item active">
                                <a class="nav-link" href="#">TABLELA DE DISPONIBILIDADE DE CARROS<span class="sr-only">(current)</span></a>
                            </li>';
                            echo '<li class="nav-item active">
                                <a class="nav-link" href="#">HISTÓRICO DE ALUGUEIS<span class="sr-only">(current)</span></a>
                            </li>';
                        }
                        if(!(is_null($user_is_logged) ) || $user_is_logged === true){
                            echo '<li class="nav-item active">
                                <a class="nav-link" href="#">MEUS CARROS ALUGADOS<span class="sr-only">(current)</span></a>
                            </li>';
                        }
                        if(is_null($user_is_logged) || $user_is_logged === false){
                            echo '<li class="nav-item active">
                                <a class="nav-link" href="'. base_url('index.php/controller_primario/to_login') .'">LOG IN<span class="sr-only">(current)</span></a>
                            </li>';
                        }
                        if(!(is_null($user_is_logged) ) || $user_is_logged === true){
                            echo '<li class="nav-item active">
                                <a class="nav-link" href="#">LOG OUT<span class="sr-only">(current)</span></a>
                            </li>';
                        }
                    ?>
                    
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="BUSQUE UM CARRO">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Busque</button>
                </form>
            </div>
        </nav>
    </header>

    <script>
        $buttonMenu = document.querySelector('[data-toggle="collapse"]');
        $menuNavbar = document.querySelector('[data-js="navbar-menu"]');

        $buttonMenu.addEventListener('click', handleMenuShow ,false);

        function handleMenuShow(event){
        event.preventDefault();
        $menuNavbar.classList.toggle('show');
    }
    </script>