<?php
/**
 * Layout 5001
 */

 class layout
 	{
 		
	function menus()
		{
			$sx = '222';
			return($sx);
		}
 	
	function cab()
		{
			global $jid,$pb,$menu;
			$sx = '';
			$img = http.'public/'.$jid.'/images/homeHeaderLogoImage.png';
			/* TOPO */
			$sx .= '<div id="cab">'.chr(13);
			
			$sx .= '<center>';
			$sx .= '<div id="logo_top" style="width: 870px; text-align: center;">';
			
			$sx .= '<div id="top_menu">';
			$sx .= $this->topmenu();
			$sx .= '</div>';
			
			$sx .= '<div id="issn">';
			$sx .= 'ISSN: '.$pb->issn;
			$sx .= '</div>';
			
			$sx .= '<center>'.chr(13);
			$sx .= '<IMG SRC="'.$img.'" width="870">'.chr(13);
			$sx .= '</div>'.chr(13);
			$sx .= '</div>'.chr(13);
			$sx .= '<center>'.chr(13);
			
			$sx .= '<div id="content">'.chr(13);
			
			
			return($sx);			
		}
	function topmenu()
		{
			global $pb,$menu,$jid;
			$sx = '<nav id="topmenu"><UL>';
			for ($r=0;$r < count($menu);$r++)
				{
					$link = $path.'?dd99='.lowercasesql($menu[$r]);
					$sx .= '	<LI><A HREF="'.$link.'"><span>';
					$sx .= msg($menu[$r].'_'.strzero($jid,4));
					$sx .= '</span></A></LI>';
					$sx .= chr(13);
				}
			$sx .= '</UL></nav>';
			return($sx);
		}
	function about()
		{
			global $jid;
			$sx = '<table align="center" cellspacing=10>';
			$sx .= '<TR>';
			$sx .= '<TD colspan=2 rowspan=2><Img src="'.http.'public/'.$jid.'/images/ladrilho_01.png">';
			$sx .= '<TD>&nbsp;';
			$sx .= '<TD>&nbsp;';
			
			$sx .= '<TR >';
			$sx .= '<TD valign="bottom" rowspan=2><Img src="'.http.'public/'.$jid.'/images/ladrilho_04.png">';
			$sx .= '<TD valign="bottom" rowspan=2><Img src="'.http.'public/'.$jid.'/images/ladrilho_04.png">';
			$sx .= '<TD valign="bottom" rowspan=2><Img src="'.http.'public/'.$jid.'/images/ladrilho_04.png">';
			
			$sx .= '<TR>';
			$sx .= '<TD align="right" colspan=2><Img src="'.http.'public/'.$jid.'/images/ladrilho_07.png">';
			
			$sx .= '<TR align="center">';
			$sx .= '<TD colspan=5><Img src="'.http.'public/'.$jid.'/images/ladrilho_00.png">';
			$sx .= '<TR valign="top">';
			$sx .= '<TD><Img src="'.http.'public/'.$jid.'/images/ladrilho_08.png">';
			$sx .= '<TD><Img src="'.http.'public/'.$jid.'/images/ladrilho_05.png">';
			$sx .= '<TD><Img src="'.http.'public/'.$jid.'/images/ladrilho_06.png">';
			$sx .= '<TD  valign="top"><Img src="'.http.'public/'.$jid.'/images/ladrilho_07.png">';
			$sx .= '</table>';
			return($sx);
		}
		
 	} 
?>