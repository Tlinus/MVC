<?php \Core\Template::render('fragments/doctype'); ?>

<?php \Core\Template::render('fragments/header'); ?>
<link rel="stylesheet" type="text/css" href="../css4/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css4/bootstrap-theme.min.css">

<div class="container">
	<a href="../projet">Retour au projet</a>
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

		<div class="col-8 text-left">
			<form class="list-group-item list-group-item-action permanent flex-column align-items-start" action="" method="post">
                <div class="input-group">
					<input type="hidden" name="id_projet" value="<?php echo $_SESSION['Projet']->id ?>">
					<input type="hidden" name="id" value="<?php echo $_SESSION['TacheModify']->id ?>">

                    <input name="name" type="text" class="col-12 form-control" placeholder="Titre votre tache" value="<?php echo $_SESSION['TacheModify']->name ?>">
                   
                <div class="input-group">
                    <textarea  name="commentaire"  class="col-12 form-control" placeholder="Description de la tache" ><?php echo $_SESSION['TacheModify']->commentaire ?></textarea>
                </div>
                <input type="hidden" name="modify">
                <div class="input-group">
                    <button type="submit"  class="col-12 btn btn-success">Modifier la tache</button>
                </div>
            </form>
        </div>
    </div>

<?php \Core\Template::render('fragments/footer'); ?>