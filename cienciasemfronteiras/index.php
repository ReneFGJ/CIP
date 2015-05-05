<?php
header('Content-Type: text/html; charset=utf-8');
$name="CiÃªncia sem Fronteiras PUCPR";
$content = "ciÃªncia sem fronteias, ciÃªncia, fronteiras, intercÃ¢mbio, estudos, pesquisa, pucpr";

$include = '../';
require("../db.php");
require('../_class/_class_csf.php');
$csf = new csf;
?>
<!DOCTYPE html>
<html>
    <head>
    	<title>CiÃªncia sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="<?php echo $name;?>" content="<?php echo $content;?>">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div  align="center">
			<h3>Estamos trabalhando juntos na construção da página!</h3>
					<img src="img/pg_construtions.jpg">
   			 </div><!-- /.container -->
				
				
				
				</div><!--fecha div total-->
				
				
				
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>