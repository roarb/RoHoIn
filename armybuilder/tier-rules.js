function displayTierListSelection(el,tierListId){ // el = clicked element, tierListId = the id of the available tiered lists separated by |
    // check first if another .tiered-army-list-choice window was populated if so, reshow that , if not build one.
    if ($('.tiered-army-list-choice').length > 0){
        showTierOptions();
    } else {
        var tierListIds = tierListId.split('|');
        $(tierListIds).each(function(key, id){
            if (id != '') { // need to add a check for cases where there are more than one tier list option returned.
                showAjaxLoading();
                var msg = '';
                var choiceBox = '<div class="ajax-loader tiered-army-list-choice" id="choice-loader">';
                $.ajax({
                    url: '/ajax/view-tier-list-on-builder-page.php?id='+id,
                    type: 'post',
                    dataType: 'html',
                    success: function(data) {
                        msg += data;
                        choiceBox += msg;
                        choiceBox += '</div><div class="shadow" id="notice-shadow"></div>';
                        $('body').append(choiceBox);
                        hideAjaxLoading();
                    }
                });
            }
        });
    }
}

function selectTierList(tierObject, level){
    // selected from displayTierListSelect() popup window, tierObject = the entire tier object, level is the tier chosen - use to start applying rules to the page
    // 1 - change the button clicked to display a checkmark and change the iron-icon class to accent or secondary focus
    var selectedIcon = $('.choose-tier-'+level);
    $('.tier-action-item').removeClass('secondary selected').attr('icon', 'playlist-add'); // removes any previously selected tiers
    $(selectedIcon).addClass('secondary selected').attr('icon', 'check');

    // 2 - add the tier name to the #display-army-tier that is clickable to reopen the .tiered-army-list-choice
    var tierChoiceReadout = '<span onclick="showTierOptions()" style="cursor:pointer;">'+tierObject['name']+' - tier '+level+'</span>';
    $('#display-army-tier').html(tierChoiceReadout);

    // 2.1 update the tier icon on the warcasters block to indicate that a tier has been chosen, on click relaunch the .tiered-army-list-choice
    $('.leader .view-tiers').addClass('secondary selected');

    // 2.2 update the tempList with the selected tier
    tempList['tierListId'] = tierObject['id'];
    tempList['tierListLevelSet'] = level;
    tempList['tierObject'] = tierObject;

    // 3 - apply the tier 1 rules
    if (level > 0){
        // 2.2 remove tier 2+ previously chosen tier rules
        resetTierRulesToBase();  // this action will need to reset the army list - need to populate warning yes/no
        applyTierRules(tierObject, 1);
    }

    // 4 if level > 1 apply the tier 2 rules
    if (level > 1){
        applyTierRules(tierObject, 2);
    }

    // 5 if level > 2 apply the tier 3 rules
    if (level > 2){
        applyTierRules(tierObject, 3);
    }

    // 6 if level > 3 apply the tier 4 rules
    if (level > 3){
        applyTierRules(tierObject, 4);
    }

    // last change the popup (.tiered-army-list-choice) and the #notice-shadow displays to none.
    $('.ajax-loader.tiered-army-list-choice').animate({
        opacity:0
    }, 1000, function(){
        $('.ajax-loader.tiered-army-list-choice').hide().css('opacity',1);
    });
    $('#notice-shadow').animate({
        opacity:0
    }, 1000, function(){
        $('#notice-shadow').hide().css('opacity',.5);
    });

    armyListBuilderShortSave();
}

function showTierOptions(){
    $('.tiered-army-list-choice').show();
    $('#notice-shadow').show();
}

function resetTierRulesToBase (){
    // reset the #tier-list-req-notice level 2 3 4 blocks
    $('#tier-list-req-notice').html('');
    // reset tempList object requirements to contain only tier 1 to start run
    tempList['tierList2Req'] = [];
    tempList['tierList3Req'] = [];
    tempList['tierList4Req'] = [];
    // adjust the page to reflect only tier one.
    unsetTierBonus(tempList['tierList2Ben'], 2); // val = rule to be rest, key+2 = level
    unsetTierBonus(tempList['tierList3Ben'], 3); // val = rule to be rest, key+2 = level
    unsetTierBonus(tempList['tierList4Ben'], 4); // val = rule to be rest, key+2 = level
}

function removeTierList(){
    // unselect all tier choices
    // return caster tier icon to default
    // remove text from .tiered-army-list-choice
    // remove all chosen tier rules
    // close the popup window
    $('.tiered-army-list-choice').hide();
    $('#notice-shadow').hide();
    armyListBuilderShortSave();
}

function applyTierRules(tierObject, level, run){ // tierObject = tier rules in object - level = tier level chosen, run = null or 'add' if on a unit model addition call

    var caster = $('#model-id-'+tierObject["caster"]).parent().attr('id');
    var battlegroupNumber = caster.replace('battlegroup-','');
        battlegroupNumber = battlegroupNumber.replace('-built','');
    var battleGroup = '#battlegroup-'+battlegroupNumber;
    var section = ['#battle-engine-picker',battleGroup,'#unit-picker','#solo-picker'];
    var modelRules = ['req_battleengine_rules','req_battlegroup_rules','req_units_rules','req_solos_rules'];
    $('.unit').addClass('tier-chosen'); // add class 'tier-chosen' to all models
    if (run != 'add') { // skip this step on a second run
        $(modelRules).each(function (key, val) { // run the tier 1 limited models rules
            tierFocusedModelDisplay(section[key], tierObject[val]);
        });
    }
    // apply the first tier level bonus
    var tier1BonusRules = tierObject['tier1_bonus'].substring(1,(tierObject['tier1_bonus'].length - 1)); // remove the open and close []
    tier1BonusRules = tier1BonusRules.split(']['); // create an array of the rules
    $(tier1BonusRules).each(function(key, val){ // loop through each model affected to apply rules
        applyBonusRules(val,1); // val = rule to apply, 1 = tier level
    });
    if (level == 2){ // run the tier 2 level rules
        var tier2BonusRules = tierObject['tier2_bonus'].substring(1,(tierObject['tier2_bonus'].length - 1)); // remove the open and close []
        tier2BonusRules = tier2BonusRules.split(']['); // create an array of the rules
        $(tier2BonusRules).each(function(key, val){
            applyBonusRules(val,2); // val = rule to apply, 2 = tier level
            //console.log('tier 2 bonus '+val); // will display the rule to be applied
        });
        // populate requirements block
        processTierReq(tierObject['tier2_req'], level); // tierObject['tier2_req'] = tier 2 requirement rule, level = tier level set
    }
    if (level == 3){ // run the tier 3 level rules
        var tier3BonusRules = tierObject['tier3_bonus'].substring(1,(tierObject['tier3_bonus'].length - 1)); // remove the open and close []
        tier3BonusRules = tier3BonusRules.split(']['); // create an array of the rules
        $(tier3BonusRules).each(function(key, val){
            applyBonusRules(val,3); /// val = rule to apply, 3 = tier level
            //console.log('tier 3 bonus '+val); // will display the rule to be applied
        });
        // populate requirements block
        processTierReq(tierObject['tier3_req'], level); // tierObject['tier3_req'] = tier 3 requirement rule, level = tier level set
    }
    if (level == 4){ // run the tier 4 level rules
        var tier4BonusRules = tierObject['tier4_bonus'].substring(1,(tierObject['tier4_bonus'].length - 1)); // remove the open and close []
        tier4BonusRules = tier4BonusRules.split(']['); // create an array of the rules
        $(tier4BonusRules).each(function(key, val) {
            applyBonusRules(val, 4); /// val = rule to apply, 4 = tier level
            //console.log('tier 4 bonus '+val); // will display the rule to be applied
        });
        // populate requirements block
        processTierReq(tierObject['tier4_req'], level); // tierObject['tier4_req'] = tier 4 requirement rule, level = tier level set
    }
}

function tierFocusedModelDisplay(section,rules){
    if (rules != null){
        rules = rules.substring(1, (rules.length-1));
        rules = rules.split('][');
        $(rules).each(function(key, val){
            var models = val.split(',');
            if (models[1] == 99){ // unlimited models can be added for this model id
                $(section).find('.model-id-'+models[0]).addClass('in-tier');
            }
        })
    }
}

function applyBonusRules(rule,level){
    var rulesBreakDown = rule.split(','); // rulesBreakDown[0] == the location to apply the rule
    defineBonusRuleLoc(rulesBreakDown[0], rulesBreakDown[1], level);
}

function defineBonusRuleLoc(rawLoc, rule, level){
    var loc = '';
    if (rawLoc == ''){
        return;
    } else if (rawLoc == 'caster'){ // rule location is the caster model
        loc = $('#battlegroup-1-built .leader');
        defineBonusRuleAction(loc, rule, rawLoc, level);
    } else if (rawLoc.indexOf('type') > -1 || rawLoc.indexOf('modelType') > -1){ // 'rule location is type or modelType';
        // to get the type for heavy/light warjack/vector/myrmidon/warbeast loop through the battlegroup unit objects looking for unit type.
        var type = rawLoc.substring(rawLoc.indexOf('==')+2);
        $(bgUnitObject).each(function(key,val){
            if (typeof val != 'undefined'){
                if (val['type'] == type){
                    loc = $('.model-id-'+val['id']);
                    defineBonusRuleAction(loc, rule, val['id'], level);
                }
            }
        });
    } else { // location is model id
        loc = $('.model-id-'+rawLoc);
        defineBonusRuleAction(loc, rule, rawLoc, level);
    }
}

function defineBonusRuleAction(loc, rule, id, level){ // loc = model Id or 'caster'
    // find the model and add class 'tier-x-rule-applied'
    if (rule.indexOf('FA') > -1 ){ // check if the action is to adjust the FA
        var field = 'field_allowance';
        var opp = rule.substring(3,2); // gets the opperand, we're assuming this is a single character > or < or =
        var val = parseInt(rule.substring(4,3)); // gets the new FA value to adjust by, we're assuming this is a single character
        if (!$(loc).hasClass('tier-rule-applied-level'+level)){
            $(loc).addClass('tier-rule-applied-level'+level);
            var currentVal = parseInt($(loc).find('.field-allowance').text());
            var newVal = '';
            if (opp == '+'){ newVal = currentVal + val;}
            else if (opp == '='){ newVal = val;}
            else if (opp == '-'){ newVal = currentVal - val;}
            $(loc).find('.field-allowance').text(newVal);
            // apply bonus to tempList object
            var newBenefit = {modelId: id, field: field, newValue: newVal};
            tempList['tierList'+level+'Ben'].push(newBenefit);
            // apply to page
            getModelObjectAndAdjusts(loc, id, field, newVal, level);
        }
    } else if (rule.indexOf('special_ability') > -1 || rule.indexOf('new_ability') > -1){ // check if the action is to add a special ability or a new ability
        var ruleMsg = rule.substr(rule.indexOf('|')+1);
        if (!$(loc).hasClass('tier-rule-applied-level'+level)){
            $(loc).addClass('tier-rule-applied-level'+level);
            // apply bonus to tempList object
            var newBenefit = {modelId: id, newAbility: ruleMsg};
            tempList['tierList'+level+'Ben'].push(newBenefit);
            // apply to page
            getModelDisplayAndBuildMessage(id, ruleMsg, level); // id = model id affected, ruleMsg = front facing message, level = tier level
        }
    } else if (rule.indexOf('Cost') > -1){ // check if the action is to adjust the Cost of the unit
        field = 'cost';
        opp = rule.substring(5,4); // gets the opperand, we're assuming this is a single character
        val = parseInt(rule.substring(6,5)); // gets the new cost value to adjust by, we're assuming this is a single character
        if (!$(loc).hasClass('tier-rule-applied-level'+level)) {
            $(loc).addClass('tier-rule-applied-level'+level);
            currentVal = parseInt($(loc).find('.unit-cost').text());
            if (opp == '+') {
                newVal = currentVal + val;
            }
            else if (opp == '=') {
                newVal = val;
            }
           else if (opp == '-') {
                newVal = currentVal - val;
            }
            $(loc).find('.unit-cost').text(newVal + 'pts.');
            // apply bonus to tempList object
            var newBenefit = {modelId: id, field: field, newValue: newVal};
            tempList['tierList'+level+'Ben'].push(newBenefit);
            // apply to page
            getModelObjectAndAdjusts(loc, id, field, newVal, level);
        }
    }
}

function getModelObjectAndAdjusts(loc, id, field, newVal, level){
    $('.model-id-'+id).addClass('tier-'+level+'-rule-applied');
    if ($(loc).hasClass('unit-model-option')){ // loop through all units looking for matches to the model id - if found update the field with the newVal
        $(unitModelObject).each(function(key,val){
            if (val['id'] == id){
                val[field] = newVal;
            }
        });
    }
    if ($(loc).hasClass('solo-model')) { // loop through all solos looking for matches to the model id - if found update the field with the newVal
        $(soloModelObject).each(function(key,val){
            if (val['id'] == id){
                val[field] = newVal;
            }
        });
    }
    if ($(loc).hasClass('battle-engine-model')) { // loop through all battle engines looking for matches to the model id - if found update the field with the newVal
        $(battleEngineModelObject).each(function(key,val){
           if (val['id'] == id){
               val[field] = newVal;
           }
        });
    }
    if ($(loc).hasClass('battle-group-unit')) { // loop through all battle group units looking for matches to the model id - if found update the field with the newVal
        $(bgUnitObject).each(function(key,val){
            if (val['id'] == id){
                val[field] = newVal;
            }
        });
    }
}

function getModelDisplayAndBuildMessage(id, ruleMsg, level){
    var modelId = '';
    if (id == 'caster'){
        modelId = ('#battlegroup-1-built .leader');
    } else {
        modelId = '.model-id-'+id;
    }
    $(modelId).each(function(key,val){ // loop each instance of the model unit
        //console.log(val);
        if ($(val).hasClass('tier-'+level+'-rule-applied')){
        } else {
            $(val).addClass('tier-'+level+'-rule-applied');
            // add message to the #unit-title field on the unit picker window
            $(val).find('.unit-title').append(' - New Tier Ability');
            // add a new list item to the .special-abilities ul in the unit on the unit picker window
            $(val).find('.special-abilities').append('<li class="line-head tier-added">'+ruleMsg+'</li>');
            // need to find a way to check for already applied tiered rules so they can be displayed on the current army list live view (right window)
        }
    });
}

function processTierReq(tierReq, level){
    tierReq = tierReq.substring(1,(tierReq.length -1)); // remove the opening and closing brackets [  and ]
    var tierBreakdown = tierReq.split(',');
    var newReq = {modelId: tierBreakdown[0], rule: tierBreakdown[1]};
    tempList['tierList'+level+'Req'][level] = (newReq);
    armyListBuilderShortSave();
}

function runTierRequirements(){ // process all tier requirement on short saves
    console.log(tempList);
    // apply forward facing text to the #tier-list-req-notice div
    var tierNotice = $('#tier-list-req-notice');
    if (tempList['tierListLevelSet'] > 0){
        if ($(tierNotice).find('.tier-1-notice').length == 0){
            $(tierNotice).append('<div class="tier-1-notice"><strong>Tier 1 Requirements:</strong> '+tempList["tierObject"]["tier1_req_front"]+' <span class="count-left"></span></div>');
        }
    }
    if (tempList['tierListLevelSet'] > 1){
        if ($(tierNotice).find('.tier-2-notice').length == 0){
            $(tierNotice).append('<div class="tier-2-notice"><strong>Tier 2 Requirements:</strong> '+tempList["tierObject"]["tier2_req_front"]+' <span class="count-left"></span></div>');
        }

    }
    if (tempList['tierListLevelSet'] > 2){
        if ($(tierNotice).find('.tier-3-notice').length == 0){
            $(tierNotice).append('<div class="tier-3-notice"><strong>Tier 3 Requirements:</strong> '+tempList["tierObject"]["tier3_req_front"]+' <span class="count-left"></span></div>');
        }

    }
    if (tempList['tierListLevelSet'] > 3){
        if ($(tierNotice).find('.tier-4-notice').length == 0){
            $(tierNotice).append('<div class="tier-4-notice"><strong>Tier 4 Requirements:</strong> '+tempList["tierObject"]["tier4_req_front"]+' <span class="count-left"></span></div>');
        }

    }

}

function buildTierRequirementsNotice(level, modelId, qty){ // level = tier level, modelId = needs to be the model id (we'll cross the caster exception if we see it), qty = qty(> < >= <=)X
    // for modelId = we'll need to add in an exception to handel doing model type - ie. Heavy Warbeast
    var modelIdentifier = '';
    if(modelId.indexOf('type') > -1){ // true == this modelId is a model type.
        modelIdentifier = modelId.substring((modelId.indexOf('==')+2));
        var modelIdentifierArray = modelIdentifier.split('|');
        console.log(modelIdentifierArray);
    }

    var opp = qty.substring(4,3); // gets the opperand, we're assuming this is a single character > or < or =
    var finalCount = parseInt(qty.substring(5,4)); // assumes opperand is 1 character long, also assumes the qty is 1 character long

    var modelInListCount = $('.added-to-list-panel .model-id-'+modelId).length;
    var reqBlock = $('#requirements');
    var innerHtml = '';

    $(reqBlock).removeClass('hidden'); // make the requirements block visible --- add more logic in here...

    if (level > 2){
        if (level == 3 || requirementsTier2 == ''){ // only need to set this variable once, if it runs again for level 4 it will be written as undefined. or if just tier 4 is applied and tier 2 remains unset
            requirementsTier2 = $(reqBlock).find('.tier-2-requirements').html();
        }
        innerHtml += requirementsTier2;
    }
    if (level == 4){
        requirementsTier3 = $(reqBlock).find('.tier-3-requirements').html();
        innerHtml += requirementsTier3;
    }

    if (level == 2){ // get existing level 2 tier requirement and add to the tier notice.
        innerHtml += '<div class="tier-2-requirements"><p class="sub-head">Tier 2 Requirements</p>';
        innerHtml += getTierRequirementsNoticeBlock(opp,modelInListCount,finalCount,modelIdentifier,level);
        innerHtml += '</div>';
    }
    if (level == 3){ // get existing level 3 tier requirement and add to the tier notice.
        innerHtml += '<div class="tier-3-requirements"><p class="sub-head">Tier 3 Requirements</p>';
        innerHtml += getTierRequirementsNoticeBlock(opp,modelInListCount,finalCount,modelIdentifier,level);
        innerHtml += '</div>';
    }
    if (level == 4){
        innerHtml += '<div class="tier-4-requirements"><p class="sub-head">Tier 4 Requirements</p>';
        innerHtml += getTierRequirementsNoticeBlock(opp,modelInListCount,finalCount,modelIdentifier,level);
        innerHtml += '</div>';
    }

    $(reqBlock).html(innerHtml);
}

function getTierRequirementsNoticeBlock(opp,modelInListCount,finalCount,modelIdentifier,level){
    var innerHtml = '';
    if (opp == '>'){
        if (modelInListCount <= finalCount){
            innerHtml += '<div class="requirement-item">'+((finalCount-modelInListCount)+1)+' of Model '+modelIdentifier+' are needed for Tier '+level+'</div>';
        }
    }
    return innerHtml;
}

function unsetTierBonus(rule, level){

    // currently not loading more than once, please revisit
    if (level > tempList['tierListLevelSet']) {
        // remove tier level classes
        $('.tier-rule-applied-level'+level).removeClass('tier-rule-applied-level'+level);
        $('.tier-'+level+'-rule-applied').removeClass('tier-'+level+'-rule-applied');

        $(rule).each(function(key, rule){
            if (rule != undefined) { // check to see if the rule is set
                if (rule.modelId.length > 0) {
                    if (rule.modelId == 'caster') { // execute caster item removal

                        if (rule.newAbility.length > 0) { // remove new tier ability display
                            var unitTitle = $('.battle-group-built .leader .unit-title').text(); /// find and replace unit tile update
                            unitTitle = unitTitle.replace(' - New Tier Ability', '');
                            $('.battle-group-built .leader .unit-title').text(unitTitle);
                            $('.battle-group-built .leader .special-abilities .tier-added').remove();
                        }

                    } else { // assume that modelId is a int - execute item removal

                        if (rule.newAbility.length > 0) { // remove new tier ability display
                            var unitTitle = $('.model-id-' + rule.modelId + ' .unit-label .unit-title').text(); /// find and replace unit tile update
                            unitTitle = unitTitle.replace(' - New Tier Ability', '');
                            $('.model-id-' + rule.modelId + ' .unit-label .unit-title').text(unitTitle);
                            $('.model-id-' + rule.modelId + ' .special-abilities .tier-added').remove();
                        }
                    }
                }

                console.log(rule);
                console.log(level);
            }
        });


    }
}