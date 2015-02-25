<?
global $dd;
require("include/sisdoc_windows.php");
require("include/sisdoc_data.php");
require("include/issues.php");
require('./include/sisdoc_autor.php');


$iss= issue($dd[1],1);

$sql = "select * from articles where id_article = '".$dd[1]."' ";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	
	if ($line['journal_id'] == $jid)
		{
		$formato = 1;
		$AutorFormato = 1;
		
		define(bgborder,"#CCCCCC");
		$id_article = $dd[1];
		{
			$xlink = '<A HREF="?dd1='.$line['id_article'].'&dd99=view" class="lt2">';
			$tit1=trim($line['article_title']);
			$tit2=trim($line['article_2_title']);
			$tit3=TRIM($line['article_3_title']);
			if (strlen($is_max) == 0) { $is_max = '640'; }
			?>
			<P>
			<TABLE width="<?=$is_max?>" border=0 align="center">
			<TR><TD rowspan="20">&nbsp;&nbsp;</TD><TD class="lt3" colspan="2"><?=$tit1;?>
		<?
			if (isset($tit2)) { echo '<P><FONT CLASS="lt2"><I>'.$tit2; } 
			if (isset($tit3)) { echo '<P><FONT CLASS="lt2"><I>'.$tit3; } 
			?></TD></TR>
			<?
			/**** autores ****/
		?>
			<TR><td width="3%">&nbsp;</td><TD class="lt1" width="97%"><I><?
			$nme=$line['article_author'];
			$autor = mst_autor($nme,2);
			echo $autor;
			?>
			</TD></TR>
			<?
			$art_id = $line['id_article'];
			$dt1=$line['article_dt_envio'];
			$dt2=$line['article_dt_aceite'];
			$ab1=$line['article_abstract'];
			$ab2=$line['article_2_abstract'];
			$ab3=$line['article_3_abstract'];
			
			$su1=$line['article_keywords'];
			$su2=$line['article_2_keywords'];
			$su3=$line['article_3_keywords'];
			
			$id1=$line['article_idioma'];
			$id2=$line['article_2_idioma'];
			$id3=$line['article_3_idioma'];
			$t2 = strtolower($path.'.'.$jnid);
			
			if (strlen($ab1) > 0) { $rlt = view000($ab1,'',$su1); }
			if (strlen($ab2) > 0) { $rlt = view000($ab2,'',$su2); }
			if (strlen($ab3) > 0) { $rlt = view000($ab3,'',$su3); }
			}
			?>		
			<TR><TD colspan="3" class="lt0"><P>&nbsp;<P>
			<?
			$autor = mst_autor($nme,3);
			echo $autor;
			?>
			</TD></TR>
			<TR><TD colspan="3"><BR>
			<?=view_envio($dt1,$dt2,$id1,$tit1);?>
			<?=view_envio($dt1,$dt2,$id2,$tit2);?>
			<?=view_envio($dt1,$dt2,$id3,$tit3);?>
			</TD></TR>
			<TR><TD>
			<?
			if (strlen($no_pdf) == 0)
			{
			echo '<A HREF="javascript:newxy('.chr(39).http.'index.php/'.$path.'?dd1='.$dd[1].'&dd99=pdf'.chr(39).',180,20);" title="Format PDF'.chr(13).'click aqui e veja o artigo'.chr(13).'na integra">[pdf]</A>';
			}
			?>
			</TD></TR>
			<TR><TD><P>&nbsp;</P></TD></TR>
			<TR><TD colspan="3" class="lt1" align="left"><I>OAI-ID:</I> oai:<?=$t2.':article/'.$art_id?></TD></TR>		
			<TR><TD colspan="10" class="lt1" align="left"><I>link:</I> <?=http.'index.php/'.$path.'?dd1='.$art_id.'&dd99=view'?></TD></TR>		
			</TABLE>		
			<?
		}
}	
function view_envio($de,$da,$id,$tit)
	{
	if (strlen($tit) > 0)
		{
		$tt1="";
		$rlt="";
		if (substr($id,0,2)=='pt') 
			{
			$rlt = '<DIV width="100%" class="lt0"  align="right">';
			if ($de != '19000101')
				{ $rlt = $rlt . 'Recebido em '.stodbr($de).'; '; }
			if ($da != '19000101')
				{ $rlt = $rlt . 'Aceito em '.stodbr($da).'.'; }
			$rlt = $rlt . '</DIV>';
			}
		if (substr($id,0,2)=='en') 
			{
			$rlt = '<DIV width="100%" class="lt0"  align="right">';
			if ($de != '19000101')
				{ $rlt = $rlt . 'Received in '.stodus($de).'; '; }
			if ($da != '19000101')
				{ $rlt = $rlt . 'Accepted in '.stodus($da).'.</DIV>'; }
			$rlt = $rlt . '</DIV>';
			}
		}
	return($rlt);
	}

function view000($ab,$id,$su)
	{
	if (strlen($ab) > 0)
		{
		$ab = str_replace(chr(13),'&nbsp;<BR>',$ab);
		echo '<TR><TD colspan="2">&nbsp;</TD></TR>';
		echo '<TR class="lt2"><TD colspan="2"><DIV align="justify" class="lta">';
		if (substr($id,0,2)=='pt') {$tt1='Resumo'; $tt2='Palavra chave'; };
		if (substr($id,0,2)=='en') {$tt1='Abstract'; $tt2='Keywords'; };
		if (substr($id,0,2)=='fr') {$tt1='Resume'; $tt2='Words (ver)'; };
		echo '<B>'.$tt1.'</font></B><BR><img src="'.$img_dir.'nada.gif" width="1" height="8" alt="" border="0"><BR>';
		echo $ab;
		echo '</DIV></TD></TR>';
		if (isset($su) and (strlen(trim($su)) > 0))
			{
			echo '<TR><TD class="lta" colspan="2"><BR><B>'.$tt2.' :&nbsp;</B>';
			echo $su;
			echo '</TD></TR>';
			}
		}	
	}
?>