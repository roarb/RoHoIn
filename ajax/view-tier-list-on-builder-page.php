<?php
include '../core/Core.php';
include '../core/tiered-list.php';

$tiers = new AllTieredLists();

$tierList = $tiers->getTieredListById($_GET['id']);
?>

<script type="text/javascript">
    var tierList = <?php echo json_encode($tierList); ?>;
    $('.tier-action-item').hover(function (){
        $(this).toggleClass('primary-focus');
    });
    $('.remove-tier').hover(function (){
        $(this).toggleClass('accent');
    });
</script>

<div class="tier-info">
    <paper-material elevation="1" class="cushion">
        <div class="remove-tiered-list" onclick="removeTierList()" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
            <paper-icon-button icon="cancel" class="remove-tier"></paper-icon-button>
            <span class="mo-notice hidden">Remove Tier</span>
        </div>
        <h3><?php echo $tierList['name'] ?> - Tiered List</h3>
        <ul>
            <li><strong>Battle Group:</strong> <?php echo $tierList['req_battlegroup_front'] ?></li>
            <li><strong>Units:</strong> <?php echo $tierList['req_units_front'] ?></li>
            <li><strong>Solos:</strong> <?php echo $tierList['req_solos_front'] ?></li>
            <li><strong>Battle Engines:</strong> <?php echo $tierList['req_battleengine_front'] ?></li>
        </ul>
        <paper-material elevation="1" class="cushion">
            <strong>Tier 1:</strong><br />
            <ul>
                <li><strong>Requirement:</strong> <?php echo $tierList['tier1_req_front'] ?></li>
                <li><strong>Bonus:</strong> <?php echo $tierList['tier1_bonus_front'] ?></li>
            </ul>
            <div class="choose-tiered-list" onclick="selectTierList(tierList, 1)" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                <paper-icon-button icon="playlist-add" class="choose-tier-1 tier-action-item"></paper-icon-button>
                <span class="mo-notice hidden">Activate Tier</span>
            </div>
        </paper-material>
        <paper-material elevation="1" class="cushion">
            <strong>Tier 2:</strong><br />
            <ul>
                <li><strong>Requirement:</strong> <?php echo $tierList['tier2_req_front'] ?></li>
                <li><strong>Bonus:</strong> <?php echo $tierList['tier2_bonus_front'] ?></li>
            </ul>
            <div class="choose-tiered-list" onclick="selectTierList(tierList, 2)" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                <paper-icon-button icon="playlist-add" class="choose-tier-2 tier-action-item"></paper-icon-button>
                <span class="mo-notice hidden">Activate Tier</span>
            </div>
        </paper-material>
        <paper-material elevation="1" class="cushion">
            <strong>Tier 3:</strong><br />
            <ul>
                <li><strong>Requirement:</strong> <?php echo $tierList['tier3_req_front'] ?></li>
                <li><strong>Bonus:</strong> <?php echo $tierList['tier3_bonus_front'] ?></li>
            </ul>
            <div class="choose-tiered-list" onclick="selectTierList(tierList, 3)" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                <paper-icon-button icon="playlist-add" class="choose-tier-3 tier-action-item"></paper-icon-button>
                <span class="mo-notice hidden">Activate Tier</span>
            </div>
        </paper-material>
        <paper-material elevation="1" class="cushion">
            <strong>Tier 4:</strong><br />
            <ul>
                <li><strong>Requirement:</strong> <?php echo $tierList['tier4_req_front'] ?></li>
                <li><strong>Bonus:</strong> <?php echo $tierList['tier4_bonus_front'] ?></li>
            </ul>
            <div class="choose-tiered-list" onclick="selectTierList(tierList, 4)" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">
                <paper-icon-button icon="playlist-add" class="choose-tier-4 tier-action-item"></paper-icon-button>
                <span class="mo-notice hidden">Activate Tier</span>
            </div>
        </paper-material>
    </paper-material>
</div>