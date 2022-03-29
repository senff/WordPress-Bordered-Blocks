<?php
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit;
	if ( get_option( 'borderedblocks_options' ) != false ) {
		delete_option( 'borderedblocks_options' );
	}
?>
