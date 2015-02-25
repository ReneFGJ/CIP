<?

$sql = "select *,sections.seq as seqx from articles ";
$sql .= "left join sections on article_section = section_id ";

$sql .= " where articles.journal_id = ".$jid;
$sql .= " and article_publicado <> 'X' ";
$sql .= " and sections.seq >= 79 ";
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
