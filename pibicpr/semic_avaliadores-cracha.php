<?php
require("cab.php");

				$c = 'us';
				$c1 = 'id_'.$c;
				$c2 = $c.'_codigo_id';
				$c3 = 7;
				$sql = "update pareceristas set $c2 = lpad($c1,$c3,0) where $c2='' ";
				if ($base=='pgsql') { $sql = "update pareceristas set $c2 = trim(to_char(id_".$c.",'".strzero(0,$c3)."')) where $c2=''  or ".$c2." isnull"; }
				$rlt = db_query($sql);


$sql = "select id_us, us_nome, us_nome_asc, us_cnpq from pibic_semic_avaliador 
		left join pareceristas on psa_p01 = us_codigo_id
		where ((psa_p05 = 'SEMIC21') or (psa_p05 = 'MP15'))
		group by id_us, us_nome,us_nome_asc, us_cnpq
		order by us_nome_asc ";
$rlt = db_query($sql);

$tot = 0;
while ($line = db_read($rlt))
	{
		$tot++;
		$codigo = trim($line['id_us']);
		$cod = strzero($codigo,11);
		$dv = cpf_calc(strzero($codigo,9));
		$codigo .= '-'.$dv;
		$nome = UpperCase($line['us_nome']);
		
		if (strlen($nome) > 20)
			{
				$nome = substr($nome,0,20);
				$ok = 1;
				while ((strlen($nome) > 5) and ($ok == 1))
					{
						$nome = substr($nome,0,strlen($nome)-1);
						$nn = substr($nome,strlen($nome)-1,1);
						if ($nn == ' ') { $ok = 0; }
					}			
			}
		
		echo $nome.'<BR>';
		echo 'AVALIADOR';
		if ($line['us_cnpq']=='1') { echo ' - CNPq'; }
		echo '<BR>';
		echo 'COD: '.$codigo;
		echo '<BR>';
	}
	echo '<BR><BR>'.$tot;
	
function cpf_calc($cpf)
	{
		$cpf = strzero($cpf,9);
		for ($r=0;$r <=99;$r++)
			{
				//echo '<BR>'.$cpf.strzero($r,2);
				if (cpf($cpf.strzero($r,2)))
					{
						return(strzero($r,2));
						$r=100;
						
					}
				
			}
	}
	
function cpf($cpf)
	{
	$cpf = sonumero($cpf);
	if (strlen($cpf) <> 11) { return(false); } 
	
	$soma1 = ($cpf[0] * 10) + ($cpf[1] * 9) + ($cpf[2] * 8) + ($cpf[3] * 7) + 
			 ($cpf[4] * 6) + ($cpf[5] * 5) + ($cpf[6] * 4) + ($cpf[7] * 3) + 
			 ($cpf[8] * 2); 
	$resto = $soma1 % 11; 
	$digito1 = $resto < 2 ? 0 : 11 - $resto; 
	
	$soma2 = ($cpf[0] * 11) + ($cpf[1] * 10) + ($cpf[2] * 9) + 
			 ($cpf[3] * 8) + ($cpf[4] * 7) + ($cpf[5] * 6) + 
			 ($cpf[6] * 5) + ($cpf[7] * 4) + ($cpf[8] * 3) + 
			 ($cpf[9] * 2); 
			 
	$resto = $soma2 % 11; 
	$digito2 = $resto < 2 ? 0 : 11 - $resto;

	if (($cpf[9] == $digito1) and ($cpf[10] == $digito2))
		{ return(true); } else
		{ return(false); }
	}	

?>
