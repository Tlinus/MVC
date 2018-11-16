<header style="margin-bottom: 100px;">
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="./">Todo </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			
		</button>

		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto"></ul>
			<ul class="navbar-nav mr-right">
				<?php if(empty($_SESSION['user'])){  ?>
				<li class="nav-item"> <a href="./Login" class="nav-link">Login</a></li>
				<li class="nav-item"><a href="./Register" class="nav-link">Register</a></li>
				<?php }else{ ?>
					<li class="nav-item"><a class="nav-link" href="http://localhost/mvccours/Logout">Deconnexion</a></li>
					<li class="nav-item"><a class="nav-link" href="http://localhost/mvccours/utilisateur/delete">Supprimer mon compte</a></li>
					<li class="nav-item"><a class="nav-link" href="http://localhost/mvccours/modify">Modifier les informations de mon compte</a></li>
				<?php } ?>
			</ul>
		</div>
	</nav>
</header>