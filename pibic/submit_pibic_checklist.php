<?
$check = array();
array_push($check,array('1','Professor - mestre ou doutor'));
array_push($check,array('1','Professor - carga horária igual ou > 15h semanais'));
//array_push($check,array('1','Professor - currículo lattes'));
//array_push($check,array('1','Professor - membro de grupo de pesquisa'));

//array_push($check,array('1','Aluno - regularmente matriculado'));

//array_push($check,array('1','Um aluno para cada plano de trabalho'));

/////////////////////////////// ARWUIVO
if ($fl1 == true)
	{ array_push($check,array('1','Arquivos - projeto de pesquisa do professor')); } 
	else { array_push($check,array('0','Arquivos - projeto de pesquisa do professor'));	}
	
///////////////////////////////////////// PIBIC (Arquivos)	
if ($projeto_aluno == true) 
	{
		if ($fl2 == true)
			{ array_push($check,array('1','Arquivos - plano de trabalho PIBIC')); } 
			else { array_push($check,array('0','Arquivos - plano de trabalho PIBIC'));	}
	}	
///////////////////////////////////////// PIBIC JR (Arquivos)
if ($projeto_jr == true) 
		{
		if ($fl3 == true)
			{ array_push($check,array('1','Arquivos - plano de trabalho PIBIC Jr.')); } 
			else { array_push($check,array('0','Arquivos - plano de trabalho PIBIC Jr.'));	}
		}

/////////////////////////////// Área do conhecimento
$op1 = '1'; $op2 = '1';
if (substr($area1,0,1) == '0') { $op1 = '0'; $nerr++; }
if (substr($area2,2,2) == '00') { $op2 = '0'; $nerr++; }
array_push($check,array($op1,'Área do conhecimento - projeto do professor (principal) '.substr($area1,0,1)));
array_push($check,array($op2,'Área do conhecimento - projeto do professor (específica) '.substr($area2,2,2)));

////////////////////////////// Áreas Correlatas
$area_1 = substr($area1,0,4);
$area_2 = substr($area2,0,4);
if ($area_1 != $area_2)
	{
		array_push($check,array(0,'Área do conhecimento (específica) não é relacionada a área (principal) '));
	} else {
		array_push($check,array(1,'Área do conhecimento (específica) é relacionada a área (principal) '));
	}
	

$st = '<TABLE width="'.$tab_max.'" class="lt2" border=0>';
$st .= '<TR><TD background="silver" colspan="2" class="lt4">Check-List</TD></TR>';

for ($chk = 0;$chk < count($check);$chk++)
	{
	$st .= '<TR>';
	$st .= '<TD width="10">';
	$c1 = $check[$chk][0];
	$c2 = $check[$chk][1];
	if ($c1 == '1')
		{ $ci = 'img/icone_check.jpg'; } else
		{ $ci = 'img/icone_nocheck.jpg'; } 
	$st .= '<img src="'.$ci.'" height="16" alt="" border="0">';
	$st .= '<TD>';
	$st .= $c2;
	$st .= '</TR>';
	}
$st .= '</TABLE>';
?>

