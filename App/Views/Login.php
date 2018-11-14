<?php \Core\Template::render('fragments/doctype'); ?>

<?php \Core\Template::render('fragments/header'); ?>

<div class="container">
    <div class="col-sm-offset-3 col-sm-6 login-adjust">
        <?php if(isset($_SESSION['error_login'])){
            ?>
            <div class="alert alert-danger" role="alert">
            <?php
            
            echo $_SESSION['error_login'];
            ?>
            </div>
            <?php
            unset($_SESSION['error_login']);
        } ?>
        <h1 class="text-center">Connexion</h1>
        <form method= "post" action="utilisateur/login" class="connexion-formulaire">
            <div class="form-group">
                <h3>login:</h3>
                <input class="form-control" type="text" name="login" placeholder="Entrer Email">
            </div>
            <div class="form-group">
                <h3>Password:</h3>
                <input class="form-control" type="password" name="password" placeholder="Entrer Mot de Passe">
            </div>
            <div>
            	<!-- <p><a href="/recuperation/">Mot de passe oublié ?</a></p> -->
            </div>
            <div class="text-center">
                <input class="btn float-right " type="submit" value="Connexion" >
            </div>
            <div class="error">
                <?php 
                    if(!empty($_SESSION['errorLogin']))
                        {
                            echo '<p id="errorLogin" >' .$_SESSION['errorLogin']. '</p>';
                            unset($_SESSION['errorLogin']); 
                        }
                ?>
            </div>

            <div class="break"></div>
        </form>
    </div>
</div>


<?php \Core\Template::render('fragments/footer'); ?>