<?php \Core\Template::render('fragments/doctype'); ?>

<?php \Core\Template::render('fragments/header'); ?>


<div class="container">
	<a href="index">Retour</a>
	<div class="row">

		<?php 
			if(isset($_SESSION['error:Tache'])){
				?>
				<div class="alert alert-danger" role="alert">
				<?php
				echo $_SESSION['error:Tache'];
				?>
				</div>
				<?php
				unset($_SESSION['error:Tache']);						
			}
			if(isset($_SESSION['success:Tache'])){
				?>
				<div class="alert alert-success" role="alert">
				<?php
				echo $_SESSION['success:Tache'];
				?>
				</div>
				<?php
				unset($_SESSION['success:Tache']);						
			}
		?>
		<h1 style="width: 100%;" class="text-center"> <?php echo $_SESSION['Projet']->name ?></h1>
		<div class="col-12 text-center">
			<form action="projet/delete" method="post" style="margin: 25px; display: inline-block;">
				<input type="hidden" name="id" value="<?php echo $_SESSION['Projet']->id ?>">
				<button class="btn btn-danger">Supprimer</button>
			</form>
			<form action="projet/modify" method="post" style="margin: 25px; display: inline-block;">
				<input type="hidden" name="id" value="<?php echo $_SESSION['Projet']->id ?>">
				<button class="btn btn-info">Modifier</button>
			</form>
		</div>
		<div class="col-8 text-left">
			<form class="list-group-item list-group-item-action permanent flex-column align-items-start" action="tache/ajouter" method="post">
                <div class="input-group">
					<input type="hidden" name="id_projet" value="<?php echo $_SESSION['Projet']->id ?>">

                    <input name="name" type="text" class="col-12 form-control" placeholder="Titre votre tache">
                   
                <div class="input-group">
                    <textarea name="commentaire" class="col-12 form-control" placeholder="Description de la tache"></textarea>
                </div>
                <div class="input-group">
                    <button type="submit" class="col-12 btn btn-success">+ Ajouter une tache</button>
                </div>
            </form>
        </div>
    </div>
        <h1 class="text-center" style="margin: 50px;"> Liste des taches </h1>
			
			<?php if(!empty($_SESSION['Taches'])){
				echo "";
				foreach ($_SESSION['Taches'] as  $Tache) { ?>
					<div class="row" style="width: 100%; border: 1px solid #888; border-radius: 10px; padding: 5px; margin: 20px;
					<?php if($Tache->etat){ echo 'background-color: rgba(20, 145, 40, 0.6);'; } ?> ">
						<div class="col-12 text-left" style="border-bottom: 1px solid #777;">
							<form action="tache/modify" method="post" style="margin-top: 4px; display: inline-block;">
								<input type="hidden" name="id" value="<?php echo $Tache->id ?>">
								<input type="hidden" name="id_projet" value="<?php echo $_SESSION['Projet']->id ?>">
								<button class="btn btn-link"><h3><?php echo $Tache->name; ?></h3></button>
							</form>
						</div>
						<div class="col-5 text-left">
							<h6 style="padding: 10px;"><?php echo $Tache->commentaire; ?></h6>				
						</div>
						<div class="col-2 text-left">
							<h6 style="padding: 10px;"><?php echo $Tache->ts_creation; ?></h6>				
						</div>
						<div class="col-3 text-left">
							<?php if($Tache->etat) {
								?>
								<form action="tache/undone" method="post" style="margin-top: 4px; display: inline-block;">
									<input type="hidden" name="id" value="<?php echo $Tache->id ?>">
									<input type="hidden" name="id_projet" value="<?php echo $_SESSION['Projet']->id ?>">
									<button class="btn btn-warning">Undone</button>
								</form>
							<?php }else{ ?>		
								<form action="tache/done" method="post" style="margin-top: 4px;display: inline-block;"  >
									<input type="hidden" name="id" value="<?php echo $Tache->id ?>">
									<input type="hidden" name="id_projet" value="<?php echo $_SESSION['Projet']->id ?>">

									<button class="btn btn-success">Done</button>
								</form>		
							<?php } ?>
							<form action="tache/delete" method="post" style="margin-top: 4px; display: inline-block;">
								<input type="hidden" name="id" value="<?php echo $Tache->id ?>">
								<input type="hidden" name="id_projet" value="<?php echo $_SESSION['Projet']->id ?>">
								<button class="btn btn-danger">Supprimer</button>
							</form>
						</div>
					</div>
				<?php }
			}
			?>


	</div>
</div>


<!-- fiverr -->

<?php \Core\Template::render('fragments/footer'); ?>