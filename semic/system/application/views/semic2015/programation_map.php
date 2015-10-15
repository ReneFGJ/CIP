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
		<h3> &nbsp;&nbsp; Administração, auditórios, salas de vídeo e anfiteatro </h3>
		<ul>
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_adm.png');?>" title="Prédio Administrativo - Sala Aleijadinho - Térreo">Administração</a>
			</li>				
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Anfiteatro Brasílio Vicente de Castro - CCBS - Bloco Verde - Térreo">Anfiteatro Brasílio Vicente de Castro</a>
			</li>			
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde_2A.png');?>" title="Auditório Carlos Chagas - CCBS - Bloco Verde - 2º andar">Auditório Carlos Chagas</a>
			</li>			
				<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Auditório Carlos Costa - CCBS - Bloco Verde - Térreo">Auditório Carlos Costa</a>
			</li>		
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Auditório Gregor Mendel - CCBS - Bloco Verde - Térreo">Auditório Gregor Mendel</a>
			</li>
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde_2A.png');?>" title="Auditório Madre Léonie - CCBS - Bloco Verde - 2º andar">Auditório Madre Léonie</a>
			</li>		
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Auditório Mario de Abreu - CCBS - Bloco Verde - Térreo">Auditório Mario de Abreu</a>
			</li>			
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/casa_estrela.png');?>" title="Casa Estrela PUCPR - Em frente as quadras poliesportivas">Casa Estrela</a>
			</li>
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Sala de vídeo I - CCBS - Bloco Verde - Térreo">Sala de vídeo I</a>
			</li>
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_verde.png');?>" title="Sala de vídeo II - CCBS - Bloco Verde - Térreo">Sala de vídeo II</a>
			</li>	
			<li>
				<a class="screenshot" rel="<?php echo base_url('img/semic2015/mapa_azul.png');?>" title="Teatro TUCA - CCET - Bloco Azul - Térreo">TUCA</a>
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
