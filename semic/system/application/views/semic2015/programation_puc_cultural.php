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
<h1 > PROGRAMA��O PUCPR CULTURAL</h1>
<div align="left">
	<p>
		<b>ABERTURA</b>
		<br />
		PARTICIPA��O PERFOM�TICA DO CORAL CHAMPAGNAT DA PUCPR	SOB A REG�NCIA DA MAESTRINA <b>ROSEMERI PAESE</b>
	</p>
	<p>
		<b>Participa��es Especiais:</b> Professores m�sicos <b>Marcelo Mira, Rodrigo Reis, Adriano Akira</b> e <b>Eduardo Scheeren</b>.
		<br />
		<br />
		<b>Local:</b> Audit�rio TUCA - Bloco azul, t�rreo - PUCPR
		<br />
		<ul>
			<li>
				06/10 ter�a-feira - 8h30
			</li>
		</ul>
	</p>
	<br />
	<br />
	<p>
		<b>TRANSCENDENDO NA ESTRELA - CONSTELA��ES SIST�MICAS NA CASA ESTRELA</b>
		<br />
		VIV�NCIA GRUPAL CONDUZIDA PELAS CONSTELADORAS <b>MARUSA HELENNA DA GRA�A</b> E <b>VERA BOEING</b> NA <b>CASA ESTRELA</b>, O LOCAL M�GICO NO MARCO ZERO DO CAMPUS DA PUCPR.
	</p>
	<p align="justify">
		Com o tema <b> "Um Lugar para os Exclu�dos - Somos Todos Um"</b>, a viv�ncia � baseada nos conceitos e na t�cnica de <b>Bert Hellinger</b>, o criador das Constela��es Familiares.
	</p>
	<p align="justify">
		<b>Marusa da Gra�a</b> e <b>Vera Boeing</b> s�o nomes locais de refer�ncia no Brasil em Constela��es Sist�micas.
	</p>
	<p>
		Sess�es com dura��o de 90 minutos.
		<br/>
		<br />
		<b>Local:</b> Casa Estrela - PUCPR
	</p>
	<ul>
		<li>
			06/10 - ter�a-feira  - 14h
		</li>
		<li>
			07/10 - quarta-feira - 9h
		</li>
	</ul>
	<p>
		Inscri��es e retirada de ingressos no Credenciamento (40 vagas por sess�o)
	</p>
	<br />
	<br />
	<p>
		<b>DO ERUDITO AO POPULAR - CONCERTO DA ORQUESTRA DA PUCPR</b>
		<br />
		SOB A REG�NCIA DO MAESTRO PAULO TORRES.
	</p>
	<p align="justify">
		A apresenta��o did�tica vai mostrar os grandes compositores dos per�odos Barroco, Cl�ssico, Rom�ntico e Moderno em ordem cronol�gica.
	</p>
	<p>
		<br />
		<b>Local:</b> Apresenta��o no Audit�rio TUCA - Bloco azul, t�rreo - PUCPR
		<br />
		<ul>
			<li>
				06/10 ter�a-feira - 15h
			</li>
		</ul>
	<p>
		N�o � necess�rio retirar ingresso (lota��o do TUCA: 500 lugares)
	</p>
</div>
<br />
<br />
<p>
	<b>CASA ESTRELA</b>
</p>
<p align="justify">
	A <b><a class="screenshot" rel="<?php echo base_url('img/semic2015/casa_estrela_2.jpg');?>" title="Casa Estrela PUCPR - patrim�nio da Arquitetura local, restaurada e reedificada pela PUCPR">Casa Estrela</a></b>, patrim�nio da Arquitetura local, restaurada e reedificada pela PUCPR, �nica no mundo por sua peculiaridade na inten��o da forma, foi constru�da manualmente em madeira por Augusto Gon�alves de Castro (perito contador) e sua esposa Dion�zia Azulay no in�cio da d�cada de 30. A fam�lia Castro era Esperantista, Teosofista e adepta da Fraternidade Universal.
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