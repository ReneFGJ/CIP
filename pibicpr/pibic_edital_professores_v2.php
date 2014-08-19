<?
require ("cab.php");
require ($include . "sisdoc_debug.php");
require ($include . "sisdoc_colunas.php");
require ($include . "sisdoc_windows.php");
require ($include . "sisdoc_data.php");
require ($include . "sisdoc_autor.php");

require ("../_class/_class_docentes.php");
$doce = new docentes;

echo '<H1>Atribuição de bolsas</h1>';
echo '<H3>Consistências de regras de atribuição</h3>';

/* recupera professores produtividade */

/* Converte reprovados em desqualificados */
$sql = "update pibic_bolsa set pb_tipo = 'D' where pb_tipo = 'X'";
$rlt = db_query($sql);

$produ = $doce -> produtividade();

/* Recupera bolsas atribuidas */
$cps = "*";
$sql = "select $cps from pibic_bolsa ";
$sql .= "inner join pibic_professor on pp_cracha = pb_professor ";
$sql .= "left join apoio_titulacao on ap_tit_codigo = pp_titulacao ";
$sql .= "inner join pibic_bolsa_tipo on pbt_codigo =  pb_tipo ";
$sql .= " where pp_ano = '" . date("Y") . "' ";
$sql .= " and pb_ativo = 1 ";
$sql .= "order by pp_centro, pp_nome, pbt_edital, pbt_auxilio desc, pb_tipo ";

$rlt = db_query($sql);

/* Variaveis iniciais */
$xprof = "X";
$xcentro = "X";
$pibiti = 0;
$pibic = 0;
$pibiti_r = 0;
$pibic_r = 0;
$repo = 0;
$xedital = "X";

$dr1 = 0;
$ms1 = 0;
$ds1 = 0;

$hc = '';
$ln = array();
/* Recupera dados da base */
while ($line = db_read($rlt)) {
	array_push($ln, $line);
}

/* Processa informações */
$rs = '';
for ($r = 0; $r < count($ln); $r++) {

	$line = $ln[$r];
	$protocolo = trim($line['']);
	$professor = trim($line['pp_nome']);
	$centro = trim($line['pp_centro']);
	$bolsa = trim($line['pb_tipo']);
	$bolsa_img = '<IMG SRC="img/logo_bolsa_' . $bolsa . '.png" border=0 title="' . $line['pb_protocolo'] . '-' . $line['pb_protocolo_mae'] . '" alt="' . $line['pb_protocolo'] . '">';
	$edital = trim($line['pbt_edital']);
	$auxilio = $line['pbt_auxilio'];
	$ss = trim($line['pp_ss']);
	$tit = trim($line['ap_tit_titulo']) . ' ';
	$tit_cod = trim($line['ap_tit_codigo']);
	$prod = trim($line['pp_prod']);
	if ($prod != '0') { $prod = 'PROD';
	} else { $prod = '&nbsp;';
	}
	if ($ss == 'N') { $ss = '';
	}

	if (($professor != $xprof) or ($edital != $xedital)) {
		if (strlen($ic + $icv + $it + $itv + $icem) > 0) {
			$bg1 = '';
			$bg2 = '';
			$bg3 = '';

			/* Bolsas IC */
			if ($ic > $pibic) {$bg1 = ' bgcolor="FF8080" ';
			}
			if ($icv > $pibic_icv) {$bg1 = ' bgcolor="FF8080" ';
			}

			/* Bolsas IC */
			if ($it > $pibiti) {$bg2 = ' bgcolor="FF8080" ';
			}
			if ($itv > $pibiti_itv) {$bg2 = ' bgcolor="FF8080" ';
			}
			$sx .= chr(13) . chr(10);
			$sx .= '<TD align="center" class="tabela01" width="3	0" ' . $bg1 . '>';
			$sx .= ($ic) . '/' . ($icv);
			$sx .= '<TD align="center" class="tabela01" width="30" ' . $bg2 . '>';
			$sx .= ($it) . '/' . ($itv);
			$sx .= '<TD align="center" class="tabela01" width="30" ' . $bg3 . '>';
			$sx .= ($icem) . '/' . ($icemv);
		}
		$pibic_icv = 2;
		$pibiti_itv = 2;
		$pibic_em = 20;

		$pibic = 2;
		$pibiti = 2;

		$ic = 0;
		$icv = 0;
		$it = 0;
		$itv = 0;
		$icem = 0;
		$icr = 0;
		$itr = 0;
		$icemr = 0;
		$icemv = 0;

		/* Altera Centro */
		if ($centro != $xcentro) {
			$sx .= chr(13) . chr(10);
			$sx .= '<TR class="lt3"><TD colspan="40" class="tabela01">
					<B><font style="font-size:22px">' . $centro . '</font></B></TD></TR><TR>';
			$xcentro = $centro;
		}

		/* Mostra dados do professor */
		$sx .= chr(13) . chr(10);
		$sx .= '<TR class="lt2">
					<TD colspan="1" class="tabela01" width="40%">' . $professor . '</TD>';
		$sx .= '<TD class="tabela01">' . $tit . '</TD>';
		$sx .= '<TD class="tabela01" align="center">&nbsp;' . $ss . '&nbsp;</TD>';
		$sx .= '<TD class="tabela01">' . $prod . '</TD>';
		$sx .= '<TD class="tabela01">' . $edital . '</TD>';
		$sx .= '<TD class="tabela01">';
		$xprof = $professor;
		$xedital = $edital;

		/* Atribui mais ICV e ITV para doutores */
		if ($tit_cod == '002') {
			$pibic_icv = $pibic_icv + 2;
			$pibic_itv = $pibic_itv + 2;
		}
	}
	$sx .= '<img src="img/logo_bolsa_' . $bolsa . '.png">&nbsp;';

	if (($bolsa != 'D') and ($bolsa != 'R')) {
		if ($auxilio > 0) {
			if ($edital == 'PIBIC') { $ic++;
			}
			if ($edital == 'PIBITI') { $it++;
			}
			if ($edital == 'PIBITCE') { $icem++;
			}
		} else {
			if ($edital == 'PIBIC') { $icv++;
			}
			if ($edital == 'PIBITI') { $itv++;
			}
			if ($edital == 'PIBITCE') { $icemv++;
			}
		}
	} else {
		if ($edital == 'PIBIC') { $icd++;
		}
		if ($edital == 'PIBITI') { $itd++;
		}
		if ($edital == 'PIBITCE') { $icemd++;
		}
	}
}

if (strlen($ic + $icv + $it + $itv + $icem) > 0) {
	$bg1 = '';
	$bg2 = '';
	$bg3 = '';

	/* Bolsas IC */
	if ($ic > $pibic) {$bg1 = ' bgcolor="FF8080" ';
	}
	if ($icv > $pibic_icv) {$bg1 = ' bgcolor="FF8080" ';
	}

	/* Bolsas IC */
	if ($it > $pibiti) {$bg2 = ' bgcolor="FF8080" ';
	}
	if ($itv > $pibiti_itv) {$bg2 = ' bgcolor="FF8080" ';
	}
	$sx .= chr(13) . chr(10);
	$sx .= '<TD align="center" class="tabela01" width="3	0" ' . $bg1 . '>';
	$sx .= ($ic) . '/' . ($icv);
	$sx .= '<TD align="center" class="tabela01" width="30" ' . $bg2 . '>';
	$sx .= ($it) . '/' . ($itv);
	$sx .= '<TD align="center" class="tabela01" width="30" ' . $bg3 . '>';
	$sx .= ($icem) . '/' . ($icemv);
}
?>
<table class="tabela00" width="100%">
<TR bgcolor="#c0c0c0"><TH>Professor</TH>
<TH>Titulação</TH>
<TH>SS</TH>
<TH>Prod.</TH>
<TH>Edital</TH>
<TH>Bolsas</TH>
<TH>PIBIC</TH>
<TH>PIBITI</TH>
<TH><NOBR>IC Jr</NOBR></TH>
</TR>
<?=$sx; ?>
</table>