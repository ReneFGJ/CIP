<?php
require ("cab.php");
require ("../_class/_class_docentes.php");

global $acao, $dd, $cp, $tabela;
require ($include . 'cp2_gravar.php');
require ($include . 'sisdoc_colunas.php');
require ($include . 'sisdoc_debug.php');
require ($include . 'sisdoc_form2.php');

$cl = new docentes;
$cp = $cl -> cp_blacklist();
$tabela = $cl -> tabela;
$http_edit = page();
$http_redirect = '';
$tit = msg("docente");

/** Comandos de Edi��o */
echo '<div id="content">';
echo '<CENTER><font class=lt5>Penalidades</font></CENTER>';
echo '<TABLE width="<?=$tab_max; ?>" align="center" bgcolor="<?=$tab_color; ?>"><TR><TD>';
editar();
echo '</TD></TR></TABLE>';
?>

<UL class="lt1">
<LI class="lt4">Relat�rio Parcial
<UL class="lt2">
<LI>Atraso na submiss�o do relat�rio parcial, com solicita��o de envio fora do prazo, com parecer favor�vel do Comit� Gestor para entrega da documenta��o - penalidade de cinco (5) pontos no processo de sele��o do pr�ximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>Atraso na submiss�o do relat�rio parcial com indeferimento do Comit� Gestor para entrega da documenta��o em atraso acarreta em cancelamento do projeto, n�o emiss�o de declara��o de participa��o no Programa e penalidade de dez (10) pontos. PROTOCOLO xxxxxxxxx</LI>
<LI>Atraso na submiss�o do relat�rio parcial, sem manifesta��o do professor, projeto cancelado, penalidade de 15 pontos. PROTOCOLO xxxxxxxxx</LI>
</UL>
</LI>

<LI class="lt4">Relat�rio Final</LI>
<UL>
<LI>Atraso na submiss�o do relat�rio final, com solicita��o de envio fora do prazo, com parecer favor�vel do Comit� Gestor para entrega da documenta��o -  penalidade de cinco (5) pontos no processo de sele��o do pr�ximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>Atraso na submiss�o do relat�rio final com indeferimento do Comit� Gestor para entrega da documenta��o em atraso acarreta em cancelamento do projeto, n�o emiss�o de declara��o de participa��o no Programa e penalidade de dez (10) pontos. PROTOCOLO xxxxxxxxx</LI>
<LI>Atraso na submiss�o do relat�rio final e resumo, sem manifesta��o do professor, penalidade: impossibilidade de participar no edital seguinte. PROTOCOLO xxxxxxxxx</LI>
</UL>

<LI class="lt4">SEMIC
<UL  class="lt2">
<LI>A aus�ncia do professor orientador em qualquer uma das etapas do SEMIC, sem justificativa aceita pelo Comit� Gestor, PENALIDADE: impedimento de inscri��o no edital subsequente. PROTOCOLO xxxxxxxxx</LI>
</UL>
</LI>
<LI class="lt4">Outros</LI>
<UL class="lt2">
<LI>Solicita��o de cancelamento de projeto pelo professor. Deferimento do comit� gestor deferimento com penalidade de 15 pontos para o pr�ximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>O professor orientador n�o cumpriu com suas atividades de avaliador de projetos na etapa da submiss�o, sem justificativa, penalidade de 05 pontos no pr�ximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>O professor orientador n�o cumpriu com suas atividades de avaliador de relat�rio parcial, sem justificativa, penalidade de 05 pontos no pr�ximo edital. PROTOCOLO xxxxxxxxx</LI>
<LI>O professor orientador n�o cumpriu com suas atividades de avaliador de relat�rio final, sem justificativa, penalidade de 05 pontos no pr�ximo edital. PROTOCOLO xxxxxxxxx</LI>
</UL>
</UL>
<BR><BR><BR><BR><BR><BR><BR><BR>
<?

/** Caso o registro seja validado */
if ($saved > 0) {
	redirecina('docente.php?dd0=' . $dd[0]);
}
echo '</div>';	
require ("../foot.php");
?>
