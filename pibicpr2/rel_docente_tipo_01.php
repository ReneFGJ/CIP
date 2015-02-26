<?
require("cab.php");
require($include.'sisdoc_colunas.php');

$ano = '2011';
if (strlen($dd[1]) == 0) { $edital = 'PIBIC'; }

$sql = "select * from pibic_bolsa_contempladas
		inner join docentes on pb_professor = pp_cracha
		inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo
		inner join apoio_titulacao on pp_titulacao = ap_tit_codigo 
		where pb_status <> 'C' and pb_ano = '$ano'
		";
		
$sql = "select * from (
		select count(*) as total, ap_tit_titulo, pb_professor, pbt_edital, pp_cracha ,pp_nome,
		pp_carga_semanal, pp_ss, pp_centro, pp_negocio, pp_escola 
		from pibic_bolsa_contempladas
		inner join docentes on pb_professor = pp_cracha
		inner join apoio_titulacao on pp_titulacao = ap_tit_codigo
		inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo
		where pb_status <> 'C' and pb_ano = '$ano' and pbt_edital = '$edital'
		group by pbt_edital, pb_professor, ap_tit_titulo, pp_cracha ,pp_nome,
		pp_carga_semanal, pp_ss, pp_centro, pp_negocio, pp_escola
		) as tabela
		
		order by pp_nome
		";

$rlt = db_query($sql);

$h40 = array();
$h20 = array();
$h20m = array();
$hdi = array();

$msc = array();
$dr  = array();
$oth = array();

$pmsc = array();
$pdr  = array();
$poth = array();
$ss = 0;
$cg40 = 0;
$cg20 = 0;
$cg10 = 0;
while ($line = db_read($rlt))
	{
		$edital = UpperCaseSql(trim($line['pbt_edital']));
		$tit = trim($line['ap_tit_titulo']);
		$t = 0;
		if ($edital == 'PIBIC')
			{
			if ($tit == 'Dr.') { array_push($dr,$line); $t=1;}
			if ($tit == 'Msc.') { array_push($msc,$line); $t=1; }
			if ($tit == 'Esp.') { array_push($oth,$line); $t=1; }
			
			if ($line['pp_ss']=='S') { $ss++; }
			if ($line['pp_carga_semanal']==40) { $cg40++; }
			if (($line['pp_carga_semanal'] >= 20) and ($line['pp_carga_semanal'] < 40)) { $cg20++; }
			if (($line['pp_carga_semanal'] >= 0) and ($line['pp_carga_semanal'] < 20)) { $cg10++; }
			}
		if ($t==0) { echo 'Ops. '.$tit.', ['.$edital.']'; exit; }
	}
echo '<center>';
echo 'COMPOSIÇÃO DOS PESQUISADORES';
echo '<table border=1>';
echo '<TR><TH>Mod.<TH>Doutor<TH>Mestre<TH>Outros';
echo '<TR align="center" class="lt4">';
echo '<TD>PIBIC';
echo '<TD>'.count($dr);
echo '<TD>'.count($msc);
echo '<TD>'.count($oth);
echo '<TR align="center" class="lt4">';
echo '</table>';

echo 'CARGA HORÁRIA';

echo '<table border=1>';
echo '<TR><TH>Mod.<TH>SS<TH>40 horas<TH> >= 20 horas<TH>< 20 hotas';
echo '<TR align="center" class="lt4">';
echo '<TD>'.$edital;
echo '<TD>'.$ss;
echo '<TD>'.$cg40;
echo '<TD>'.$cg20;
echo '<TD>'.$cg10;
echo '</table>';

echo 'DESCRIÇÃO DOCENTE';

echo '<table border=0 class="lt1" width="704">';
echo '<TR><TH>Pos<TH>Nome<TH>Tit.<TH>SS<TH>Carg.Horária<TH>Cracha<TH>Orient.';
for ($r=0;$r < count($dr);$r++)
	{
	$ln = $dr[$r];
	echo '<TR '.coluna().'>';
	echo '<TD>'.($r+1);
	echo '<TD>';
	echo $ln['pp_nome'];
	echo '<TD align="center">';
	echo $ln['ap_tit_titulo'];
	echo '<TD align="center">';
	echo $ln['pp_ss'];
	echo '<TD align="center">';
	echo $ln['pp_carga_semanal'];
	echo '<TD align="center">';	
	echo $ln['pp_cracha'];
	echo '<TD align="center">';
	echo $ln['total'];
	}
	
echo '<TR><TH>Pos<TH>Nome<TH>Tit.<TH>SS<TH>Carg.Horária<TH>Cracha<TH>Orient.';
for ($r=0;$r < count($msc);$r++)
	{
	$ln = $msc[$r];
	echo '<TR '.coluna().'>';
	echo '<TD>'.($r+1);
	echo '<TD>';
	echo $ln['pp_nome'];
	echo '<TD align="center">';
	echo $ln['ap_tit_titulo'];
	echo '<TD align="center">';
	echo $ln['pp_ss'];
	echo '<TD align="center">';
	echo $ln['pp_carga_semanal'];
	echo '<TD align="center">';	
	echo $ln['pp_cracha'];
	echo '<TD align="center">';
	echo $ln['total'];
	}
echo '<TR><TH>Pos<TH>Nome<TH>Tit.<TH>SS<TH>Carg.Horária<TH>Cracha<TH>Orient.';
for ($r=0;$r < count($oth);$r++)
	{
	$ln = $oth[$r];
	echo '<TR '.coluna().'>';
	echo '<TD>'.($r+1);
	echo '<TD>';
	echo $ln['pp_nome'];
	echo '<TD align="center">';
	echo $ln['ap_tit_titulo'];
	echo '<TD align="center">';
	echo $ln['pp_ss'];
	echo '<TD align="center">';
	echo $ln['pp_carga_semanal'];	
	echo '<TD align="center">';	
	echo $ln['pp_cracha'];
	echo '<TD align="center">';
	echo $ln['total'];
	}	
echo '</table>';

 