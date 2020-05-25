<?php 
/* Template Name: Custom Registration Page 
 *
 * Registration Page Template.
 *
 * @author Jenny Johannessen
 * @since 1.0.0
 */

get_header();

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
        wp_create_user($username, $password, $email);
        echo "User created successfully";
        exit();
    } else {
        print_r($error);
    }
    
}
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