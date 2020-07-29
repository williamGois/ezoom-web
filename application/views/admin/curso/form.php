<div class="row">
	<div class="col-sm-6">
		<h1><?= is_null($curso->id) ? 'Cadastrar novo Curso' : $curso->titulo ?></h1>
		<p class="lead">Formulario</p>
	</div>

	<div class="col-sm-6">
		<p class="text-right">
			<a href="<?= site_url('admin/curso/') ?>" class="btn btn-default">
				<i class="glyphicon glyphicon-chevron-left"></i> Voltar
			</a>
		</p>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">

		<?= form_open_multipart('admin/curso/form/' . $curso->id, 'class="well"') ?>

		<div class="form-group">
			<label>Titulo do Curso</label>
			<?= form_error('titulo') /*  */ ?>
			<input type="type" name="titulo" value="<?= $curso->titulo ?>" class="form-control" />
		</div>

		<div class="form-group">
			<label>Descricao</label>
			<?= form_error('descricao') /*  */ ?>
			<textarea type="type" name="descricao" class="form-control"><?= $curso->descricao ?></textarea>
		</div>
		<?php if (!is_null($curso->id)) { ?>
			<div class="form-group">
				<img src="<?= base_url('upload/tumb/' . $curso->imagem); ?>" class="img-responsive galeria-img" />
			</div>
		<?php } ?>
		<div class="form-group">
			<label>Imagem Capa</label>
			<?= form_error('userfile') /*  */ ?>
			<input type="file" name="userfile" accept="image/*" />
		</div>

		<div class="form-group">
			<label>Categoria do curso</label>
			<?= form_error('categoria') /*  */ ?>
			<select name="categoria" class="form-control">
				<option></option>
				<?php foreach ($categorias as $categoria) : ?>
					<option <?= set_select('categoria', $categoria->id, ($categoria->id == $curso->categoria_id)) ?> value="<?= $categoria->id ?>">
						<?= $categoria->nome ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">
				<i class="glyphicon glyphicon-floppy-disk"></i> Salvar
			</button>
		</div>

		</form>
	</div>

	<?php if (!is_null($curso->id)) { ?>
		<div class="col-lg-6">

			<?= form_open_multipart('admin/curso/adicional/' . $curso->id, 'class="well"') ?>

			<div class="form-group">
				<label>Imagem Adicional</label>
				<?= form_error('imagemAdicional') /*  */ ?>
				<input type="file" name="imagemAdicional" accept="image/*" />
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">
					<i class="glyphicon glyphicon-floppy-disk"></i> Adicionar Imagem
				</button>
			</div>

			</form>
			<?php if (!is_null($curso_imagens)) : ?>
				<?php foreach ($curso_imagens as $img) : ?>
					<div class="col-md-4" style="margin-bottom: 2%;">
						<img src="<?= base_url('upload/tumb/' . $img->imagem); ?>" class="img-responsive" />
						<a href="<?= site_url('admin/curso/deleteAdicional/' . $img->id); ?>" class="btn btn-xs btn-danger" title="eliminar" onclick="javascript:return confirm('Deseja deletar esta imagem?');">
							<i class="glyphicon glyphicon-trash"></i>
						</a>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	<?php } ?>
</div>