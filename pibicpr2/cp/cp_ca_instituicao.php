<?
$tb = 'select cidade_codigo, trim(cidade_nome) || chr(32) || chr(45) || chr(32) || estado_nome as cidade_nome from ( select * from (';
$tb .= 'select * from(select estado_codigo, pais_nome || chr(32) || chr(40) || trim(estado_nome) || chr(41) as estado_nome from ajax_estado inner join ajax_pais on estado_pais = pais_codigo ) as estado ';
$tb .= 'inner join ajax_cidade on estado_codigo = cidade_estado ';
$tb .= ') as cidade1 ) as cidade where (cidade_ativo = 1) order by upper(asc7(cidade_nome)) ';

$tabela = "ca_instituicao";
$cp = array();
array_push($cp,array('$H4','id_ci','id_ci',False,True,''));
array_push($cp,array('$A','','Dados sobre a instituição',False,True,''));
array_push($cp,array('$S100','ci_nome','Nome da instituição',True,True,''));

array_push($cp,array('$Q cidade_nome:cidade_codigo:'.$tb,'ci_cidade','imo_cidade',False,True,''));

array_push($cp,array('$S100','ci_endereco','Endereco',False,True,''));
array_push($cp,array('$S20','ci_bairro','Bairro',False,True,''));
array_push($cp,array('$CEP','ci_cep','CEP',False,True,''));

array_push($cp,array('$T50:4','ci_text','Comentários',False,True,''));

array_push($cp,array('$[0-10]','ci_peso_1','Avaliação MEC (nota)',True,True,''));
array_push($cp,array('$O 1:Local (da instituição)&2:Local (no estado)&3:Externo (fora do estado)&4:Internacional (América latina)&5:Internacional (America Central)&6:Internacional (América do Norte)&7:Internacional (Europa)&8:Internacional (Asia)','ci_peso_2','Local',True,True,''));
array_push($cp,array('$O 0:NÃO&1:SIM','ci_peso_3','Internacional',True,True,''));

array_push($cp,array('$O 1:SIM&0:NÃO','ci_ativo','sis_ativo',True,True,''));

//if (strlen($dd[0]) ==0)
//	{
//	$qsql = "select * from ".$tabela." where upper(asc7(ci_nome)) = '".UpperCaseSQL($dd[2])."' ";
//	$qrlt = db_query($qsql);
//
//	if ($qline = db_read($qrlt))
//		{
//		echo '<BR><BR><font class="lt3"><font color="RED"><B>';
//		echo $dd[2].'</B><BR><BR>';
//		echo "Nome já cadastrado no sistema";
//		exit;
//		}
//	}
/// Gerado pelo sistem "base.php" versao 1.0.2
?>
