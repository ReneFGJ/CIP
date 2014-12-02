<?php
$cpf = $dd[12];
$cpf = troca($cpf,'.','');
$cpf = troca($cpf,'-','');

if (strlen($cpf) > 0)
{
$cpf = strzero($cpf, 11);

		$sql = "select * from semic_ouvinte_cadastro where sc_cpf = '$cpf' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			$nome = trim($line['sc_nome']);
			$cpf = trim($line['sc_cpf']);
			$instituicao = trim($line['sc_instituicao']);
			$idc = $line['id_sc'];
		}

		if (strlen($nome.$nome2) > 0) {
			$sql = "select * from semic_ouvinte where sm_nome = '$nome'";
			$rlt = db_query($sql);
			$tot1 = 0;
			$tot2 = 0;	
			while ($line = db_read($rlt))
				{
					$cracha = $line['id_sm'];
					$tipo = trim($line['sm_tipo']);
					if ($tipo == 'E') { $tot1++; }
					if ($tipo == 'S') { $tot2++; }
				}
			if (($tot1 + $tot2) > 0)
				{
					$sx .= '<table class="tabela01" align="center" width="790">';
					$sx .= '<TR><TD>'.$nome;
					$sx .= '<TR><TD>Total de apresentação assistidas '.$tot1;
					if ($tot2 > 0)
						{
							$sx .= '<TR><TD>Saídas antecipadas '.$tot2;
						}
					$sx .= '</table>';
					echo $sx;
				}
			if ((($tot1 + $tot2) >= 4) or ($dd[1]=='FREE'))
				{
					$link = '<A HREF="http://www2.pucpr.br/reol/eventos/cicpg/declaracao_ouvinte.php?dd0='.$idc.'&dd90='.md5($idc.'2014').'" 
							class="botao_certificado" target="_new"
					>';
					$link .= 'Imprimir declaração de ouvinte';
					$link .= '</A>';
					$tela = $link.$tela;							
				} else {
					$tela = '<font color="red">Não cumpriu carga horária mínima para emissão de declaração de participação</font>'.$tela;
				}
		
		}
		//} else {
		//echo $tela;
		//echo '<font color="red">CPF Incorreto</font>';
}
?>