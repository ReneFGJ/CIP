<?php
require("cab.php");
require($include.'sisdoc_lattes.php');
require("../_class/_class_pareceristas_limbo.php");

$msg = '../messages/msg_'.page();
if (file_exists($msg)) { require($msg); } else { echo 'Erro: mensagens.'; }
$lattes = new lattes;
$limbo = new avaliador_limbo;
?>
<style>
	.it1 
	{
	font-weight: bolder;
	font-size: 13px;		
	}
</style>
<?

if (strlen($dd[1])==0)
{
	$sx = '';
	$sx .= '<table width=800 align=center>';
	$sx .= '<TR><TD align=center class=lt4>Cadastro de Parecerista';
	$sx .= '<TR class="lt1"><TD>Metodologia: Será cadastrado o link do curriculo lattes do parecerista, bem como sua área de atuação conforme tabela do CNPq. ';
	$sx .= 'Estes dados devem ser inseridos nos campos abaixo fazendo com que o sistema cadastre em um "limbo" gerando um código de controle será informado após o cadastro. ';
	$sx .= 'O número de controle deverá ser enviado conjuntamente no e-mail convite (diretamente na plataforma Lattes) com uma mensagem personalizada o convidando para ser parecerista. ';
	$sx .= 'Após o envio do e-mail é necessário aguardar o e-mail do parecerista com a resposta, para que se possa ativá-lo e enviar novamente para seu e-mail um link para que possa selecionar as áreas de avaliação.';
	$sx .= '<TR><TD><BR><BR>';
	$sx .= '<form method="post" action="'.page().'">';
	$sx .= '<font class="lt1">link do lattes</font>';
	$sx .= '<BR>	<font class="lt0">(ex:http://buscatextual.cnpq.br/buscatextual/visualizacv.do?metodo=apresentar&id=K4791249J9)</font>';
	$sx .= '<BR>';
	$sx .= '<input type="text" name="dd1" size="100">';
	$sx .= '<BR>';
	$sx .= '<BR>';
	$sx .= 'aréa do conhecimento';
	$sx .= '<BR>';

/* areas do conhecimento */
	$sx .= '<select name="dd2">'.$cr;
	
	$sql = "select * from ajax_areadoconhecimento ";
	$sql .= " where not ((a_cnpq like '%X%') or (a_cnpq like '%X%'))";
	$sql .= " and (a_semic = 1) and (a_cnpq like '%.00-%')";
	$sql .= " order by a_cnpq";
	$rlt = db_query($sql);
	/* Mostra os idiomas disponï¿½veis */
	$xarea = '';
	while ($line = db_read($rlt))
		{
			$sel = '';
			$area = substr(trim($line['a_cnpq']),0,4);
			if (substr($area,1,1)=='.')
			{
				$vlr = trim($line['a_cnpq']);
				if ($dd[2] == trim($line['a_cnpq'])) { $sel = 'selected'; }				
				if ($xarea != $area)
					{
						//$dsb = 'disabled';
						if (substr($area,2,2) != '00') { $style = 'it1'; $dsb = ''; }
						$sx .= '<option value="'.trim($vlr).'" class="'.$style.'" '.$dsb.' '.$sel.' >';
						$sx .= trim($line['a_cnpq']).' '.substr(trim($line['a_descricao']),0,40);
						$sx .= '</option>';
						$xarea = $area;			
					}  else {
						$sx .= '<option class="it2" value="'.$line['a_cnpq'].'" '.$sel.'>';
						$sx .= trim($line['a_cnpq']).' '.(substr(trim($line['a_descricao']),0,40));
						$sx .= '</option>';
					}
			}			
		}
	$sx .= '</select>'.$cr;
	
	echo '<BR>';	
	$sx .= '<BR><input type="submit" value="enviar >>>">';
	$sx .= '</form>';
	$sx .= '</table>';
	echo $sx;
} else {
	$link = $dd[1];
	//$lattes->structure();
	$s = $lattes->inport($link);
	//$limbo->structure();
	$limbo->area=$dd[2];
	$limbo->link=$lattes->link;
	$limbo->nome=$lattes->pesquisador;
	$limbo->mensagem();
	
	echo '<table width=500 align=center >';
	echo '<TR>';
	echo '<TD>';
	echo 'Preozado(a), '.$limbo->nome;
	echo msg('texto_parecerista');
	echo '<BR><BR>';
	echo '[MSG:'.$limbo->codigo.']';
	echo '</table>';
}


?>

