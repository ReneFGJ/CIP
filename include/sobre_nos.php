</CENTER>
<TABLE cellpadding="10" width="<?=$lag_tabela?>" class="lt1">
<?
$sql = "select * from patrocinadores_journal ";
$sql = $sql . "inner join patrocinadores on patrocinadores_id = id_patro ";
$sql = $sql . "where journal_id = ".$jid." and patro_tipo = 'P'"; 
$rlt = db_query($sql);
$ok=0;
while ($line = db_read($rlt))
	{
	if ($ok==0)
		{
		?>
		<TR align="left">
		<TR><TD colspan="20" class="lt3">PATROCINADORES / Sponsors</TD></TR>
		<TR align="center" valign="bottom">
		<?
		$ok = 1;
		}
		echo "<TD>";
		$link = trim($line['patro_link']);
		$img  = trim($line['patro_imagem']);
		$desc = trim($line['patro_descricao']);
		echo '<A HREF="'.$link.'" target="new">';
		if (strlen($img) > 0)
			{
			echo '<img src="'.$img_dir.$img.'" border="0"><BR>';
			}
		echo $desc;
		echo "</A>";
	}
?>
</TABLE>