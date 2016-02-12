// JavaScript Document

function reveal(item){
	jQuery(item).show();
}

function disappear(item){
	jQuery(item).hide();
}

function unitSelected(){
	var unitType = jQuery('#unit-type').val();
	if (unitType == 'Warlock' || unitType == 'Warcaster'){
		reveal('#spell1-item');
		reveal('#bg-points-item');
		reveal('#feat-item');
	}
	if (unitType == 'Warlock' || unitType.indexOf("Warbeast") > -1){
		reveal('#fury-item');
	}
	if (unitType == 'Warcaster'){
		reveal('#focus-item');
	}
	if (unitType.indexOf("Warbeast") > -1){
		reveal('#threshold-item');
		reveal('#animus-known-item');
		reveal('#damage-spiral-item');
	}
	if (unitType.indexOf("jack") > -1 || unitType.indexOf("Vector") > -1 || unitType.indexOf("Myrmidon") > -1){
		reveal('#damage-grid-item');
	}
	if (unitType == 'Unit' || unitType == 'Solo'){
		reveal('#purchase-low-item');
		reveal('#purchase-high-item');
	}
}

function factionSelected(){
	var faction = jQuery('#faction').val();
	if (faction == 'Minions' || faction == 'Mercenaries'){
		reveal('#related-faction-item');
	}
}


function slideDown(element){
	var h = $(element).height();
	$(element).height(0).show();
		$(element).animate({
			opacity: 1,
			height: h
		  }, 1000);
}

function slideAway(element){
	var h = $(element).height();
	$(element).animate({
			opacity: 0,
			height: 0
		  }, 1000, function(){
			  $(element).hide().height(h);
			  });
}

function showType(str){
    $.post('/ajax/gettype.php?type='+str)
        .done(function(data){
            $('#type-select').html(data);
            $('#model-select').html('');
        });
}

function showModels(str){
    $.post('/ajax/gettype.php?model='+str)
        .done(function(data){
            $('#model-select').html(data);
        });
}

function loadSingleModel(name) {
	window.location.assign("/playtest/single-unit.php?name="+name);
}

function updateUnitCount(val,type,userId,unitName, unitId){
    $.post("/ajax/update-barracks.php?user="+userId+"&count="+val+"&type="+type+"&unit="+unitName)
        .done(function(data){
            $('#unit-update-feedback').html(data);
            barracksModelsCount(userId, unitId);
        });
}

function toggleBarracksFaction(faction){
	// get toggle switch current class
	var factionRows = jQuery('.barracks-entries .'+faction);
	if (jQuery(factionRows).hasClass('show')){
		jQuery(factionRows).removeClass('show').addClass('hide');
	} else {
		jQuery(factionRows).removeClass('hide').addClass('show');
	}	
}

// ajax loaders
    function showAjaxLoading(){
        var shadowBox = '<div class="ajax-loader" id="ajax-loader"><paper-spinner active></paper-spinner></div><div class="shadow" id="ajax-shadow"></div>';
        $('body').append(shadowBox);
    }

    $(document).ajaxComplete(function() {
        hideAjaxLoading()
    });

    function hideAjaxLoading(){
        $('#ajax-loader').remove();
        $('#ajax-shadow').remove();
    }

// notification window
    function displayNotice(msg, bool){ // msg = the notice message, bool = true/success false/error
        var noticeClass = '';
        if (bool == true){
            noticeClass = 'success';
        } else if (bool == false){
            noticeClass = 'error';
        }
        var noticeBox = '<div class="ajax-loader '+noticeClass+'" id="notice-loader" onclick="removeNotice();">'+msg+'</div>';
            noticeBox += '<div class="shadow" id="notice-shadow" onclick="removeNotice();"></div>';
        $('body').append(noticeBox);
    }

    function removeNotice(){
        $('#notice-shadow.shadow').remove();
        $('#notice-loader').remove();
        $('#choice-loader').remove();
    }

// menu object movement scripts //
function toggleLoggedInMoreMenu(){
    var menu = $('#login-more-menu');
    if ($(menu).height() == 0){
        $(menu).animate({
            height: 32
        }, 500)
    } else {
        $(menu).animate({
            height: 0
        }, 500)
    }
}

$(document).ready(function(){
	$('#nav-login-button').on('click', function(){
        slideDown('#login-window');
		slideAway('#start-login-button');
    });
    // links built for touchstart / click //
    $('.link-roho-home').on('touchstart click', function(){ window.location = '/index.php';});
    $('.link-account-home').on('touchstart click', function(){ window.location = '/account/index.php';});
    $('.link-account-barracks').on('touchstart click', function(){ window.location = '/account/barracks.php';});
    $('.link-admin-home').on('touchstart click', function(){ window.location = '/admin/index.php';});
    $('.link-armybuilder-home').on('touchstart click', function(){ window.location = '/armybuilder/index.php';});
    $('.link-login-register').on('touchstart click', function(){ window.location = '/login/register.php';});
    $('.link-login-password-reset').on('touchstart click', function(){ window.location = '/login/password_reset.php';});
    $('.link-logout').on('touchstart click', function(){ window.location = '/index.php?logout';});
    $('.link-login-edit').on('touchstart click', function(){ window.location = '/login/edit.php';});
    $('.link-playtest-home').on('touchstart click', function(){ window.location = '/playtest/index.php';});
    $('.link-playtest-all-abilities').on('touchstart click', function(){ window.location = '/playtest/all-abilities.php';});
    $('.link-playtest-all-spells').on('touchstart click', function(){ window.location = '/playtest/all-spells.php';});
    $('.link-playtest-all-units').on('touchstart click', function(){ window.location = '/playtest/all-units.php';});
    $('.link-playtest-all-weapons').on('touchstart click', function(){ window.location = '/playtest/all-weapons.php';});
    $('.link-playtest-single-unit').on('touchstart click', function(){ window.location = '/playtest/single-unit.php';});

    $('.link-out').on('touchstart click', function(){
        var data = $(this).data('src');
        window.location = 'http://roho.in'+data;
    });
    // size the info block with a vert scrollbar where needed
    infoBlockResize();

    // size the info block if there is an additional toolbar present
    infoBlockToolsResize();

    //size the info block if there is a h2 title above the infoblocks
    infoBlockTitleResize();

    //size the main nav block
    mainNavResize();

    // adds larger drop shadow to buttons on hover
    $('.paper-button').hover(
        function(){
            $(this).attr('elevation', 3);
        }, function(){
            $(this).attr('elevation', 1);
        }
    );

});

function infoBlockResize(){
    var infoBlock = $('.info-block');
    var infoH = $(infoBlock).height();
    var h = $(window).height() - 64;
    $(infoBlock).css('max-height',h);
    if (infoH+64 > $(window).height()){
        $(infoBlock).css('overflow-y', 'auto');
    }
}

function infoBlockToolsResize(){
    var infoBlockTools = $('.info-block-tools');
    var infotH = $(infoBlockTools).height();
    var th = $(window).height() - 100;
    $(infoBlockTools).css('max-height',th);
    if (infotH+100 > $(window).height()){
        $(infoBlockTools).css('overflow-y', 'auto');
    }
}

function infoBlockTitleResize(){
    var infoBlockTools = $('.info-block-title');
    var infotH = $(infoBlockTools).height();
    var th = $(window).height() - 115;
    $(infoBlockTools).css('max-height',th);
    if (infotH+100 > $(window).height()){
        $(infoBlockTools).css('overflow-y', 'auto');
    }
}

function mainNavResize(){
    var infoBlockTools = $('#main-nav');
    var infotH = $(infoBlockTools).height();
    var th = $(window).height() - 64;
    $(infoBlockTools).css('max-height',th);
    if (infotH+100 > $(window).height()){
        $(infoBlockTools).css('overflow-y', 'auto');
    }
}

// barracks updater
function barracksModelsCount(userId, unitId){
    $.get("/ajax/update-barracks-new-painted.php?user="+userId+"&model="+unitId, function (data){
        $('#barracks-update').html(data);
    });
}

// paper/iron form element helpers //
function toggleCheckbox(id){
    var checkBox =  $(id);
    //checkBox.prop("checked", !checkBox.prop("checked"));
    if (checkBox.val() == 0){
        checkBox.val(1);
    } else {
        checkBox.val(0);
    }
}

function toggleCheckInCheckbox(id){
    var checkbox = $(id);
    if (checkbox.attr('checked')==true){
        $(checkbox).attr('checked', false);
    } else {
        $(checkbox).attr('checked', true);
    }
}

function submitForm(id) {
    $(id).submit();
}

// bug reporting build out
$(document).ready(function(){
    var bugFab = '<paper-fab icon="bug-report" class="bug-fab fixed-fab" id="bug-report"></paper-fab>';
        bugFab += '<paper-toast text="Submit a Bug Report" id="bug-toast"></paper-toast>';
        bugFab += '<div id="bug-report-form"></div>';
    $('body').append(bugFab);

    $('#bug-report').on('touchstart click', function(){
        $.get("/ajax/bug-report.php?url="+window.location.href, function(data){
            $('#bug-report-form').show();
            $('#bug-report-form').html(data);
        })
    });
    $('#bug-report').mouseover(function(){
        document.querySelector('#bug-toast').show();
    });
});
function submitBugForm(){
    var url = "/ajax/bug-report-submission.php";
    $.ajax({
        type: "POST",
        url: url,
        data: $('#submit-bug-report-form').serialize(),
        success: function(data) {
        }

    });
    // reset the window thanking them for the input.
    var thankYou = '<p style="padding-top:30px;">Thank you for your Bug Submission. We\'ll make sure to inform you when a solution has been put in place.</p><br />';
        thankYou += '<paper-button raised id="close-bug-report">Close</paper-button>';
        thankYou += "<script>$('#close-bug-report').on('touchstart click', function() {$('#bug-report-form').hide();});";
    $('.bug-report-wrapper').html(thankYou);
    return false; // avoid to execute the actual submit of the form.
}

function expandUnitDisplay(el){
    var addBlock = $(el).parent().find('.additional-model-info');
    $(el).toggleClass('open');
    var openHeight = $(addBlock).height() + 80;
    if ($(addBlock).hasClass('open')){
        $(el).parent().animate({
            height: 36
        }, 1000);
        $(addBlock).animate({
            opacity: 0
        }, 1000, function(){
            $(addBlock).removeClass('open').hide();
        });
    } else {
        $(addBlock).show();
        $(el).parent().animate({
            height: openHeight
        }, 1000);
        $(addBlock).animate({
            opacity: 1
        }, 1000, function(){
            $(addBlock).addClass('open');
        });
    }
}