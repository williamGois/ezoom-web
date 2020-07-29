<div class="row">
  <div class="col-sm-6">
    <h1>Ezoom </h1>
    <p class="lead">Cursos</p>
  </div>

  <div class="col-sm-6">
    <p class="text-right">
      <a href="<?= site_url('admin/curso/form'); ?>" class="btn btn-default">
        <i class="glyphicon glyphicon-save"></i> Adicionar Curso
      </a>
    </p>
  </div>
</div>

<div class="row">
  <?php foreach ($cursos as $curso): ?>
    <div class="col-sm-4 galeria-item">
      <!--Pnel-->
      <div class="panel galeria-link">
        
        <!--Image-->
        <div class="img">
          <a href="<?= base_url('admin/curso/form/' . $curso->id); ?>" class="fancybox-effects-a" data-fancybox-group="gallery" title="<?= $curso->titulo; ?>">
            <img src="<?= base_url('upload/tumb/'.$curso->imagem); ?>" class="img-responsive galeria-img" />
          </a>
        </div>
        <!--/Image-->

        <!--Body-->
        <div class="panel-body">
          <h1 style="font-size: 21px; text-align:center; font-weight: bold;"><?= $curso->titulo; ?></h1>

          <div class="text-right">
            <a href="<?= site_url('admin/curso/form/' . $curso->id); ?>" class="btn btn-xs btn-primary" title="editar" >
              <i class="glyphicon glyphicon-pencil"></i>
            </a>&nbsp;
            <a href="<?= site_url('admin/curso/delete/' . $curso->id); ?>" class="btn btn-xs btn-danger" title="eliminar" onclick="javascript:return confirm('Deletar este curso?');">
              <i class="glyphicon glyphicon-trash"></i>
            </a>
          </div>
        </div>
        <!--/Body-->
      </div>
      <!--/Panel-->
    </div>
  <?php endforeach; ?>
</div>

<div class="row">
  <div class="col-md-12 text-center">
    <?= $this->pagination->create_links(); ?>
  </div>
</div>