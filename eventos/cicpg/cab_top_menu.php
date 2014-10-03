

<?
$menui = array();
switch ($LANG)
	{
	case 'en':
		break;
	default:
		array_push($menui,'Menu Principal');
		array_push($menui,'Apresentação');
		array_push($menui,'Submissão de trabalhos');
		break;
	}
?>
<div id="logo_pucpr"></div>
<ul id="gn-menu" class="gn-menu-main"> 
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller"> 
							<ul class="gn-menu">
								<li> <a href="index.php"><i class="fa fa-home"></i> Início</a></li>
								<li> <a href="apresentacao.php"><i class="fa fa-comment"></i> Apresentação</a></li>
								<li> <a href="programacao.php"><i class="fa fa-clock-o"></i> Programação</a></li>
								<li> <a href="submissao-de-trabalhos.php"><i class="fa fa-file"></i> Submissão de trabalhos</a></li>
								<li> <a href="comissoes.php"><i class="fa fa-users"></i> Comissão Organizadora</a></li>
								<li> <a href="instituicoesparticipantes.php"><i class="fa fa-university"></i> Instituições Participantes</a></li>
								<li> <a href="mapas.php"><i class="fa fa-map-marker"></i>  Localização e Hospedagem</a></li>
								<li> <a href="materiais-para-divulgacao.php"><i class="fa fa-thumbs-up"></i> Materiais para divulgação</a></li>
								<li> <a href="perguntas-frequentes.php"><i class="fa fa-question-circle"></i> Perguntas Frequentes</a></li>
								<li> <a href="politicas-de-adesao.php"><i class="fa fa-check-square-o"></i> Políticas de Adesão</a></li>
								<li> <a href="sobre-curitiba.php"><i class="fa fa-bus"></i> Sobre Curitiba</a></li><li> <a href="galeria-de-homenageados.php"><i class="fa fa-star"></i> Galeria de Homenageados</a></li>
								<li> <a href="contato.php"><i class="fa fa-envelope"></i></i> Contato</a></li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li> 
				
				<li class="submissao-botao"><a href="submissao-de-trabalhos.php">Submissão de trabalhos</a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="calendario.php"><span>Prazos</span></a></li>
				<li><a class="codrops-icon codrops-icon-drop" href=""><span></span></a></li>

			</ul>
<!--<nav id="menu">
	<div id="hamburger-helper">
		<div>
			<div id="ham1" class="barra"></div>
			<div id="ham2" class="barra"></div>
			<div id="ham3" class="barra"></div>
		</div>
	</div>
	<ul>
		<li>
			&nbsp;
		</li>
		<li>

		</li>
		<li><IMG SRC="img/icone_16.png" height="28">
		</li>
		<li>
			<a href="index.php#page00" class="menu_top">INICIAL</a>
		<li>
			<a href="index.php#page01" class="menu_top">MENU</a>
		<li>
			<a href="index.php#page03" class="menu_top"><?php echo UpperCase($menui[2]);?></a>
		<li>
			<a href="index.php#page05" class="menu_top">PRAZOS</a>
		<li>
			<a href="index.php#page12" class="menu_top">FAQ</a>
						
	</ul>
	<div id="menus" class="menu_left menu_lateral">
	    	<div class="mobile-menu">
	    		<UL>
	    		<LI><a href="index.php#page01" class="y-out">Menu Principal</a></LI>
	    		<LI><a href="index.php#page02" class="y-out">Apresentação</a></LI>
	    		<LI><a href="index.php#page03" class="y-out"><?php echo $menui[2];?></a></LI>
	    		<LI><a href="index.php#page04" class="y-out">Instruções para Autores</a></LI>
	    		<LI><a href="index.php#page05" class="y-out">Datas Importantes</a></LI>
	    		<LI><a href="index.php#page06" class="y-out">Contato / Contact</a></LI>
	    		<LI><a href="index.php#page03" class="y-out">Comissão Organizadora</a></LI>
	    		</UL>
	    	</div>
	</div>	
</nav>-->


<script>
	$("#hamburger-helper").click(function() {
		$("#ham1").toggleClass('barra_first');
		$("#ham2").toggleClass('barra_middle');
		$("#ham3").toggleClass('barra_last');
		$("#ham3").animate('barra_last');
		$("#menus").animate({
			opacity : 1,
			top : "50",
			height : "toggle"
		}, 500, function() {/* Animation complete. */
		});
	});

</script> 