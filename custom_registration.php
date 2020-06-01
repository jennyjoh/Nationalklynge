<?php 
/* Template Name: Custom Registration Page 
 *
 * Registration Page Template.
 *
 * @author Jenny Johannessen
 * @since 1.0.0
 */

global $wpdb;

if ($_POST) {
    
    $username = $wpdb->escape($_POST['uid']);
    $email = $wpdb->escape($_POST['mail']);
    $password = $wpdb->escape($_POST['pwd']);
    $passwordRepeat = $wpdb->escape($_POST['pwd-repeat']);

$error = array();

    if (strpos($username, ' ')!==FALSE) {
        $error['username_space'] = "Username has space";
    }

    if(empty($username)) {
        $error['username_empty'] = "Needed Username must";
    }

    if(username_exists($username)) {
        $error['username_exists'] = "Username already exists";
    }

        if(!is_email($email)) {
        $error['email_valid'] = "Email has no valid value";
    }

        if(email_exists($email)) {
        $error['email_existence'] = "Email already exists";
    }

    if(strcmp($password , $passwordRepeat) !==0) {
        $error['password'] = "Password did not match";
    }

    if (count($error) == 0) {
		
		add_action('user_register', 'auto_login_after_register');

		function auto_login_after_register( $user_id ){
			global $wpdb;
			
			 //echo "Redirect1";

			 $creds = array();
			 $creds['user_login'] = $wpdb->escape($_POST['uid']);
			 $creds['user_password'] = $wpdb->escape($_POST['pwd']);
			
			 $creds['remember'] = false;
			 $user = wp_signon( $creds, false );
			
			if ( is_wp_error($user) ) {
            	echo $user->get_error_message();
        	} else { 
				//echo "Redirect2";

				wp_redirect( site_url('mit-nk') );
				exit;
			 }
		}    
		
		wp_insert_user( array ('user_login' =>$username, 'user_pass'=>$password, 'user_email'=>$email, 'role' => 'member') );   
		
// 		$user_id = wp_create_user($username, $password, $email);
// 		$user = new WP_User($user_id);
// 		$user->set_role('member');
		
         echo "User created successfully";
//         exit();
		
		
    } else {
        print_r($error);
    }
    
}


get_header();

?>



<!--
<form action="">
    <p>
        <label for="txtUsername">Brugernavn</label>
        <div>
            <input type="text" id="txtUsername" name="txtUsername" placeholder="Brugernavn">
        </div>
    </p>
</form>
-->

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Signup</h1>
                <form class="form-signup" method="POST">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="uid" placeholder="Username">
                    
                    <label for="email">E-mail</label>
                    <input type="text" id="email" name="mail" placeholder="E-mail">
                    
                    <label for="password">Adgangskode</label>
                    <input type="password" id="password" name="pwd" placeholder="Password">
                    
                    <label for="repeatpwd">Gentag adgangskode</label>
                    <input type="password" id="repeatpwd" name="pwd-repeat" placeholder="Repeat password">
                    
                    <button id="signupbtn" type="submit" name="signup-submit">Tilmeld</button>
                </form>
        </section>
    </div>
</main>

<?php get_footer(); ?>