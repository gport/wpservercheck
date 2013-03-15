<?php

	// PHP version check
	echo '<h2>PHP Version Check</h2>';	
	
	echo 'The current PHP version is: ' . phpversion() . '.<br/>';

	if(phpversion() > '5.2.4') {
		
		$phpsupport = true;
		
		echo '<span style="color: green; font-weight: bold">Passed!</span> (Wordpress requires PHP version 5.2.4 or higher).<br/>';
		echo '<b style="color: green">Yay, PHP is ready to run Wordpress.</b><br/>';

	} else {
		
		$phpsupport = false;
		
		echo '<span style="color: red; font-weight: bold">Failed!</span> (Wordpress requires PHP version 5.2.4 or higher).<br/>';
		
		echo '<b style="color: red">';
		
			$phpmessage = 'Please ask your hosting company to upgrade to PHP version 5.2.4 or higher.';	
			echo $phpmessage;
		
		echo '</b><br/>';	
		
	}
	
	// mySQL version check
	echo '<h2>mySQL Version Check</h2>';

	$mysqlserver = 'localhost';
	$mysqluser = 'username';
	$mysqlpass = 'password';	

	$link = @mysql_connect($mysqlserver,$mysqluser,$mysqlpass);

	if(!$link || mysql_error()) {
    		    	
	   echo '<b style="color: red">Could not connect to the specified mySQL server, please check your credentials.</b><br/>';
	    	
    } else {
	    
		echo 'The current mySQL version is: ' . mysql_get_server_info() . '.<br/>';

		if(mysql_get_server_info() > '5.0') {
			
			$sqlsupport = true;
			
			echo '<span style="color: green; font-weight: bold">Passed!</span> (Wordpress requires mySQL version 5.0 or higher).<br/>';
			echo '<b style="color: green">Super, mySQL is ready to run Wordpress.</b><br/>';
	
		} else {
			
			$sqlsupport = false;
			
			echo '<span style="color: red; font-weight: bold">Failed!</span> (Wordpress requires mySQL version 5.0 or higher).<br/>';
			
			echo '<b style="color: red">';
			
				$sqlmessage = 'Please ask your hosting company to upgrade to mySQL version 5.0 or higher.';
				echo $sqlmessage;
			
			echo '.</b><br/>';
					
						
		}

		mysql_close($link);
		
	}
	
	echo '<h2>Mod_rewrite Version Check</h2>';
	
	// MOD rewrite check
	
	if(in_array('mod_rewrite', apache_get_modules())){
		
		$modreritesupport = true;
		
		echo 'Mod_rewrite is <span style="color: green; font-weight: bold">enabled</span>.<br/>';
		echo '<b style="color: green">Great, your server is configured to use mod_rewrite! This enables the use of pretty permalinks on Wordpress (don\'t forget to make your .htaccess writable).</b><br/>';
					
	} else {
		
		$modreritesupport = false;
		
		echo 'Bummer. mod_rewrite is <span style="color: #a8a805; font-weight: bold">disabled</span>.<br/>';
		
		echo '<b style="color: #a8a805">';
		
			$modmessage = 'Please ask your hosting company to enable mod_rewrite if you want those pretty permalinks.';			
			echo $modmessage;

		echo '</b><br/>';
		

	}
		
	// GD library version
	$dgversionarray = gd_info();
	$gdversion = ereg_replace('[[:alpha:][:space:]()]+', '', $dgversionarray['GD Version']);

	echo '<h2>GD library Version</h2>';
	
	echo 'The current GD library version is: ' . $gdversion . '.<br/>';

	if($gdversion > '0') {
		
		$gdsupport = true;
		
		echo 'This means that the GB Library is <span style="color: green; font-weight: bold">enabled</span>.<br/>';
		echo '<b style="color: green">Awesome, Wordpress will be able to resize your images beautifully!</b><br/>';

	} else {
		
		$gdsupport = false;
		
		echo 'The GB Library is <span style="color: #a8a805; font-weight: bold">disabled</span>.<br/>';
		
		echo '<b style="color: #a8a805">';
		
			$gdmessage = 'You can\'t resize images with Wordpress. Ask your hosting company to enable the GB library for this functionality.';		
			echo $gdmessage;
		
		echo '</b><br/>';
		
	}

	// Conclusion
	
	echo '<h1>Conclusion</h1>';
	
	if($phpsupport && $sqlsupport && $modreritesupport && $gdsupport) {
		
		echo '<b style="color: green">Amazing! Seems like the folks at your hosting company actually know what they are doing! Your server is 100% ready to run Wordpress including pretty permalinks and the resizing of images!</b><br/>';
		
	} elseif(!$phpsupport || !$sqlsupport){
		
		echo '<b style="color: red">You are not ready to run Wordpress, your server doesn\'t meet some of the core requirements.</b><br/><br/>To fix this you need to take the following steps:<br/>';
		
		if(!$phpsupport) {
			
			echo '- <b>' . $phpmessage . '</b><br/>';
			
		}
		if(!$sqlsupport) {
			
			echo '- <b>' . $sqlmessage . '</b><br/>';
			
		}
		if(!$modreritesupport || !$gdsupport) {
		
			echo '<br/>Next to the missing core requirements, your server is also missing some functionality. To fix those, take the following steps:<br/>';
		
			if(!$modreritesupport) {
				
				echo '- <b>' . $modmessage . '</b><br/>';
				
			}	
			if(!$gdsupport) {
				
				echo '- <b>' . $gdmessage . '</b><br/>';
				
			}
		
		}
						
	} else {

		echo '<b style="color: green">Nice! Your server is ready to run Wordpress</b>, <b style="color: #a8a805">but you will be missing some extra functionality.</b><br/><br/>To fix this you need to take the following steps:<br/>';
		
		if(!$modreritesupport) {
			
			echo '- <b>' . $modmessage . '</b><br/>';
			
		}	
		if(!$gdsupport) {
			
			echo '- <b>' . $gdmessage . '</b><br/>';
			
		}
				
	}
	
	echo '<br/><small>Please note that the author of this script does not accept any responsability for mistakes in this script.</small>';	
	
?>