<?php \Core\Template::render('fragments/doctype'); ?>

<?php \Core\Template::render('fragments/header'); ?>



<div class="container">
	<div class="row">
		<?php
			if(isset($_SESSION['error:Projet'])){
				?>
				<div class="alert alert-danger" role="alert">
				<?php
				echo $_SESSION['error:Projet'];
				?>
				</div>
				<?php
				unset($_SESSION['error:Projet']);						
			}

			if(isset($_SESSION['user'])){?>
				<h1 class="text-center"><?php echo $_SESSION['user']->login; ?>: Vos Projets </h1>
				<div class="col-12">
					<form calss="form-group" action="projet/nouveau" method="post">
						
						<button type="submit" class="btn btn-success" style="margin-left: 20px;float: right;"> créer</button>
						<input type="text" name="name" style="float: right;">
						<label  style="float: right; margin-right: 20px;"> Creer un nouveau projet</label>
						
					</form>
				</div>
				<?php
				$Projets = \Models\Projet::find(['id_utilisateur' => $_SESSION['user']->id]); 
				foreach ($Projets as $value) { ?>
					<form action="projet" method="post">
						<input type="hidden" name="id_projet" value="<?php echo $value->id ?>">
						<button type="submit" class="btn btn-info" style="margin:25px;"><?php echo $value->name ?></button>
					</form>

				<?php
				}
			}
		?>

	</div>
</div>


<!-- fiverr -->

<?php 
\Core\Template::render('fragments/footer'); 
unset($_SESSION['Projet']);
unset($_SESSION['Taches']);
?>