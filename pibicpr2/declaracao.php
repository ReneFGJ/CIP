<?
    /**
     * P�gina de Busca do Sistema
	 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com> (Analista-Desenvolvedor)
	 * @copyright Copyright (c) 2011, PUCPR
	 * @access public
     * @version v0.11.28
	 * @link http://www.brapci.ufpr.br
	 * @package ModPublico
	 * @subpackage UC0001
     */

require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('Declara��es PIBIC/PIBITI','Inscrito no programa','')); 
	array_push($menu,array('Declara��es PIBIC/PIBITI','Participa��o no programa (anos anteriores)','')); 

	array_push($menu,array('Avaliadores','Avaliador processo de sele��o','')); 
	array_push($menu,array('Avaliadores','Avaliador do SEMIC','')); 
	
	array_push($menu,array('SEMIC','Avaliador do SEMIC','')); 
	array_push($menu,array('SEMIC','Declara��o de participa��o (SEMIC/IC)','declaracao_central.php?tp=1')); 
///////////////////////////////////////////////////// redirecionamento

?>
<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="declaracao.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?
menus($menu,'3');
?>
</TABLE>
<? require("foot.php");	?>