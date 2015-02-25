<?
global $lib_resumo;
$lib_resumo = true;
echo '<BR>Biblioteca de extensão carregada<BR>';
function resumo_ext_autor_2($_lx)
	{
	$_lx = troca($_lx,'Ccjs','CCJS');
	$_lx = troca($_lx,'Ccet','CCET');
	$_lx = troca($_lx,'Ctch','CTCH');
	$_lx = troca($_lx,'Ccbs','CCBS');
	$_lx = troca($_lx,'Cctp','CCTP');
	$_lx = troca($_lx,'Ccsa','CCSA');
	
	return($_lx);
	}
	
function resumo_ext_resumo($_lx)
	{
	$_lx = troca($_lx,'Objetivo(s):','Objetivos:');
	$_lx = troca($_lx,'Resultado(s):','Resultados:');
	
	$_lx = troca($_lx,'<B>','');
	$_lx = troca($_lx,'</B>','');
	$_lx = troca($_lx,'<b>','');
	$_lx = troca($_lx,'</b>','');
	$_lx = troca($_lx,'<BR>',chr(13));
	$_lx = troca($_lx,'<br>',chr(13));
	return($_lx);
	}
		
function resumo_ext_autor($_lx)
	{
	$_lx = troca($_lx,'<B>','');
	$_lx = troca($_lx,'</B>','');
	$_lx = troca($_lx,'<b>','');
	$_lx = troca($_lx,'</b>','');
	$_lx = troca($_lx,'(Noturno) ','');
	$_lx = troca($_lx,'(Manhã) ','');
	$_lx = troca($_lx,'(Tarde) ','');
	$_lx = troca($_lx,'(Diurno) ','');
	
	
	$_lx = troca($_lx,'Centro de Ciências Jurídicas e Sociais - ','');
	$_lx = troca($_lx,'Centro de Teologia e Ciências Humanas - ','');
	$_lx = troca($_lx,'Centro de Ciências Biológicas e da Saúde - ','');
	$_lx = troca($_lx,'Centro de Ciências Exatas e de Tecnologia - ','');
	$_lx = troca($_lx,'Centro de Ciências, Tecnologia e Produção - ','');
	$_lx = troca($_lx,'Centro de Ciências Sociais Aplicadas - ','');
	
	$_lx = troca($_lx,'Bacharelado em ','');
	$_lx = troca($_lx,'Curso de ','');
	$_lx = troca($_lx,'- Hab.: ',': ');
	$_lx = troca($_lx,'Licenciatura em ','');
	$_lx = troca($_lx,'(Ênfase em Agroindústria) ','');
	$_lx = troca($_lx,'(Controle e Automação)','');
	$_lx = troca($_lx,'(quarta e quinta)','');




	
	
	
	$_lx = troca($_lx,'; ',';');
	$_lx = troca($_lx,';Orientador',';;[ORI]');
	$_lx = troca($_lx,';Bolsa CNPq',';;[CNPQ]');
	$_lx = troca($_lx,';Bolsa PUCPR',';;[PUC]');
	$_lx = troca($_lx,';Bolsa Fundação Araucária',';;[ARU]');
//	$_lx = troca($_lx,';Bolsa PUCPR',';;[PUC]');

	$_lx = troca($_lx,';Coorientador',';;[COO]');
	$_lx = troca($_lx,';Colaborador',';;[COL]');
	
	$_lx = troca($_lx,'Coorientador;(Excluir se não existir)','');
	$_lx = troca($_lx,'Colaborador;(Excluir se não existir)','');

	$_lx = troca($_lx,';Aluna ICV','[ICV]');
	$_lx = troca($_lx,';Iniciação Científica Voluntária','[ICV]');
	
//	$_lx = troca($_lx,'','[ARU]')
//	$_lx = troca($_lx,'',';;[PUC]');
//	$_lx = troca($_lx,'
//	$_lx = troca($_lx,'			
	$_lx = troca($_lx,'<BR>',chr(13));
	$_lx = troca($_lx,'<br>',chr(13));
	return($_lx);
	}
?>