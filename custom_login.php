<?php 
/**
 * Template Name: Custom login page - JJ
 *
 * Login Page Template.
 *
 * @author Jenny Johannessen
 * @since 1.0.0
 */

get_header(); 

global $user_ID;
global $wpdb;

if (!$user_ID) {

    if ($_POST) {
        //protect against SQL injection
        $username = $wpdb->prepare($_POST['username']);
        $password = $wpdb->prepare($_POST['password']);

        $login_array = array();
        $login_array['user_login'] = $username;
        $login_array['user_password'] = $password;

        $verify_user = wp_signon($login_array, true);
        if (!is_wp_error($verify_user)) {
            echo "<script>window.location = '".site_url('/mit-nk/')."'</script>";
        }else {
            echo "<div class='invalid'><p>Invalid credentials</p></div>";
        }
    }else {
        # code...
    }
    //user is not logged in
    ?>
<main id="site-content" role="main">

<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			
		}
	}

    ?>
    

 <div class="nk-login">
        <h2 class="h2-login">This needs to be styled</h2>
            <form method="POST">
                <label class="labeltxt" for="username">Brugernavn eller email</label>
                    <input id="username" type="text" placeholder="Brugernavn eller email" name="username">
                <label class="labeltxt" for="password">Adgangskode</label>
                    <input id="password" type="password" placeholder="Adgangskode" name="password">
                    <input type="submit" name="submit" value="Submit">
            </form>
</main>
    <?php
    get_footer(); 

} else {
    //user is logged in
}

?>