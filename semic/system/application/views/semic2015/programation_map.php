<script src="jquery.js" type="text/javascript"></script>
<script src="main.js" type="text/javascript"></script>
<style>
	#screenshot {
		position: absolute;
		border: 2px solid #ccc;
		background: #333;
		padding: 5px;
		display: none;
		color: #fff;
		height: auto;
		border-radius: 10px;
	}
</style>
<h1><span> Locais importantes</span></h1>
<div class="estilo_data4_1 celula-tabela-horario">
	<p>
		<h3> &nbsp;&nbsp; Administra��o, audit�rios, salas de v�deo e anfiteatro </h3>
		<ul>
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_adm.png');?>" title="Pr�dio Administrativo - Sala Aleijadinho - T�rreo">Administra��o</a>
			</li>				
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Anfiteatro Bras�lio Vicente de Castro - CCBS - Bloco Verde - T�rreo">Anfiteatro Bras�lio Vicente de Castro</a>
			</li>			
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde_2A.png');?>" title="Audit�rio Carlos Chagas - CCBS - Bloco Verde - 2� andar">Audit�rio Carlos Chagas</a>
			</li>			
				<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Audit�rio Carlos Costa - CCBS - Bloco Verde - T�rreo">Audit�rio Carlos Costa</a>
			</li>		
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Audit�rio Gregor Mendel - CCBS - Bloco Verde - T�rreo">Audit�rio Gregor Mendel</a>
			</li>
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde_2A.png');?>" title="Audit�rio Madre L�onie - CCBS - Bloco Verde - 2� andar">Audit�rio Madre L�onie</a>
			</li>		
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Audit�rio Mario de Abreu - CCBS - Bloco Verde - T�rreo">Audit�rio Mario de Abreu</a>
			</li>			
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/casa_estrela.png');?>" title="Casa Estrela PUCPR - Em frente as quadras poliesportivas">Casa Estrela</a>
			</li>
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Sala de v�deo I - CCBS - Bloco Verde - T�rreo">Sala de v�deo I</a>
			</li>
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Sala de v�deo II - CCBS - Bloco Verde - T�rreo">Sala de v�deo II</a>
			</li>	
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_azul.png');?>" title="Teatro TUCA - CCET - Bloco Azul - T�rreo">TUCA</a>
			</li>	
		</ul>
	</p>
	<hr size="5" width="100%" align="left" noshade>
	<hr size="8" width="100%" align="left" noshade>
</div>

<!-- Tooltipi do mapa  -->
<script type="text/javascript" src="./Simple Tooltips w  CSS & jQuery   Tutorial by Soh Tanaka_files/jquery.min.js"></script>
<script type="text/javascript">
	this.screenshotPreview = function() {
		/* CONFIG */
		xOffset = 10;
		yOffset = 30;
		/* END CONFIG */
		$("a.screenshot").hover(function(e) {
			this.t = this.title;
			this.title = "";
			var c = (this.t != "") ? "<br/>" + this.t : "";
			$("body").append("<p id='screenshot'><img src='" + this.rel + "' alt='url preview' />" + c + "</p>");
			$("#screenshot").css("top", (e.pageY - xOffset) + "px").css("left", (e.pageX + yOffset) + "px").fadeIn("fast");
		}, function() {
			this.title = this.t;
			$("#screenshot").remove();
		});
		$("a.screenshot").mousemove(function(e) {
			$("#screenshot").css("top", (e.pageY - xOffset) + "px").css("left", (e.pageX + yOffset) + "px");
		});
	};
</script>

<script type="text/javascript">
	// starting the script on page load
	$(document).ready(function() {
		screenshotPreview();
	});
</script>
