<?php
session_start();

if(!isset($_SESSION['vidTitle']))
{
	$_SESSION['vidTitle'] = '';
}

if(isset($_POST['vidTitle']))
{
	if($_POST['vidTitle']!=null)
	{
		$vidTitle = $_POST['vidTitle'];
		$_SESSION['vidTitle'] = $vidTitle;
	}
	echo $_SESSION['vidTitle'];
}

