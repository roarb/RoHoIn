<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../core/Core.php';
    include '../../core/DamageImmunity.php';
    include '../../admin/header.php';
    $allTypes = new AllDamageImmunityTypes;
    $typesList = $allTypes->getAllDamageImmunityTypes();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Damage / Immunity Type Additions - RoHo.in Admin Panel</title>
</head>

<body class="default">
<?php if($_SESSION['user_name'] ==  'roarb'): ?>
    <paper-drawer-panel>
        <paper-header-panel drawer>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            </paper-toolbar>
            <?php include '../../nav/main-nav.php'; ?>
        </paper-header-panel>

        <paper-header-panel main>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
                <h1 class="full-page-title">Damage / Immunity Type Additions</h1>
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
                        <h3>Current Damage / Immunity Types:</h3>
                        <paper-item>
                            <paper-item-body class="list-items">
                                <div class="md-tile-content">
                                    <ul>
                                        <?php foreach ($typesList as $type): ?>
                                            <?php echo '<li>'.$type['name'].'</li>'; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </paper-item-body>
                        </paper-item>
                    </paper-material>
                </div>
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Add a Damage / Immunity Type:</h3>
                        <form action="damage-type-save.php" id="damage-type-form" method="post">
                            <paper-input-container>
                                <label>New Damage / Immunity Type</label>
                                <input id="new-damage-type" name="new-damage-type" is="iron-input">
                            </paper-input-container>
                            <paper-button class="full-width-button" onclick="submitForm('#damage-type-form')">Submit</paper-button>
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
        $('.faction-select-toolbar .damage-type').addClass('active');
    });
</script>
</body>
</html>
