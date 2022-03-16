<?php
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit;
	if ( get_option( 'gutenblock_options' ) != false ) {
		delete_option( 'gutenblock_options' );
	}
?>
