<?php
class posicao
	{
		function show_2($pos,$total,$desc=array(),$pages=array())
			{
				global $dd,$protocolo;
				$sx .= '<link rel="stylesheet" href="'.http.'css/style_cabecalho_passos.css">'.chr(13);
				$sx .= '
				<table id="cabecalho-localizador" border=0 cellpadding=10 cellspacing=0 >
				<tr>
				';
				for ($r=1;$r <= $total;$r++ )
				{
					if (strlen($pages[$r])==0) { $page = page(); }
						else { $page = $pages[$r]; }
					$class3 = "passo-concluido";
					$class2 = "passo-atual";
					$class1 = "passo-fazer";
					if ($r < $pos) { $class = $class3; }
					if ($r == $pos) { $class = $class2; }
					if ($r > $pos) { $class = $class1; }
					
					$link = '<A HREF="'.$page.'?dd0='.$dd[0].'&dd90='.$dd[90].'&dd99='.$dd[99].'&pag='.$r.'" class="passo-numero">';
					//if (strlen($protocolo)==0) { $link = ''; }
					
					$sx .= '<td width="65" align="center" height="65" class="'.$class.'">
					'.$link.'<span class="passo-numero">'.$r.'</span></A>
					</td>
					';
				}
				$sx .= '</table>'.chr(13);
			return($sx);
			}
		function show($pos,$total,$desc=array(),$pages=array())
			{
				global $dd,$protocolo;
				
					$class3 = "passo-concluido";
					$class2 = "passo-atual";
					$class1 = "passo-fazer";				
				
				$sx = '<div class="passo" >';
				for ($r=0;$r < $total;$r++ )
				{
					$rm = ($r+1);
					if (strlen($pages[$r])==0) { $page = page(); }
						else { $page = $pages[$r]; }
					if ($rm < $pos) { $class = $class3; }
					if ($rm == $pos) { $class = $class2; }
					if ($rm > $pos) { $class = $class1; }
					$link = '<A HREF="'.$page.'" class="passo-numero">';
					
					if ($pos >= $total) { $link = ''; }
					
					//if (strlen($protocolo)==0) { $link = ''; }
					$sx .= '<div class="'.$class.'">
					'.$link.'<span class="passo-numero">'.($rm).'</span></A>
					
					</div>
					';
				}
				$sx .= '</div>'.chr(13).chr(10);
				$sx .= '<div class="passo-texto">
						'.msg('position_'.$pos).'
						</div>';
			return($sx);
			}			
	}
?>