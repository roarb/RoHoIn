<?php include('login/index-start.php'); ?>
<html lang="en">
<head>
<?php include 'admin/header.php'; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RoHo.in Experiments in Futility</title>
</head>

<body class="default">

<paper-drawer-panel>
    <paper-header-panel drawer>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
        </paper-toolbar>
        <?php include 'login/index.php'; ?>
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
        <h2 class="cushion">Welcome to RoHo - experience the experiments</h2>
        <div class="horizontal layout">
            <div class="flex-2">
                <paper-button raised class="full-button link-playtest-single-unit">
                    Browse Individual Models
                </paper-button>
                <?php if ($_SESSION['user_name'] == 'roarb' || $_SESSION['user_name'] == 'rohoin'): ?>
                    <paper-button raised class="full-button link-admin-home">
                        Admin Panel
                    </paper-button>
                <?php endif; ?>
            </div>
            <div class="flex-2">
                <?php if ($_SESSION['user_id'] != ''): ?>
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