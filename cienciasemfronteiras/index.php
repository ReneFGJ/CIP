<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ciências sem Fronteiras</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/caroussel.css" rel="stylesheet">
    <link href="css/font-stylesheet.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>

    <?php
        require('componentes/headerpuc.php');
    ?>


    <div class="navbar-wrapper">
      <div class="container">

        <?php
        require('componentes/nav.php');
        ?>

      </div>
    </div>


 

 

      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette"  data-sr="enter bottom, hustle 10px">
        <div class="col-md-7">
          <h2 class="featurette-heading">Alunos aprovam 100% o Ciência sem Fronteiras<span class="text-muted"></span></h2>
          <p class="lead">100% dos alunos responderam que fariam o intercâmbio novamente. Ainda está com dúvidas que o Ciência sem Fronteiras é uma ótima oportunidade para sua carreira? Veja o <a href="depoimentos.php">depoimento dos alunos</a>.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="img/thumbsup-icone.png" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">
		
	  <!--	
      <div class="row featurette"  data-sr="enter bottom, hustle 10px">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">Alunos aprovam 100% o Ciência sem Fronteiras<span class="text-muted"></span></h2>
          <p class="lead">100% dos alunos responderam que fariam o intercâmbio novamente. Ainda está com dúvidas que o Ciência sem Fronteiras é uma ótima oportunidade para sua carreira? Veja o <a href="depoimentos.php">depoimento dos alunos</a>.</p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" src="img/thumbsup-icone.png" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette"  data-sr="enter bottom, hustle 10px">
        <div class="col-md-7">
          <h2 class="featurette-heading">Alunos aprovam 100% o Ciência sem Fronteiras<span class="text-muted"></span></h2>
          <p class="lead">100% dos alunos responderam que fariam o intercâmbio novamente. Ainda está com dúvidas que o Ciência sem Fronteiras é uma ótima oportunidade para sua carreira? Veja o <a href="depoimentos.php">depoimento dos alunos</a>.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="img/thumbsup-icone.png" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">
-->

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
        <?php
        require('componentes/footer.php');
        ?>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/vendor/holder.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <script src='js/scrollReveal.min.js'></script>
    <script>

      window.sr = new scrollReveal();
    </script>


  </body>
</html>