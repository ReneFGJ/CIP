<?php
class layout
	{
		
		function abre_secao($titulo)
			{
				$sx = '
					<div class="titulo_conteudo">'.$titulo.'</div>
					<div class="txt_conteudo"><P>				
				';
				return($sx);
			}
		
		function fecha_secao()
			{
				$sx .= '</P></div>';
				return($sx);
			}
		
		function redes_sociais()
			{
				$sx = '
    			<div class="redes_sociais">
    				<div class="tit_redes_sociais">Redes Sociais</div>
    				<div class="google_mais"><g:plusone size="tall"></g:plusone></div>
			        <div class="share-twitter"><a class="twitter-share-button"
    					href="http://twitter.com/share?url=http://www.pucpr.br/semic&text=Seminário de Iniciação Científica PUCPR"
    					rel="nofollow" data-count="horizontal" data-via="escolasites"><img border="0" class="banner_lateral" src="imagens/bt_tweetar.png" /></a></div>
    				<div class="facebook">
        				<iframe src="http://www.facebook.com/plugins/like.php?href=http://www.pucpr.br/semic"
            				scrolling="no" frameborder="0"
            				style="border:none; width:133px; height:90px"></iframe></div>	    
    				</div>				
    			</div>
    			<div class="cb"></div>				
				';
				return($sx);
			}
		function menu_pesquisador()
			{
				$sx = '<ul class="pesquisador">
        			<li><a href="#">PIBIC</a></li>
        			<li><a href="#">PIBIC Jr.</a></li>
        			<li><a href="#">PIBITI</a></li>
        			<li><a href="http://www2.pucpr.br/reol/cienciasemfronteiras/" target="csf">Ci&ecirc;ncia sem <br />Fronteiras</a></li>
        			</ul>';
				return($sx);
			}

		function notas_esquerda($titulo,$texto,$area)
			{
				global $LANG;
				$sty = 'titulo_nota_home_vermelha';
				if ($area == '2') { $sty = 'titulo_nota_home_azul'; }
				if ($area == '3') { $sty = 'titulo_nota_home_verde_escuro'; }
				if ($area == '4') { $sty = 'titulo_nota_home_verde_claro'; }
				if ($area == '5') { $sty = 'titulo_nota_home_roxo'; }
								
				$sx = '
        		<div class="nota_home">
        			<div class="'.$sty.'">'.$titulo.'</div>
            		<div class="txt_nota_home">'.$texto.'</div>';
				//$sx .= '<div class="link_home"><a href="#">Leia mais</a></div>';
				$sx .= '<BR></div>';	
				
				
				if ($LANG=="en")
					{
						$sx = '
        					<div class="nota_home">
        					<div class="'.$sty.'">'.$titulo.'</div>
            				<div class="txt_nota_home">'.$texto.'</div>';
						//$sx .= '<div class="link_home"><a href="#">Read more</a></div>';
						$sx .= '<BR></div>';
					}
				return($sx);
			}		        
		
		function coluna_esquerda()
			{
				$sx = '<div class="coluna_esquerda">
				<p>&nbsp;</p>
<h2>Bem-vindo ao XXI Semin&aacute;rio de Inicia&ccedil;&atilde;o Cient&iacute;fica da Pontif&iacute;cia Universidade Cat&oacute;lica do Paran&aacute; (SEMIC)</h2>
<p>&nbsp;</p>
<p>A Inicia&ccedil;&atilde;o Cient&iacute;fica &eacute; sempre um desafio e a prepara&ccedil;&atilde;o do Semin&aacute;rio Anual &eacute; o segundo desafio desse percurso junto aos alunos iniciantes no campo da ci&ecirc;ncia. A import&acirc;ncia desse caminho &eacute; ineg&aacute;vel na descoberta de novos talentos e temos registrado boas surpresas. Queremos que o evento de 2013 seja mais uma delas, pois afinal de contas atingimos a maioridade: 21 anos de PIBIC na PUCPR!</p>
<p>Os demais programas que fazem parte do SEMIC s&atilde;o mais recentes: PIBIC Jr desde 2006 e PIBITI desde 2010, mas como &ldquo;irm&atilde;os mais novos&rdquo;, miram-se no espelho do mais velho.</p>
<p>E, como parte do SEMIC, temos tamb&eacute;m a apresenta&ccedil;&atilde;o de algumas pesquisas realizadas nos programas da P&oacute;s-Gradua&ccedil;&atilde;o <I>stricto sensu</I>. Desse modo, a totalidade de trabalhos no evento atinge 1.300 pesquisas, subdivididas nas seguintes modalidades:</p>
<table width="100%" border="0">
  <tr>
    <td>PIBIC</td>
    <td>iPIBIC</td>
    <td>PIBITI</td>
    <td>iPIBITI</td>
    <td>Mobilidade Nacional</td>
    <td>Mobilidade Internacional</td>
    <td>PIBIC Jr</td>
    <td>Mostra da PG</td>
    <td>Total</td>
  </tr>
  <tr>
    <td>721</td>
    <td>55</td>
    <td>81</td>
    <td>12</td>
    <td>10</td>
    <td>02</td>
    <td>09</td>
    <td>358</td>
    <td>1.248</td>
  </tr>
</table>
<p>i=trabalhos a serem apresentados em ingl&ecirc;s</p>
<p>Em rela&ccedil;&atilde;o &agrave;s atividades, mantemos as sess&otilde;es alinhadas com os temas da internacionaliza&ccedil;&atilde;o da Universidade e do desenvolvimento tecnol&oacute;gico e inova&ccedil;&atilde;o:</p>
<ul>
  <li>Sess&atilde;o internacional com apresenta&ccedil;&atilde;o de&nbsp; 67 trabalhos em ingl&ecirc;s (PIBIC =55, PIBITI = 12);</li>
  <li>Sess&atilde;o Ci&ecirc;ncia sem Fronteiras &ndash; com depoimento de alguns dos 65 alunos da PUCPR que j&aacute; regressaram do exterior;</li>
  <li>Espa&ccedil;o Pesquisar &eacute; Evoluir &ndash; com mostra de prot&oacute;tipos de projetos/propostas de pesquisa com teor de inova&ccedil;&atilde;o.</li>
</ul>
<p> Nossa inten&ccedil;&atilde;o &eacute; criar um ambiente prop&iacute;cio para a discuss&atilde;o de ideias inovadoras, para o compartilhar dos resultados das pesquisas e, ainda, o espa&ccedil;o para os jovens pesquisadores e empreendedores receberem o feedback de pesquisadores experientes que atuam na qualidade de avaliadores.</p>
<p>Na sess&atilde;o de mobilidade nacional queremos compartilhar a experi&ecirc;ncia inicial dos 10 alunos no programa PIBIC &ndash; PIBITI sandu&iacute;che e na internacional dos 02 alunos que est&atilde;o sendo o piloto da proposta PIBIC &ndash; PIBITI Internacional.</p>
<p>Ap&oacute;s todos esses acontecimentos, chegamos ao encerramento do evento, momento em que anunciamos os melhores trabalhos em cada uma das categorias. N&atilde;o perca esse momento de celebra&ccedil;&atilde;o!</p>
<p>Agradecer a todos os atores que contribu&iacute;ram para que mais um ano de Inicia&ccedil;&atilde;o Cient&iacute;fica acontecesse na Universidade &eacute; quase uma miss&atilde;o imposs&iacute;vel. Registro os meus sinceros agradecimentos pelo apoio recebido da administra&ccedil;&atilde;o da PUCPR, em especial da Pr&oacute;-Reitoria de Pesquisa e P&oacute;s-Gradua&ccedil;&atilde;o.</p>
<p>De maneira particular, quero reconhecer o trabalho di&aacute;rio, intenso e dedicado dos professores orientadores que tornam poss&iacute;vel este evento, pois nos oferecem a mat&eacute;ria prima. Agrade&ccedil;o tamb&eacute;m a todos os pesquisadores avaliadores que contribu&iacute;ram com seu &lsquo;feedback&rsquo; para o avan&ccedil;o da qualidade da pesquisa desenvolvida pelos alunos.</p>
<p>N&atilde;o posso deixar de falar da parceria que tenho com brilhantes pesquisadores membros do Comit&ecirc; Gestor, suporte decisivo em momentos delicados. E, com muito apre&ccedil;o, agrade&ccedil;o a minha incansavelmente equipe de colaboradores que respondem prontamente a todas as demandas formuladas.</p>
<p>&nbsp;</p>
<blockquote>
  <p>Desejo a todos momentos proveitosos e de grande realiza&ccedil;&atilde;o!</p>
  <p>Sauda&ccedil;&otilde;es,</p>
  <p>Cleybe Vieira <br>
  Coordenadora da Inicia&ccedil;&atilde;o Cient&iacute;fica</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</blockquote>


				';
				return($sx);
			}

			function coluna_esquerda_en()
			{
				$sx = '<div class="coluna_esquerda">
				<p>&nbsp;</p>
<h2>Welcome to the 21th PUCPR<br>Research Presentation Meeting</h2>
<p>&nbsp;</p>
<p>Scientific Apprenticeship is always a challenging endeavor and preparation for the Annual Meeting means an extra challenge in the path of the apprentices. The importance of this trajectory for the discovery of new talents is undeniable and we have witnessed pleasant surprises. We all desire that this year’s event brings even more surprises. After all, we have reached the age of majority: twenty-one years of the Undergraduate Research Apprenticeship Program (PIBIC) at PUCPR!</p>
<p>The other programs that take part in the 21st PUCPR Research Presentation Meeting were launched more recently: the Secondary Level Research Apprenticeship Program (PIBIC Jr), in 2006, and the Undergraduate Technology Apprenticeship Program (PIBITI), in 2010. But as PIBIC’s younger brothers, they reflect the older brother. </p>
<p>As part of the SEMIC, we will also have presentations of research conducted by graduate programs, totaling 1.300 presentations distributed in the following categories:</p>
<table width="100%" border="0">
  <tr>
    <td>PIBIC</td>
    <td>iPIBIC</td>
    <td>PIBITI</td>
    <td>iPIBITI</td>
    <td>National Mobility</td>
    <td>International Mobility</td>
    <td>PIBIC Jr</td>
    <td>Graduate</td>
    <td>Total</td>
  </tr>
  <tr>
    <td>721</td>
    <td>55</td>
    <td>81</td>
    <td>12</td>
    <td>10</td>
    <td>02</td>
    <td>09</td>
    <td>358</td>
    <td>1.248</td>
  </tr>
</table>
<p>i= works to be presented in English</p>
<p>Activities in this year’s event are divided into sessions on the themes of internationalization of the University and technological development and innovation, as last year: </p>
<ul>
  <li>International Session, with 67 presentations in English (PIBIC =55, PIBITI = 12);</li>
  <li>Science without Borders Section, with testimonials of some of the 65 PUCPR students that have returned from their international experience;</li>
  <li>“Research and Evolve” Space, with displays of prototypes of innovative research projects or proposals. </li>
</ul>
<p> Our aim is to create an environment conducive to the discussion of innovative ideas, to sharing research results and a place where young researchers and entrepreneurs receive feedback from expert researchers who act as reviewers. 
</p>
<p>In the national mobility session we want to share the experience of the first 10 PIBIC and PIBITI sandwich students. In the international mobility session, the first two students involved in the International PIBIC and PIBITI pilot programs will also share their experience. </p>
<p>At the closing of the event, we will host an award ceremony in which the best presentations in each category are announced. Don’t miss that moment of celebration! </p>
<p>To mention and thank all those who contributed to scientific apprenticeship in our university is an almost impossible task. I want to express my sincere appreciation for the support I received from PUCPR’s central administration, especially from office of the Executive Vice President for Research and Graduate Studies.  </p>
<p>On a special note, I want to recognize the daily, intensive and dedicated work of the undergraduate research advisors who made this event possible by providing us with the “raw material”. I would also like to thank all the reviewers for their contribution to the advancement of the research done by the students by providing them valuable feedback.  </p>
<p>I must not forget to mention the partnership I have with brilliant researchers who are members of the Undergraduate Research Committee for their decisive support in delicate moments. Last but not least, and with a lot of appreciation, I want to thank my tireless collaborators who always responded promptly and efficiently to all demands. </p>
<p>&nbsp;</p>
<blockquote>
  <p>I wish you enjoy profitable moments of great achievements. </p>
  <p>Kind regards,</p>
  <p>Cleybe Vieira <br>
  Coordinator for Undergraduate Research</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</blockquote>


				';
				return($sx);
			}
		function coluna_esquerda_fecha()
			{
				$sx = '</div>';
				return($sx);
			}
			
			
		function coluna_direita()
			{
				$sx = '<div class="coluna_direita">';
				return($sx);
			}

		function coluna_direita_fecha()
			{
				$sx = '</div>';
				return($sx);
			}

		function box_materia_home($titulo='',$imagem='',$texto='',$link='',$area = '1')
			{
				global $LANG;
				$sty = 'titulo_materia_home_vermelha';
				if ($area == '2') { $sty = 'titulo_materia_home_azul'; }
				if ($area == '3') { $sty = 'titulo_materia_home_verde_escuro'; }
				if ($area == '4') { $sty = 'titulo_materia_home_verde_claro'; }
				if ($area == '5') { $sty = 'titulo_materia_home_roxo'; }
				
				$more = 'Confira o resumo';
				if ($LANG='en') { $more = 'Read more'; }
				
				$texto = '<strong class="primeira">'.substr($texto,0,1).'</strong>'.substr($texto,1,strlen($texto));
				$sx .= '
        			<div class="box_materia_home">
        			<div class="'.$sty.'">'.$titulo.'</div>

		            <img class="foto_materia_home" src="imagens/'.$imagem.'" width="110" height="115" />
            		<div class="txt_materia_home">
            			'.$texto.'
                		<div class="link_home"><a href="'.$link.'">'.$more.'</a></div>   
					</div>	            
            		<div class="cb"></div>
      				</div>				
				';
				return($sx);			
			}
			
		function box_amarelo($texto)
			{ 
			$sx = '
   	  			<div class="box_amarelo">'.$texto.'</div>
   	    	';
			return($sx);
			}
			
		function banner_vermelho()
			{
				global $LANG;
				$sx = '
        			<div class="box_amarelo_home">
            		<div class="titulo_amarelo">O qu&ecirc; &eacute; o SEMIC?</div>
            		<div class="txt_semic">O Semin&aacute;rio de Inicia&ccedil;&atilde;o Cient&iacute;fica (SEMIC) e a Mostra de Pesquisa da P&oacute;s-Gradua&ccedil;&atilde;o da PUCPR s&atilde;o eventos abertos &agrave; comunidade, em que s&atilde;o exibidos os trabalhos de Inicia&ccedil;&atilde;o Cient&iacute;fica desenvolvidos pelos alunos ao longo do ano.</div>
            		<div class="saiba_mais"><a href="semic.php?idioma='.$LANG.'&dd50=idioma.html">+ leia mais</a></div>
        			</div>';
				if ($LANG == 'en')
					{
					$sx = '
        			<div class="box_amarelo_home">
            		<div class="titulo_amarelo">What is the SEMIC?</div>
            		<div class="txt_semic">The Scientific Initiation Seminar (SEMIC) and the Post Graduation Research Show are events open to the community, in which are shown the Scientific Initiation work developed by the undergraduate students throughout the year and the researchers developed by the master and doctor degree students from PUCPR.</div>
            		<div class="saiba_mais"><a href="semic.php?idioma='.$LANG.'&dd50=idioma.html">+ read more</a></div>
        			</div>';				
					}
				return($sx);
			}
		
		/*
		 *  Header_site
		 */
		function header_site()
			{
			global $LANG;
			//<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			$sx = '
				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>				
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
				<title>XXI Seminário de Iniciação Científica</title>
				<link href="style.css" rel="stylesheet" type="text/css" />
				';
			if ($LANG=='en')
				{ $sx .= '<link href="style_en.css" rel="stylesheet" type="text/css" />'; }
					
			$sx .= '
				<link href="style_ext.css" rel="stylesheet" type="text/css" />
				<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
				</head>
				
				<script type="text/javascript">
				  var _gaq = _gaq || [];
  				_gaq.push([\'_setAccount\', \'UA-12712904-7\']);
  				_gaq.push([\'_trackPageview\']);
				  (function() {
    			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
			    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
				  })();
				</script>				
				
				<body>
				<div class="geral">
					<div id="div1">&nbsp;&nbsp;<a href="index.php?idioma=en&dd50=idioma.html"><img src="img/ididoma_en.png" border=0 title"English" alt="English"></A> | 
											   <a href="index.php?idioma=pt_BR&dd50=idioma.html"><img src="img/ididoma_br.png" border=0 title="Português" alt="Português"></A>
					| <B>ISSN 2176-1930</B>
					</div>											   
					<div class="topo">	
				';				
        				//<a href="http://www2.pucpr.br/reol/semic"><div class="bt_inicio"></div></a>
        	$sx .= '
        				<a href="http://www.facebook.com/pucpr2" target="_blank"><div class="bt_face_puc"></div></a>
        				<a href="https://twitter.com/pucpr_imprensa" target="_blank"><div class="bt_twit_puc"></div></a>
        				<a href="http://www.youtube.com/canalpucpr" target="_blank"><div class="bt_youtube_puc"></div></a>
    				</div>';
			$sx .= $this->topmenu_site();
			$sx .= '<div class="conteudo">';
			return($sx);				
			}

		/*
		 * Top Menu
		 */
		 function topmenu_site()
		 	{
		 		global $LANG;
		 		$menu = array('SEMIC','Programação','Expediente','Índice onomástico','Sumário Geral','Edições anteriores');
				if ($LANG == 'en')
				{ $menu = array('SEMIC','Programme','Conference Committee','Index','Proceedings','Back Editions'); }
		 		$sx .= '
		 			<div class="menu">
      				<ul>
        				<li><a href="index.php?idioma='.$LANG.'&dd50=idioma.html">'.$menu[0].'</a></li>
        				<li><a href="programacao.php?idioma='.$LANG.'&dd50=idioma.html">'.$menu[1].'</a></li>
        				<li><a href="expediente.php?idioma='.$LANG.'&dd50=idioma.html">'.$menu[2].'</a></li>
        				<li><a href="indice_onomastico.php?idioma='.$LANG.'&dd50=idioma.html">'.$menu[3].'</a></li>
        				<li><a href="sumario_geral.php?idioma='.$LANG.'&dd50=idioma.html">'.$menu[4].'</a></li>
        				<li><a class="ultimo" href="edicoes_anteriores.php?idioma='.$LANG.'&dd50=idioma.html">'.$menu[5].'</a></li>
      				</ul>
    				</div>
    				';
					return($sx);
			}
		
		/*
		 * FOOT SITE
		 * no params
		 */
		function foot_site()
			{
				$sx = '
				</div>
					<div class="rodape"><img src="imagens/img_rodape.png" width="840" height="160" /></div>
					</div>
				<center>ISSN 2176-1930</center>
				<div style="display: none">
				<img src="hhttp://www2.pucpr.br/reol/semic/img/xxsemic_eu_faco_pesquisa.jpg" border=0>
				</div>
				</body>
				</html>				
				';
				//dbclose();
				return($sx);
			}
	}
