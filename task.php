<?php

#Task one

// WP_Query arguments
$args = array(
	'post_type'              => array( 'company' ),
	'post_status'            => array( 'publish' ),
	'posts_per_page'         => '100',
	'order'                  => 'DESC',
	'orderby'   			 => 'meta_value_num',
	'meta_key'  			 => 'sponsored',
	'meta_query' 			 => array(
									'relation' => 'AND',
									array(
										'key'     => 'ranking',
										'compare' => 'EXISTS',
									),
									array(
										'key'     => 'sponsored',
										'compare' => 'EXISTS',
									),
								),
);

// The Query
$query = new WP_Query( $args );


#Task two


//http://yourwpsite.dev/wp-admin/admin-ajax.php?action=add-notifier-email&email=test@dev.com&company_id=12345

add_action( 'wp_ajax_add-notifier-email', 'add_notifier_email' );
add_action( 'wp_ajax_nopriv_add-notifier-email', 'add_notifier_email' );

function add_notifier_email(){
	$email =$company_id = '';
	if(!isset($_REQUEST['email']) || $_REQUEST['email'] != '' ) return;
	if(!isset($_REQUEST['company_id']) || $_REQUEST['company_id'] != '' ) return;
	$email =$_REQUEST['email'];
	$company_id = $_REQUEST['company_id'];
	$email_notifier = array(
	    'email' => $email
	);

	add_row('email_notifiers', $email_notifier,$company_id);
}



#Task three


// WPCLI 

// $ wp post list --post_type=company 
$ wp post meta update $(wp post list --post_type=company) _Upgraded=true
