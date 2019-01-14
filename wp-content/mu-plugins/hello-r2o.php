<?php
/*
Plugin Name: Hello ubk
Plugin URI: 
Description: Says nice things about ubk
Author: ubk
Version: 1.0.2
*/

function hello_r2o_get_quotes() {
    /** Quotes - one per line */
    $hello_r2o_quotes = "Hello WordPress";

    // Here we split it into lines
    $hello_r2o_quotes = explode( "\n", $hello_r2o_quotes );

    // And then randomly choose a line
    return wptexturize( $hello_r2o_quotes[ mt_rand( 0, count( $hello_r2o_quotes ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_r2o() {
    $chosen = hello_r2o_get_quotes();
    echo "<p id='r2o'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_r2o' );

// We need some CSS to position the paragraph
function r2o_css() {
    // This makes sure that the positioning is also good for right-to-left languages
    $x = is_rtl() ? 'left' : 'right';

    echo "
	<style type='text/css'>
	#r2o {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'r2o_css' );