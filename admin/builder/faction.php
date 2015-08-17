<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../core/Core.php';
    include '../../core/Faction.php';
    include '../../admin/header.php';  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Faction Additions - RoHo.in Admin Panel</title>
</head>

<body class="default">
<?php if($_SESSION['user_name'] ==  'roarb'): ?>
    <paper-drawer-panel>
        <paper-header-panel drawer>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            </paper-toolbar>
            <?php include '../../login/index.php'; ?>
            <?php include '../../nav/main-nav.php'; ?>
            <paper-fab mini icon="arrow-back" class="nav-back link-out primary-focus" data-src="/admin/builder.php"></paper-fab>
        </paper-header-panel>

        <paper-header-panel main>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
                <h1 class="full-page-title">Add a New Faction</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
               <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="horizontal layout">
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Current Factions:</h3>
                        <paper-item>
                            <paper-item-body class="list-items">
                                <div class="md-tile-content">
                                    <ul>
                                        <?php $allFactions = new AllFactions;
                                        $factionsList = $allFactions->getAllFactions();

                                        foreach ($factionsList as $faction){
                                            echo '<li>'.$faction['name'].'</li>';
                                        }  ?>
                                    </ul>
                                </div>
                            </paper-item-body>
                        </paper-item>
                    </paper-material>
                </div>
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Add a Faction:</h3>
                        <form action="faction-save.php" id="faction-form" method="post">
                            <paper-input-container>
                                <label>New Faction</label>
                                <input id="new-faction" name="new-faction" is="iron-input">
                            </paper-input-container>
                            <paper-button raised class="full-width-button" onclick="submitForm('#faction-form')">Submit</paper-button>
                        </form>
                    </paper-material>
                </div>
            </div>
        </paper-header-panel>
    </paper-drawer-panel>
<?php else: ?>
    <paper-drawer-panel>
        <paper-header-panel drawer>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            </paper-toolbar>
            <?php include '../../login/index.php'; ?>
            <?php include '../../nav/main-nav.php'; ?>
        </paper-header-panel>

        <paper-header-panel main>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
                <h1 class="full-page-title">Please login as Admin first</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <div class="info-block">
                <p class="cushion center">This area is off limits for all but the most awesome of people.</p>
            </div>
        </paper-header-panel>
    </paper-drawer-panel>
<?php endif; ?>
<script>
    $(document).ready(function(){
        $('.faction-select-toolbar .faction').addClass('active');
    });
</script>
</body>
</html>
