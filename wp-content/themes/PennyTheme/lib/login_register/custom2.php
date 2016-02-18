<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - PennyTheme
*	More Info: http://sitemile.com/p/penny
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/

	include 'sett.php';
	include 'login.php';
	include 'register.php';
	

	add_action('init', 'PennyTheme_do_login_register_init', 99);
	
	//=======================================================
	
		function PennyTheme_do_login_register_init()
		{
		  global $pagenow;
		
			if(isset($_GET['action']) && $_GET['action'] == "register")
			{
				PennyTheme_do_register_scr();	
			}
		
		  switch ($pagenow)
		  {
			case "wp-login.php":	
			   PennyTheme_do_login_scr();
			break;
			case "wp-register.php":
			   PennyTheme_do_register_scr();
			break;
		  }
		}
		
	//=========================================================	



?>