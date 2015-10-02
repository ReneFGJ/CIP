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
<h1 > PUCPR CULTURAL PROGRAM </h1>
<div align="left">
	<p>
	<b>OPENING</b>
		<br />
		Performative participation of Champagnat Choir of PUCPR	under the regency of Conductor <b>ROSEMERI PAESE</b>
	</p>
	<p>
		<b>Special Participation:</b> Teachers and mausicians <b>Marcelo Mira, Rodrigo Reis, Adriano Akira</b> e <b>Eduardo Scheeren</b>.
		<br />
		<br />
		<b>Local:</b> Theatre TUCA - blue block, downstairs - PUCPR
		<br />
		<ul>
			<li>
				October, 6th - Tuesday - 8h30 
			</li>
		</ul>
	</p>
	<br />
	<br />
	<p>
		<b>TRANSCENDING THE STAR - SYSTEMIC CONSTELLATIONS AT "CASA ESTRELA"</b>
		<br />
		Group experience led by <b>MARUSA HELENNA DA GRAÇA</b> and <b>VERA BOEING</b> in the  <b>"Casa Estrela"</b>(Star house), the magical place at ground zero of PUCPR campus.
	</p>
	<p align="justify">
		With the theme <b> "A Place to the excluded - We Are All One"</b>,  the Experience is based on the concepts and techniques of<b>Bert Hellinger</b>, the creator of Family Constellations.
	</p>
	<p align="justify">
		<b>Marusa da Graça</b> and <b>Vera Boeing</b> are reference local names in Brazil in Systemic Constellations.
	</p>
	<p>
		Sessions (lasting 90 minutes)
		<br/>
		<br />
		<b>Local:</b> Casa Estrela - PUCPR
	</p>
	<ul>
		<li>
			October 6th  - Tuesday ? 2pm
		</li>
		<li>
			October 7th  - Wednesday - 9am
		</li>
	</ul>
	<p>
		Registration and withdrawal of tickets (40 seats per session)
	</p>
	<br />
	<br />
	<p>
		<b>DO ERUDITO AO POPULAR - CONCERTO DA ORQUESTRA DA PUCPR</b>
		<br />
		under the direction of MAESTRO PAULO TORRES.
	</p>
	<p align="justify">
		The didactic presentation will show the development throughout history of a large symphony orchestra and the great composers of Baroque period, Classical, Romantic and Modern chronologically.
	</p>
	<p>
		<br />
		<b>Local:</b> Presentation at TUCA- PUCPR´s Theatre
		<br />
		<ul>
			<li>
				October 6th  - Tuesday – 3pm
			</li>
		</ul>
	<p>
		It is not necessary to withdraw tickets (capacity of TUCA: 500 seats)
	</p>
</div>
<br />
<br />
<p>
	<b>CASA ESTRELA</b>
</p>
<p align="justify">
	The <b><a class="screenshot" rel="<?php echo base_url('img/semic2015/casa_estrela_2.jpg');?>" title="Casa Estrela PUCPR - Heritage of local architecture, restored and rebuilt by PUCPR, ">Casa Estrela</a></b>, heritage of local architecture, restored and rebuilt by PUCPR, unique in the world for its uniqueness in the intention of form, was manually built in wood by Augusto Gonçalves de Castro (counter expert) and his wife Dionízia Azulay in the early 30´s. The Castro family was Esperanto expert, Theosophist and supporter of Universal Brotherhood.
</p>
<div >
	<table width="1024" align="center">
		<tr>
			<td >
			<br />
			<img src="<?php echo base_url('img/semic2015/casa_estrela_1.png');?>" style="height:300; border=1px; solid;  border-radius:10px; border-color:#84847F;"></td>
		</tr>
		<tr>
			<td class="lt01" align="left"><h5>Front and inside the Casa Estrela</h5></td>
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
	^ Back to the top
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