<?php

/**
 * Post to a P2 from the command line (OSX at least)
 *
 * Easier with something like this in your .bash_profile:
 *
 * status_update() {
 *      php ~/Development/tools/status-update.php "$1" "$2"
 * }
 *
 * Then run as:
 *
 * status_update "This is my status update" "tag1, tag2, tag with a space"
 */

// setup
$xmlrpc_user = 'YOUR XMLRPC USERNAME';
$xmlrpc_pass = 'YOUR XMLRPC PASSWORD';
$xmlrpc_url  = 'YOUR XMLRPC ENDPOINT';

// using it wrong
if ( ! isset( $argv[1] ) )
	die( 'no valid status update submitted' );

// generate an array of tags to use if a second argument exists
if ( isset( $argv[2] ) )
	$tags = explode( ',', $argv[2] );
else
	$tags = array();

$data = array(
	'post_content' => $argv[1],
	'post_format'  => 'status',
	'post_status'  => 'publish',
	'terms_names'  => array(
		'post_tag' => $tags,
		),
);

$params = array( 0, $xmlrpc_user, $xmlrpc_pass, $data );
$request = xmlrpc_encode_request( 'wp.newPost', $params );

// the poor coder's XMLRPC
$ch = curl_init();
curl_setopt( $ch, CURLOPT_POSTFIELDS, $request );
curl_setopt( $ch, CURLOPT_URL, $xmlrpc_url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $ch, CURLOPT_TIMEOUT, 1 );
$results = curl_exec( $ch );
curl_close( $ch );

// And.... Assume success like a boss. ;)
