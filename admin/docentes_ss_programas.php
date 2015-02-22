<?
require("cab.php");

$sql = "select * from programa_pos_docentes 
			inner join pibic_professor on pp_cracha = pdce_docente
			inner join programa_pos on pdce_programa = pos_codigo
		where pp_ss <> 'S' and  pdce_ativo = '1' 		
		order by pp_nome	
		";
$rlt = db_query($sql);

$sx .= '<table width="100%">';
$sx .= '<TR><TD colspan="10" class="lt4">Professores sem marca��o SS';
$sqlu = '';
$id = 0;
while ($line = db_read($rlt))
{
	$id++;
	$sx .= '<TR>';
	$sx .= '<TD>'.$line['pp_nome'];
	$sx .= '<TD>'.$line['pos_nome'];
	$sx .= '<TD align="center">'.$line['pdce_ano_entrada'];
	
	$sqlu .= "update pibic_professor set pp_ss = 'S' where pp_cracha = '".$line['pp_cracha']."'; ".chr(13);
	
}	
$sx .= '</table>';

/*
 * Marcados como SS sem vinculos aos programas
 * 
 * 
 * 
 */ 

/* Professores sem vinculo SS */
$sql = "select * from pibic_professor 
			left join programa_pos_docentes on pp_cracha = pdce_docente
			left join programa_pos on pdce_programa = pos_codigo and pdce_ativo = 1
		where (pp_ss = 'S') and  (pdce_ativo isnull) and (pp_update <> '".date("Y")."')	
		order by pp_nome	
		";
$rlt = db_query($sql);

$sx .= ' ';
$sx .= '<table width="100%">';
$sx .= '<TR><TD colspan="10" class="lt4">Professores desligados';
while ($line = db_read($rlt))
{
	$id++;
	$sx .= '<TR>';
	$sx .= '<TD>'.$line['pp_nome'];
	$sx .= '<TD>'.$line['pp_ss'];
	$sx .= '<TD>'.$line['pp_update'];
	$sx .= '<TD align="center">'.$line['pdce_anol_entrada'];
	
	$sqlu .= "update pibic_professor set pp_ss = 'N' 
					where pp_cracha = '".$line['pp_cracha']."'; ".chr(13);
	
}	
$sx .= '</table>';

/* Regra dos doutorando */
$sql = "select * from pibic_professor where pp_centro like 'DOUTORAN%' and pp_titulacao <> '011' ";
$rlt = db_query($sql);
$sx .= '<table width="100%">';
$sx .= '<TR><TD colspan="10" class="lt4">Doutorandos com titula��o de doutor';
while ($line = db_read($rlt))
{
	$id++;
	$sx .= '<TR>';
	$sx .= '<TD>'.$line['pp_nome'];
	$sx .= '<TD>'.$line['pp_centro'];
	$sx .= '<TD>'.$line['pp_titulacao'];
	$sx .= '<TD>'.$line['pp_ss'];
	$sx .= '<TD>'.$line['pp_update'];
	$sx .= '<TD align="center">'.$line['pdce_ano_entrada'];
	
	$sqlu .= "update pibic_professor set pp_ativo = 1, pp_titulacao = '011', pp_ss = 'N' ,
					pp_centro = 'DOUTORANDO'
					where pp_cracha = '".$line['pp_cracha']."'; ".chr(13);
	
}	
$sx .= '</table>';
/* Grava */
if (($dd[1]=='1') and (strlen($sqlu) > 0))
	{
		$rlt = db_query($sqlu); 
	}

/*
 * Docentes Demetidos marcados como ativos
 * 
 * 
 * 
 */ 
$sql = "select * from pibic_professor where 
				(pp_ativo = 1 and pp_update <> '".date("Y")."')
				or
				((pp_centro = '' or pp_centro isnull) and (pp_ativo = 1))
				";
$sx .= ' ';
$rlt = db_query($sql);
$sx .= '<table width="100%">';
$sx .= '<TR><TD colspan="10" class="lt4">Professores ativos sem atualiza��o';
while ($line = db_read($rlt))
{
	$id++;
	$sx .= '<TR>';
	$sx .= '<TD>'.$line['pp_nome'];
	$sx .= '<TD>'.$line['pp_ss'];
	$sx .= '<TD>'.$line['pp_update'];
	$sx .= '<TD align="center">'.$line['pdce_ano_entrada'];
	
	$sqlu .= "update pibic_professor set pp_ativo = 0 
					where pp_cracha = '".$line['pp_cracha']."'; ".chr(13);
	
}	
$sx .= '</table>';
/* Grava */
if (($dd[1]=='1') and (strlen($sqlu) > 0))
	{
		$rlt = db_query($sqlu); 
	}

	
if ($id > 0)
	{
		$sx .= '<A HREF="'.page().'?dd1=1">Confirma auto corre��o</A>';
	}

echo $sx;
	
require("../foot.php");		
?> 