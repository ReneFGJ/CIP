<?
$ano = date("Y");
$area = substr($dd[0], 0, 1);
if ($area == 'T') { $area = '';
}

/* Excluir todas as bolsas */
//$sql = "delete from pibic_bolsa ";
//$rlt = db_query($sql);

$sql = "delete from pibic_bolsa where pb_ativo = 0 ";
$rlt = db_query($sql);

$sql = "select max(pee_edital) as edital from pibic_edital";
$rlt = db_query($sql);

if ($line = db_read($rlt)) { $edital = strzero($line['edital'], 4);
}

require ("pibic_edital_3_resumo.php");

//$sql = 'CREATE INDEX index_key_01 ON "pibic_submit_documento" (doc_ano,doc_edital,doc_status); ';
//$rlt = db_query($sql);
//$sql = 'CREATE INDEX index_key_02 ON "pibic_professor" (pp_cracha); ';
//$rlt = db_query($sql);
//$sql = 'CREATE INDEX index_key_03 ON "apoio_titulacao" (ap_tit_codigo); ';
//$rlt = db_query($sql);
//$sql = 'CREATE INDEX index_key_06 ON "pibic_bolsa" (pb_protocolo,pb_ativo); ';
//$rlt = db_query($sql);
//$sql = 'CREATE INDEX index_key_05 ON "pibic_aluno" (pa_cracha); ';
//$rlt = db_query($sql);


$sql = "select * from pibic_submit_documento
		 	left join pibic_aluno on pa_cracha = doc_aluno
			where pa_cracha isnull ";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$sql = "update pibic_submit_documento set doc_aluno = '00000000' where id_doc = ".$line['id_doc'];
		$xrlt = db_query($sql);
		echo $sql;
	}

$cps = 'pb3.id_pb as idp, doc_ava_estrategico, id_pj, pj_codigo, doc_doutorando, doc_area, pb2.pb_tipo as pb_tipo_ant, pb3.pb_tipo as pb_tipo_atu,pb1.pb_tipo as pb_tipo, ap_tit_titulo, pp_nome, pp_centro, pp_ss, pa_nome, doc_icv, doc_estrategica, doc_nota, doc_protocolo_mae, doc_protocolo ';
$cps .= ', pp_prod, pp_cracha, doc_aluno, doc_avaliacoes ';
//$cps = '*';
$sql = "select " . $cps . " from pibic_submit_documento ";
$sql .= " left join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";

$sql .= " inner join pibic_aluno on pa_cracha = doc_aluno ";
$sql .= " left join pibic_bolsa as pb1 on (doc_protocolo = pb1.pb_protocolo) ";
$sql .= " left join pibic_projetos on pj_codigo = doc_protocolo_mae ";
$sql .= " left join pibic_bolsa_contempladas as pb2 on ((pb2.pb_aluno = doc_aluno) and (pb2.pb_status<>'C') and (pb2.pb_ano='" . (date("Y") - 1) . "')) ";
$sql .= " left join pibic_bolsa_contempladas as pb3 on ((pb3.pb_protocolo = doc_protocolo) and (pb3.pb_status<>'C') and (pb3.pb_ano='" . (date("Y")) . "')) ";
$sql .= " where doc_ano = '" . date("Y") . "' ";
$sql .= " and doc_edital = '" . $dtipo . "' ";
$sql .= " and (doc_protocolo <> doc_protocolo_mae) ";
if (strlen($area) > 0) { $sql .= " and doc_area = '" . $area . "' ";
}
$sql .= " and (doc_status <> 'X' and doc_status <> '@' ) ";
$sql .= " and (doc_aluno <> '') ";
$sql .= " and doc_nota > 10 ";
$sql .= " order by  doc_area, doc_nota desc, doc_protocolo ";



if ($dtipo == 'PIBICE') {
	$cps = 'pb3.id_pb as idp, doc_ava_estrategico, id_pj, pj_codigo, doc_doutorando, doc_area, pb2.pb_tipo as pb_tipo_ant, pb3.pb_tipo as pb_tipo_atu,pb1.pb_tipo as pb_tipo, ap_tit_titulo, pp_nome, pp_centro, pp_ss, doc_icv, doc_estrategica, doc_nota, doc_protocolo_mae, doc_protocolo ';
	$cps .= ', pp_prod, pp_cracha, doc_aluno, doc_avaliacoes ';
	$cps = '*';
	$sql = "select $cps from pibic_submit_documento ";
	$sql .= " left join pibic_professor on pp_cracha = doc_autor_principal ";
	$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";

	$sql .= " left join pibic_bolsa on (doc_protocolo = pb_protocolo) ";
	$sql .= " left join pibic_projetos on pj_codigo = doc_protocolo_mae ";

	$sql .= " where doc_ano = '" . date("Y") . "' ";
	$sql .= " and doc_edital = '" . $dtipo . "' ";
	$sql .= " and (doc_protocolo <> doc_protocolo_mae) ";
	if (strlen($area) > 0) { $sql .= " and doc_area = '" . $area . "' ";
	}
	$sql .= " and (doc_status <> 'X' and doc_status <> '@' ) ";
	$sql .= " and doc_nota > 10 ";
	$sql .= " order by  doc_area, doc_nota desc, doc_protocolo ";
}
$rlt = db_query($sql);
$ord = 0;
$icv = '';
$area = '';
?>
<style>
	.linkx {
		font-size: 12px;
		color: #00929A;
		font-weight: bolder;
	}
	.linkx:hover {
		font-size: 12px;
		color: #00929A;
		font-weight: bolder;
	}
</style>
<?
echo '<table width="1024" cellpadding="0" cellspacing="2" border="0" class="lt1">';
echo '<TR valign="baseline" class="lt0">';
echo '<TH rowspan="2">Pos</TH>';
echo '<TH colspan="3">Bolsa</TH>';
echo '<TH rowspan="2">Professor</TH>';
echo '<TH rowspan="2">Centro</TH>';
echo '<TH rowspan="2">SS</TH>';
echo '<TH rowspan="2">Prod</TH>';
echo '<TH rowspan="2">Estudante</TH>';
echo '<TH rowspan="2">ICV</TH>';
echo '<TH rowspan="2">Estrat.</TH>';
echo '<TH rowspan="2">Nota</TH>';
echo '<TH rowspan="2">Dr.(Estud.)</TH>';
echo '<TH rowspan="2">Ava.</TH>';
echo '<TH rowspan="2">Protocolo</TH>';
if ($user_nivel >= 9) { echo '<TH rowspan="2">Ação</TH>';
}
echo '</TR>';
echo '<TR valign="baseline" class="lt0">';
echo '<TH colspan="1">Anterior</TH>';
echo '<TH colspan="1">edital</TH>';
echo '<TH colspan="1">Atual</TH>';
echo '</TR>';

$xarea = "X";

while ($line = db_read($rlt)) {
	$idpx = $line['idp'];
	$ord++;
	$bolsa_ant = trim($line['pb_tipo_ant']);
	$bolsa_atu = trim($line['pb_tipo_atu']);
	$id_pj = $line['id_pj'];
	$bolsa_ind = trim($line['pb_tipo']);
	$ava = $line['doc_avaliacoes'];
	/* Imagens */
	if (strlen($bolsa_ind) > 0) { $bolsa_ind_img = '<IMG SRC="img/logo_bolsa_' . $bolsa_ind . '.png" border=0 height="16" >';
	} else { $bolsa_ind_img = '-';
	}
	if (strlen($bolsa_atu) > 0) { $bolsa_atu_img = '<IMG SRC="img/logo_bolsa_' . $bolsa_atu . '.png" border=0 height="16" >';
	} else { $bolsa_atu_img = '-';
	}
	if (strlen($bolsa_ant) > 0) { $bolsa_ant_img = '<IMG SRC="img/logo_bolsa_' . $bolsa_ant . '.png" border=0 height="16" >';
	} else { $bolsa_ant_img = '-';
	}
	
	$doutorando = $line['doc_doutorando'];
	if ($doutorando == 1) { $doutorando = 'SIM';
	} else { $doutorando = '-';
	}
	/* Dados do Professor */
	$prof = trim($line['ap_tit_titulo']);
	$prof = nbr_autor(trim($prof . ' ' . $line['pp_nome']), 7);
	$centro = trim($line['pp_centro']);
	$ss = trim($line['pp_ss']);
	$prod = trim($line['pp_prod']);
	if ($prod == '0') { $prod = '-';
	} else { $prod = "SIM";
	}

	/* Dados do Aluno */
	$estudante = nbr_autor(trim($line['pa_nome']), 7);

	/* Dados do Plano do aluno */
	$icv = trim($line['doc_icv']);
	if (($icv == 'S') or ($icv == '1')) { $icv = 'SIM';
	} else {$icv = '-';
	}

	$estra = $line['doc_ava_estrategico'];
	if ($estra == '1') { $estra = '<IMG SRC="img/star_5.png">';
	} else {$estra = '-';
	}
	$nota = number_format($line['doc_nota'] / 10, 1);
	$protocolo = $line['doc_protocolo_mae'];
	$linkp = '<A HREF="http://www2.pucpr.br/reol/pibicpr/pibic_projetos_detalhes.php?dd0=' . $id_pj . '&dd90=' . checkpost($id_pj) . '" target="_pp">';
	$protocolo .= '/' . $line['doc_protocolo'];
	$area = trim($line['doc_area']);
	/* ACAO */
	$acao = '<A onclick="newxy(\'' . $ptipo . '_bolsa_indicar_tipo.php?dd1=' . trim($line['pp_cracha']) . '&dd2=' . trim($line['doc_protocolo']) . '&dd0=' . trim($line['doc_aluno']) . '\',700,300);" class="linkx">';
	$acao .= '[Indicar]</A>';
	$cor = '';

	/* Cabeçalho das áreas */
	if ($xarea != $area) {
		echo '<TR><TD colspan="12" class="lt3"><B>';
		if ($area == 'A') { echo 'Ciências Agrárias';
		}
		if ($area == 'E') { echo 'Ciências Exatas';
		}
		if ($area == 'H') { echo 'Ciências Humanas';
		}
		if ($area == 'V') { echo 'Ciências da Vida';
		}
		if ($area == 'S') { echo 'Sociais Aplicadas';
		}
		$xarea = $area;
		echo '</B></TD></TR>';
	}

	if ((strlen($icv) > 2) and (strlen($bolsa_ind_img) > 0) and ($bolsa_ind != 'I')) { $cor = '<font color="red">';
	}
	$link = '<A HREF="pibic_bolsas_contempladas.php?dd0=' . $idpx . '" target="_new">';

	echo '<TR ' . coluna() . ' style="border-top: 1px solid #000000;">';
	echo '<TD align="center" class="tabela01">' . $ord . '</TD>';
	echo '<TD align="center" class="tabela01">' . $bolsa_ant_img . '</TD>';
	echo '<TD align="center" class="tabela01">' . $bolsa_ind_img . '</TD>';
	echo '<TD align="center" class="tabela01">' . $link . $bolsa_atu_img . '</TD>';
	echo '<TD align="left" class="tabela01">' . $prof . '</TD>';
	echo '<TD align="center" class="tabela01">' . $centro . '</TD>';
	echo '<TD align="center" class="tabela01">' . $ss . '</TD>';
	echo '<TD align="center" class="tabela01">' . $prod . '</TD>';
	echo '<TD align="left" class="tabela01">' . $cor . $estudante . '</TD>';
	echo '<TD align="center" class="tabela01">' . $icv . '</TD>';
	echo '<TD align="center" class="tabela01">' . $estra . '</TD>';
	echo '<TD align="center" class="tabela01">' . $nota . '</TD>';
	echo '<TD align="center" class="tabela01">' . $doutorando;
	echo '<TD align="center" class="tabela01">(' . $ava . ')';
	echo '<TD align="center" class="tabela01">' . $linkp . $protocolo . '</A></TD>';
	//if ($user_nivel >= 9)
	{ echo '<TD align="center">' . $acao . '</TD>';
	}
	echo '</TR>';
}
echo '</table>';

require ("foot.php");
?>
