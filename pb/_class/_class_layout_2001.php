<?php
class layout
	{
	var $capa = 1;
	
	function issues($jid=0)
		{
			global $path;
			$issue = new issue;
			$rn = $issue->publication_list($jid);
			
			for ($r=0;$r < count($rn);$r++)
				{
					$line = $rn[$r];
					$capa = trim($line['issue_capa']);					
					$link = '<A HREF="'.http.'pb/index.php/'.$path.'?dd99=issue&dd0='.$line['id_issue'].'">';

					$sx .= '<div class="capas" >xx<center>';
					$sx .= $link;
					if (strlen($capa) > 0)
						{ $capa = '<img src="'.http.'public/'.$jid.'/capas/'.$capa.'" height="140" border=0><BR>';	}
					
					$sx .= $capa;
					$sx .= '</A>';
					$sx .= 'v.'.trim($line['issue_volume']);
					$sx .= ', n.'.trim($line['issue_number']);
					$sx .= ', '.trim($line['issue_year']);
					$sx .= '</div>';
				}
			return($sx);
		}
	
	function sumario($sx)
		{
			global $sm;
			
			$sr = '<div>';
			$sr .= '<div style="float: left; width: 200px;">';
			$sr .= '<h6>SUMÁRIO</h6>';
			$sr .= '<BR><BR>';
			$sr .= '<img src="'.$sm->capa.'" width="150">';
			$sr .= '</div>';
			$sr .= '<div style="float: left; width: 550px;">';
			$sr .= $sx;
			$sr .= '</div>';
			return($sr);
		}
	
	function cab()
		{
			global $jid,$pb,$menu;
			$sx = '';
			$img = http.'public/'.$jid.'/images/homeHeaderLogoImage.png';
			/* TOPO */
			$sx .= '<style>
						#cab
						{
						background-image: url('.$img.');
						width:870px;
						height: 163px;
						left: 50%;
						position: relative;
						margin-left: -430px;	
						}
					</style>
			';
				
			
			$sx .= '<div id="cab">'.chr(13);
				$sx .= '<div id="top_menu">';
				$sx .= $this->topmenu();
				$sx .= '</div>';
			
				$sx .= '<div id="issn">';
				$sx .= 'ISSN: '.$pb->issn;
				$sx .= '</div>';

				$sx .= '<div id="peerreview">';
				$sx .= '<I>PEER REVIEW</I>';
				$sx .= '</div>';

			$sx .= '</div>'.chr(13);
			$sx .= '<center>'.chr(13);
			
			$sx .= '<div id="content">'.chr(13);	
			
			return($sx);
		}
		
	function call_of_paper()
		{
			
		}
	function mostrar_ensaio($size=400,$file='IMG_####.jpg',$seq1=0,$seq2=14)
		{
			$sx .= '<BR><center>'.chr(13);
			$sx .= '<script language="JavaScript" src="'.http.'pb/js/jcycle.js" type="text/javascript"></script>'.chr(13);
			$sx .= '<script language="JavaScript" type="text/javascript">
    					$(function() {
        					$(\'#slideShow\').cycle({ fx: \'fade\' });
    					});
  					</script>';	
			$sx .= '<div>';
			$sx .= '<div id="slideShow"  '.$style.' style="float: left">'.chr(13);
			for ($r=$seq1; $r <= $seq2; $r++)
				{
					global $jid;
					$img = troca($file,'####',strzero($r,4));
					$img = http.'public/'.$jid.'/images/'.$img;
					$sx .= '<img src="'.$img.'" height="'.$size.'" '.$style.'>'.chr(13);					
				}
			
			$sx .= '</div>'.chr(13);
			$sx .= '<div style="float: right">'.chr(13);
					$img = troca($file,'####','000A');
					$img = http.'public/'.$jid.'/images/'.$img;
					$sx .= '<img src="'.$img.'" height="'.$size.'" '.$style.'>'.chr(13);								
			$sx .= '</div>'.chr(13);
			$sx .= '</div>'.chr(13);
			$sx .= '<BR>Fonte: Melvin Quaresma (2013)';
			$sx .= '</center>';
			return($sx);			
		}
	function capa()
		{
			global $jid,$pb,$path;
			
			/* DIV 01 */
			$link01 = 'onclick="window.location.href = \''.http.'pb/index.php/'.$path.'?dd99=actual\';" ';
			$div01 = '
			<div class="texto">
			<div class="direita"><font color="#FFFFFF"><B>'.msg('mais').' [+]'.'</B></font></div>
			</div>';
			
			/* DIV 03 */
			$div03 = '
			<div class="texto">
				<div class="direita"><font color="#FFFFFF"><B>'.msg('author_'.strzero($jid,4)).' [+]'.'</B></font></div>
				<BR>
				<B>INSTRUÇÕES</B><BR>
			</div>
			';
			
			/* DIV 04 */
			$link04 = 'onclick="window.location.href = \''.http.'pb/index.php/'.$path.'?dd99=about\';" ';
			$div04 = '
			<div class="texto">
			<div class="direita"><font color="#000000"><B>'.msg('about_'.strzero($jid,4)).' [+]'.'</B></font></div>
			<center><img src="'.http.'public/'.$jid.'/images/menu_icone_01.png"></center>
			'.msg('texto_01_'.strzero($jid,4)).'
			</div>';
			
			/* DIV 05 */
			$link05 = 'onclick="window.location.href = \''.http.'pb/index.php/'.$path.'?dd99=issues\';" ';
			$div05 = '
			<div class="texto">
			<div class="direita"><font color="#000000"><B>'.msg('issues_'.strzero($jid,4)).' [+]'.'</B></font></div>
			<center><img src="'.http.'public/'.$jid.'/images/menu_icone_02.png"></center>
			'.msg('texto_02_'.strzero($jid,4)).'
			</div>';
			
			/* DIV 05 */
			$div06 = '
			<div class="texto">
			<div class="direita">'.$pb->creative_commons().'<BR>
			'.$pb->idiomas().'
			</div></div>';			

			$sx = '
			<div id="capa">
				<div id="content01">
					<div id="ladri_01" '.$link01.'>'.$div01.'</div>
					<div id="ladri_02">&nbsp;</div>
					<div id="ladri_03">'.$div03.'</div>
				</div>
				<div id="content02">
					<div id="ladri_06" '.$link06.'>'.$div06.'</div>
					<div id="ladri_04" '.$link04.'>'.$div04.'</div>
					<div id="ladri_05" '.$link05.'>'.$div05.'</div>
				</div>
			</div>
			<center><img src="'.http.'public/'.$jid.'/images/ladrilho_00.png"></center>
			';
			return($sx);
		}
	function topmenu()
		{
			global $pb,$menu,$jid;
			$sx = '<nav id="topmenu"><UL>';
			for ($r=0;$r < count($menu);$r++)
				{
					$link = $path.'?dd99='.lowercasesql($menu[$r]);
					$sx .= '<LI><A HREF="'.$link.'"><span>'.chr(13);
					$sx .= msg($menu[$r].'_'.strzero($jid,4)).chr(13);
					$sx .= '</span></A></LI>'.chr(13);
					$sx .= chr(13);
				}
			$sx .= '</UL></nav>';
			return($sx);
		}
	function foot()
		{
			
		}
	}
?>
