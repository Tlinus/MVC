<?php \Core\Template::render('fragments/doctype'); ?>

<?php \Core\Template::render('fragments/header'); ?>


		<div class="container">
			<div class="row">

					<h1 class="text-center" style="width:100%;">Bienvenue</h1>

						
						
						<form method="post" action="./utilisateur/register" style="width: 100%">
							
								<?php if(isset($_SESSION['error:register'])){
									?>
									<div class="alert alert-danger" role="alert">
									<?php
									echo $_SESSION['error:register'];
									?>
									</div>
									<?php
									unset($_SESSION['error:register']);
								} ?>
							<div class="col-4 offset-4 text-center " style="margin-top: 20px; margin-bottom: 20px;">				
								<h3 >Identifiant:</h3>
								<input  name="login" type="text" placeholder="Pseudo..." required 
									<?php if(!empty($_POST['login'])){
											echo  'value="'.$_POST['login']. '"';
										} 
									?> 
								/>
							</div>
							<div class="col-4 offset-4 text-center " style="margin-top: 20px; margin-bottom: 20px;">				
								<h3>Votre Nom: </h3>
								<input name="lastName" type="text" placeholder="Mon nom" required 
										<?php if(!empty($_POST['lastName'])){
											echo  'value="'.$_POST['lastName']. '"';
										} 
									?> />
							</div>
							<div class="col-4 offset-4 text-center " style="margin-top: 20px; margin-bottom: 20px;">				
								<h3>Votre Nom: </h3>
								<input name="firstName" type="text" placeholder="Mon nom" required 
										<?php if(!empty($_POST['firstName'])){
											echo  'value="'.$_POST['firstName']. '"';
										} 
									?> />
							</div>
							<div class="col-4 offset-4 text-center " style="margin-top: 20px; margin-bottom: 20px;">				
								<h3>Mot de passe: </h3>
								<input type="password" name="password" placeholder="Mot de passe..." required 
									<?php if(!empty($_POST['mdp'])){
											echo  'value="'.$_POST['mdp']. '"';
										} 
									?> />
							</div>
							<div class="col-4 offset-4 text-center " style="margin-top: 20px; margin-bottom: 20px;">				
								<h3>Veuillez confirmer votre mot de passe: </h3>
								<input type="password" name="password2" placeholder="Confirmation..." required 
									<?php if(!empty($_POST['mdp2'])){
											echo 'value="'.$_POST['mdp2']. '"';
										} 
									?> />
							</div>
							<div class="col-4 offset-4 text-center " style="margin-top: 20px; margin-bottom: 20px;">				
								<input id="inscription" type="submit" class="btn" value="S'inscrire!"/> <br>
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
					<h4 class="col-4 offset-4 text-center ">déja inscrit? <a href="login" > Connexion</a> </h4>
				</div>
			</div>
	}


<?php \Core\Template::render('fragments/footer'); ?>