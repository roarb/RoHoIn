<?php 

include'_header.php';

?>

<div class="cushion logged-in">
    <div class="welcome-msg" style="float:left; padding-top:5px; width:80%;">Welcome <strong><?php echo $_SESSION['user_name'] ?></strong></div>
    <paper-icon-button icon="more-vert" onclick="toggleLoggedInMoreMenu()" style="float:right; padding-top:0;"></paper-icon-button>
    <div class="clear"></div>
    <div id="login-more-menu" style="height:0; overflow:hidden; padding:0;">
        <paper-button raised class="link-logout">Log Out</paper-button>
        <paper-button raised class="link-login-edit">Edit User Data</paper-button>
    </div>
</div>


