<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/index.php">Le chat</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/index.php">Accueil <span class="sr-only">(actuel)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/chat.php">Chat</a>
                </li>
                <?php
                if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                // Ici, l'utilisateur est connecté
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/profil.php">Bonjour <?= $_SESSION['user']['pseudo'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="/deconnexion.php"><i class="la la-user"></i></a>
                    </li>

                <?php }else{ ?>
                    <li class="nav-item">
                        <a class="btn btn-success" href="/connexion.php"><i class="la la-user"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success" href="/inscription.php"><i class="la la-plus"></i></a>
                    </li>

                    <?php
                }
                ?>
                <li class="nav-item">
                    <a class="btn btn-light" href="/messagerie.php"><i class="la la-envelope la-2x"></i><span id="pm" class="badge badge-primary"><?= ($compte['nombre'] > 0) ? $compte['nombre'] : '' ?></span></a>
                </li>
            </ul>
        </div>

    </div>
</nav>