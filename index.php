<?php include 'login/index-start.php'; ?>
<html lang="en">
<head>
    <?php include 'admin/header.php'; ?>
    <?php include 'core/Core.php'; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>RoHo.in Experiments in Futility</title>
    <?php $core = new AllCore(); ?>
    <?php $admin = $core->getAdmin(); ?>
</head>

<body class="default">

<paper-drawer-panel>
    <paper-header-panel drawer>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
        </paper-toolbar>
        <?php include 'nav/main-nav.php'; ?>
    </paper-header-panel>

    <paper-header-panel main>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            <h1 class="full-page-title"><a href="http://roho.in">Reactive Online Hobby Organizational . Interface</a></h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <h2 class="cushion-sides">Welcome to RoHo.in - currently still in beta</h2>
        <div class="horizontal layout col2-set">
            <div class="flex-2 cushion-sides info-block-title col-1">
                <paper-material elevation="1" class="cushion large" style="display:block">
                    <p>The goal of this site is to create a place to research, plan, track and evolve your Warmachine - Hordes wargaming hobby.</p>
                    <p>Currently in the beta state, everything is still a work in progress. If you do happen to see a bug, or something that isn't working quite right,
                        there is a 'bug tracker' button in the bottom right corner of every page. Please click on that button and fill out the form. Every bug reported
                        is a bug that doesn't make it to the final version of the site.</p>
                    <p>Over the past few months I've been building the database up to contain every model, weapon, ability and stat. And currently I'm working on my goal of
                        creating the most accurate and fool proof army builder around. You can test the army build with the link below, or browse any of the models in the game
                        with the other link.</p>
                    <p>RoHo.in also has the ability to create an account and login. If you do, a few more features will open up. For one, you'll have the ability to save
                        models to your <a href="/account/barracks.php" title="Account Barracks">'barracks'</a>. This feature will then keep track of which models you have, which ones you
                        have painted and can run some stat crunching on that.<br />
                        Furthermore, we plan on adding a feature to allow you to build an army list limited by either the models you own, or only your painted models. Finally, if you're
                        browsing another players army list, the models you own and/or have painted will also be shown, so you'll immediately be able to see if you could use that list.</p>
                    <p>As the site continues to grow and expand there are a number of things we'd love to add in. However we'd love to hear from you as well about any new
                        features, or elements that you think could make the site even better. Please <a href="mailto:rob@roho.in">email rob@roho.in</a>, we'd be happy to hear from you.</p>
                    <p>Eventual upgrade ideas include:
                    <ul>
                        <li>Club Formation - private section</li>
                        <li>Privately shared army lists</li>
                        <li>Peer to Peer social interaction</li>
                        <li>Model vs. Model combat</li>
                        <li>Tournament Organizational Tools</li>
                        <li>Automated Leagues</li>
                        <li>Personal / Club game tracking</li>
                        <li>Big data analytics on models / lists / players</li>
                    </ul>
                    </p>
                </paper-material>
            </div>
            <div class="flex-2 cushion-sides info-block-title col-2">
                <paper-button raised class="full-button link-playtest-single-unit">
                    Browse Individual Models
                </paper-button>
                <?php if ($admin): ?>
                    <paper-button raised class="full-button link-admin-home">
                        Admin Panel
                    </paper-button>
                <?php endif; ?>
                <?php if ($core->getLoggedIn()): ?>
                    <paper-button raised class="full-button link-account-barracks">
                        View Your Barracks
                    </paper-button>
                <?php else: ?>
                    <?php /*<paper-button raised class="full-button link-login-register"> // we'll need to add something to incentivize a login here.
                        Log in to view your Barracks
                     </paper-button> */ ?>
                <?php endif; ?>
                <paper-button raised class="full-button link-armybuilder-home">
                    Create a New Army List
                </paper-button>
            </div>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>