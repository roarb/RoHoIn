<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/Core.php'; ?>
<?php $core = new AllCore() ?>
<div id="main-nav">
    <?php include $_SERVER['DOCUMENT_ROOT'].'/login/index.php'; ?>
    <paper-menu class="main-nav">
        <paper-button raised class="link-playtest-home">Playtesting Center</paper-button>
        <paper-button raised class="link-playtest-single-unit">Single Models</paper-button>
        <paper-button raised class="link-armybuilder-home">Army Builder</paper-button>
        <?php if ($core->getLoggedIn()): ?>
            <paper-button raised class="link-account-barracks">Your Barracks</paper-button>
            <paper-button raised class="link-account-home">Account Dashboard</paper-button>
        <?php endif; ?>
        <?php if ($core->getAdmin()): ?>
            <paper-button raised class="link-admin-home">Admin Panel</paper-button>
        <?php endif; ?>
        <paper-fab mini icon="home" class="nav-home link-roho-home primary"></paper-fab>
    </paper-menu>
    <paper-material elevation="1" class="small cushion">
        <?php include $_SERVER['DOCUMENT_ROOT'].'/footer/index.php'; ?>
    </paper-material>
</div>