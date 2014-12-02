<?php
require("cab_semic.php");
;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');

//$row_class = 'link';
$jid = 85;
$jids = strzero($jid,7);

require("../_class/_class_docentes.php");
$dis = new docentes;
$dis->le($dd[0]);

echo $dis->mostra();

if (strlen($acao) > 0)
	{
		$nome_asc = UpperCaseSql($dis->pp_nome);
		$sql = "select * from pareceristas 
					where us_nome_asc = '$nome_asc' ";
		$sql .= " and us_journal_id = $jids ";
		$rlt = db_query($sql);
		if (!($line = db_read($rlt)))
			{
				require("../_class/_class_pareceristas.php");
				$par = new parecerista;
				
				$nome = $dis->nome;
				$login = $dis->pp_cracha;
				$cracha = $dis->pp_cracha;
				$nome = $dis->pp_nome;
				$email = $dis->pp_email;
				$email1 = $dis->pp_email_1;
				$titulacao = 'Dr.';
				$data = date("Ymd");
				$sql = "insert into pareceristas 
						(
						us_cracha,us_nome,us_login,
						us_titulacao,us_ativo,us_dt_admissao,
						us_email, us_email_alternativo, us_codigo,
						ap_ordem, us_nome_asc, us_journal_id, us_aceito,
						us_instituicao
						) values (
						'','$nome','$login',
						'$titulacao','1',$data,
						'$email','$email1','',
						1,'$nome_asc',$jid,10,
						'0000012'
						)
				";
				$rlt = db_query($sql);
				$par->updatex();
			} else {
				echo 'Já Cadastrado na Base';
			}
	}

echo '<form method="post" action="'.page().'">';
echo '<input type="hidden" value="'.$dd[0].'" name="dd0">';
echo '<input type="submit" value="Confirmar Importação" name="acao">';
echo '</form>';
require("../foot.php");
