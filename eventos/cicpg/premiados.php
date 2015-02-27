<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require("../../db_reol2_pucpr.php");

$cp = array();

array_push($cp, array('Internacional oral','iFISIOL03T','iEPR11T'));
array_push($cp, array('Internacional poster','iMED09','iCOMUN01'));
array_push($cp, array('CICPG poster - Vida','BIOQ12','BIOQ14','BIOG06'));
array_push($cp, array('CICPG poster - Exatas e Engenharia','EAMB55T','QUI16','QUI11T'));
array_push($cp, array('CICPG poster - Sociais Aplicadas','COMUN22','DIR31','DIR10'));
array_push($cp, array('CICPG poster - Humanidades e Letras','TEO95','EDU29','EDU03'));
array_push($cp, array('CICPG poster - Agr rias','CTA23T','CTA11','MEDVET103T'));
array_push($cp, array('CICPG oral - Vida','FAR04*','EF30*','MED12*'));
array_push($cp, array('CICPG oral - Exatas e Engenharia','ELE20*','QUI14*','ECV14'));
array_push($cp, array('CICPG oral - Sociais Aplicadas','ADM02*','ADM06*','ADM57*'));
array_push($cp, array('CICPG oral - Humanidades e Letras','HIS07*','LETR10*','SOCIO04*'));
array_push($cp, array('CICPG oral - Agrária','MEDVET31*','FLORE17*','MEDVET61*'));
array_push($cp, array('PIBIC poster - Vida','BOT01','ECO05','SC07'));
array_push($cp, array('PIBIC poster - Exatas e Engenharia','EAMB25','EPR13','ECV15'));
array_push($cp, array('PIBIC poster - Sociais Aplicadas','DIRpr13','COMUN09','ADM11'));
array_push($cp, array('PIBIC poster - Humanidades e Letras','FILO81','EDU19','EDU01'));
array_push($cp, array('PIBIC poster - Agrária','AGRO01','AGRO21','MEDVET01'));
array_push($cp, array('PIBIC oral - Vida','ODO08*','ECO09*'));
array_push($cp, array('PIBIC oral - Exatas e Engenharia','CCOMP39*','QUI05*'));
array_push($cp, array('PIBIC oral - Sociais Aplicadas','ARQUR05*','DIR53*'));
array_push($cp, array('PIBIC oral - Humanidades e Letras','EDU55*','TEO73*'));
array_push($cp, array('PIBIC oral - Agrária','MEDVET81*','MEDVET75*'));
array_push($cp, array('Pós-Graduação - Vida (Oral, poster, externo)','PPGCA117*','PODO104','PODO105'));
array_push($cp, array('Pós-Graduação - Exatas e Engenharia (Oral, poster, externo)','PMEC135','PPGTS101','PEPR110'));
array_push($cp, array('Pós-Graduação - Sociais Aplicadas (Oral, poster, externo)','PPLAN02','PDIR118','PDIR135'));
array_push($cp, array('Pós-Graduação - Humanidades e Letras (Oral, poster, externo)','PEDU115','PFILO122','PTEO108'));
array_push($cp, array('PIBITI - Oral ','EDU77T*','EBIO03T*'));
array_push($cp, array('PIBITI - poster','EAMB61t','CCOMP25T'));
array_push($cp, array('PIBIC Jr','PIBICjr29','PIBICjr08'));
array_push($cp, array('Jovens ideias','JI05','JI02','JI10'));
array_push($cp, array('Pesquisar ‚ evoluir','PEV11','PEV03','PEV04'));


for ($a=0;$a < count($cp);$a++)
	{
		echo '<HR><h1>'.$cp[$a][0].'</h1><BR>';
		for ($i=1;$i < count($cp[$a]);$i++)
		{
			$ii = trim($cp[$a][$i]); 
			$id = mostra_painel(trim($ii));
			if (strlen($id) == 0)
				{
					if ($ii = '') { $id = 0; }
				}
			$link = '<A HREF="trabalho.php?dd0='.$id.'" target="new">';
			echo '(<font color="blue">'.$link.$id.'</A></font>)';
			//echo '<HR>'.$id;		
		}
	}

		function mostra_painel($id='')
			{
				//$id = troca($id,'*','');
				if (strlen($id) > 0)
				{
					echo '<BR><BR><BR><BR><BR><BR><BR>';
				$sql = "select * from articles 
						where journal_id = 85 and (article_ref = '".$id."')
								 and article_publicado = 'S'";
				$rlt = db_query($sql);
				$id = '';
				if ($line = db_read($rlt))
					{
						print_r($line);
						exit;
						return($line['id_article']);
					}
				}
	
				return($sx);
			}
?>
