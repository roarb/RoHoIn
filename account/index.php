<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php';
    $user = $_SESSION; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Your RoHo.in Account Center</title>
</head>

<body class="default">

<paper-drawer-panel>
    <paper-header-panel drawer>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
        </paper-toolbar>
        <?php include '../login/index.php'; ?>
        <?php include '../nav/main-nav.php'; ?>
    </paper-header-panel>

    <paper-header-panel main>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            <h1 class="full-page-title">Your RoHo.in Account Center</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <div class="info-block cushion">
            <?php if (isset($_SESSION['user_name'])): ?>
                <paper-material elevation="1" class="cushion">
                    <p>Welcome <?php echo $user['user_name'] ?>, this will be your account dashboard.</p>
                    <p>From here we'll be adding:</p>
                    <ul><li>A way to keep track of your Army Lists and how well they perform for you.</li>
                        <li>Your currently owned and painted models in the <a href="/account/barracks.php" title="Barracks">Barracks</a></li>
                        <li>A photo gallery</li>
                        <li>And all your personal stats vs the website stats</li></ul>
                </paper-material>
            <?php else: ?>
                <paper-material elevation="1">
                    <p>It doesn't look like you have an account, please <a href="http://roho.in/login/register.php" title="Register a New Account">register for one</a>.</p>
                </paper-material>
            <?php endif; ?>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>