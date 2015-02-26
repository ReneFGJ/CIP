<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_autor.php");

$area = array();
array_push($area,'Ciências da Vida - PIBIC');
array_push($area,'Ciências Exatas e da Terra - PIBIC');
array_push($area,'Ciências Agrárias - PIBIC');
array_push($area,'Ciências Sociais e Aplicadas - PIBIC');
array_push($area,'Ciências Humanas - PIBIC');

$sl = array();
array_push($sl,array('Sala XX','XX',1,5,'25 de Outubro - 19:45 - Biologia'));

array_push($sl,array('','BIO',1,8,'26 de Outubro - 08h00 - Sala 05 - Biologia'));
array_push($sl,array('','BIO',9,13,'26 de Outubro - 10h30 - Sala 05 - Biologia'));
array_push($sl,array('','BIO',14,19,'27 de Outubro - 08h00 - Sala 02 - Biologia'));

array_push($sl,array('','BIOTEC',1,4,'26 de Outubro - 08h00 - Sala 06 - Biotecnologia'));
array_push($sl,array('','BIOTEC',5,10,'26 de Outubro - 10h30 - Sala 06 - Biotecnologia'));

array_push($sl,array('','CBIO',1,9,'26 de Outubro - 13h45 - Sala 05 - Ciências Biológicas'));

array_push($sl,array('','EDFi',1,5,'26 de Outubro - 14h00 - Sala 03 -  Farmácia'));
array_push($sl,array('','ENF',1,2,'26 de Outubro - 14h00 - Sala 03 - Farmácia'));

array_push($sl,array('','FAR',1,5,'26 de Outubro - 08h45 - Sala 04 - Farmácia'));
array_push($sl,array('','FAR',6,10,'26 de Outubro - 10h30 - Sala 04 - Farmácia'));


array_push($sl,array('','FISIO',1,1,'26 de Outubro - 10h30 - Sala 05 - Fisioterapia'));

array_push($sl,array('','MED',1,8,'26 de Outubro - 08h00 - Sala 03 - Medicina'));
array_push($sl,array('','MED',9,16,'26 de Outubro - 16h30 - Sala 03 - Medicina'));
array_push($sl,array('','MED',17,21,'26 de Outubro - 19h30 - Sala 03 - Medicina'));
array_push($sl,array('','MED',22,27,'27 de Outubro - 08h00 - Sala 03 - Medicina'));

array_push($sl,array('','NUT',1,5,'26 de Outubro - 08h00 - Sala 07 - Nutrição '));

array_push($sl,array('','ODO',1,5,'25 de Outubro - 19h45 - Sala 01 - Odontologia '));
array_push($sl,array('','ODO',6,14,'26 de Outubro - 08h00 - Sala 01 - Odontologia '));
array_push($sl,array('','ODO',15,21,'26 de Outubro - 10h30 - Sala 01 - Odontologia '));
array_push($sl,array('','ODO',22,29,'26 de Outubro - 14h00 - Sala 01 - Odontologia '));
array_push($sl,array('','ODO',30,36,'26 de Outubro - 16h30 - Sala 01 - Odontologia '));
array_push($sl,array('','ODO',37,42,'27 de Outubro - 08h00 - Sala 01 - Odontologia '));

array_push($sl,array('','PSI',1,8,'26 de Outubro - 16h30 - Sala 05 - Odontologia '));

array_push($sl,array('','COMP',1,6,'26 de Outubro - 19h30 - Sala 10 - Ciência da Computação '));
array_push($sl,array('','CIV',1,6,'26 de Outubro - 14h00 - Sala 09 - Engenharia Civil '));

array_push($sl,array('','ECOMP',1,10,'26 de Outubro - 13h45 - Sala 10 - Engenharia de Computação '));
array_push($sl,array('','PROD',1,10,'26 de Outubro - 16h30 - Sala 09 - Engenharia de Produção '));
array_push($sl,array('','PROD',11,16,'27 de Outubro - 08h00 - Sala 09 - Engenharia de Produção '));

array_push($sl,array('','ELE',1,3,'26 de Outubro - 14h00 - Sala 09 - Engenharia Elétrica '));

array_push($sl,array('','MEC',1,8,'26 de Outubro - 08h00 - Sala 08 - Engenharia Mecanica '));

array_push($sl,array('','MECA',1,10,'26 de Outubro - 10h30 - Sala 08 - Engenharia Mecatrônica '));
array_push($sl,array('','MECA',11,14,'26 de Outubro - 14h00 - Sala 08 - Engenharia Mecatrônica '));
array_push($sl,array('','MECA',15,17,'26 de Outubro - 16h45 - Sala 08 - Engenharia Mecatrônica '));
array_push($sl,array('','MECA',18,30,'27 de Outubro - 08h00 - Sala 08 - Engenharia Mecatrônica '));

array_push($sl,array('','EQ',1,6,'26 de Outubro - 16h30 - Sala 06 - Engenharia Química '));

array_push($sl,array('','FIS',1,2,'26 de Outubro - 16h30 - Sala 06 - Física '));

array_push($sl,array('','SI',1,2,'26 de Outubro - 14h00 - Sala 09 - Sistemas de Informação '));


array_push($sl,array('','AGRO',1,9,'26 de Outubro - 13h45 - Sala 06 - Agronomia '));

array_push($sl,array('','ALIM',1,3,'26 de Outubro - 08h00 - Sala 07 - Engenharia de Alimentos '));
array_push($sl,array('','ALIM',4,11,'26 de Outubro - 10h30 - Sala 09 - Engenharia de Produção '));

array_push($sl,array('','AMBI',1,8,'26 de Outubro - 14h00 - Sala 07 - Engenharia Ambiental '));
array_push($sl,array('','AMBI',9,12,'26 de Outubro - 16h30 - Sala 07 - Engenharia Ambiental '));
array_push($sl,array('','AMBI',13,20,'27 de Outubro - 08h00 - Sala 07 - Engenharia Ambiental '));


array_push($sl,array('','FLO',1,4,'28 de Outubro - 08h00 - Sala 06 - Engenharia Florestal '));

array_push($sl,array('','MEDVET',1,7,'25 de Outubro - 19h45 - Sala 02 - Medicina Veterinária '));
array_push($sl,array('','MEDVET',8,15,'26 de Outubro - 08h00 - Sala 02 - Medicina Veterinária '));
array_push($sl,array('','MEDVET',16,22,'26 de Outubro - 10h30 - Sala 02 - Medicina Veterinária '));
array_push($sl,array('','MEDVET',23,32,'26 de Outubro - 16h30 - Sala 02 - Medicina Veterinária '));


array_push($sl,array('','AD',1,9,'26 de Outubro - 08h00 - Sala 10 - Administração '));
array_push($sl,array('','AD',10,19,'26 de Outubro - 10h30 - Sala 10 - Administração '));
array_push($sl,array('','AD',20,29,'27 de Outubro - 08h00 - Sala 10 - Administração '));

array_push($sl,array('','ARQ',1,3,'26 de Outubro - 14h00 - Sala 13 - Arquitetura e Urbanismo '));
array_push($sl,array('','ARQ',4,10,'26 de Outubro - 16h45 - Sala 13 - Arquitetura e Urbanismo '));
array_push($sl,array('','ARQ',11,20,'27 de Outubro - 08h00 - Sala 06 - Arquitetura e Urbanismo '));


array_push($sl,array('','CC',1,5,'26 de Outubro - 19h45 - Sala 09 - Ciências Contábeis '));
array_push($sl,array('','CSj',1,8,'26 de Outubro - 08h00 - Sala 09 - Comunicação Social : Jornalismo '));
array_push($sl,array('','CSj',9,12,'26 de Outubro - 10h30 - Sala 09 - Comunicação Social : Jornalismo '));
array_push($sl,array('','CSrp',1,12,'26 de Outubro - 10h30 - Sala 09 - Comunicação Social : Relações Públicas '));


array_push($sl,array('','DsIn',1,4,'26 de Outubro - 14h00 - Sala 13 - Desenho Industrial '));


array_push($sl,array('','DI',1,7,'25 de Outubro - 19h45 - Sala 03 - Direito '));
array_push($sl,array('','DI',8,14,'25 de Outubro - 19h45 - Sala 04 - Direito '));

array_push($sl,array('','DI',15,17,'26 de Outubro - 08h00 - Sala 12 - Direito '));
array_push($sl,array('','DI',18,27,'26 de Outubro - 10h30 - Sala 12 - Direito '));
array_push($sl,array('','DI',28,37,'26 de Outubro - 16h00 - Sala 12 - Direito '));
array_push($sl,array('','DI',38,43,'26 de Outubro - 19h30 - Sala 12 - Direito '));
array_push($sl,array('','DI',44,49,'27 de Outubro - 08h00 - Sala 12 - Direito '));

array_push($sl,array('','SE',1,2,'26 de Outubro - 10h30 - Sala 10 - Secretariado Executivo '));

array_push($sl,array('','FI',1,8,'26 de Outubro - 08h00 - Sala 11 - Filosofia '));
array_push($sl,array('','FI',9,17,'26 de Outubro - 10h30 - Sala 11 - Filosofia '));
array_push($sl,array('','FI',18,23,'27 de Outubro - 08h00 - Sala 11 - Filosofia '));

array_push($sl,array('','HI',1,5,'27 de Outubro - 08h00 - Sala 04 - História '));

array_push($sl,array('','LE',11,16,'26 de Outubro - 10h30 - Sala 13 - Letras '));

array_push($sl,array('','PE',1,5,'26 de Outubro - 08h00 - Sala 13 - Pedagogia '));
array_push($sl,array('','PE',6,14,'26 de Outubro - 10h30 - Sala 13 - Pedagogia '));

array_push($sl,array('','SO',1,7,'26 de Outubro - 16h30 - Sala 09 - Sociologia '));

array_push($sl,array('','TEO',1,8,'26 de Outubro - 14h00 - Sala 04 - Teologia '));
array_push($sl,array('','TEO',9,12,'27 de Outubro - 08h00 - Sala 04 - Teologia '));




$tpx = 2;

$sql = "select *,sections.seq as seqx from articles ";
$sql .= "left join sections on article_section = section_id ";

$sql .= "left join pibic_bolsa_contempladas on ((article_3_abstract = 'PIBIC' || pb_protocolo ) ";
$sql .= " or (article_3_abstract = 'PIBITI' || pb_protocolo )) ";

$sql .= " left join pibic_professor on pb_professor = pp_cracha ";

$sql .= " where articles.journal_id = ".$jid;
$sql .= " and (pb_status <> 'C' ) "; 
$sql .= " and article_publicado <> 'X' ";

//$sql .= " order by article_title ";
$sql .= " order by 	";
$sql .= " sections.seq, ";
$sql .= " pp_nome_asc, ";
$sql .= " title, ";
$sql .= " article_3_abstract, ";
$sql .= " id_article desc ";
//$sql .= " limit 200 ";
//$sql .= " limit 1 ";
$rlt = db_query($sql);
$id = 0;
$up = '';
$xxa = 'x';
$sax = '00'; /* Sala Atual */
//echo '<table width="'.$tab_max.'"><TR><TD>';
$it = 0;
$ar = 0;
$arn = 'x';
while ($line = db_read($rlt))
	{
	$it++;
	/** 
	 * Nome da sessão
	 */
	$sessao = $line['title'];
	
	/**
	 * Autores
	 */
	$a = $line['article_author'];
	$a = troca($a,';Bolsista PUCPR',';;[PUC]');
	$a = troca($a,'Prof.','');
	$a = troca($a,'Profa.','');
	$a = troca($a,'Dr.','');
	$a = troca($a,'Dra.','');
	$a = troca($a,'PROFª. DRª','');
	$a = troca($a,'PROFª. DR','');
	$a = troca($a,'PROF. DR','');
	
//	$a = troca($a,';Orientador',' - Orientador');
	$a = troca($a,';Colaborador',';[COL]');
	$a = troca($a,'Co-orientador','Coorientador');
//	$a = troca($a,';Aluno',' - Aluno');
//	$a = troca($a,';Aluna',' - Aluna');
//	$a = troca($a,'[ARU]','Bolsista Fundação Araucária');
//	$a = troca($a,'[CNPQ]','Bolsista CNPq');
//	$a = troca($a,'[PUC]','Bolsista PUCPR');
//	$a = troca($a,'[ICV]','Inicação Científica Voluntária');
//	$a = troca($a,'[COL]','Colaborador');
//	$a = troca($a,'[COO]','Coorientador');
//	$a = troca($a,'[ORI]','Orientador');
	$a = troca($a,' E ',' e ');
	$a = troca($a,'[icv]',' - Inicação Científica Voluntária');

	$a = troca($a,'[ARU]','');
	$a = troca($a,'[CNPQ]','');
	$a = troca($a,'[PUC]','');
	$a = troca($a,'[ICV]','');
	$a = troca($a,'[COL]','');
	$a = troca($a,'[COO]','');
	$a = troca($a,'[ORI]','');
	$a = troca($a,'- Bolsa Estratégica PUCPR','');
	$a = troca($a,'- Inicação Científica Voluntária','');
	$a = troca($a,'– Bolsista/fundação Araucária','');
	$a = troca($a,'- Bolsista CNPqq','');
	$a = troca($a,': Orientador','');
	$a = troca($a,': Autor','');
	$a = troca($a,'- Bolsista CNPq','');

	/**
	 *  Tratamento
	 */
	$au = array();
	$a = ' '.$a.chr(13);
	while (strpos($a,chr(13)) > 0)
		{
		$ap = strpos($a,chr(13));
		$as = trim(substr($a,0,$ap));
		$a = ' '.substr($a,$ap+1,strlen($a));
		if (strlen($as) > 0)
			{
			$as1 = $as;
			$as2 = '';
			$as3 = '';
			if (strpos($as,';') > 0) { $as1 = substr($as,0,strpos($as,';')); $as2 = ' '.substr($as,strpos($as,';')+1,strlen($as)); }
			if (strpos($as2,';') > 0) { $as2 = trim(substr($as,0,strpos($as,';'))); $as3 = trim(substr($as,strpos($as,';')+1,strlen($as))); } 

			if (strlen($as3) > 0) { $as2 = $as3; }
			$as1 = trim(troca($as1,chr(13),''));
			$as2 = trim(troca($as2,chr(13),''));
			if ($as2 == 'Orientador') { $orientador = 1; } else { $orientador = 0; }
			$as2 = troca($as2,';','');
			array_push($au,array(trim($as1),trim($as2),$orientador));
			}
		}

	$a = troca($a,';;','');
	$a = troca($a,';',' - ');
	$a = troca($a,'--','-');
	$a = troca($a,'  ',' ');
	
	$col = array();
	
	/* Grande Área */
	if ($line['seqx'] != $arn)
		{
		$arn = trim($line['seqx']);
		if ($arn == 2) { $sr .= '[Y]'.$area[($ar++)].'<BR>'; }
		if ($arn == 20) { $sr .= '[Y]'.$area[($ar++)].'<BR>'; }
		if ($arn == 40) { $sr .= '[Y]'.$area[($ar++)].'<BR>'; }
		if ($arn == 50) { $sr .= '[Y]'.$area[($ar++)].'<BR>'; }
		if ($arn == 70) { $sr .= '[Y]'.$area[($ar++)].'<BR>'; }
		$arn = $line['seqx'];
		}
	
	
	////////////////////////////////////////////// Gerar Nomes
	$n1 = '';
	$n2 = '';
	$n3 = '';

		if ($xxa != trim($line['abbrev']))
			{
			$nome_sessao = trim($line['title']);
			$sr .= '<HR>[Q]'.$line['title'];
//			$sr .= '('.$line['seq'].')<HR>';
			$nr = 0;
			$xxa = trim($line['abbrev']);
			}

//	for ($r=0;$r < count($au);$r++)
	for ($r=0;$r < 2;$r++)
		{
		$autor = NBR_autor($au[$r][0],7);
		$autor = troca($autor,'Aluno de ','');
		$autor = troca($autor,'Pucpr','PUCPR');
		$autor = troca($autor,'Cnpq','CNPq');
		$autor = troca($autor,'Ccet','CCET');
		$autor = troca($autor,'Ccbs','CCBS');
		$autor = troca($autor,'Csaa','CSAA');
		$autor = troca($autor,'Ctch','CTCH');
		$autor = troca($autor,'Ccjs','CCJS');
		$autor = troca($autor,'Ccsa','CCSA');
		$autor = troca($autor,' Em ',' em ');
		$autor = troca($autor,' No ',' no ');
		$autor = troca($autor,' Na ',' na ');
		$autor = troca($autor,' E ',' e ');
		$autor = troca($autor,'/pibic','  PIBIC');
		$autor = troca($autor,'PIBICjr','PIBIC Jr');
		$autor = troca($autor,'Pibicjr','PIBIC Jr');
		$autor = troca($autor,'Pibic Jr','PIBIC Jr');
		$autor = troca($autor,'puc-pr','PUCPR');
		$autor = troca($autor,'Puc-pr','PUCPR');
		$autor = troca($autor,'PUC-PR','PUCPR');
		$autor = troca($autor,'--','-');
		
		$autor = troca($autor,'Pós-graduação','Pós-Graduação');
		$autor = troca($autor,'Pós graduação','Pós-Graduação');
		$autor = troca($autor,'Pós Graduação','Pós-Graduação');
		$autor = troca($autor,'– Orientador','');
		$autor = troca($autor,'– Bolsista/pucpr','');
		$autor = troca($autor,'– Icv','');
		
		

		if ($au[$r][2] == 1)
			{
				$n1 = $au[$r][0].' '.chr(13).$n1;
			} else {
				$n1 .= $au[$r][0].' '.chr(13);
			}
			while (strpos($autor,'-') > 0)
				{ $autor = ''.substr($autor,0,strpos($autor,'-')-1); }
			if (strlen($au[$r][1]) > 0)
				{
					$n2 .= $autor.chr(13);
//					$n2 .= $autor.' - '.$au[$r][1].chr(13);
					$n3 .= $au[$r][0].';'.$au[$r][1].chr(13);		
				} else {
					$n2 .= $autor.chr(13);
					$n3 .= $au[$r][0].chr(13);		
				}
		}
	$aa1 = $n1;
	$aa2 = $n2;
	$aa3 = $n3;
	$ord = $n1;
	/**
	 * 
	 */
	 $aa2 = trim(troca($aa2,chr(13),'; '));
	 $aa2 = substr($aa2,0,strlen($aa2)-1).'.';
	 $aa2 = trim(troca($aa2,'–.','.'));
	 $aa2 = trim(troca($aa2,'–;',';'));
	 $aa2 = trim(troca($aa2,' ;',';'));
	 $aa2 = trim(troca($aa2,' .','.'));
	 $aax = trim($line['article_author']);
	 $aa2 .= ' - '.trim(substr($aax,strlen($aax)-7,5));
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	$seqa = $line['article_seq'];
	$nr = $nr + 1;
//	if ($sega > 50)
//		{
		$sega = $nr;
//		} else {
//		$sega = (50+$nr);
//		}
	$seq = $line['seq'];
	$ord = '['.strzero($seq,3) . '] '.$sigla.$line['abbrev'].' '.$ord;
	
	/**
	 * Tratamento de título
	 */
	 
	 $ttt = trim($line['article_title']);
	 $ttt = troca($ttt,' ','_');
	 $ttt = UpperCase(substr($ttt,0,1)).LowerCase(substr($ttt,1,strlen($ttt)));
	 $ttt = troca($ttt,'_',' ');
	 $ttt = troca($ttt,'paraná','Paraná');
	 $ttt = troca($ttt,'brasil','Brasil');
	 $ttt = troca($ttt,'são francisco do sul','São Francisco do Sul');
	 $ttt = troca($ttt,'santa catarina','Santa Catarina');
	 $ttt = troca($ttt,'rio iguaçu','Rio Íguaçu');
	 $ttt = troca($ttt,'piraquara','Piraquara');
	 $ttt = troca($ttt,'curitiba-pr','Curitiba-PR');
	 $ttt = troca($ttt,'curtiba','Curtiba');
	 $ttt = troca($ttt,'curitiba','Curitiba');
	 $ttt = troca($ttt,'curitiba','Curitiba');	 
	 $ttt = troca($ttt,'curitba','Curitiba');	 
	 
	 $ttt = troca($ttt,'rio jordão','Rio Jordão');
	 $ttt = troca($ttt,'américa do sul','América do Sul');
	 $ttt = troca($ttt,'frança','França');
	 $ttt = troca($ttt,'frança','França');
	 $ttt = troca($ttt,'alemanha','Alemanha');
	 $ttt = troca($ttt,'século xviii','Século XVIII');
	 $ttt = troca($ttt,' ipi',' IPI');
	 $ttt = troca($ttt,' icms',' ICMS');
	 $ttt = troca($ttt,' iss',' ISS');
	 $ttt = troca($ttt,' stf',' STF');
	 
	 $ttt = troca($ttt,'michel foucault','Michel Foucault');
	 $ttt = troca($ttt,'foucault','Foucault');
	 $ttt = troca($ttt,'associação paranaense de cultura','Associação Paranaense de Cultura');
	 $ttt = troca($ttt,'(apc)','(APC)');
	 $ttt = troca($ttt,'chão-defábrica','chão-de-fábrica');
	 $ttt = troca($ttt,'cetepar','Cetepar');
	 $ttt = troca($ttt,'projetos de ti','projetos de Ti');
	 $ttt = troca($ttt,'sub-bacia do iraí','sub-bacia do Iraí');
	 $ttt = troca($ttt,'almirante tamandaré','Almirante Tamandaré');
	 $ttt = troca($ttt,'/pr','/PR');

	 $ttt = troca($ttt,' / pr','/PR');
	 $ttt = troca($ttt,'são josé dos pinhais','São José dos Pinhais');
	 $ttt = troca($ttt,'tijucas do sul ','Tijucas do Sul');
	 $ttt = troca($ttt,'Pucpr','PUCPR');
	 $ttt = troca($ttt,'cetepar','Cetepar');
	 $ttt = troca($ttt,'almirante tamandaré','Almirante Tamandaré');

	 $ttt = troca($ttt,' toledo',' Toledo');
	 $ttt = troca($ttt,' – cei',' – CEI');
	 $ttt = troca($ttt,' spp',' SPP');
	 $ttt = troca($ttt,'immanuel kant','Immanuel Kant');
	 $ttt = troca($ttt,' kant',' Kant');
	 $ttt = troca($ttt,'perleman','Perleman');
	 $ttt = troca($ttt,'descartes','Descartes');
	 $ttt = troca($ttt,'gilles deleuze','Gilles Deleuze');
	 $ttt = troca($ttt,'merleau-ponty','Merleau-Ponty');
	 $ttt = troca($ttt,'friedrich nietzsche','Friedrich Nietzsche');

	 $ttt = troca($ttt,'nietzsche','Nietzsche');
	 $ttt = troca($ttt,'pinker','Pinker');
	 $ttt = troca($ttt,'shangrilá','Shangrilá');
	 $ttt = troca($ttt,'Brasileir','brasileir');
	 
	 $ttt = troca($ttt,'londrina','Londrina');
	 $ttt = troca($ttt,'maringá','Maringá');
	 $ttt = troca($ttt,'Brasileiro','brasileiro');
	 
	 
	 $ttt = troca($ttt,'<','&lt;');
	 $ttt = troca($ttt,'>','&gt;');
	 $ttt = troca($ttt,' ii',' II');
	 $ttt = troca($ttt,' iii',' III');
	 $ttt = troca($ttt,' iv',' IV');
	 
	 $ttt = troca($ttt,'(','{<I>');
	 $ttt = troca($ttt,')','}</I>');

	 $ttt = troca($ttt,'{','(');
	 $ttt = troca($ttt,'}',')');

	 /** SALA */

	$ab = trim($line['abbrev']);

	for ($q=0;$q < count($sl);$q++)
		{
		$ac = trim($sl[$q][1]);
		if ($ab == $ac)
			{
			if (($nr >= $sl[$q][2]) and ($nr <= $sl[$q][3]))
				{
				$sln = $sl[$q][4];
				}
			}
		}
	if ($sax != $sln)
		{
		$sr .= '<HR>';
		$sr .= '[L]'.$sln.'';
		$sr .= '<HR>';
		$sax = $sln;
		}
	
//	$sr .= '<div align="right">[C]'.$sigla.$line['abbrev'].'-'.$nr.'</div><TT>';
//	$sr .= '<div align="right">';
//	$sr .= '[C]'.$line['abbrev'].strzero($nr,2).'</div><TT>';
	$sr .= '[C]'.$line['abbrev'].strzero($line['article_seq'],2).'</div><TT>';
	
	$sr .= '[T]'.$ttt;
	$sr .= '<BR>';
	$sr .= '[A]'.($aa2);
	$sr .= '<HR>';
	
	$up .= "update articles set ";
//	$up .= " article_3_abstract = '".UpperCaseSql($ord)."' , ";
	$up .= " article_seq = '".$sega."' ";
	$up .= "where id_article = ".$line['id_article'].';'.chr(13);
//	echo mst($up);
	}
//echo $up;
echo '======ATUALIZADO========';
//echo '<BR>'.$ord;
//$rlt = db_query($up);
//echo '<HR>';
$sr = troca($sr,'[C]','</font><font size=3>');
$sr = troca($sr,'[A]','</B><i>');
$sr = troca($sr,'[T]','<b> ');
$sr = troca($sr,'</I></font><HR>','$$</B></I>');
$sr = troca($sr,'<HR>','</I>$$');
$sr = troca($sr,'$$','<HR>');
$sr = troca($sr,'[L]','<font size=5>');
?>
<TT>
</center>
<?=$sr;?>
<HR><?=$it;?>
