<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Ezoom Cursos</title>
  
  <?= link_tag('assets/bootstrap/css/bootstrap.min.css') ?>
  <?= link_tag('assets/app/css/app.css') ?>
  <?= link_tag('assets/app/css/curso.min.css') ?>
</head>
<body>

  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-header">
	  <a class="navbar-brand" rel="home" href="<?= base_url() ?>">Ezoom Cursos</a>
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	</div>
	<div class="collapse navbar-collapse">
	  <ul class="nav navbar-nav">
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias <i class="caret"></i></a>
		  <ul class="dropdown-menu">
			<?php foreach ($categorias as $categoria): ?>
			  <li>
				<a href="<?= base_url('categoria/'.$categoria->slug) ?>">
				  <?= $categoria->nome ?>	
				</a>
			  </li>
			<?php endforeach; ?>
		  </ul>
		</li>
	  </ul>
	</div>
  </nav>

  <div class="container">
	