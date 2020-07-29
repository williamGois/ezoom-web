	
  </div><!-- /container -->
	
  <footer>
  	<div class="container">
	  <div class="row">
	    <div class="col-md-12 text-center">
		  <p>William *.* <?php echo date("Y"); ?> </p>
	    </div>
	  </div>
  	</div>
  </footer>

  <!-- JQuery 
  ================================================== -->
  <script src="<?= base_url("assets/jquery/jquery-1.11.3.min.js") ?>"></script>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <script src="<?= base_url("assets/bootstrap/js/bootstrap.min.js") ?>"></script>
    
  <!-- Fancybox 
  ================================================== -->
  <script src="<?= base_url("assets/fancybox/source/jquery.fancybox.js?v=2.1.5") ?>"></script>
  <?= link_tag('assets/fancybox/source/jquery.fancybox.css?v=2.1.5') ?>

  <script type="text/javascript">
	  $(document).ready(function() {

	    $('.fancybox').fancybox();

	    $(".fancybox-effects-a").fancybox({
		  helpers: {
		    title : {
			  type : 'outside'
		    },
		    overlay : {
		      speedOut : 0
		    }
		  }
	    });
	  });
  </script>

</body>
</html>