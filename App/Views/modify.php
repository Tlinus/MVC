<?php \Core\Template::render('fragments/doctype'); ?>

<?php \Core\Template::render('fragments/header'); ?>


		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 text-center" >
					<h1 class="text-center">Bienvenue</h1>
					<div class="row">
						
								<?php if(isset($_SESSION['error_modify'])){
									?>
									<div class="alert alert-danger" role="alert">
									<?php
									
									echo $_SESSION['error_modify'];
									?>
									</div>
									<?php
									unset($_SESSION['error_modify']);
								} ?>
						
						<form method="post" action="./utilisateur/modify" class='formulaire-inscription'>
							<div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4">				
								<h3>Login:</h3>
								<input name="login" type="text" placeholder="Pseudo..."  
									<?php echo  'value="'.$_SESSION['user']->login. '"'; ?> 
								/>
							</div>
							<div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4">				
								<h3>Votre nom: </h3>
								<input name="lastName" type="text" placeholder="Mon nom" required 
										<?php echo  'value="'.$_SESSION['user']->lastName. '"';  ?> 
								 />
							</div>
							<div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4">				
								<h3>Votre prénom: </h3>
								<input name="firstName" type="text" placeholder="Mon nom" required 
										<?php echo  'value="'.$_SESSION['user']->firstName. '"';  ?> 
								 />
							</div>
							<div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4">		
								<h3>Mot de passe: </h3>
								<input type="password" name="password" placeholder="Mot de passe..." required 
									<?php echo  'value="'.$_SESSION['user']->password. '"';  ?> 
								 />
							</div>
							<div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4">
								<input id="inscription" type="submit" class="btn" value="Modifier"/> <br>
							</div>
						</form>
						<?php 
							if(isset($erreur))
								{
									// si on à un message d'erreur suite à une mauvaise saisie on l'affiche
									// BONUS va comprendre pourquoi ça clignote pas -_-' HTMML CSS, rien n'y fait/...
								echo '<p id="error">' .$erreur. '</p>';
								}
						?>
					</div>
					<!-- au cas où il y aurait eu une mauvaise direction on propose au visiteur si il a déja un compte de s'authentifier... -->
					<h4> déja inscrit? <a href="login" > Connexion</a> </h4>
				</div>
			</div>
	}


<?php \Core\Template::render('fragments/footer'); ?>