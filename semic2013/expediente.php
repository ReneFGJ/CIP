<?
require('db.php');
/*
 * Incluir Classes para a p�gina
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
<center>PONTIF�CIA UNIVERSIDADE CAT�LICA DO PARAN� ADMINISTRA��O SUPERIOR</center>

Gr�o-Chanceler: <b>Dom Moacyr Jos� Vitti</b>
Presidente da Associa��o Paranaense de Cultura: <b>Delcio Afonso Balestrin</b>
Vice-Presidente da Associa��o Paranaense de Cultura: <b>Ant�nio Benedito de Oliveira</b>
Reitor: <b>Clemente Ivo Juliatto</b>
Vice-Reitor: <b>Paulo Ot�vio Mussi Augusto</b>
Pr�-Reitor Acad�mico: <b>Eduardo Dami�o da Silva</b>
Pr�-Reitor de Pesquisa e P�s-Gradua��o: <b>Waldemiro Gremski</b>
Pr�-Reitor Comunit�rio e de Extens�o: <b>Paulo Ot�vio Mussi Augusto</b> (Interino)
Pr�-Reitor de Administra��o, Planejamento e Desenvolvimento: <b>Jos� Luiz Casela</b>

Diretoria de P�s-Gradua��o
<b>Nathan Mendes</b>

Diretoria de Pesquisa
<b>Paula Cristina Trevilatto</b>

Coordenadoria de Inicia��o Cient�fica 
<b>Cleybe Hiole Vieira</b>

<b>COMIT� GESTOR</b>
Cesar Candiotto
Cleybe Hiole Vieira
Edvaldo Ant�nio Ribeiro Rosa
F�bio Rueda Faucz
Gezelda Moraes
J�lio C�sar Nievola
Maria Alexandra Viegas Cortez Cunha
Paula Cristina Trevilatto
Renata Ernlund Freitas de Macedo
Roberto Pecoits Filho

<b>COMIT� LOCAL</b>

<b>GRANDE �REA: CI�NCIAS DA VIDA</b>

�rea: Ci�ncias Biol�gicas
Almir Petersen Barreto
Andr�a Novais Moreno
Edvaldo Ant�nio Ribeiro Rosa
F�bio Rueda Faucz
Janete Dubiaski da Silva
Salmo Raskin
Paula Cristina Trevilatto

�rea: Ci�ncias M�dicas e da Sa�de
Ana Maria Trindade Gregio
Beatriz Helena Sottile Fran�a
Carlos Alberto Afonso
Carlos Alberto Mayora Aita
Jos� Rocha Faria Neto
Paulo Henrique Couto
Roberto Pecoits Filho
Rodrigo Rached

�rea: Ci�ncias Agron�micas e Veterin�rias
Airton Rodrigues Pinto J�nior
Cl�udia Turra Pimp�o
Cristina Santos Sotomaior
Renata Ernlund Freitas de Macedo
Ruy In�cio Neiva de Carvalho

<b>GRANDE �REA: CI�NCIAS EXATAS E DA TERRA</b>

�rea: Engenharias e Ci�ncias Matem�ticas
Jo�o Elias Abdalla Filho
Leandro dos Santos Coelho
Luciano Antonio Mendes
Lu�s Mauro Moura
Marcelo Rudek
Munir Ant�nio Gariba
Nilson Barbieri
S�rgio Eduardo Gouvea da Costa
Viviana Cocco Mariani

�rea: Computa��o
Cinthia Obladen de Almendra Freitas
Fabr�cio Enembreck
J�lio C�sar Nievola
Luiz Augusto de Paula Lima J�nior

<b>GRANDE �REA: CI�NCIAS HUMANAS</b>

�rea: Ci�ncias Humanas
Antonio Edmilson Paschoal
Cesar Candiotto
Cl�lia Peretti
Daniel Omar Perez
Dilmeire Sant�Anna Ramos Vosgerau
Joana Paulin Romanowski
Romilda Teodora Ens

<b>GRANDE �REA: CI�NCIAS SOCIAIS APLICADAS</b>
Cl�udia Maria Barbosa
Cl�vis Ultramari
Danielle Anne Pamplona
Harry Alberto Bollmann
Heitor Takashi Kato
Katya Kozicki
Maria Alexandra Viegas Cortez Cunha
Samira Kauchakje

<b>Cardeno do SEMIC</b>
<I>Organizadora</I>
Cleybe Hiola Vieira

<I>Vers�o eletr�nica</I>
Alessandra de Lacerda Carvalho
Edena Maria Beiga Grein
Everton Asm�
Rafael Moreira Calasans
Rene Faustino Gabriel J�nior

<b>Capa</b>
Felipe Machado de Souza

<b>Projeto gr�fico e diagrama��o</b>
Felipe Machado de Souza
</P>
';

if ($LANG == 'en')
{
	$sx = '
<p>
Pontifical Catholic University of Parana�- PUCPR 

<b>Central Administration</b>

Chancellor: Dom Moacyr Jos� Vitti
Chair of the Board of Trustees: Brother Delcio Afonso Balestrin, FMS
Vice-Chair of the Board of Trustees: Brother Ant�nio Benedito de Oliveira, FMS
President: Brother Clemente Ivo Juliatto, FMS
Vice President: Paulo Ot�vio Mussi Augusto
Executive Vice President for Academic Affairs: Eduardo Dami�o da Silva
Executive Vice President for Research and Graduate Studies: Waldemiro Gremski
Executive Vice President for Community Affairs and Extension: M�simo Della Justina
Executive Vice President for Administration and Institutional Development: Jos� Luiz Casela
Director for Research: Paula Cristina Trevilatto 
Director for Graduate Studies: Nathan Mendes
Coordinator for Undergraduate Research: Cleybe Hiole Vieira

<b>Undergraduate Research Committee</b>
Adalgiza de Oliveira
Am�lia do Carmo Sampaio Rossi
C�sar Candiotto
Cleybe Hiole Vieira
Eduardo Agostinho
Edvaldo Ant�nio Ribeiro Rosa
Gezelda Moraes
J�lio C�sar Nievola
Lucia Mazieiro
Maria Alexandra Viegas Cortez Cunha
Mauro Nagashima
Paula Cristina Trevilatto
Paulo Renato Parreira 
Renata Ernlund Freitas de Macedo

<b>Undergraduate Research Committee � Board of Reviewers
Life Sciences:</b>
Almir Petersen Barreto
Ana Maria Trindade Gregio 
Andr�a Novais Moreno
Beatriz Helena Sottile Fran�a 
Carlos Alberto Mayora Aita
Edvaldo Ant�nio Ribeiro Rosa
Janete Dubiaski da Silva
Jos� Rocha Faria Neto 
Paula Cristina Trevilatto
Paulo Henrique Couto
Roberto Pecoits Filho
Rodrigo Rached
Salmo Raskin

<b>Agricultural and Veterinary Sciences</b>
Cl�udia Turra Pimp�o
Cristina Santos Sotomaior
Renata Ernlund Freitas de Macedo
Ruy In�cio Neiva de Carvalho

<b>Exact Sciences and Engineering</b>
Cinthia Obladen de Almendra Freitas
Fabr�cio Enembreck
Jo�o Elias Abdalla Filho
J�lio C�sar Nievola
Leandro dos Santos Coelho
Luciano Antonio Mendes
Lu�s Mauro Moura
Luiz Augusto de Paula Lima J�nior
Marcelo Rudek
Munir Ant�nio Gariba
Nilson Barbieri
S�rgio Eduardo Gouvea da Costa
Viviana Cocco Mariani

<b>Humanities</b>
Antonio Edmilson Paschoal
C�sar Candiotto
Cl�lia Peretti
Daniel Omar Perez
Dilmeire Sant�anna Ramos Vosgerau
Joana Paulin Romanowski
Romilda Teodora Ens

<b>Applied Social Sciences</b>
Cl�udia Maria Barbosa
Cl�vis Ultramari 
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
Everton Asm�
Rafael Moreira Calasans
Rene Faustino Gabriel J�nior

<b>Proofreading</b>
Debora Capella

<b>English translation and revision</b>
Ane Cibele Palma
Carmen Terezinha Koppe
Elis Carrijo Guimar�es Mendon�a
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
$fc->line_1th = 'Semin�rio de Inicia��o Cient�fica (20. : 2012 nov. 6-8 : Curitiba, PR)';
$fc->line_2th = 'Resumos do XXI Semin�rio de Inicia��o Cient�fica [recurso eletr�nico] ; XV Mostra de Pesquisa da P�s-Gradua��o ; XI Semin�rio de Pesquisa Jr ; III PIBITI / organizadora Cleybe Hiole Vieira. - Curitiba : Champagnat, 2013.';
$fc->line_3th = 'V�rios autores.<BR>ISSN 2176-1930';
$fc->ponto_acesso = '1. Ci�ncia - Congressos. 2. Pesquisa � Congressos. I. Vieira, Cleybe Hiole.';
$fc->pistas = 'II.  Mostra de Pesquisa da P�s-Gradua��o (14. : 2012 nov. 6-8 : Curitiba, PR). III. Semin�rio de Pesquisa Jr (10. : 2012 nov. 6-8 : Curitiba, PR). IV. PIBITI (2. : 2012 nov. 6-8 : Curitiba, PR). V. T�tulo.';
//echo $fc->mostra();
*/
echo $site->fecha_secao();

/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
