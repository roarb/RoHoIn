<?php 

include'_header.php';

?>

<div class="cushion logged-in">
    <div class="welcome-msg" style="float:left; padding-top:5px; width:80%;">Welcome <strong><?php echo $_SESSION['user_name'] ?></strong></div>
    <paper-icon-button icon="more-vert" onclick="toggleLoggedInMoreMenu()" style="float:right; padding-top:0;"></paper-icon-button>
    <div class="clear"></div>
    <paper-material elevation="2" class="cushion" id="login-more-menu" style="height:0; padding:0; overflow:hidden; text-align:center;">
        <paper-button raised class="link-logout">Log Out</paper-button>
        <paper-button raised class="link-login-edit">Edit User Data</paper-button>
    </paper-material>
</div>


