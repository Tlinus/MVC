<?php 
session_destroy();
unset($_SESSION);

\Core\Template::render('index');