<?php
	$include = '../';
	require("../db.php");
	header('Content-Type: text/html; charset=utf-8');
	$name="Ciência sem Fronteiras PUCPR";
	$content = "ciência sem fronteiras, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";
	require('../_class/_class_csf.php');
	$csf = new csf;
?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Quem já viajou? - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
		<meta name="<?php echo $name;?>" content="<?php echo $content;?>">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>Quem já<span class="lt6light"> viajou?</span></h1>
				  <p class="lt4">Quer descobrir quem são e onde estão os alunos que a PUCPR já enviou
				  			para o <strong>Ciência sem Fronteiras</strong>?</p>
				  

				  <div id="graficos">
				  	<?php echo utf8_encode($csf->world_mapa_estudantes()); ?>
				  </div>
				  
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
					  <option value="engineering">Engenharia e Áreas tecnológicas</option>
					  <option value="exatasterra">Ciências Exatas e da Terra</option>
					  <option value="biologyhealth">Biologia, Biomedicina e Saúde</option>
					  <option value="computertechnology">Computação e Tecnologia da Informação</option>
					  <option value="aerospacial">Tecnologia Aeroespacial</option>
					  <option value="pharmacy">Farmácia</option>
					  <option value="sustainableproduction">Produção de Agricultura Sustentável</option>
					  <option value="oil">Óleo, Gás e Carvão Mineral</option>
					  <option value="renewableenergies">Energias renováveis</option>
					  <option value="mineraltechnologies">Mineral Technologies</option>
					  <option value="biotechnology">Biotecnologia</option>
					  <option value="nanotechnology">Nanotecnologia e Novos Materiais</option>
					  <option value="naturaldisasters">Prevenção de Desastres Naturais e Tecnologia da Mitigação</option>
					  <option value="biodiversity">Biodiversity and Bioprospection</option>
					  <option value="seasciences">Ciências do Mar</option>
					  <option value="creativeindustry">Indústria Criativa</option>
					  <option value="newtechnologiesengineering">Novas Tecnologias na Engenharia da Construção</option>
					  <option value="technicalformation">Formação Técnica</option>
					  
					  
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
				 			<td class="lt5">ALUNOS</td>
				 			<td class="lt5">CURSO</td>
				 			<td class="lt5">PAÍS</td>
				 			<td class="lt5">UNIVERSIDADE</td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Alex dos Santos Xavier</td>
				 			<td>Engenharia da Computação</td>
				 			<td>Espanha</td>
				 			<td><a href="http://www.upc.edu/">Universitat Politecnica de Catalunya</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Aline de Fátima Lapchenks</td>
				 			<td>Arquitetura e Urbanismo</td>
				 			<td>França</td>
				 			<td><a href="http://www.univ-lille1.fr/">Université Lille</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Allan Adley Fagundes Amorim</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.ncsu.edu/">North Carolina State University</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Amanda Barros de Assis</td>
				 			<td>Comun. Social - Hab.: Publicidade e Propaganda</td>
				 			<td>Canadá</td>
				 			<td><a href="http://www.kwantlen.ca/">Kwantlen Polytechnic University</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Amanda Oliveira Voltolini</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.ist.utl.pt/">Instituto Superior Técnico</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ana Carolina Mastriani Arantes</td>
				 			<td>Odontologia</td>
				 			<td>Bélgica</td>
				 			<td><a href="http://www.uclouvain.be/">Université Catholique de Louvain</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ana Claudia Emerenciano Guedes</td>
				 			<td>Engenharia Civil</td>
				 			<td>Austrália</td>
				 			<td><a href="http://www.uq.edu.au/">The University of Queensland</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ana Luiza Ferreira de Souza</td>
				 			<td>Comun. Social - Hab.: Jornalismo</td>
				 			<td>Reino Unido</td>
				 			<td><a href="http://www.uel.ac.uk/">University of East London</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ana Paula Rebelo</td>
				 			<td>Medicina Veterinária</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.ufl.edu/">University of Florida</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>André Grochowicz</td>
				 			<td>Desenho Industrial - Hab.: Design Digital</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.newschool.edu/parsons/">Parsons The New School For Design</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>André Mendes da Silva</td>
				 			<td>Engenharia Mecatrônica</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.universityofcalifornia.edu/">University of California</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Arthur Geron Gonçalves Dias</td>
				 			<td>Marketing</td>
				 			<td>Canadá</td>
				 			<td><a href="http://www.kwantlen.ca/home.html">University Polytechnic Kwantlen</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Bernardo Keller Richter</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Canadá</td>
				 			<td><a href="http://www.utoronto.com/">Universty of Toronto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Bernardo Suss</td>
				 			<td>Direito</td>
				 			<td>Escócia</td>
				 			<td><a href="http://www.dundee.ac.uk/">University of Dundee</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Caio Kolczycki Dall Stella</td>
				 			<td>Desenho Insdustrial - Hab.: Programação Visual</td>
				 			<td>Espanha</td>
				 			<td><a href="http://www.upv.es/index-en.html">Universitat Politècnica de València</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Christiane Scheidt Friedrich</td>
				 			<td>Engenharia de Alimentos</td>
				 			<td>Alemanha</td>
				 			<td><a href="http://www.uni-goettingen.de/en/1.html">Georg August Universität Göttingen</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ciro Albuquerque II</td>
				 			<td>Fisioterapia</td>
				 			<td>Austrália</td>
				 			<td><a href="http://www.uq.edu.au/">University of Queensland</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Cynthia Olivia Gomes Nadal</td>
				 			<td>Engenharia Ambiental</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uevora.pt/">Universidade de Évora</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Daniel Carlos Coatti Rocha</td>
				 			<td>Medicina Veterinária</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.universityofcalifornia.edu/">University of California</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Daniele Campanharo Bizetto</td>
				 			<td>Engenharia Ambiental</td>
				 			<td>Austrália</td>
				 			<td></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Eduardo Martello Moreira</td>
				 			<td>Medicina</td>
				 			<td>Holanda</td>
				 			<td><a href="http://www.eur.nl/english/">University Erasmus</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Eduardo Rosa Moreira</td>
				 			<td>Arquitetura e Urbanismo</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.up.pt/">Universidade de Porto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Elias Hans Dener Ribeiro da Silva</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Itália</td>
				 			<td><a href="http://www.polimi.it/">Politecnico di Milano</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Elori Mieko Oikawa</td>
				 			<td>Biotecnologia</td>
				 			<td>Finlândia</td>
				 			<td><a href="http://www.oulu.fi/english/">University of Oulu</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Emanuela Carla dos Santos</td>
				 			<td>Odontologia</td>
				 			<td>Bélgica</td>
				 			<td><a href="http://www.kuleuven.be/english/">University Leuven</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ester Farias de Souza</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Hong Kong</td>
				 			<td><a href="http://www.hku.hk/">University of Hong Kong</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Fagner de Carvalho Rodrigues</td>
				 			<td>Engenharia Ambiental</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uc.pt/">Universidade de Coimbra</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Felipe Vieira Riva</td>
				 			<td>Biotecnologia</td>
				 			<td>Portugal</td>
				 			<td><a href="http://sigarra.up.pt/feup/pt/web_page.inicial">Faculdade de Engenharia da Universidade do Porto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Felipe Sant'ana</td>
				 			<td>Engeharia Mecânica</td>
				 			<td>Alemanha</td>
				 			<td><a href="http://www.uni-kl.de/en/international">Technische Univertitat Kaiserslautern</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Gabriela Przygurski Claus Hartin</td>
				 			<td>Engenharia Química</td>
				 			<td>Canadá</td>
				 			<td><a href="http://www.utoronto.com/">University of Toronto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Giulia Cavichiolo Saldanha</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Itália</td>
				 			<td><a href="http://www.polimi.it/">Politecnico di Milano</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Giullia Ulrich Kurt</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Itália</td>
				 			<td><a href="http://www.polimi.it/">Politecnico di Milano</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Guilherme Arnon Schmitt</td>
				 			<td>Arquitetura e Urbanismo</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.newschool.edu/parsons/">Parsons The New School For Design</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Guilherme Henrique Schizel</td>
				 			<td>Licenciatura em Física</td>
				 			<td>Finlândia</td>
				 			<td><a href="http://www.oulu.fi/english/">University of Oulu</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Gustavo Campana Mendes</td>
				 			<td>Engenharia Mecatrônica</td>
				 			<td>Canadá</td>
				 			<td><a href="http://umanitoba.ca/">University of Manitoba</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Henrique Teixeira Sebastiani</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Canadá</td>
				 			<td><a href="http://www.concordia.ca/">Concordia University</a></td>
				 		</tr>
				 		
				 		
				 		
				 		<tr class="lt3">
				 			<td>Juliano Szpak dos Santos</td>
				 			<td>Licenciatura em Ciências Biológicas</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uc.pt/">Universidade de Coimbra</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Leonardo Puchetti Polak</td>
				 			<td>Bacharelado em Biologia</td>
				 			<td>Escócia</td>
				 			<td><a href="http://www.dundee.ac.uk/">University of Dundee</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Letícia Alves dos Santos Rosolem</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.wmich.edu/">University Western Michigan</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Letícia Gonçalez Francio</td>
				 			<td>Fisioterapia</td>
				 			<td>Austrália</td>
				 			<td><a href="http://www.uq.edu.au/">University of Queensland</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Luciana Basso da Fonseca</td>
				 			<td>Engenharia de Alimentos</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.universityofcalifornia.edu/">University of California</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Marcelo Esther Fonseca</td>
				 			<td>Bacharelado em Biologia</td>
				 			<td>Hong Kong</td>
				 			<td><a href="http://www.hku.hk/">University of Hong Kong</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Marco Antonio Gonçalves Kawajiri</td>
				 			<td>Ciência da Computação</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.ncsu.edu/">North Caroline State University</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Marcus Vinícius Rodrigues Galdino</td>
				 			<td>Engenharia da Computação</td>
				 			<td>Canadá</td>
				 			<td><a href="http://www.utoronto.com/">University of Toronto</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Maria Eduarda Letti Souza</td>
				 			<td>Engenharia de Produção</td>
				 			<td>França</td>
				 			<td><a href="http://www.insa-lyon.fr/">Institut National des Sciences Appliquées de Lyon</td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Maria Manoela Thies</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Itália</td>
				 			<td><a href="http://www.polimi.it/">Politecnico di Milano</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Mariana de Souza Castro</td>
				 			<td>Biotecnologia</td>
				 			<td>França</td>
				 			<td><a href="http://www.insa-lyon.fr/">Institut National des Sciences Appliquées de Lyon</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Mariana Rodrigues Siqueira</td>
				 			<td>Comun. Social - Hab.: Jornalismo</td>
				 			<td>Reino Unido</td>
				 			<td><a href="http://www.roehampton.ac.uk/home/">University of Roehampton</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Mariana Tejada Kamiya</td>
				 			<td>Arquitetura e Urbanismo</td>
				 			<td>Coreia do Sul</td>
				 			<td><a href="http://www.useoul.edu/">Seoul National University</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Mateus Justi Luvizotto</td>
				 			<td>Medicina</td>
				 			<td>Holanda</td>
				 			<td><a href="http://www.eur.nl/english/">University Erasmus</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Milaine Konno Szmainski</td>
				 			<td>Odontologia</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.ul.pt/portal/page?_pageid=173,1&_dad=portal&_schema=PORTAL">Universidade de Lisboa</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Nicole Tanuri Romancini</td>
				 			<td>Biotecnologia</td>
				 			<td>França</td>
				 			<td><a href="http://www.insa-lyon.fr/">Institut National des Sciences Appliquées de Lyon</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Nicolle Amboni Schio</td>
				 			<td>Medicina</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uc.pt/">Universidade de Coimbra</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Nikole Anne Furukawa</td>
				 			<td>Engenharia Química</td>
				 			<td>Coréia do Sul</td>
				 			<td><a href="http://www.postech.ac.kr/">POSTECH</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Nolberto Camilo da Costa Neto</td>
				 			<td>Engenharia de Produção</td>
				 			<td>Austrália</td>
				 			<td></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Renata Antunes</td>
				 			<td>Arquitetura e Urbanismo</td>
				 			<td>Austrália</td>
				 			<td><a href="http://www.uwo.ca/">University of Western</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Ronaldo Viana Leite Filho</td>
				 			<td>Medicina Veterinária</td>
				 			<td>Estados Unidos</td>
				 			<td><a href="http://www.universityofcalifornia.edu/">University of California</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Sabrina Xavier Haj Mussi</td>
				 			<td>Desenho Industrial - Hab.: Programação Visual</td>
				 			<td>França</td>
				 			<td><a href="http://www.utbm.fr/la-universidad-de-tecnologia-de-belfort-montbeliard.html">Universidade Técnologica de Belfort</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Siliane Marie Gantzel</td>
				 			<td>Bacharelado em Biologia</td>
				 			<td>Finlândia</td>
				 			<td><a href="http://www.oulu.fi/english/">University of Oulu</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Talissa Carine Rosa</td>
				 			<td>Bacharelado em Educação Física</td>
				 			<td>Espanha</td>
				 			<td><a href="http://www.upm.es/internacional">Universidad Politécnica de Madrid</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Thaís Fernandes Otto</td>
				 			<td>Arquitetura e Urbanismo</td>
				 			<td>Reino Unido</td>
				 			<td><a href="http://www.salford.ac.uk/">University of Salford</a></td>
				 		</tr>
				 		
				 		<tr class="lt3">
				 			<td>Thamires Cappelletti Hack</td>
				 			<td>Arquitetura e Urbanismo</td>
				 			<td>Alemanha</td>
				 			<td><a href="http://www.uni-kl.de/">TU Kaiserslautern</a></td>
				 		</tr>
				 		
				 		
				 		<tr class="lt3">
				 			<td>Washington Luiz Peroni Balsevicius</td>
				 			<td>Engenharia de Computação</td>
				 			<td>Portugal</td>
				 			<td><a href="http://www.uminho.pt/">Universidade do Minho</a></td>
				 		</tr>
				 		
				 		
				 		
				 	</table>
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 	
				 <div id="links-relacionados">
					<h3>Links relacionados:</h3>
					<li><a href="dequaiscursos.php">De quais cursos são os alunos que já foram selecionados?</a></li>
					<li><a href="areascursos.php">Quais são as Áreas Prioritárias do programa?</a></li>
				</div>
				 	
			</div>
			
			<?php require("footer.php");?>
			
		</div>
		
	</body>
</html>