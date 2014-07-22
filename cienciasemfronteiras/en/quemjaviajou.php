<?php
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteiras, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Who is in exchange? - Science without Borders | PUCPR</title>
        <meta charset="utf-8">
		<meta name="<?php echo $name;?>" content="<?php echo $content;?>">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>Who is in<span class="lt6light"> exchange?</span></h1>
				  <p class="lt4">Do you want to find out who are and where are the student from PUCPR in the
				  	 <strong>Science without Borders</strong>?</p>

				  	 <div id="graficos">
				  	<img src="img/teste-imagem-grafico.jpg" />
				  </div>
				  <!--<div id="espaco-branco">
				  		
				  </div>-->
				  
				   
				  <!--
				  <div id="filtro-alunos">
				  	
				  	<p>Busque alunos por filtro:</p>
				  	
				  	<span class="lt3">Continente</span><select>
					  <option value="todos">Todos</option>
					  <option value="americasul">América</option>
					  <option value="asia">Ásia</option>
					  <option value="europa">Europa</option>
					  <option value="oceania">Oceania</option>
					</select>
					
					<span class="lt3">Áreas de Interesse:</span><select>
					  
					  
					  <option value="todas">Todas</option>
					  <option value="engineering">Engeneering and Technological field</option>
					  <option value="exatasterra">Exact and Earth Sciences</option>
					  <option value="biologyhealth">Biology, Biomedical and Health</option>
					  <option value="computertechnology">Computer and Information Technology</option>
					  <option value="aerospacial">Aerospacial Technology</option>
					  <option value="pharmacy">Pharmacy</option>
					  <option value="sustainableproduction">Sustainable Agricultural Production</option>
					  <option value="oil">Oil, Gas and Mineral Coal</option>
					  <option value="renewableenergies">Renewable Energies</option>
					  <option value="mineraltechnologies">Mineral Technologies</option>
					  <option value="biotechnology">Biotechnology</option>
					  <option value="nanotechnology">Nanotechnology and New Materials</option>
					  <option value="naturaldisasters">Natural Disasters Prevention and Mitigation Technology</option>
					  <option value="biodiversity">Biodiversity and Bioprospection</option>
					  <option value="seasciences">Sea Sciences</option>
					  <option value="creativeindustry">Creative Industry</option>
					  <option value="newtechnologiesengineering">New Technologies in Building Engineering</option>
					  <option value="technicalformation">Technical formation</option>
					  
					  
					</select>
					
					<!-<span class="lt3">Por Universidade:</span><select>
					  <option value="concordiauni">Concordia University</option>
					  <option value="faculdadeengenhariaporto">Faculdade de Engenharia da Universidade do Porto</option>
					  <option value="unigottingen">Georg August Universität Göttingen</option>
					  <option value="institutelyon">Institut National des Sciences Appliquées de Lyon</option>
					  <option value="institutosuperiortecnico">Instituto Superior Técnico</option>
					  <option value="northcarolina">North Carolina State University</option>
					  <option value="polimilano">Politecnico di Milano</option>
					  <option value="Kaiserslautern">Technische Univertitat Kaiserslautern</option>
					  <option value="unimadrid">Universidad Politécnica de Madrid</option>
					  <option value="unicoimbra">Universidade de Coimbra</option>
					  <option value="unievora">Universidade de Évora</option>
					  <option value="unilisboa">Universidade de Lisboa</option>
					  <option value="uniporto">Universidade de Porto</option>
					  <option value="uniminho">Universidade do Minho</option>
					  <option value="unitecbelfort">Universidade Técnologica de Belfort</option>
					  <option value="unicatalunya">Universitat Politecnica de Catalunya</option>
					  <option value="univalencia">Universitat Politècnica de València</option>
					  <option value="unilouvain">Université Catholique de Louvain</option>
					  <option value="unilille">Université Lille</option>
					  <option value="unierasmus">University Erasmus</option>
					  <option value="unileuven">University Leuven</option>
					  <option value="unicalifornia">University of California</option>
					  <option value="unidundee">University of Dundee</option>
					  <option value="uniflorida">University of Florida</option>
					  <option value="unihongkong">University of Hong Kong</option>
					  <option value="unimanitoba">University of Manitoba</option>
					  <option value="unioulu">University of Oulu</option>
					  <option value="uniqueensland">University of Queensland</option>
					  <option value="unitoronto">University of Toronto</option>
					  <option value="uniwestern">University of Western</option>
					  <option value="unipolykwantlen">University Polytechnic Kwantlen</option>
					  <option value="unimichigan">University Western Michigan</option>
					</select>-->
					<!--
					<a href="#" class="botao-buscar">Buscar</a>
					
					
				  </div>--> <!-- fecha div filtro alunos -->
				  
				   <table id="tabela-alunos-viajaram">
				 		<tr class="lt3">
				 			<td class="lt5">STUDENTS</td>
				 			<td class="lt5">COURSE</td>
				 			<td class="lt5">COUNTRY</td>
				 			<td class="lt5">UNIVERSITY</td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Alex dos Santos Xavier</td>
				 			<td>Computation Engineering</td>
				 			<td>Spain</td>
				 			<td><a href="http://www.upc.edu/">Universitat Politecnica de Catalunya</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Aline de Fátima Lapchenks</td>
				 			<td>Architecture and Urbanism</td>
				 			<td>France</td>
				 			<td><a href="http://www.univ-lille1.fr/">Université Lille</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Allan Adley Fagundes Amorim</td>
				 			<td>Production Engineering</td>
				 			<td>United States</td>
				 			<td><a href="http://www.ncsu.edu/">North Carolina State University</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Amanda Barros de Assis</td>
				 			<td>Publicity and Advertisement</td>
				 			<td>Canada</td>
				 			<td><a href="http://www.kwantlen.ca/">Kwantlen Polytechnic University</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Amanda Oliveira Voltolini</td>
				 			<td>Production Engineering</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.ist.utl.pt/">Instituto Superior Técnico</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ana Carolina Mastriani Arantes</td>
				 			<td>Odontology</td>
				 			<td>Belgium</td>
				 			<td><a href="http://www.uclouvain.be/">Université Catholique de Louvain</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ana Claudia Emerenciano Guedes</td>
				 			<td>Civil Engineering</td>
				 			<td>Australia</td>
				 			<td><a href="http://www.uq.edu.au/">The University of Queensland</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ana Luiza Ferreira de Souza</td>
				 			<td>Journalism</td>
				 			<td>United Kingdom</td>
				 			<td><a href="http://www.uel.ac.uk/">University of East London</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ana Paula Rebelo</td>
				 			<td>Veterinary Medicine</td>
				 			<td>United States</td>
				 			<td><a href="http://www.ufl.edu/">University of Florida</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>André Grochowicz</td>
				 			<td>Digital Design</td>
				 			<td>United States</td>
				 			<td><a href="http://www.newschool.edu/parsons/">Parsons The New School For Design</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>André Mendes da Silva</td>
				 			<td>Engenharia Mecatrônica</td>
				 			<td>United States</td>
				 			<td><a href="http://www.universityofcalifornia.edu/">University of California</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Arthur Geron Gonçalves Dias</td>
				 			<td>Marketing</td>
				 			<td>Canada</td>
				 			<td><a href="http://www.kwantlen.ca/home.html">University Polytechnic Kwantlen</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Bernardo Keller Richter</td>
				 			<td>Production Engineering</td>
				 			<td>Canada</td>
				 			<td><a href="http://www.utoronto.com/">Universty of Toronto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Bernardo Suss</td>
				 			<td>Law</td>
				 			<td>Scotland (UK)</td>
				 			<td><a href="http://www.dundee.ac.uk/">University of Dundee</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Caio Kolczycki Dall Stella</td>
				 			<td>Graphic Design</td>
				 			<td>Spain</td>
				 			<td><a href="http://www.upv.es/index-en.html">Universitat Politècnica de València</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Christiane Scheidt Friedrich</td>
				 			<td>Food Engineering</td>
				 			<td>Germany</td>
				 			<td><a href="http://www.uni-goettingen.de/en/1.html">Georg August Universität Göttingen</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ciro Albuquerque II</td>
				 			<td>Physioterapy</td>
				 			<td>Australia</td>
				 			<td><a href="http://www.uq.edu.au/">University of Queensland</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Cynthia Olivia Gomes Nadal</td>
				 			<td>Environmental Engineering</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uevora.pt/">Universidade de Évora</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Daniel Carlos Coatti Rocha</td>
				 			<td>Veterinary Medicine</td>
				 			<td>United States</td>
				 			<td><a href="http://www.universityofcalifornia.edu/">University of California</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Daniele Campanharo Bizetto</td>
				 			<td>Environmental Engineering</td>
				 			<td>Australia</td>
				 			<td></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Eduardo Martello Moreira</td>
				 			<td>Medicine</td>
				 			<td>Netherlands</td>
				 			<td><a href="http://www.eur.nl/english/">University Erasmus</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Eduardo Rosa Moreira</td>
				 			<td>Architecture and Urbanism</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.up.pt/">Universidade de Porto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Elias Hans Dener Ribeiro da Silva</td>
				 			<td>Production Engineering</td>
				 			<td>Italy</td>
				 			<td><a href="http://www.polimi.it/">Politecnico di Milano</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Elori Mieko Oikawa</td>
				 			<td>Biology</td>
				 			<td>Finland</td>
				 			<td><a href="http://www.oulu.fi/english/">University of Oulu</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Emanuela Carla dos Santos</td>
				 			<td>Odontology</td>
				 			<td>Belgium</td>
				 			<td><a href="http://www.kuleuven.be/english/">University Leuven</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ester Farias de Souza</td>
				 			<td>Production Engineering</td>
				 			<td>Hong Kong</td>
				 			<td><a href="http://www.hku.hk/">University of Hong Kong</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Fagner de Carvalho Rodrigues</td>
				 			<td>Environmental Engineering</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uc.pt/">Universidade de Coimbra</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Felipe Vieira Riva</td>
				 			<td>Biotecnology</td>
				 			<td>Portugal</td>
				 			<td><a href="http://sigarra.up.pt/feup/pt/web_page.inicial">Faculdade de Engenharia da Universidade do Porto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Felipe Sant'ana</td>
				 			<td>Mechanical Engineering</td>
				 			<td>Germany</td>
				 			<td><a href="http://www.uni-kl.de/en/international">Technische Univertitat Kaiserslautern</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Gabriela Przygurski Claus Hartin</td>
				 			<td>Chemistry Engineering</td>
				 			<td>Canada</td>
				 			<td><a href="http://www.utoronto.com/">University of Toronto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Giulia Cavichiolo Saldanha</td>
				 			<td>Production Engineering</td>
				 			<td>Italy</td>
				 			<td><a href="http://www.polimi.it/">Politecnico di Milano</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Giullia Ulrich Kurt</td>
				 			<td>Production Engineering</td>
				 			<td>Italy</td>
				 			<td><a href="http://www.polimi.it/">Politecnico di Milano</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Guilherme Arnon Schmitt</td>
				 			<td>Architecture and Urbanism</td>
				 			<td>United States</td>
				 			<td><a href="http://www.newschool.edu/parsons/">Parsons The New School For Design</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Guilherme Henrique Schizel</td>
				 			<td>Physics Bachelor's Degree</td>
				 			<td>Finland</td>
				 			<td><a href="http://www.oulu.fi/english/">University of Oulu</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Gustavo Campana Mendes</td>
				 			<td>Engenharia Mecatrônica</td>
				 			<td>Canada</td>
				 			<td><a href="http://umanitoba.ca/">University of Manitoba</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Henrique Teixeira Sebastiani</td>
				 			<td>Production Engineering</td>
				 			<td>Canada</td>
				 			<td><a href="http://www.concordia.ca/">Concordia University</a></td>
				 		</tr>
				 		
				 		
				 		
				 		<tr class="lt3">
				 			<td>Juliano Szpak dos Santos</td>
				 			<td>Biologycal Sciences Bachelor's Degree</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uc.pt/">Universidade de Coimbra</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Leonardo Puchetti Polak</td>
				 			<td>Biology Bachelor's Degree</td>
				 			<td>Scotland</td>
				 			<td><a href="http://www.dundee.ac.uk/">University of Dundee</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Letícia Alves dos Santos Rosolem</td>
				 			<td>Production Engineering</td>
				 			<td>United States</td>
				 			<td><a href="http://www.wmich.edu/">University Western Michigan</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Letícia Gonçalez Francio</td>
				 			<td>Physioterapy</td>
				 			<td>Australia</td>
				 			<td><a href="http://www.uq.edu.au/">University of Queensland</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Luciana Basso da Fonseca</td>
				 			<td>Food Engineering</td>
				 			<td>United States</td>
				 			<td><a href="http://www.universityofcalifornia.edu/">University of California</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Marcelo Esther Fonseca</td>
				 			<td>Biology Bachelor's Degree</td>
				 			<td>Hong Kong</td>
				 			<td><a href="http://www.hku.hk/">University of Hong Kong</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Marco Antonio Gonçalves Kawajiri</td>
				 			<td>Computation Science</td>
				 			<td>United States</td>
				 			<td><a href="http://www.ncsu.edu/">North Caroline State University</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Marcus Vinícius Rodrigues Galdino</td>
				 			<td>Computation Engineering</td>
				 			<td>Canada</td>
				 			<td><a href="http://www.utoronto.com/">University of Toronto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Maria Eduarda Letti Souza</td>
				 			<td>Production Engineering</td>
				 			<td>France</td>
				 			<td><a href="http://www.insa-lyon.fr/">Institut National des Sciences Appliquées de Lyon</td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Maria Manoela Thies</td>
				 			<td>Production Engineering</td>
				 			<td>Italy</td>
				 			<td><a href="http://www.polimi.it/">Politecnico di Milano</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Mariana de Souza Castro</td>
				 			<td>Biotechnology</td>
				 			<td>France</td>
				 			<td><a href="http://www.insa-lyon.fr/">Institut National des Sciences Appliquées de Lyon</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Mariana Rodrigues Siqueira</td>
				 			<td>Journalism</td>
				 			<td>United Kingdom</td>
				 			<td><a href="http://www.roehampton.ac.uk/home/">University of Roehampton</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Mariana Tejada Kamiya</td>
				 			<td>Architecture and Urbanism</td>
				 			<td>South Korea</td>
				 			<td><a href="http://www.useoul.edu/">Seoul National University</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Mateus Justi Luvizotto</td>
				 			<td>Medicine</td>
				 			<td>Netherlands</td>
				 			<td><a href="http://www.eur.nl/english/">University Erasmus</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Milaine Konno Szmainski</td>
				 			<td>Odontology</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.ul.pt/portal/page?_pageid=173,1&_dad=portal&_schema=PORTAL">Universidade de Lisboa</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Nicole Tanuri Romancini</td>
				 			<td>Biotechnology</td>
				 			<td>France</td>
				 			<td><a href="http://www.insa-lyon.fr/">Institut National des Sciences Appliquées de Lyon</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Nicolle Amboni Schio</td>
				 			<td>Medicine</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uc.pt/">Universidade de Coimbra</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Nikole Anne Furukawa</td>
				 			<td>Chemistry Engineering</td>
				 			<td>South Korea</td>
				 			<td><a href="http://www.postech.ac.kr/">POSTECH</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Nolberto Camilo da Costa Neto</td>
				 			<td>Production Engineering</td>
				 			<td>Australia</td>
				 			<td></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Renata Antunes</td>
				 			<td>Architecture and Urbanism</td>
				 			<td>Australia</td>
				 			<td><a href="http://www.uwo.ca/">University of Western</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ronaldo Viana Leite Filho</td>
				 			<td>Veterinary Medicine</td>
				 			<td>United States</td>
				 			<td><a href="http://www.universityofcalifornia.edu/">University of California</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Sabrina Xavier Haj Mussi</td>
				 			<td>Graphic Design</td>
				 			<td>France</td>
				 			<td><a href="http://www.utbm.fr/la-universidad-de-tecnologia-de-belfort-montbeliard.html">Universidade Técnologica de Belfort</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Siliane Marie Gantzel</td>
				 			<td>Biology Bachelor's Degree</td>
				 			<td>Finland</td>
				 			<td><a href="http://www.oulu.fi/english/">University of Oulu</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Talissa Carine Rosa</td>
				 			<td>Physical Education Bachelor's Degree</td>
				 			<td>Spain</td>
				 			<td><a href="http://www.upm.es/internacional">Universidad Politécnica de Madrid</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Thaís Fernandes Otto</td>
				 			<td>Architecture and Urbanism</td>
				 			<td>United Kingdom</td>
				 			<td><a href="http://www.salford.ac.uk/">University of Salford</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Thamires Cappelletti Hack</td>
				 			<td>Architecture and Urbanism</td>
				 			<td>Germany</td>
				 			<td><a href="http://www.uni-kl.de/">TU Kaiserslautern</a></td>
				 		</tr>
				 		
				 		
				 		<tr class="lt3">
				 			<td>Washington Luiz Peroni Balsevicius</td>
				 			<td>Computation Engineering</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uminho.pt/">Universidade do Minho</a></td>
				 		</tr>
				 		
				 		
				 		
				 	</table>
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 <div id="links-relacionados">
					<h3>Related Links:</h3>
					<li><a href="dequaiscursos.php">Which course belong the students that are abroad?</a></li>
					<li><a href="areascursos.php">Which are the priority areas?</a></li>
				</div>
				 	
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>