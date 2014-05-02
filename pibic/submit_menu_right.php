<?
$checklist = False;
/////////////////////////////////////////////////// MANAGERS
$menu = array();
if ($submissao_aberta == true)
	{
	if ($tplogin == 'I')
		{
			array_push($menu,array('Projetos','Submissão de novo projeto','submit_phase_1.php')); 
		} else {
			array_push($menu,array('manuscritos','Submissão de novo manuscrito','submit_phase_1.php')); 
			if ($idioma == "2")
			{
				$menu = array();
				array_push($menu,array('manuscripts','New manuscript submission','submit_phase_1.php')); 
				}
		}
	} else {
		echo '<CENTER><font class="lt3"><font color="#FF8040"><B>SUBMISSÃO DE PROJETOS: ENCERRADO</B></font></font></CENTER>';
	}
?>
<?
$texto = 'SUB_MSG_1';
$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_MSG_1' ";
$sql .= " and nw_idioma = '".$idioma_id."'";
$sql .= " and nw_journal = ".$jid;
$rrr = db_query($sql);
?>
<font class="lt1">
<?
while ($eline = db_read($rrr))
	{
	echo '<H1>'.$eline['nw_titulo'].'</H1>';
	$texto = $eline['nw_descricao'];
	}
	echo mst($texto);

////////////////////////////// PIBIC
if ($tplogin == 'I')
	{
	require("pibic_professor.php");
	}
////////////////////////////////////	
?>
</p>
<table width="100%">
<?


if ($submitok == true)
	{
	if ($checklist == true)
		{	
		for ($k=0;$k < count($menu);$k++)
			{
			echo '<TR><TD><form method="post" action="'.$menu[$k][2].'">';
			echo '<input type="submit" name="bt" value="'.$menu[$k][1].'" style="width=500; height:40">';
			echo '</FORM>';
			}
		} else {
			if ($tituok == True)
				{
				$texto = 'SUB_ERR_2';
				$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_ERR_2' "; // carga horaria invalida
				$sql .= " and nw_idioma = '".$idioma_id."'";
				$sql .= " and nw_journal = ".$jid;
				} else {
				$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_ERR_3' "; // titulacao invalida
				$sql .= " and nw_idioma = '".$idioma_id."'";
				$sql .= " and nw_journal = ".$jid;				
				}
			$rrr = db_query($sql);
			while ($eline = db_read($rrr))
			{ $texto = '<font class="lt3">'.$eline['nw_titulo'].'</font><BR><BR>'; $texto .= $eline['nw_descricao']; }
			echo mst($texto);			
		}
	} else {
		////////////// Justificativa
		$texto = 'SUB_ERR_1';
		$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_ERR_1' ";
		$sql .= " and nw_idioma = '".$idioma_id."'";
		$sql .= " and nw_journal = ".$jid;
		$rrr = db_query($sql);
		while ($eline = db_read($rrr))
		{ $texto = '<font class="lt3">'.$eline['nw_titulo'].'</font><BR><BR>'; $texto .= $eline['nw_descricao']; }
		echo mst($texto);		
	}
?>
</table>
<?
///////////// Mostra projetos abertos
if ($submissao_aberta==true) { require("submit_menu_abertos.php"); }
?>