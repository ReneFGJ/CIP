<?
require("db.php");

    header("Pragma: public"); // required 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Cache-Control: private",false); // required for certain browsers 
    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"fundacao.xls\"");
	
$sx = '<TABLE width="100%" align="center">';
$sx .= '<TR><TD colspan="10" align="center">';
$sx .= 'CHAMADA DE PROJETOS 04/'.$dd[3].' - INICIAÇÃO CIENTÍFICA - '.$dd[4];
$sx .= '<TR><TD colspan="10">Instituição: Pontifícia Universidade Católica do Paraná';
$sx .= '<TR>';
$sx .= '<TD>Pos';
$sx .= '<TD>';
$sx .= 'Nome completo do bolsista';
$sx .= '<TD>';
$sx .= 'Filiação';
$sx .= '<TD>';
$sx .= 'RG';
$sx .= '<TD>';
$sx .= 'CPF';
$sx .= '<TD>';
$sx .= 'Endereço residencial do bolsista';
$sx .= '<TD>';
$sx .= 'e-mail do bolsista';
$sx .= '<TD>';
$sx .= 'telefone bolsista';
$sx .= '<TD>';
$sx .= 'titulo do projeto';
$sx .= '<TD>';
$sx .= 'local de desnevolvimento do projeto';
$sx .= '<TD>';
$sx .= 'nome do orientador';

{
	$id = 0;
	$sql = "select * from pibic_bolsa_contempladas ";
	$sql .= " left join pibic_aluno on pa_cracha = pb_aluno ";
	$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
	$sql .= " where (pb_status <> 'C' and pb_status <> '@') ";
		if (strlen(trim($dd[4])) > 0)
			{ $sql .= " and (pb_ano = '".$dd[4]."') "; }
		if (strlen(trim($dd[2])) > 0)
			{ $sql .= " and (pb_tipo = '".$dd[2]."') "; }
	$sql .= " order by pa_nome ";
		$rlt = db_query($sql);
		if (strlen($dd[2]) > 0) 
			{
			$xsql = "select * from pibic_bolsa_tipo where pbt_codigo = '".$dd[2]."' ";
			$xrlt = db_query($xsql);
			$xline = db_read($xrlt);
			$bolsa = trim($xline['pbt_descricao']);
			}
		echo '<table width="'.$tab_max.'" align="center" border="1" cellpadding="4" cellspacing="0">';
		echo '<TR><TD align="center">Critérios - Ano:'.$dd[4].' <B>'.$bolsa.'</B>';

		echo '<TR valign="top"><TD>';
		$px = 'x';
		while ($line = db_read($rlt))
			{			
			$pp=$line['pa_nome'];
			if ($px != $pp)
				{
				$px = $pp;
				$id++;
				$sx .= '<TR>';
				$sx .= '<TD>'.$id;
				$sx .= '<TD>';
				$sx .= $line['pa_nome'];
				$sx .= '<TD>';
				$sx .= $line['pa_pai'];
				$sx .= ' / '.$line['pa_mae'];
				$sx .= '<TD>';
				$sx .= $line['pa_rg'];
				$sx .= '<TD>';
				$sx .= $line['pa_cpf'];
				$sx .= '<TD>';
				$sx .= $line['pa_endereco'];
				$sx .= '<TD>';
				$sx .= $line['pa_email'];
				
				$sx .= '<TD>';
				$sx .= $line['pa_tel1'];
				$sx .= ' / '.$line['pa_tel2'];
				
				$sx .= '<TD>';
				$sx .= $line['pb_titulo_projeto'];
				
				$sx .= '<TD>PUCPR/';
				$sx .= $line['pa_centro'];
				
				$sx .= '<TD>';
				$sx .= $line['pa_nome'];
				}
			}
		$sx .= '</table>';
		}
	
echo $sx;
?>