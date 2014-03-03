<?php

function loadPage($pageName)
{
	if(file_exists('php/pages/'.$pageName.'.php'))
	{
		include('php/pages/'.$pageName.'.php');
	}
	if(file_exists('pages/'.$pageName.'.php'))
	{
		include('pages/'.$pageName.'.php');
	}
}

function content()
{
	if(isset($_GET['page']))
		{
			loadPage($_GET['page']);
		}
		else
		{
			loadPage('start');
		}
}

?>