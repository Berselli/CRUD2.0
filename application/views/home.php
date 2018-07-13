<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap.css')?>">
        <title>Document</title>
    </head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-green bg-green">
            <a class="navbar-logo" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">ALUGUEL DE CARROS<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">CADASTRO DE CARROS<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">TABLELA DE DISPONIBILIDADE DE CARROS<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">LOG IN<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">LOG OUT<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="BUSQUE UM CARRO">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Busque</button>
                </form>
            </div>
        </nav>
    </header>
    <div class="jumbotron">
    <h1 class="display-3">Bem-Vindo!</h1>
    <p class="lead">Este é um site de testes, já que está aqui aproveite e teste as funcionalidades.</p>
    <hr class="my-4">
    <p>Aqui você poderá pesquisar carros para aluguel e aluga-los, se for um usuário administrador poderá cadastrar novos carros
         e verificar o estado e disponibiliade de toda frota.</p>
    <p>
        Muito obrigador por visitar esta página.
    </p>
    </div>

    <footer class="modal-footer bg-green footer-position" >
        <div class="footer-div navbar-collapse" >
            <a class="footer-logo " href="#" ></a>
            <ul class="navbar-nav mr-auto " >
                <li>
                    <address>
                        <i>  
                            Informações ao consumidor: Localiza Rent - CNPJ nº 00.000.000/0000-00 <br>
                        </i>
                        <i>
                            Sede: Avenida Fulano Ciclano, n° 000 - Bairro do Ciclano – CEP: 00.000-000 - Cidadezinha do Fulano – XX <br>
                        </i>
                    </address>                        
                </li>
            </ul>
            <ul class="navbar-nav mr-auto " >
                <li>
                    <address>
                        <i>
                            Central de Reservas 24h: 0800 000 0000 | Assistência a Clientes 24h: 0800 000 0000 <br>
                        </i>
                        <i>
                            E-mail: centraldereservas@mail.com <br>
                        </i>     
                    </address>                        
                </li>
            </ul>       
        </div>

    </footer>

</body>
</html>