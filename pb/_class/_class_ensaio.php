<?php
class ensaio
	{
	function mostrar($size=400,$file='IMG_####.jpg',$seq1=0,$seq2=14)
		{
			for ($r=$seq1; $r <= $seq2; $r++)
				{
					global $jid;
					$img = troca($file,'####',strzero($r,4));
					$img = http.'public/'.$jid.'/images/'.$img;
					$sx .= '<img src="'.$img.'" height="'.$size.'" id="IMG'.$r.'">';
					
					return($sx);
				}
			
			
		}	
	}
?>
