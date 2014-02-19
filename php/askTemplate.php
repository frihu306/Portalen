<?php

if($_GET['template_id'] == 'no')
{
	echo '{"type":"no","start":"","end":""}';
}

if($_GET['template_id'] == 1)
{
	echo '{"type":1,"start":"2014-02-19 18:00","end":"2014-02-19 22:00"}';
}

if($_GET['template_id'] == 2)
{
	echo '{"type":2,"start":"2014-02-19 22:00","end":"2014-02-20 03:00"}';
}

?>