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
          <a title="<?= $produto->titulo; ?>">
            <img src="<?= base_url('upload/' . $produto->imagem); ?>" class="img-responsive" style="margin: 0 auto; width: 100%;" />
          </a>
        </div>

        <div class="panel-body text-center">
          <h1><?= $produto->titulo; ?></h1>

          <hr>

          <p><?= $produto->descricao; ?>.</p>

          <br>

          <br><br>

          <?php if (!is_null($produto_imagens)) : ?>
            <?php foreach ($produto_imagens as $img) : ?>
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