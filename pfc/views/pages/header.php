<nav class="navbar navbar-expand-lg navbar-light bg-white bottom-shadow sticky-top">
    <a class="navbar-brand" href="#">
        <img src="<?php $this->path('assets/images/ecomp/logoNome.png');?>" alt="" width="120" class="d-inline" id="logo1">
        <img src="<?php $this->path('assets/images/ecomp/logo.png');?>" alt="" width="30" class="d-none" id="logo2">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav flex-lg-row ml-lg-auto d-lg-flex">
            <li class="nav-item"> <a class="nav-link" href="<?php echo ROOT_URL?>">Home</a></li>
            <?php 
                if(isset($_SESSION['isLogged']) && $_SESSION['isLogged']){
                    echo '<li class="nav-item"><a class="nav-link" href="'.ROOT_URL.'member">Área de Membros</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="'.ROOT_URL.'project">Área de Projetos</a></li>';
                }
                else{
                    echo '<li class="nav-item"><a class="nav-link" href="'.ROOT_URL.'login">Login</a></li>';
                }
            ?>

            <li class="nav-item"> <a class="nav-link" href="<?php echo ROOT_URL?>about">Como funciona ?</a></li>
            <?php 
                if(isset($_SESSION['isLogged']) && $_SESSION['isLogged']){
                    echo '<li class="nav-item"><a class="nav-link" href="'.ROOT_URL.'logout">Sair</a></li>';
                }
            ?>
        </ul>
    </div>
</nav>