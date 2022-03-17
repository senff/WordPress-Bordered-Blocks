<?php
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit;
	if ( get_option( 'gutenborders_options' ) != false ) {
		delete_option( 'gutenborders_options' );
	}
?>
