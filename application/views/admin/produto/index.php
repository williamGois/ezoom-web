<div class="row">
  <div class="col-sm-6">
    <h1>91 seguros </h1>
    <p class="lead">Produtos</p>
  </div>

  <div class="col-sm-6">
    <p class="text-right">
      <a href="<?= site_url('admin/produto/form'); ?>" class="btn btn-default">
        <i class="glyphicon glyphicon-save"></i> Adicionar Produto
      </a>
    </p>
  </div>
</div>

<div class="row">
  <?php foreach ($produtos as $produto): ?>
    <div class="col-sm-4 galeria-item">
      <!--Pnel-->
      <div class="panel galeria-link">
        
        <!--Image-->
        <div class="img">
          <a href="<?= base_url('admin/produto/form/' . $produto->id); ?>" class="fancybox-effects-a" data-fancybox-group="gallery" title="<?= $produto->titulo; ?>">
            <img src="<?= base_url('upload/tumb/'.$produto->imagem); ?>" class="img-responsive galeria-img" />
          </a>
        </div>
        <!--/Image-->

        <!--Body-->
        <div class="panel-body">
          <h1 style="font-size: 21px; text-align:center; font-weight: bold;"><?= $produto->titulo; ?></h1>

          <div class="text-right">
            <a href="<?= site_url('admin/produto/form/' . $produto->id); ?>" class="btn btn-xs btn-primary" title="editar" >
              <i class="glyphicon glyphicon-pencil"></i>
            </a>&nbsp;
            <a href="<?= site_url('admin/produto/delete/' . $produto->id); ?>" class="btn btn-xs btn-danger" title="eliminar" onclick="javascript:return confirm('Deletar este produto?');">
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