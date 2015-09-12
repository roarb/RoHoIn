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

    runTierRequirements();
}

function showTierOptions(){
    $('.tiered-army-list-choice').show();
    $('#notice-shadow').show();
}

function resetTierRulesToBase (){
    // reset the #tier-list-req-notice level 2 3 4 blocks
    $('#tier-list-req-notice').html('<div class="tier-1-notice"></div><div class="tier-2-notice"></div><div class="tier-3-notice"></div><div class="tier-4-notice"></div>');
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

        if (type == 'Unit' || type == 'Character Unit' || type == 'Cavalry Unit') {// run adjustment on UNITS
            $(unitModelObject).each(function (key, val) {
                if (typeof val != 'undefined') {
                    if (val['type'] == type) {
                        loc = $('.model-id-' + val['id']);
                        defineBonusRuleAction(loc, rule, val['id'], level);
                    }
                }
            });
        }

        else if (type == 'Solo' || type == 'Character Solo') { // run adjustment on SOLOS
            $(soloModelObject).each(function (key, val) {
                if (typeof val != 'undefined') {
                    if (val['type'] == type) {
                        loc = $('.model-id-' + val['id']);
                        defineBonusRuleAction(loc, rule, val['id'], level);
                    }
                }
            });
        }

        else if (type == 'Battle Engine'){
            $(battleEngineModelObjectt).each(function(key,val){ // run adjustment on Battle Engines
                if (typeof val != 'undefined'){
                    if (val['type'] == type){
                        loc = $('.model-id-'+val['id']);
                        defineBonusRuleAction(loc, rule, val['id'], level);
                    }
                }
            });
        }

        else {
            $(bgUnitObject).each(function(key,val){ // run adjustment on Battlegroup models
                if (typeof val != 'undefined'){
                    if (val['type'] == type){
                        loc = $('.model-id-'+val['id']);
                        defineBonusRuleAction(loc, rule, val['id'], level);
                    }
                }
            });
        }

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
            var adjustVal = '';
            if (opp == '+') {
                newVal = currentVal + val;
                adjustVal = '+'+val;
            }
            else if (opp == '=') {
                newVal = val;
                adjustVal = val;
            }
           else if (opp == '-') {
                newVal = currentVal - val;
                adjustVal = '-'+val;
            }
            $(loc).find('.unit-cost').text(newVal + 'pts.');
            // apply bonus to tempList object
            var newBenefit = {modelId: id, field: field, newValue: newVal, adjustValue: adjustVal};
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

function processShortSaveTierBen(tierBenObj){ // fired when adding model to the list - will apply the new ability to the model entry
    if (typeof tierBenObj.newAbility != 'undefined'){
        getModelDisplayAndBuildMessage(tierBenObj.modelId, tierBenObj.newAbility, tempList['tierListLevelSet']);
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
    var newReq = {modelId: tierBreakdown[0], ruleString: tierBreakdown[1]};
    tempList['tierList'+level+'Req'][level] = (newReq);
    armyListBuilderShortSave();
}

function runTierRequirements(shortSave){ // process all tier requirement on short saves - if shortSave = true it came from the army-builder.js shortsave
    //console.log(tempList);
    // apply forward facing text to the #tier-list-req-notice div

    var tierNotice = $('#tier-list-req-notice');
    $(tierNotice).addClass('active');
    if (tempList['tierListLevelSet'] > 0){
        $(tierNotice).find('.tier-1-notice').html('<strong>Tier 1 Requirements:</strong> '+tempList["tierObject"]["tier1_req_front"]+' <span class="count-left"></span>');
    }
    if (shortSave === true){
        console.log('found to be shortsave function');
        if (tempList['tierListLevelSet'] > 1){
            var req2Needed = $(tierNotice).find('.tier-2-notice .req-msg');
            var notice = getLiveRequiredNotice(tempList['tierList2Req']);
            $(req2Needed).html(notice);
        }
        if (tempList['tierListLevelSet'] > 2){
            var req3Needed = $(tierNotice).find('.tier-3-notice .req-msg');
            var notice = getLiveRequiredNotice(tempList['tierList3Req']);
            $(req3Needed).html(notice);
        }
        if (tempList['tierListLevelSet'] > 3){
            var req4Needed = $(tierNotice).find('.tier-4-notice .req-msg');
            var notice = getLiveRequiredNotice(tempList['tierList4Req']);
            $(req4Needed).html(notice);
        }
    } else {
        if (tempList['tierListLevelSet'] > 1){
            var tier2notice = $(tierNotice).find('.tier-2-notice');
            var notice = '<strong>Tier 2 Requirements:</strong> '+tempList["tierObject"]["tier2_req_front"]+' ';
            notice += getLiveRequiredNotice(tempList['tierList2Req']);
            $(tier2notice).html(notice);
        }
        if (tempList['tierListLevelSet'] > 2){
            var tier3notice = $(tierNotice).find('.tier-3-notice');
            var notice = '<strong>Tier 3 Requirements:</strong> '+tempList["tierObject"]["tier3_req_front"]+' ';
            notice += getLiveRequiredNotice(tempList['tierList3Req']);
            $(tier3notice).html(notice);
        }
        if (tempList['tierListLevelSet'] > 3){
            var tier4notice = $(tierNotice).find('.tier-4-notice');
            var notice = '<strong>Tier 4 Requirements:</strong> '+tempList["tierObject"]["tier4_req_front"]+' ';
            notice += getLiveRequiredNotice(tempList['tierList4Req']);
            $(tier4notice).html(notice);
        }
    }
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

                        if (typeof rule.newAbility != 'undefined') { // remove new tier ability display
                            var unitTitle = $('.model-id-' + rule.modelId + ' .unit-label .unit-title').text(); /// find and replace unit tile update
                            unitTitle = unitTitle.replace(' - New Tier Ability', '');
                            $('.model-id-' + rule.modelId + ' .unit-label .unit-title').text(unitTitle);
                            $('.model-id-' + rule.modelId + ' .special-abilities .tier-added').remove();
                        }
                        if (typeof rule.field != 'undefined'){ // check for stat update
                            if (rule.field == "cost"){ // adjust for cost
                                var unitCost = $('.model-id-' + rule.modelId + ' .unit-cost').text(); // find and replace the unit cost field
                                if (rule.adjustValue.substring(0,1) == '-'){
                                    unitCost = parseInt(rule.adjustValue.substring(1,2)) + parseInt(unitCost);
                                } else if (rule.adjustValue.substring(0,1) == '+'){
                                    unitCost = parseInt(rule.adjustValue.substring(1,2)) - parseInt(unitCost);
                                }
                                $('.model-id-' + rule.modelId + ' .unit-cost').text(unitCost+' pts');
                            } else if (rule.field == "FA"){ // adjust for field allowance

                            }
                        }
                    }
                }
            }
        });


    }
}

function getLiveRequiredNotice(req){
    var definedReq = {};
    $(req).each(function(key, val){ // remove empty sets from the array
        if (typeof val != 'undefined'){
            definedReq = val;
        }
    });

    var liveNotice = '<span class="notice">';
    if (definedReq.modelId.indexOf('ype') > -1){ // found a modelType or type
        console.log('found a modelType or type');
    } else { // assume a modelId #
        var qtyNeeded = parseInt(definedReq.ruleString.substr(definedReq.ruleString.length -1)) + 1;
        var inlist = $('#create-army-list .model-id-'+definedReq.modelId).length;
        var stillNeed = qtyNeeded - inlist;
        if (stillNeed > 0){
            liveNotice += '<span class="req-msg req-needed">Still need '+stillNeed+' more</span>';
        } else {
            liveNotice += '<span class="req-msg req-fulfilled">All set with  '+inlist+'</span>';
        }
    }

    liveNotice += '</span>';

    return liveNotice;
}