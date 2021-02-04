<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Produto</title>

	<?= link_tag('assets/bootstrap/css/bootstrap.min.css') ?>
	<?= link_tag('assets/app/css/admin.min.css') ?>
	<?= link_tag('assets/app/css/produto.min.css') ?>
</head>
<body>
<div id="wrapper">
	<!-- Sidebar -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= base_url("admin") ?>">91 seguros<sup><small><span class="label label-danger">v1.0</span></small></sup> </a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<nav class="collapse navbar-collapse navbar-ex1-collapse">

			<ul class="nav navbar-nav side-nav">
				<li><a href="<?= base_url("admin") ?>"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
				<li><a href="<?= base_url("admin/categorias") ?>"><i class="glyphicon glyphicon-tag"></i> Categorias</a></li>
				<li><a href="<?= base_url("admin/produto") ?>"><i class="glyphicon glyphicon-picture"></i> Produtos</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right navbar-user">
				<li class="dropdown user-dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="glyphicon glyphicon-user"></i> <?= $_SESSION['usuario']['nome'] ?> <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?= base_url('admin/auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> Salir</a></li>
					</ul>
				</li>
			</ul>

		</nav><!-- /.navbar-collapse -->
	</nav>

	<div id="page-wrapper">
