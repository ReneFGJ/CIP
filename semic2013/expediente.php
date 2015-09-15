<?
require('db.php');
/*
 * Incluir Classes para a página
 */
require("_class/_class_semic_layout.php");
$site = new layout;

//require("../_class/_class_ficha_catalografica.php");
//$fc = new ficha_catalografica;

/* 
 * BBM - Header Site 
 */
echo $site->header_site();

//echo $site->banner_vermelho();

//echo $site->abre_secao('Expediente');
echo '<div class="txt_conteudo"><BR>';

$sx ='
<p>
<center>PONTIFÍCIA UNIVERSIDADE CATÓLICA DO PARANÁ ADMINISTRAÇÃO SUPERIOR</center>

Grão-Chanceler: <b>Dom Moacyr José Vitti</b>
Presidente da Associação Paranaense de Cultura: <b>Delcio Afonso Balestrin</b>
Vice-Presidente da Associação Paranaense de Cultura: <b>Antônio Benedito de Oliveira</b>
Reitor: <b>Clemente Ivo Juliatto</b>
Vice-Reitor: <b>Paulo Otávio Mussi Augusto</b>
Pró-Reitor Acadêmico: <b>Eduardo Damião da Silva</b>
Pró-Reitor de Pesquisa e Pós-Graduação: <b>Waldemiro Gremski</b>
Pró-Reitor Comunitário e de Extensão: <b>Paulo Otávio Mussi Augusto</b> (Interino)
Pró-Reitor de Administração, Planejamento e Desenvolvimento: <b>José Luiz Casela</b>

Diretoria de Pós-Graduação
<b>Nathan Mendes</b>

Diretoria de Pesquisa
<b>Paula Cristina Trevilatto</b>

Coordenadoria de Iniciação Científica 
<b>Cleybe Hiole Vieira</b>

<b>COMITÊ GESTOR</b>
Cesar Candiotto
Cleybe Hiole Vieira
Edvaldo Antônio Ribeiro Rosa
Fábio Rueda Faucz
Gezelda Moraes
Júlio César Nievola
Maria Alexandra Viegas Cortez Cunha
Paula Cristina Trevilatto
Renata Ernlund Freitas de Macedo
Roberto Pecoits Filho

<b>COMITÊ LOCAL</b>

<b>GRANDE ÁREA: CIÊNCIAS DA VIDA</b>

Área: Ciências Biológicas
Almir Petersen Barreto
Andréa Novais Moreno
Edvaldo Antônio Ribeiro Rosa
Fábio Rueda Faucz
Janete Dubiaski da Silva
Salmo Raskin
Paula Cristina Trevilatto

Área: Ciências Médicas e da Saúde
Ana Maria Trindade Gregio
Beatriz Helena Sottile França
Carlos Alberto Afonso
Carlos Alberto Mayora Aita
José Rocha Faria Neto
Paulo Henrique Couto
Roberto Pecoits Filho
Rodrigo Rached

Área: Ciências Agronômicas e Veterinárias
Airton Rodrigues Pinto Júnior
Cláudia Turra Pimpão
Cristina Santos Sotomaior
Renata Ernlund Freitas de Macedo
Ruy Inácio Neiva de Carvalho

<b>GRANDE ÁREA: CIÊNCIAS EXATAS E DA TERRA</b>

Área: Engenharias e Ciências Matemáticas
João Elias Abdalla Filho
Leandro dos Santos Coelho
Luciano Antonio Mendes
Luís Mauro Moura
Marcelo Rudek
Munir Antônio Gariba
Nilson Barbieri
Sérgio Eduardo Gouvea da Costa
Viviana Cocco Mariani

Área: Computação
Cinthia Obladen de Almendra Freitas
Fabrício Enembreck
Júlio César Nievola
Luiz Augusto de Paula Lima Júnior

<b>GRANDE ÁREA: CIÊNCIAS HUMANAS</b>

Área: Ciências Humanas
Antonio Edmilson Paschoal
Cesar Candiotto
Clélia Peretti
Daniel Omar Perez
Dilmeire Sant´Anna Ramos Vosgerau
Joana Paulin Romanowski
Romilda Teodora Ens

<b>GRANDE ÁREA: CIÊNCIAS SOCIAIS APLICADAS</b>
Cláudia Maria Barbosa
Clóvis Ultramari
Danielle Anne Pamplona
Harry Alberto Bollmann
Heitor Takashi Kato
Katya Kozicki
Maria Alexandra Viegas Cortez Cunha
Samira Kauchakje

<b>Cardeno do SEMIC</b>
<I>Organizadora</I>
Cleybe Hiola Vieira

<I>Versão eletrônica</I>
Alessandra de Lacerda Carvalho
Edena Maria Beiga Grein
Everton Asmé
Rafael Moreira Calasans
Rene Faustino Gabriel Júnior

<b>Capa</b>
Felipe Machado de Souza

<b>Projeto gráfico e diagramação</b>
Felipe Machado de Souza
</P>
';

if ($LANG == 'en')
{
	$sx = '
<p>
Pontifical Catholic University of Parana - PUCPR 

<b>Central Administration</b>

Chancellor: Dom Moacyr José Vitti
Chair of the Board of Trustees: Brother Delcio Afonso Balestrin, FMS
Vice-Chair of the Board of Trustees: Brother Antônio Benedito de Oliveira, FMS
President: Brother Clemente Ivo Juliatto, FMS
Vice President: Paulo Otávio Mussi Augusto
Executive Vice President for Academic Affairs: Eduardo Damião da Silva
Executive Vice President for Research and Graduate Studies: Waldemiro Gremski
Executive Vice President for Community Affairs and Extension: Másimo Della Justina
Executive Vice President for Administration and Institutional Development: José Luiz Casela
Director for Research: Paula Cristina Trevilatto 
Director for Graduate Studies: Nathan Mendes
Coordinator for Undergraduate Research: Cleybe Hiole Vieira

<b>Undergraduate Research Committee</b>
Adalgiza de Oliveira
Amélia do Carmo Sampaio Rossi
César Candiotto
Cleybe Hiole Vieira
Eduardo Agostinho
Edvaldo Antônio Ribeiro Rosa
Gezelda Moraes
Júlio César Nievola
Lucia Mazieiro
Maria Alexandra Viegas Cortez Cunha
Mauro Nagashima
Paula Cristina Trevilatto
Paulo Renato Parreira 
Renata Ernlund Freitas de Macedo

<b>Undergraduate Research Committee – Board of Reviewers
Life Sciences:</b>
Almir Petersen Barreto
Ana Maria Trindade Gregio 
Andréa Novais Moreno
Beatriz Helena Sottile França 
Carlos Alberto Mayora Aita
Edvaldo Antônio Ribeiro Rosa
Janete Dubiaski da Silva
José Rocha Faria Neto 
Paula Cristina Trevilatto
Paulo Henrique Couto
Roberto Pecoits Filho
Rodrigo Rached
Salmo Raskin

<b>Agricultural and Veterinary Sciences</b>
Cláudia Turra Pimpão
Cristina Santos Sotomaior
Renata Ernlund Freitas de Macedo
Ruy Inácio Neiva de Carvalho

<b>Exact Sciences and Engineering</b>
Cinthia Obladen de Almendra Freitas
Fabrício Enembreck
João Elias Abdalla Filho
Júlio César Nievola
Leandro dos Santos Coelho
Luciano Antonio Mendes
Luís Mauro Moura
Luiz Augusto de Paula Lima Júnior
Marcelo Rudek
Munir Antônio Gariba
Nilson Barbieri
Sérgio Eduardo Gouvea da Costa
Viviana Cocco Mariani

<b>Humanities</b>
Antonio Edmilson Paschoal
César Candiotto
Clélia Peretti
Daniel Omar Perez
Dilmeire Sant’anna Ramos Vosgerau
Joana Paulin Romanowski
Romilda Teodora Ens

<b>Applied Social Sciences</b>
Cláudia Maria Barbosa
Clóvis Ultramari 
Danielle Anne Pamplona
Harry Alberto Bollmann
Heitor Takashi Kato
Katya Kozicki
Maria Alexandra Viegas Cortez Cunha
Samira Kauchakje

<b>Proceedings</b>
<I>Organization	</I>
Cleybe Hiola Vieira

<I>Eletronic Version</I>
Alessandra de Lacerda Carvalho
Edena Maria Beiga Grein
Everton Asmé
Rafael Moreira Calasans
Rene Faustino Gabriel Júnior

<b>Proofreading</b>
Debora Capella

<b>English translation and revision</b>
Ane Cibele Palma
Carmen Terezinha Koppe
Elis Carrijo Guimarães Mendonça
Gisele Rietow
Karina Aires R. Fernandes Couto de Moraes

<b>Cover</b>
Felipe Machado de Souza
</P>

<b>Graphic Design and Layout</b>
Felipe Machado de Souza
</P>
';
}

$sx = troca($sx,chr(10),'<BR>');
echo ($sx);
echo '</div>';

/* Ficha */
/*
$fc->cutter = 'S471r';
$fc->cdd = '506.3';
$fc->line_1th = 'Seminário de Iniciação Científica (20. : 2012 nov. 6-8 : Curitiba, PR)';
$fc->line_2th = 'Resumos do XXI Seminário de Iniciação Científica [recurso eletrônico] ; XV Mostra de Pesquisa da Pós-Graduação ; XI Seminário de Pesquisa Jr ; III PIBITI / organizadora Cleybe Hiole Vieira. - Curitiba : Champagnat, 2013.';
$fc->line_3th = 'Vários autores.<BR>ISSN 2176-1930';
$fc->ponto_acesso = '1. Ciência - Congressos. 2. Pesquisa – Congressos. I. Vieira, Cleybe Hiole.';
$fc->pistas = 'II.  Mostra de Pesquisa da Pós-Graduação (14. : 2012 nov. 6-8 : Curitiba, PR). III. Seminário de Pesquisa Jr (10. : 2012 nov. 6-8 : Curitiba, PR). IV. PIBITI (2. : 2012 nov. 6-8 : Curitiba, PR). V. Título.';
//echo $fc->mostra();
*/
echo $site->fecha_secao();

/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
