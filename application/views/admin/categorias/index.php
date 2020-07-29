<div class="row">
  <div class="col-sm-6">
    <h1>Categorias</h1>
    <p class="lead">Registros</p>
  </div>

  <div class="col-sm-6">
    <p class="text-right">
      <a href="<?= site_url('admin/categorias/form/'); ?>" class="btn btn-default">
        <i class="glyphicon glyphicon-plus"></i> Adicionar Categoria
      </a>
    </p>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th>Categoria</th>
          <th>Slug</th>
          <th style="width:40px;"></th>
          <th style="width:40px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categorias as $categoria) : ?>
          <tr>
            <td><?= $categoria->nome; ?></td>
            <td><?= $categoria->slug; ?></td>
            <td>
              <a href="<?= site_url('admin/categorias/form/' . $categoria->id); ?>" class="btn btn-xs btn-primary">
                <i class="glyphicon glyphicon-pencil"></i>
              </a>
            </td>
            <td>
              <a href="<?= site_url('admin/categorias/delete/' . $categoria->id); ?>" class="btn btn-xs btn-danger" onclick="javascript:return confirm('Deletar Categoria?');">
                <i class="glyphicon glyphicon-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>