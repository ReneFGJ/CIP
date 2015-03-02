<?
require("cab_pibic.php");

require("../_class/_class_pibic_bolsa_contempladas.php");

if (strlen($acao) > 0)
	{
		$tipo = trim($dd[1]);
		$proto = trim($dd[2]);
		$check = trim($dd[3]);
		
		if ($check == checkpost($proto))
			{
				$_SESSION['ic_protocolo'] = $proto;
				redireciona($http.'protocolo/protocolo_abrir_'.$tipo.'.php');
				exit;				
			}
	}

$b1 = 'Avançar >>>';

$pb = new pibic_bolsa_contempladas;

echo '<h1>'.msg('protocolo_'.$dd[1]).'</h1>';

$professor = trim($nw->user_cracha);

$sql = "select * from ".$pb->tabela." 
			inner join pibic_aluno on pb_aluno = pa_cracha
			inner join pibic_professor on pb_professor = pp_cracha
			inner join pibic_bolsa_tipo on pb_tipo = pbt_codigo
			left join ajax_areadoconhecimento on pb_semic_area = a_cnpq
			where pbt_edital <> 'CSF'
			and pb_professor = '".$professor."' 
			and pb_status = 'A'
			and (a_ativo = '1' or a_semic = '1') 
			";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
		$proto = trim($line['pb_protocolo']);
		
		$sx .= '<form method="post" action="'.page().'">';
		$sx .= '<input type="hidden" name="dd1" value="'.$dd[1].'">';
				
		$sx .= '<TR valign="top">';
//		$sx .= '<TD width="99%">';
		$sx .= $pb->mostra_registro($line);
		
		$sx .= '<TD>';
		$sx .= '<input type="hidden" name="dd2" value="'.$proto.'">';
		$sx .= '<input type="hidden" name="dd3" value="'.checkpost($proto).'">';		
		$sx .= '<TD colspan=5>';
		$sx .= '<input type="submit" name="acao" value="Solicitar alterar desse protocolo >>>">';
		$sx .= '</form>';
	}
echo '<table width="100%" class="tabela00" border=0 >'.$sx.'</table>';
echo '</form>';

echo '<BR><BR><BR><BR><BR><BR><BR>';

echo '</div></div>';
echo $hd->foot();
?>