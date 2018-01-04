<?php

/*
 * Plugin Name: Projekty Intellegro
 * Plugin URI: http://www.karolszczesny.com
 * Description: Do zarządzani projektami 
 * Version: 0.3
 * Author: Karol szczesny
 * Author URI: http://www.karolszczesny.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}




// plugin uninstallation clean up
register_uninstall_hook( __FILE__, 'my_projeky_uninstall' );
function my_projeky_uninstall() {
    delete_option( 'options_projeky' );
}


require_once ('option_page.php');





// varable to set admin value
function projekty_toolbar_link($wp_admin_bar) {
   	$current_user = wp_get_current_user();
   	$currentemail = $current_user->user_email ;
  	$project_options = get_option("options_projeky");

	$admin_mail = $project_options  ['mail_admin'];
	$admin_login = $project_options  ['login_admin'];

	$user_mail_1 = $project_options  ['user_mail_1'];
	$user_1_login = $project_options  ['login_mail_1'];
	
	$user_mail_2 = $project_options  ['user_mail_2'];
	$user_2_login = $project_options  ['login_mail_2'];




   if ($currentemail == $admin_mail ) {
    $args = array(
		        'id' => 'wpbeginner',
		        'title' => 'ZARZĄDZANIE', 
		        'href' => $admin_login, 
		        'meta' => array(
		            'class' => 'wpbeginner', 
		            'target' => '_BLANK',
		            'title' => 'Zlecanie działań,  błędów, kontrola wykonalności. Co zostało wykonane a co jeszcze należy , przechowywanie  plików. '
		            )
		    );
		    $wp_admin_bar->add_node($args);
   	}
	elseif ($currentemail == $user_mail_1 ) {
  	
  
			 $args = array(
		        'id' => 'wpbeginner',
		        'title' => 'ZARZĄDZANIE', 
		        'href' => $user_1_login, 
		        'meta' => array(
		            'class' => 'wpbeginner', 
		            'target' => '_BLANK',
		            'title' => 'Zlecanie działań,  błędów, kontrola wykonalności. Co zostało wykonane a co jeszcze należy , przechowywanie  plików. '
		            )
		    );
		    $wp_admin_bar->add_node($args);
		}
	elseif ($currentemail == $user_mail_2 ) {
  	
  
			 $args = array(
		        'id' => 'wpbeginner',
		        'title' => 'ZARZĄDZANIE', 
		        'href' => $user_2_login, 
		        'meta' => array(
		            'class' => 'wpbeginner', 
		            'target' => '_BLANK',
		            'title' => 'Zlecanie działań,  błędów, kontrola wykonalności. Co zostało wykonane a co jeszcze należy , przechowywanie  plików. '
		            )
		    );
		    $wp_admin_bar->add_node($args);
		}
   
}
add_action('admin_bar_menu', 'projekty_toolbar_link', 1);

	

