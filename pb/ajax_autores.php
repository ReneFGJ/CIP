<?php
$include = '../';
require("../db.php");

$protocolo = $dd[1];

$aut = array();
array_push($aut,array('Rene Faustino Gabriel Junior','Msc','Pontifícia Universidade Católica do Paraná',
						'Pró-Reitoria de Pesquisa e Pós-Graduação','PUCPR',
						'renefgj@gmail.com','Curitiba','Paraná','Brasil',
						'Doutorando do Curso de Ciência da Informação na UNESP de Marília. Meste em Ciência Gestão e Tecnologia da Informação pela UFPR e Graduado em Biblioteconomia pela PUCPR.',
						1						
						));
array_push($aut,array('Rene Faustino Gabriel Junior','Msc','Pontifícia Universidade Católica do Paraná',
						'Pró-Reitoria de Pesquisa e Pós-Graduação','PUCPR',
						'renefgj@gmail.com','Curitiba','Paraná','Brasil',
						'Doutorando do Curso de Ciência da Informação na UNESP de Marília. Meste em Ciência Gestão e Tecnologia da Informação pela UFPR e Graduado em Biblioteconomia pela PUCPR.',
						2
						));
$sx = '<table border=0 class="tabela00" width="100%" cellpadding=2 cellspacing=0>';
for ($r=0;$r < count($aut);$r++)
	{
		$id = $aut[$r][10];
		$sx .= '<TR valign="top">';
		$sx .= '<TD width="40"><font style="font-size: 30px">'.($r+1).'</font>';
		
		$sx .= '<TD class="lt2">';
		$sx .= '<div style="border:1px solid; padding: 4px; "> ';
		$sx .= $aut[$r][1];
		$sx .= ' <B>'.$aut[$r][0].'</B>';
			
		$sx .= chr(13).'<BR>';
		$sx .= '<font class="lt0">'.$aut[$r][2];
		$sx .= ' ('.$aut[$r][4].')';
		$sx .= ' - <I>'.$aut[$r][3].'</I>';		

		$sx .= ' - ';
		$sx .= ''.$aut[$r][6];
		$sx .= ', '.$aut[$r][7];
		$sx .= ', '.$aut[$r][8];		
		
		$sx .= '<BR>'.$aut[$r][9];
		$sx .= '<BR><B>e-mail</B>: '.$aut[$r][5];
		$sx .= '</font>';
		
		$sx .= '<BR>';
		$sx .= '<input type="button" id="nwa" value="'.('delete_autor').'" onclick="delautor('.$id.');" class="botao-geral">';
		$sx .= '&nbsp;|&nbsp;';
		$sx .= '<input type="button" id="nwa" value="'.('edit_autor').'" onclick="editautor('.$id.');" class="botao-geral">';
		$sx .= '</td></TR>';		

	}
$sx .= '<TR><TD><TD>';
$sx .= '<BR><BR>';
$sx .= '<input type="button" id="nwa" value="'.('new_autor').'" onclick="newautor();" class="botao-geral">';

$sx .= '</table>

<script>
	function newautor()
		{
			alert("NOVO AUTOR '.$protocolo.'");
		}
	function delautor(id)
		{
			alert("DELETAR AUTOR '.$protocolo.'");
		}
	function editautor(id)
		{
			alert("ALTERAR AUTOR '.$protocolo.'");
		}		
</script>

';

/* Novo autor */


echo $sx;
?>

	
