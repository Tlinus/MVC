<?php \Core\Template::render('fragments/doctype'); ?>

<?php \Core\Template::render('fragments/header'); ?>
<link rel="stylesheet" type="text/css" href="../css4/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css4/bootstrap-theme.min.css">

<div class="container">
	<div class="row">

		<h1 style="width: 100%;" class="text-center"> <?php echo $_SESSION['Projet']->name ?></h1>
		<form class="list-group-item list-group-item-action permanent flex-column align-items-start" action="" method="post">
            <div class="input-group col-12" >
				<input type="hidden" name="id" value="<?php echo $_SESSION['projetModify']->id ?>">
				<input type="text" style="width: 50%; margin-left: 20%;"name="name" value="<?php echo $_SESSION['projetModify']->name ?>">

				<button class="btn btn-info" name='modify'>Modifier</button>
			</div>
		</form>
		


<?php \Core\Template::render('fragments/footer'); ?>