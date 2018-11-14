		
		<!-- [[[[[[[[HEADER]]]]]]]]] -->
		<div class="col-xs-12 "> 

			<header class="row">
				<div class="logo-header">
					<div class="col-xs-4  col-sm-1  pad-xs-only">
						<img src="/img/logoduSite2.png" alt="Logo">
					</div>
				</div>
				<nav>
					<!-- [[[[[[[[Search Bar & user ]]]]]]]]] -->
					<div class=" stop-height">
						<form>
							<input type="text" name="search-main" class="col-xs-6 col-sm-2 col-sm-offset-1	">
							<button type="submit" class="glyphicon glyphicon-search searchBar col-xs-1"></button>
						</form>
						<?php 	if($_SESSION['unconnected'] == 1 || $_SESSION['connected'] == 0){ include(PATH_VIEWS.'includes/connexion_header_not_connected.php');}
							 	else{ include(PATH_VIEWS.'includes/connexion_header_connected.php'); } 
						?>
					</div>
					<?php 
						//admin module
						if(!empty($_SESSION['is_admin']) && $_SESSION['is_admin'] != 0){ ?>
							<div class="col-xs-12 col-sm-10 col-sm-offset-1 ">
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-lg-3 nav-header-li text-center pad-xs-only">
										<a href="/AdminMenu/"> Administration </a>
									</div>
									<div class="col-xs-6 col-sm-6 col-lg-3 nav-header-li text-center pad-xs-only">
										<a href="/nouvelleRubrique/"> Nouvelle rubrique </a>
									</div>
									<div class="col-xs-6 col-sm-6 col-lg-3 nav-header-li text-center pad-xs-only">
										<a href="/nouvelleSousRubrique/"> Nouvelle sous-rubrique </a>
									</div>
									<div class="col-xs-6 col-sm-6 col-lg-3 nav-header-li text-center pad-xs-only">
											<a class="dropdown-toggle" data-toggle="dropdown" href="/nouvelArticle/" role="button" aria-haspopup="true" aria-expanded="false">
										       Nouvel article <span class="caret"></span>
										    </a>
										    <ul class="dropdown-menu " style="width: 100%;">
										      <li><a href="/nouvelArticleLien/">Lien</a></li>
										      <li><a href="/nouvelArticleVideo/">Video</a></li>
										    </ul>

										
									</div>
								</div>
							</div>

						<?php }
					?>

					<!-- [[[[[[[[Fonctionalites Site]]]]]]]]] -->
					<div class="col-xs-12 col-sm-10 col-sm-offset-1 ">
						<div class="row">
							<div class="col-xs-6 col-sm-2 col-lg-1 nav-header-li text-center pad-xs-only">
								<a href="/rubriques/"> Learning </a>
							</div>
							<div class="col-xs-6 col-sm-2 col-lg-1 nav-header-li text-center pad-xs-only">
								<a href=""> Sharing </a>
							</div>
							<div class="col-xs-6 col-sm-2 col-lg-1 nav-header-li text-center pad-xs-only">
								<a href=""> Categories </a>
							</div>
						</div>
					</div>

					
				</nav>
			</header>
		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		