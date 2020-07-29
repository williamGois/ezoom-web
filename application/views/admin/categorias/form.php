<div class="row">
  <div class="col-sm-6">
    <h1><?= is_null($categoria->id) ? 'Nova Categoria' : $categoria->nome; ?></h1>
	<p class="lead">Formulario</p>
  </div>

  <div class="col-sm-6">
    <p class="text-right">
      	<a href="<?= site_url('admin/categorias/'); ?>" class="btn btn-default">
			<i class="glyphicon glyphicon-chevron-left"></i> Voltar
	  	</a>
    </p>
  </div>
</div>

<div class="row">
	<div class="col-lg-6">

		<?= form_open('admin/categorias/form/'.$categoria->id, 'class="well"'); ?>
			<div class="form-group">
				<label>nome</label>
				<?= form_error('nome') /* Mostra erro do nome. */ ?>
				<input type="text" name="nome" value="<?= $categoria->nome ?>" class="form-control">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">
					<i class="glyphicon glyphicon-floppy-disk"></i> Salvar
				</button>
			</div>
		</form>

	</div>
</div>