
<paper-material class="cushion">
    <div class="center" style="margin-bottom:8px; border-bottom:1px solid #d1d1d1;"><?php include('_header.php'); ?></div>
    <form method="post" action="/index.php" name="loginform" id="login-form" style="margin-bottom:14px; padding-bottom:10px; border-bottom:1px solid #d1d1d1;">
        <paper-input-container>
            <label for="user_name">User Name</label>
            <input is="iron-input" id="user_name" type="text" name="user_name" required />
        </paper-input-container>
        <paper-input-container>
            <label for="user_password">Password</label>
            <input is="iron-input" id="user_password" type="password" name="user_password" autocomplete="off" required />
        </paper-input-container>
        <paper-toggle-button checked onclick="toggleCheckbox('#user_rememberme')"></paper-toggle-button><label for="user_rememberme" style="padding-left:10px;">Remember Me</label><br /><br />
        <input type="checkbox" class="hidden" id="user_rememberme" name="user_rememberme" value="1" />
        <?php //<input type="submit" name="login" value="Log In" /> ?>
        <paper-button raised <?php //onclick="submitForm('#login-form')" ?> id="submit-login" ">Log In</paper-button>
    </form>
    <paper-button raised class="full-width-button link-login-register">Register New Account</paper-button>
    <paper-button raised class="full-width-button link-login-password-reset">Forgot My Password</paper-button>
</paper-material>

<script>
    $('#submit-login').on('touchstart click', function(){
        $.post("http://roho.in/login/ajax/login.php", function(data){
            console.log(data);
        })
    })
</script>