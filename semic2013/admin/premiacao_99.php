<?

$sql = "select * from articles where article_award='1' and journal_id = 67
			and article_modalidade = '$modalidade'
			order by article_ref  ";
$rlt = db_query($sql);
$id = 0;
while ($line = db_read($rlt))
	{
		if ($id==$idr)
		{
			$trabalho = trim($line['article_title']);
			$ref = trim($line['article_ref']);
			$cod = trim($line['article_3_keywords']);
			$autres = trim($line['article_author']);
			
			if (substr($cod,0,2)=='IC')
			{
			$cod = substr($cod,2,7);
				
			if (strlen($cod) > 0)
				{
					$sql = "select * from pibic_bolsa_contempladas 
							inner join pibic_aluno on pb_aluno = pa_cracha 
							inner join pibic_professor on pb_professor = pp_cracha
 							inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_protocolo = '".$cod."' ";
					
					$rlt = db_query($sql);
					$line = db_read($rlt);
					$estudante = trim($line['pa_nome']);
					$orientador = trim($line['pp_nome']);
					$curso = trim($line['pa_curso']);
				} else {

				}
			}
			if (substr($cod,0,2)=='MS')
			{
					echo '<CENTER>';
					echo '<h1>'.$ref.'</h1>';
					echo '<h3>'.$title.'</h3>';
					echo '<h1>'.mst($autres).'</h1>';
					echo '<h2>'.$professor.'</h2>';				
			}
		}
		$id++;
	}
?>			