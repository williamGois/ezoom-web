<section id="galeria">

  <div class="row">
    <div class="col-md-12">
      <p class="btn-group pull-right">
        <a href="<?= base_url(); ?>" class="btn btn-default">
          <i class="glyphicon glyphicon-home"></i> Inicio
        </a>
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel">

        <div class="img">
          <a title="<?= $curso->titulo; ?>">
            <img src="<?= base_url('upload/' . $curso->imagem); ?>" class="img-responsive" style="margin: 0 auto; width: 100%;" />
          </a>
        </div>

        <div class="panel-body text-center">
          <h1><?= $curso->titulo; ?></h1>

          <hr>

          <p><?= $curso->descricao; ?>.</p>

          <br>

          <br><br>

          <?php if (!is_null($curso_imagens)) : ?>
            <?php foreach ($curso_imagens as $img) : ?>
              <div class="col-md-4" style="margin-bottom: 2%;">
                <img src="<?= base_url('upload/tumb/' . $img->imagem); ?>" class="img-responsive" />
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>

      </div>
    </div>
  </div>

</section>