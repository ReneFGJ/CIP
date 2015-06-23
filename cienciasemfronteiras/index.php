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


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="img/photo-99.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Somos 322 alunos CsF PUCPR pelo mundo.</h1>
              <p>Saiba mais sobre os nossos bolsistas.</p>
              <p><a class="btn btn-lg btn-primary botao-home" href="http://www2.pucpr.br/reol/cienciasemfronteiras/indicadores.php" role="button">Ver indicadores</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="img/photo-55.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Depoimento dos intercâmbistas CsF da PUCPR.</h1>
              <p>Veja o que os estudantes da PUCPR estão falando sobre o <i>Ciência sem Fronteiras</i>.</p>
              <p><a class="btn btn-lg btn-primary botao-home" href="http://www2.pucpr.br/reol/cienciasemfronteiras/depoimentos.php" role="button">Ver detalhes</a></p>
            </div>
          </div>
        </div>
        <!-- <div class="item">
          <img class="third-slide" src="img/photo-3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div> -->
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"><i class="fa fa-chevron-left"></i></span>
        <!-- <span class="sr-only">Anterior</span> -->
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"><i class="fa fa-chevron-right"></i></span>
        <!-- <span class="sr-only">Próximo</span> -->
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <a href="indicadores.php"><img class="img-circle" src="img/graficos-icone.png" alt="Generic placeholder image" width="140" height="140"></a>
          <h2><a href="indicadores.php" style="text-decoration: none; color: #b21120;">Indicadores CsF PUCPR</a></h2>
          <p><a href="indicadores.php" style="color: #5a5a5a; text-decoration: none;">Resultados do <i>Ciência sem Fronteiras</i> na PUCPR desde 2012.</a></p>
          <p><a class="btn btn-default btn-indicadores" href="indicadores.php" role="button">Ver detalhes &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 depoimento-div">
          <a href="depoimentos.php"><img class="img-circle" src="img/depoimentos-icone.png" alt="Generic placeholder image" width="140" height="140"></a>
          <h2><a href="depoimentos.php" style="text-decoration: none; color: #39aebf;">Depoimentos</a></h2>
          <p><a href="depoimentos.php" style="text-decoration: none; color: #5a5a5a;">Saiba como foi a experiência dos alunos PUCPR que já foram para o intercâmbio <i>Ciência sem Fronteiras.</i></a></p>
          <p><a class="btn btn-default btn-depoimentos" href="depoimentos.php" role="button">Ver detalhes &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 duvidas-div">
          <a href="perguntas-frequentes.php"><img class="img-circle" src="img/duvidas-icone.png" alt="Generic placeholder image" width="140" height="140"></a>
          <h2><a href="perguntas-frequentes.php" style="text-decoration: none; color: #35a433;">Dúvidas?</a></h2>
          <p><a href="perguntas-frequentes.php" style="text-decoration: none; color: #5a5a5a;">Acesse a nossa sessão de Perguntas Frequentes e tire suas dúvidas.</a></p>
          <p><a class="btn btn-default btn-duvidas" href="perguntas-frequentes.php" role="button">Ver detalhes &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


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