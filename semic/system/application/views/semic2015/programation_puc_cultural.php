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
<!--Bloco Programacao cultural   -->
<h1 > PROGRAMAÇÃO PUCPR CULTURAL</h1>
<div align="left">
	<p>
		<b>ABERTURA</b>
		<br />
		PARTICIPAÇÃO PERFOMÁTICA DO CORAL CHAMPAGNAT DA PUCPR	SOB A REGÊNCIA DA MAESTRINA <b>ROSEMERI PAESE</b>
	</p>
	<p>
		<b>Participações Especiais:</b> Professores músicos <b>Marcelo Mira, Rodrigo Reis, Adriano Akira</b> e <b>Eduardo Scheeren</b>.
		<br />
		<br />
		<b>Local:</b> Auditório TUCA - Bloco azul, térreo - PUCPR
		<br />
		<ul>
			<li>
				06/10 terça-feira - 8h30
			</li>
		</ul>
	</p>
	<br />
	<br />
	<p>
		<b>TRANSCENDENDO NA ESTRELA - CONSTELAÇÕES SISTÊMICAS NA CASA ESTRELA</b>
		<br />
		VIVÊNCIA GRUPAL CONDUZIDA PELAS CONSTELADORAS <b>MARUSA HELENNA DA GRAÇA</b> E <b>VERA BOEING</b> NA <b>CASA ESTRELA</b>, O LOCAL MÁGICO NO MARCO ZERO DO CAMPUS DA PUCPR.
	</p>
	<p align="justify">
		Com o tema <b> "Um Lugar para os Excluídos - Somos Todos Um"</b>, a vivência é baseada nos conceitos e na técnica de <b>Bert Hellinger</b>, o criador das Constelações Familiares.
	</p>
	<p align="justify">
		<b>Marusa da Graça</b> e <b>Vera Boeing</b> são nomes locais de referência no Brasil em Constelações Sistêmicas.
	</p>
	<p>
		Sessões com duração de 90 minutos.
		<br/>
		<br />
		<b>Local:</b> Casa Estrela - PUCPR
	</p>
	<ul>
		<li>
			06/10 - terça-feira  - 14h
		</li>
		<li>
			07/10 - quarta-feira - 9h
		</li>
	</ul>
	<p>
		Inscrições e retirada de ingressos no Credenciamento (40 vagas por sessão)
	</p>
	<br />
	<br />
	<p>
		<b>DO ERUDITO AO POPULAR - CONCERTO DA ORQUESTRA DA PUCPR</b>
		<br />
		SOB A REGÊNCIA DO MAESTRO PAULO TORRES.
	</p>
	<p align="justify">
		A apresentação didática vai mostrar os grandes compositores dos períodos Barroco, Clássico, Romântico e Moderno em ordem cronológica.
	</p>
	<p>
		<br />
		<b>Local:</b> Apresentação no Auditório TUCA - Bloco azul, térreo - PUCPR
		<br />
		<ul>
			<li>
				06/10 terça-feira - 15h
			</li>
		</ul>
	<p>
		Não é necessário retirar ingresso (lotação do TUCA: 500 lugares)
	</p>
</div>
<br />
<br />
<p>
	<b>CASA ESTRELA</b>
</p>
<p align="justify">
	A <b><a class="screenshot" rel="<?php echo base_url('img/semic2015/casa_estrela_2.jpg');?>" title="Casa Estrela PUCPR - patrimônio da Arquitetura local, restaurada e reedificada pela PUCPR">Casa Estrela</a></b>, patrimônio da Arquitetura local, restaurada e reedificada pela PUCPR, única no mundo por sua peculiaridade na intenção da forma, foi construída manualmente em madeira por Augusto Gonçalves de Castro (perito contador) e sua esposa Dionízia Azulay no início da década de 30. A família Castro era Esperantista, Teosofista e adepta da Fraternidade Universal.
</p>
<div >
	<table width="1024" align="center">
		<tr>
			<td >
			<br />
			<img src="<?php echo base_url('img/semic2015/casa_estrela_1.png');?>" style="height:300; border=1px; solid;  border-radius:10px; border-color:#84847F;"></td>
		</tr>
		<tr>
			<td class="lt01" align="left"><h5>Vista frontal e interior da Casa Estrela</h5></td>
		</tr>
	</table>
</div>


<br />
<br />



</div>
<br />
<hr size="5" width="100%" align="left" noshade>
<hr size="8" width="100%" align="left" noshade>
</div>

<div id="toTop" style="display: none;">
	^ Voltar ao topo
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