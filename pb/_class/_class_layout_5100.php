<?php
/**
 * Layout 5000
 */

 class layout
 	{
 	function menu()
		{
			global $menu;
			$menu = array('about','expediente','submit');
			return($menu);
		} 
 	
	
	function mostrar_ensaio($size=400,$file='IMG_####.jpg',$seq1=0,$seq2=14)
		{
		global $jid;			
			for ($r=$seq1; $r <= $seq2; $r++)
				{
					$img = troca($file,'####',strzero($r,4));
					$img = http.'public/'.$jid.'/images/'.$img;
					$sx .= '<img src="'.$img.'" height="'.$size.'" id="IMG'.$r.'">';
					
					return($sx);
				}
		} 		
	function capa()
		{
			global $pb;
			$sx = $pb->articles_resumo();
			return($sx);
		}
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

					$sx .= '<div class="capas"><center>';
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
	function cab_idiomas()
		{
			global $path,$http;
			//$sx .= '<table>';
			//$sx .= '<TR>';
			//$sx .= '<TD>';
			//$sx .= '<form method="get" action="'.$http.page().'/'.$path.'">';
			//$sx .= '<input type="hidden" name="idioma" value="en_US" />';
			//$sx .= '<input type="image" src="'.$http.'img/img_flag_en_US.png" alt="English" height="15" width="20" title="English" />';
			//$sx .= '</form>';
			
			//$sx .= '<TD>';
			//$sx .= '<form method="get" action="'.$http.page().'/'.$path.'">';
			//$sx .= '<input type="hidden" name="idioma" value="pt_BR" />';
			//$sx .= '<input type="image" src="'.$http.'img/img_flag_pt_BR.png" alt="Portugues" height="15" width="20" title="Português" />';
			//$sx .= '</form>';
			
			//$sx .= '<TD>';
			//$sx .= '<form method="get" action="'.$http.page().'/'.$path.'">';
			//$sx .= '<input type="hidden" name="idioma" value="fr" />';
			//$sx .= '<input type="image" src="'.$http.'img/img_flag_fr.png" alt="Francês" height="15" width="20" title="Frances" />';
			//$sx .= '</form>';
			
			//$sx .= '<TD>';
			//$sx .= '<form method="get" action="'.$http.page().'/'.$path.'">';
			//$sx .= '<input type="hidden" name="idioma" value="es" />';
			//$sx .= '<input type="image" src="'.$http.'img/img_flag_es.png" alt="Espanhol" height="15" width="20" title="Español" />';
			//$sx .= '</form>';						
			//$sx .= '</table>';
						
			return($sx);
		}	
	function foot()
		{
			$sx .= '</div></div>';
			return($sx);
		}
 	function sumario($txt)
		{
			return($txt);
		}
	function cab()
		{
			global $jid, $menu, $pb;
			
			$sx = '';
			$img = http.'public/'.$jid.'/images/homeHeaderLogoImage.png';
			if (!file_exists($img))
				{
					$img = http.'public/'.$jid.'/images/homeHeaderLogoImage.jpg';		
				}			
			/* TOPO */
			$sx .= '<div id="cab">'.chr(13);
			$sx .= '<center>'.chr(13);
			$sx .= '<IMG SRC="'.$img.'" width="870">'.chr(13);
			$sx .= '</div>'.chr(13);
			$sx .= '<center>'.chr(13);
			$sx .= '<div id="content">'.chr(13);
			$menu = $this->menu();
			$sx .= $this->cab_topmenu();
			
			$sx .= $this->cab_idiomas();
			return($sx);
		}
	function cab_topmenu()
		{
			global $menu,$path,$jid,$pb;
			//$jid = $this->jid;
			/* background */
			
			if (strlen($pb->cor_menu) > 0) 
				{ $sxt .= ' style="background-color: '.$pb->cor_menu.';" '; }
			$sx = '<div id="cssmenu" '.$sxt.'>'.chr(13);
			$sx .= '<UL>'.chr(13);
			for ($r=0;$r < count($menu);$r++)
				{
					$link = $path.'?dd99='.lowercasesql($menu[$r]);
					$sx .= '	<LI><A HREF="'.$link.'"><span>';
					$sx .= msg($menu[$r].'_'.strzero($jid,4));
					$sx .= '</span></A></LI>';
					$sx .= chr(13);
				}
			$sx .= '</UL>'.chr(13);
			$sx .= '</div>'.chr(13);
			$sx .= '<center>'.chr(13);
			$sx .= '<div id="content_center">'.chr(13);
			return($sx);
		}

		
 	} 
?>