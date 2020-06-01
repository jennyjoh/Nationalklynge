<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

/*function wpb_custom_new_menu() {
  register_nav_menu('my-custom-menu',__( 'TopMenu' ));
}*/


function wpb_custom_new_menu() {
    register_nav_menus(
        array(
            'top-menu' => __( 'Top Menu' )
		)
    );
}

add_action( 'init', 'wpb_custom_new_menu' );



//Shows admin bar only to administrators
add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

// //Redirects users based on their user roles
// function my_login_redirect( $url, $request, $user ){
// if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
// if( $user->has_cap( 'administrator') or $user->has_cap( 'author')) {
// $url = admin_url();
// } else {
// $url = home_url();
// }
// }
// return $url;
// }
// //add_filter('login_redirect', 'my_login_redirect', 10, 3 );




//when users log out, they are redirected to log-in page 
function redirect_to_home () {
	wp_redirect(site_url());
	exit();

}
add_action("wp_logout", "redirect_to_home");
/*
*/

/*
//when accessing wp-login, redirect to custom log in page
add_action("init", "fn_redirect_wp_admin");


function fn_redirect_wp_admin() {
	global $pagenow;
	if($pagenow == 'wp-login.php' && $_GET['action'] != "logout"){
		wp_redirect(site_url()."/log-in");
		exit;
	}
}
*/

// Add a custom user role

$result = add_role( 'member', __(
'Member' ),
array( 
	'read' => true, // true allows this capability
'edit_posts' => true, // Allows user to edit their own posts
'create_posts' => true, // Allows user to create new posts
'read_private_pages' => true,
'edit_themes' => false, // false denies this capability. User can’t edit your theme
'install_plugins' => false, // User cant add new plugins
'update_plugin' => false, // User can’t update any plugins
'update_core' => false // user cant perform core updates
) 

);

/**
* Add read_private_posts capability to subscriber
* Note this is saves capability to the database on admin_init, so consider doing this once on theme/plugin activation

add_action ('admin_init','add_sub_caps');
 
function add_sub_caps() {
    global $wp_roles;
    $role = get_role('member');
    $role->add_cap('read_private_pages');
}
*/
/* Block non-administrators from accessing the WordPress back-end with redirect
Skal jeg bruge denne her? Hvad er konsekvenserne?

function wpabsolute_block_users_backend() {
	if ( is_admin() && ! current_user_can( 'administrator' ) && ! wp_doing_ajax() ) {
		wp_redirect( home_url('/mit-nk /') ); //re-direct til loginomraade?
		exit;
	}
}
add_action( 'init', 'wpabsolute_block_users_backend' );
*/