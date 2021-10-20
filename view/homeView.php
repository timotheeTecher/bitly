<?php
    $title = 'Raccourcisseur d\'url express';
    ob_start();
?>

<section class="hero-banner">
    <div class="container">
        <header class="header">
            <img src="public/assets/images/logo.png" alt="Logo du site web">
        </header>
        <div class="under-header">
            <h1>UNE URL LONGUE ? RACCOURCISSEZ-LA</h1>
            <h2>Largement meilleur et plus court que les autres</h2>
            <form action="index.php?page=../" method="POST">
                <input class="url-input" type="url" placeholder="Collez un lien à raccourcir" name="url">
                <input class="url-submit" type="submit" value="RACCOURCIR">       
            </form>
            <?php
                if(isset($_GET['error']) && isset($_GET['message'])) {
                    $error   = $_GET['error'];
                    $message = htmlspecialchars($_GET['message']);
            ?>
                    <div class="error-message">
                        <?= $message ?>
                    </div>
            <?php
                } else if(isset($_GET['short'])) {
                    $shortcut = htmlspecialchars($_GET['short']);
            ?>
                    <div class="error-message">
                        <p>URL RACCOURCIE : http//bitly/?q=<?= $shortcut ?></p>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>
<section class="brands">
    <div class="container">
        <h3>CES MARQUES NOUS FONT CONFIANCE</h3>
        <div class="companies">
            <img src="public/assets/images/1.png" alt="Entreprise 1">
            <img src="public/assets/images/2.png" alt="Entreprise 2">
            <img src="public/assets/images/3.png" alt="Entreprise 3">
            <img src="public/assets/images/4.png" alt="Entreprise 4">
        </div>
    </div>
</section>
<footer class="footer">
    <div class="logo-footer">
        <img src="public/assets/images/logo2.png" alt="Logo du site web">
    </div>
    <p>2021 © Bitly</p>
    <p><a href="">Contact</a> - <a href="">A propos</a></p>
</footer>

<?php
    $content = ob_get_clean();
    require('template.php');
?>