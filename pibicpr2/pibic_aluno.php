<?
require("cab.php");

$sql= "select * from pibic_aluno ";
$sql .= " left join pibic_bolsa_contempladas on pa_cracha = pb_aluno ";
$sql .= " where id_pa = ".$dd[0];
$sql .= " limit 1 ";

$rlt = db_query($sql);
$line = db_read($rlt);

$cracha = trim($line['pa_cracha']);
$filename = $cracha;
$protocolo = trim($line['pb_protocolo']);
$data = trim($line['pb_data']);
$ver = 1;
$uploaddir = '/pucpr/httpd/htdocs/www2.pucpr.br/reol/';
//////////////////////////////////////////////////////////////// CPF
$ok = 0;
while ($ok < 10)
	{
	$chave = "pibic".date("Y");
	$chave = UpperCaseSQL(substr(md5($chave.$cracha),0,8));
	/////////////////////////////////////////////////////////////////////////// CPF
	$xfilename = $cracha.'-'.strzero($ok,2).'-'.$chave.'-'.$filename.'.jpg';
	$yfilename = $uploaddir. 'pibic/ass/cpf/'.$xfilename;
	if (file_exists($yfilename))
		{ $cpf = '<A HREF="/reol/pibic/ass/cpf/'.$xfilename.'" target="new">Copia do Documento CPF</A>'; }
	$xfilename = $cracha.'-'.strzero($ok,2).'-'.$chave.'-'.$filename.'.pdf';
	$yfilename = $uploaddir. 'pibic/ass/cpf/'.$xfilename;
	if (file_exists($yfilename))
		{ $cpf = '<A HREF="/reol/pibic/ass/cpf/'.$xfilename.'" target="new">Copia do Documento CPF</A>'; }
		
	/////////////////////////////////////////////////////////////////////////// CPF
	$xfilename = $cracha.'-'.strzero($ok,2).'-'.$chave.'-'.$filename.'.jpg';
	$yfilename = $uploaddir. 'pibic/ass/rg/'.$xfilename;
	if (file_exists($yfilename))
		{ $rg = '<A HREF="/reol/pibic/ass/rg/'.$xfilename.'" target="new">Copia do Documento RG</A>'; }
	$xfilename = $cracha.'-'.strzero($ok,2).'-'.$chave.'-'.$filename.'.pdf';
	$yfilename = $uploaddir. 'pibic/ass/rg/'.$xfilename;
	if (file_exists($yfilename))
		{ $rg = '<A HREF="/reol/pibic/ass/rg/'.$xfilename.'" target="new">Copia do Documento RG</A>'; }

	/////////////////////////////////////////////////////////////////////////// CPF
	$xfilename = $cracha.'-'.strzero($ok,2).'-'.$chave.'-'.$filename.'.jpg';
	$yfilename = $uploaddir. 'pibic/ass/ende/'.$xfilename;
	if (file_exists($yfilename))
		{ $ende = '<A HREF="/reol/pibic/ass/ende/'.$xfilename.'" target="new">Copia do Comprovante de Endereço</A>'; }
	$xfilename = $cracha.'-'.strzero($ok,2).'-'.$chave.'-'.$filename.'.pdf';
	$yfilename = $uploaddir. 'pibic/ass/ende/'.$xfilename;
	if (file_exists($yfilename))
		{ $ende = '<A HREF="/reol/pibic/ass/ende/'.$xfilename.'" target="new">Copia do Comprovante de Endereço</A>'; }
	$ok++;
	}
	
	/////////////////////////////////////////////////////////////////////////// Contrato
	for ($rt = 65; $rt < 91;$rt++)
		{
		$xfilename = $protocolo.'-'.chr($rt).$data.'.pdf';
		$yfilename = $uploaddir. 'pibic/contrato/2010/'.$xfilename;
		if (file_exists($yfilename))
			{ $contrato = '<A HREF="/reol/pibic/contrato/2010/'.$xfilename.'" target="new">Contrato</A>'; }
		}
	$ok++;

$sx = '<TR><TD>';
$sx .= $line['pa_nome'];
$sx .= '</TD></TR>';

$sx .= '<TR><TD>';
$sx .= $line['pa_cracha'];
$sx .= '</TD></TR>';

$sx .= '<TR><TD>CPF: ';
$sx .= $cpf;
$sx .= '</TD></TR>';

$sx .= '<TR><TD>RG: ';
$sx .= $rg;
$sx .= '</TD></TR>';

$sx .= '<TR><TD>Endereço: ';
$sx .= $ende;
$sx .= '</TD></TR>';

$sx .= '<TR><TD>Contrato: ';
$sx .= $contrato;
$sx .= '</TD></TR>';

echo '<TABLE width="'.$tab_max.'" align="center" border="1" class="lt1"><TR><TD>';
echo $sx;
echo '</table>';

?>
<BR>Bolsas do aluno
<BR>Histórico de substituição