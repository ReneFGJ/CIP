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

        <div class="page-header">
          <h1>Indicadores <i>Ciência sem Fronteiras</i> administrado pela PUCPR.</h1>
        </div>
        <div class="indicadores-paragrafo">
          <p>Painel de indicadores do programa <i>Ciência sem Fronteiras</i> com relatórios de estudantes, instituições, países e cursos.</p>
        </div>

		<!--Botões-->
        <div class="botoes-indicadores">
          <!--Mada mundo-->	
          <a href="pagina-mapa.php">
            <div class="botao-1">
              <span><i class="fa fa-map-marker"></i> Mapa dos bolsistas CsF</span>
            </div>
          </a>
		  <!--Texto-->	
          <a href="pagina-grafico.php"> 
            <div class="botao-1">
              <span>Bolsas por país</span>
            </div>
          </a>
          <!--Texto-->
          <a href="pagina-grafico-1.php">
            <div class="botao-2">
              <span>Bolsas por curso</span>
            </div>
          </a>
		  <!--Texto-->	
          <a href="pagina-grafico-2.php">
            <div class="botao-3">
              <span>Bolsas por curso e instituição</span>
            </div>
          </a>
		  <!--Texto-->	
          <a href="pagina-grafico-3.php">
            <div class="botao-4">
              <span>Bolsas por titulação</span>
            </div>
          </a>
          <!--Texto-->        
          <a href="pagina-grafico-4.php">
            <div class="botao-5">
              <span>Bolsas por gênero </span>
            </div>
          </a>
		  
		  <!--
          <a href="pagina-grafico-5.php">
            <div class="botao-6">
              <span>Perfil dos estudantes de Intercâmbio</span>
            </div>
          </a>
		  -->	
        </div>

    <div class="clear"></div>
    
      <!-- FOOTER -->
      <?php
        require('componentes/footer.php');
      ?>

    </div><!-- /.container -->

    </div>
  </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/vendor/holder.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>


  