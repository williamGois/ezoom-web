<section id="galeria">
  <div class="row">
    <div class="col-sm-6">
      <h1>Cursos</h1>
      <p class="lead"></p>
    </div>

    <div class="col-sm-6">
      <p class="btn-group pull-right">
        <a href="<?= base_url("admin/"); ?>" class="btn btn-default">
          <i class="glyphicon glyphicon-home"></i> Administração
        </a>
      </p>
    </div>
  </div>

  <div class="row">
    <?php foreach ($cursos as $curso) : ?>
      <div class="col-sm-4 galeria-item">
        <!--Panel-->
        <div class="panel galeria-link">
          <!--Image-->
          <div class="img">
            <a href="<?= base_url('show/' . $curso->id); ?>" class="fancybox-effects-a" data-fancybox-group="gallery" title="<?= $curso->titulo; ?>">
              <img src="<?= base_url('upload/tumb/' . $curso->imagem); ?>" class="img-responsive galeria-img" />
            </a>
          </div>
          <!--/Image-->
          <!--Body-->
          <div class="panel-body">
            <a href="<?= base_url('show/' . $curso->id); ?>">
              <h5 class="text-center">
                <strong><?= $curso->titulo; ?></strong>
              </h5>
            </a>
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

</section>