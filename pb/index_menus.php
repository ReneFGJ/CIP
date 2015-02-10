<?php
/* Redirecionamentos */

/* Menu principal */
$menu = array('about','expediente','anais','other_editions');
if ($jid == 62)
	{
		if ($pb->submission == 'S') 
		{
			$menu = array('about','expediente','inscricao','organizacao','hospedagem','about_cwb','contact'); 
		} else {
			$menu = array('about','expediente','fotos','organizacao','hospedagem','about_cwb','contact'); 	
		}
	}	
		 

if (trim($pb->tipo) == 'J')
	{
	$menu = array('actual','about','board','issues');
	
	
if ($jid == 9)
	{ $menu = array('actual','about','board','issues'); }


	/* SUBMIT OPEN */	
	if ($pb->submission == 'S') {
		$links = $pb->submission_link;
		if (strlen($link) > 0)
			{
				array_push($menu,$link);
			} else {
				array_push($menu,'submit');
			}
		 
	}

	
	//array_push($menu,'search');
	if ($jid == 9)
		{
			array_push($menu,'contact');
			array_push($menu,'authors');
		} else {
			array_push($menu,'authors');
		}	
	}

if ($jid == 61)
	{ $menu = array('about','expediente','anais','other_editions'); }
?>