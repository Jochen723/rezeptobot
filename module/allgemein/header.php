<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid justify-content-center">
        <a class="navbar-brand" href="../../startseite/masken/startseite.php"><i class="fa fa-cutlery" aria-hidden="true"></i>  Rezeptobot</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <span class="navbar-text">
                   <?php
                   session_start();
                   if(isset($_SESSION['mail'])) {echo $_SESSION['mail'];}?>
                </span>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../../startseite/masken/startseite.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../../kochkalender/masken/kochkalender.php">Kalender</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../../rezeptuebersicht/masken/rezeptuebersicht.php">Von A - Z</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../kategorien/masken/kategorieuebersicht.php">Kategorien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../nutzermanagement/masken/logout.php">Logout</a>
                </li>

                <li class="nav-item btn-submit-recipe">
                    <a class="nav-link" href="../../rezeptdetails/masken/neuesrezept.php"><i class="fa fa-upload" aria-hidden="true"></i> neues Rezept</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
