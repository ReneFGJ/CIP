<?php
require("cab.php");
?>


<div id="page09" class="page_min pg09">
	<img src="img/logo.png" height="150" style="width: 180px; height: auto; float: left;" />
	<span class="breadcrumb2"><a href="index.php">Início</a> > <a href="programacao.php">Programação</a></span>
	<h1>Sumário Geral</h1>
	<div class="programacao-total2">
		<div class="nuvem-tags">
		<P>Para visualizar todos os trabalhos clique <A HREF="sumario-geral.php#show">aqui</A>!</P>
		</div>
	</div>
	<h1>Apresentações por área <!--- 04/11--></h1>
	<!--<div class="caixa-nav-data">
		<h2 class="data-prox"><a href="">05/11 ></a></h2>
	</div>-->
	<div class="programacao-total2">
		<div class="nuvem-tags">
			<p>Procure os trabalhos pela área:</p>
			<ul>
				<? require("sumario_areas.php"); ?>
			</ul>
		</div>
	
		<div class="lista-trabalhos">
			<div id="medicina">			
				<a name="show"></a>
				<table class="apresentacoes-por-area" width="902" align="center">
					<?php
						$file = $dd[0];
						$file = "sumario_".$file.".php";
						
						if (file_exists($file))
							{
								require($file);
							}
					?>
					

				</table>

			</div>	
				

			</div>
		</div>
		</div>
<?php
require("foot.php");
?>