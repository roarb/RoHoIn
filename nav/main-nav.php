<?php // material design old code ?>
<?php /*
<md-button class="md-button-toggle full left-subhead md-primary md-hue-1" onclick="mainNavToggle();">Where To?</md-button>
<md-content layout="column" layout-align="space-around start" style="display:none;" id="mainNav">
    <md-button class="full" onclick="location.href='/playtest/'">Playtestering</md-button>
    <md-button class="full" onclick="location.href='/armybuilder/'">Army Builder</md-button>
 	<?php if ($_SESSION['user_name'] == 'roarb'): ?>
    	<md-button class="full" onclick="location.href='/admin/'">Admin Panel</md-button>
    <?php endif; ?>
    <?php if (isset($_SESSION['user_name'])): ?>
    	<md-button class="full" onclick="location.href='/account/'">Account Dashboard</md-button>
    <?php endif; ?>
    <md-button class="full" onclick="location.href='http://roho.in'">Home</md-button>
</md-content> */ ?>

<paper-menu class="main-nav">
    <paper-button raised class="link-playtest-home">Playtesting Center</paper-button>
    <paper-button raised class="link-playtest-single-unit">Single Models</paper-button>
    <paper-button raised class="link-armybuilder-home">Army Builder</paper-button>
    <?php if (isset($_SESSION['user_name'])): ?>
        <paper-button raised class="link-account-barracks">Your Barracks</paper-button>
        <paper-button raised class="link-account-home">Account Dashboard</paper-button>
    <?php endif; ?>
    <?php if ($_SESSION['user_name'] == 'roarb' || $_SESSION['user_name'] == 'rohoin'): ?>
        <paper-button raised class="link-admin-home">Admin Panel</paper-button>
    <?php endif; ?>
    <paper-fab mini icon="home" class="nav-home link-roho-home primary"></paper-fab>
</paper-menu>
