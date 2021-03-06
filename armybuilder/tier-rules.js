function displayTierListSelection(el,tierListId1,tierListId2){ // el = clicked element, tierListId = the id of the available tiered lists separated by |
    // check first if another .tiered-army-list-choice window was populated if so, reshow that , if not build one.
    var tierListIds = [tierListId1];
    if (tierListId2 != undefined && tempList['tierListLevelSet'] == undefined){
        showTierOptions(tierListId1,tierListId2);
        tierListIds.push(tierListId2);
    } else if($('#choice-loader').length > 0){
        $('#tier-choice-shadow').show();
        $('#choice-loader').show();
    } else {
        $(tierListIds).each(function(key, id){
            console.log(id);
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
                        choiceBox += '</div><div class="tier-choice-shadow" id="tier-choice-shadow"></div>';
                        $('body').append(choiceBox);
                        hideAjaxLoading();
                    }
                });
            }
        });
    }
}

function previewTierListSelection(el, tierListId1, tierListId2){

}

function displayTierListSelectionPostChoice(el,tierListId){
    $('#notice-shadow').remove();
    console.log('remove shadow fires');
    // run only after pop up tier list choice options fires and is selected.
    if (tierListId != '') { // need to add a check for cases where there are more than one tier list option returned.
        showAjaxLoading();
        $('#tier-choice-shadow').hide();
        var msg = '';
        var choiceBox = '<div class="ajax-loader tiered-army-list-choice" id="choice-loader">';
        $.ajax({
            url: '/ajax/view-tier-list-on-builder-page.php?id='+tierListId,
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
        tempList['tierListLevel'] = 1;
    }

    // 4 if level > 1 apply the tier 2 rules
    if (level > 1){
        applyTierRules(tierObject, 2);
        tempList['tierListLevel'] = 2;
    }

    // 5 if level > 2 apply the tier 3 rules
    if (level > 2){
        applyTierRules(tierObject, 3);
        tempList['tierListLevel'] = 3;
    }

    // 6 if level > 3 apply the tier 4 rules
    if (level > 3){
        applyTierRules(tierObject, 4);
        tempList['tierListLevel'] = 4;
    }

    // last change the popup (.tiered-army-list-choice) and the #notice-shadow displays to none.
    $('.ajax-loader.tiered-army-list-choice').animate({
        opacity:0
    }, 1000, function(){
        $('.ajax-loader.tiered-army-list-choice').hide().css('opacity',1);
    });
    $('.tier-choice-shadow').animate({
        opacity:0
    }, 1000, function(){
        $('.tier-choice-shadow').hide().css('opacity',.5);
    });
    if ($('.shadow').length > 0){
        $('.shadow').animate({
            opacity:0
        }, 1000, function(){
            $('.shadow').remove();
        })
    }

    runTierRequirements();
}

function showTierOptions(id1,id2){ // get tier 1 id then name, get tier 2 id then name - assuming only ever 2 tier lists per caster
    var innerHtml = '<div class="caster-tier-list-choice cushion"><span class="sub-head center">Select a Tier List:</span><br />';
    $(casterTierListObj[0]).each(function(key,val){
        if (id1 == val['id'] || id2 == val['id']){
            innerHtml += '<paper-button class="button paper-button" raised onclick="removeNotice(), displayTierListSelectionPostChoice(this,'+val["id"]+')">'+val["name"]+'</paper-button><br />';
        }
    });
    innerHtml += '</div>';
    displayNotice(innerHtml,true);
}

function resetTierRulesToBase (){
    // reset the #tier-list-req-notice level 2 3 4 blocks
    $('#tier-list-req-notice').html('<div class="tier-1-notice"></div><div class="tier-2-notice"></div><div class="tier-3-notice"></div><div class="tier-4-notice"></div>');
    // reset tempList object requirements to contain only tier 1 to start run
    tempList['tierListLevel'] = 0;
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
    console.log(caster);
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
            //if (models[1] == 99){ // unlimited models can be added for this model id --- no longer a need for this check
                $(section).find('.model-id-'+models[0]).addClass('in-tier');
            //}
        })
    }
}

function applyBonusRules(rule,level){
    var rulesBreakDown = rule.split(','); // rulesBreakDown[0] == the location to apply the rule
    defineBonusRuleLoc(rulesBreakDown[0], rulesBreakDown[1], level);
}

function defineBonusRuleLoc(rawLoc, rule, level){
    var loc = '';
    var multiRules = false;
    if (rule.indexOf('&&') > -1) { // there are 2 conditions - set multiRules to true.
        multiRules = true;
    }
    if (rawLoc.indexOf('newListModel') > -1){
        addNewModelToList(rule);

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
            $(battleEngineModelObject).each(function(key,val){ // run adjustment on Battle Engines
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
                //console.log('found that the benefit applies to battlegroup models');
                if (typeof val != 'undefined'){
                    loc = $('.model-id-'+val['id']);
                    defineBonusRuleAction(loc, rule, val['id'], level);
                }
            });
        }

    } else if (rawLoc.indexOf('Title') > -1) {  // checking for modelTitle key
        var title = rawLoc.substring(rawLoc.indexOf('==') + 2);

        $(unitModelObject).each(function (key, val) { // run adjustment on Units
            if (val['title'].indexOf(title) > -1) {
                loc = $('.model-id-' + val['id']);
                defineBonusRuleAction(loc, rule, val['id'], level);
            }
        });
        $(soloModelObject).each(function (key, val) { // run adjustment on Solos
            if (val['title'].indexOf(title) > -1) {
                loc = $('.model-id-' + val['id']);
                defineBonusRuleAction(loc, rule, val['id'], level);
            }
        });
        $(battleEngineModelObject).each(function (key, val) { // run adjustment on Battle Engines
            if (val['title'].indexOf(title) > -1) {
                loc = $('.model-id-' + val['id']);
                defineBonusRuleAction(loc, rule, val['id'], level);
            }
        });
        $(bgUnitObject).each(function (key, val) { // run adjustment on Battlegroup models
            if (val != undefined) {
                if (val['title'].indexOf(title) > -1) {
                    loc = $('.model-id-' + val['id']);
                    defineBonusRuleAction(loc, rule, val['id'], level);
                }
            }
        });

    } else if (rawLoc.indexOf('allModels') > -1) { // apply rule to all models possible to add to list
        loc = $('#battlegroup-1-built .leader'); // define rules on caster
        defineBonusRuleAction(loc, rule, rawLoc, level);
        $(unitModelObject).each(function (key, val) { // define rules on unitModels
            if (typeof val != 'undefined') {
                    loc = $('.model-id-' + val['id']);
                    defineBonusRuleAction(loc, rule, val['id'], level);
            }
        });
        $(battleEngineModelObject).each(function(key,val){ // run adjustment on Battle Engines
            if (typeof val != 'undefined'){
                    loc = $('.model-id-'+val['id']);
                    defineBonusRuleAction(loc, rule, val['id'], level);
            }
        });
        $(bgUnitObject).each(function(key,val){ // run adjustment on Battlegroup models
            if (typeof val != 'undefined'){
                loc = $('.model-id-'+val['id']);
                defineBonusRuleAction(loc, rule, val['id'], level);
            }
        });
        $(soloModelObject).each(function (key, val) { // define rules on soloModels
            if (typeof val != 'undefined') {
                    loc = $('.model-id-' + val['id']);
                    defineBonusRuleAction(loc, rule, val['id'], level);
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
        //console.log($(loc));
        var ruleMsg = rule.substr(rule.indexOf('|')+1);
        if (!$(loc).hasClass('tier-rule-applied-level'+level)){
            $(loc).addClass('tier-rule-applied-level'+level);
            // apply bonus to tempList object
            var newBenefit = {modelId: id, newAbility: ruleMsg};
            //console.log(newBenefit);
            tempList['tierList'+level+'Ben'].push(newBenefit);
            // apply to page
            getModelDisplayAndBuildMessage(id, ruleMsg, level); // id = model id affected, ruleMsg = front facing message, level = tier level
        }
    } else if (rule.indexOf('Cost') > -1 || rule.indexOf('cost') > -1){ // check if the action is to adjust the Cost of the unit
        console.log('tier cost benefit');
        field = 'cost';
        var currentVal = [], unitObjNewVal = '';
        opp = rule.substring(5,4); // gets the opperand, we're assuming this is a single character
        var aVal = parseInt(rule.substring(6,5)); // gets the new cost value to adjust by, we're assuming this is a single character
        if (!$(loc).hasClass('tier-rule-applied-level'+level)) {
            $(loc).addClass('tier-rule-applied-level'+level);
            var costField = $(loc).find('.unit-cost').text();
            if (costField.indexOf('|') > -1){ // unit with split costs
                var costFields = costField.split('|');
                $(costFields).each(function(key,val){
                   currentVal[key] = parseInt(val);
                });
            } else {
                currentVal = parseInt(costField);
            }
            var adjustVal = '';
            $(currentVal).each(function(key,cVal){
                if (opp == '+') {
                    newVal = cVal + aVal;
                    adjustVal = '+'+aVal;
                }
                else if (opp == '=') {
                    newVal = aVal;
                    adjustVal = aVal;
                }
                else if (opp == '-') {
                    newVal = cVal - aVal;
                    adjustVal = '-'+aVal;
                }
                if (key == 0){
                    $(loc).find('.unit-cost').text(newVal + 'pts');
                    unitObjNewVal = newVal;
                } else {
                    $(loc).find('.unit-cost').append(' | '+newVal + 'pts');
                    unitObjNewVal += ', '+newVal;
                }
            });

            // apply bonus to tempList object
            var newBenefit = {modelId: id, field: field, newValue: unitObjNewVal, adjustValue: aVal};
            tempList['tierList'+level+'Ben'].push(newBenefit);
            // apply to page
            getModelObjectAndAdjusts(loc, id, field, unitObjNewVal, level);
        }
    } else if (rule.indexOf('auto_add_battlegroup') > -1){
        $(bgUnitObject).each(function(key, val){
           if (val != undefined){
               if (val['id'] == id){
                   // need to get the model object then push to addUnitToBattleGroup(1,object)
                   addUnitToBattleGroup(1,val,true);
               }
           }
        });
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
            if (val != undefined){
                if (val['id'] == id){
                    val[field] = newVal;
                }
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
    console.log(tempList);
    tierReq = tierReq.substring(1,(tierReq.length -1)); // remove the opening and closing brackets [  and ]
    var tierBreakdown = tierReq.split(',');
    //if (tierBreakdown[0].indexOf('|') > -1){
    //    var modelIds = tierBreakdown[0].split('|');
    //    console.log(modelIds);
    //    $(modelIds).each(function(key, val){
    //        console.log(key+' - '+val);
    //        tempList['tierList'+level+'Req'].push({modelId: val, ruleString: tierBreakdown[1]});
    //    });
    //} else {
        tempList['tierList'+level+'Req'][0] = ({modelId: tierBreakdown[0], ruleString: tierBreakdown[1]});
    //}
    console.log(tempList);
    armyListBuilderShortSave();
}

function runTierRequirements(shortSave){ // process all tier requirement on short saves - if shortSave = true it came from the army-builder.js shortsave
    //console.log(tempList);
    // apply forward facing text to the #tier-list-req-notice div

    var tierNotice = $('#tier-list-req-notice');
    if (!shortSave){
        $(tierNotice).addClass('active');
    }
    if (tempList['tierListLevelSet'] > 0){
        $(tierNotice).find('.tier-1-notice').html('<strong>Tier 1 Requirements:</strong> '+tempList["tierObject"]["tier1_req_front"]+' <span class="count-left"></span>');
    }
    if (shortSave === true){
        console.log('run from shortsave function');
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
    console.log(definedReq);

    var qtyNeeded = 0;
    var inlist = 0;
    var stillNeed = 0;
    var liveNotice = '<span class="notice">';
    var i = 0;

    if (definedReq.modelId.indexOf('Type') > -1){ // found a modelType or type
        var modelType = definedReq.modelId.substr(definedReq.modelId.indexOf('==') + 2);

        if (definedReq.ruleString.indexOf('unique_qty') > -1) { // checks for unique entries of a certain type

            var unqUnitNames = [], prev = '';
            qtyNeeded = parseInt(definedReq.ruleString.substr(definedReq.ruleString.length - 1)); // assuming =

            if (modelType.indexOf('Light') > -1) { // found a Light model type model
                var unitName = []; var x = 0;
                $('#battlegroup-1-built .child-model').each(function (key, val) {
                    if ($(val).find('.unit-title').text().indexOf('Light') > -1) {
                        unitName[x] = $(val).find('.unit-name').text();
                        x++;
                    }
                });
            }

            unitName.sort();
            for (var y = 0; y < unitName.length; y++){
                if (unitName[y] !== prev){
                    unqUnitNames.push(unitName[y]);
                }
                prev = unitName[y];
            }
            inlist = unqUnitNames.length;

        } else if (definedReq.ruleString.indexOf('qty>') > -1){ // checks for qty>x

            qtyNeeded = parseInt(definedReq.ruleString.substr(definedReq.ruleString.length - 1)) + 1; // assuming <
            if (modelType == 'Solo') {
                inlist = $('#solos-built .unit-model').length;
            } else if (modelType == 'Unit') {
                inlist = $('#units-built .unit-model').length;
            } else if (modelType == 'Battlegroup') {
                inlist = $('#battlegroup-1-built .child-model').length;
            } else if (modelType.indexOf('Heavy') > -1) { // found a Heavy model type model
                $('#battlegroup-1-built .child-model').each(function (key, val) {
                    var unitTitle = $(val).find('.unit-title').text();
                    if (unitTitle.indexOf('Heavy') > -1) {
                        i++;
                    }
                });
                inlist = i;
            } else if (modelType.indexOf('Light') > -1) { // found a Light model type model
                $('#battlegroup-1-built .child-model').each(function (key, val) {
                    var unitTitle = $(val).find('.unit-title').text();
                    if (unitTitle.indexOf('Light') > -1) {
                        i++;
                    }
                });
                inlist = i;
            }
        }

        stillNeed = qtyNeeded - inlist;
        if (stillNeed > 0){
            liveNotice += '<span class="req-msg req-needed">Still need '+stillNeed+' more</span>';
        } else {
            liveNotice += '<span class="req-msg req-fulfilled">All set with  '+inlist+'</span>';
        }

    } else if (definedReq.modelId.indexOf('title') > -1) { // look for unitTitle

        var modelTitle = definedReq.modelId.substr(definedReq.modelId.indexOf('==') + 2);
        console.log(modelTitle);
        console.log('found a modelTitle match');

    } else { // assume a modelId #

        if (definedReq.modelId.indexOf('||') > -1) { // this is an or statement, multiple modelIds are valid
            var modelItem = definedReq.modelId.split('||');
            qtyNeeded = parseInt(definedReq.ruleString.substr(definedReq.ruleString.length - 1)) + 1;
            $(modelItem).each(function (key, val) {
                inlist += $('#create-army-list .model-id-' + val).length;
            });
            stillNeed = qtyNeeded - inlist;
            if (stillNeed > 0) {
                liveNotice += '<span class="req-msg req-needed">Still need ' + stillNeed + ' more</span>';
            } else {
                liveNotice += '<span class="req-msg req-fulfilled">All set with  ' + inlist + '</span>';
            }
        } else if (definedReq.modelId.indexOf('&') > -1) { // need the matching qty for each model id
            console.log(req);
            var modelIds = definedReq.modelId.split('&'), modelNeed = [];
            qtyNeeded = parseInt(definedReq.ruleString.substr(definedReq.ruleString.length - 1)) + 1;
            //qtyNeeded = (parseInt(definedReq.ruleString.substr(definedReq.ruleString.length - 1)) + 1 ) * modelIds.length;
            $(modelIds).each(function(key,modelId){
                inlist = $('#create-army-list .model-id-'+modelId).length;
                modelNeed[key] = qtyNeeded - inlist;
                stillNeed += qtyNeeded - inlist;
            });
            if (stillNeed > 0){
                liveNotice += '<span class="req-msg req-needed">Still need ( '+modelNeed[0]+' | '+modelNeed[1]+' ) more</span>'; // assuming just 2 models in this situation
            } else {
                liveNotice += '<span class="req-msg req-fulfilled">Required models added.</span>';
            }

        } else { // single modelId in statement
            qtyNeeded = parseInt(definedReq.ruleString.substr(definedReq.ruleString.length - 1)) + 1;
            inlist = $('#create-army-list .model-id-'+definedReq.modelId).length;
            stillNeed = qtyNeeded - inlist;
            if (stillNeed > 0){
                liveNotice += '<span class="req-msg req-needed">Still need '+stillNeed+' more</span>';
            } else {
                liveNotice += '<span class="req-msg req-fulfilled">All set with  '+inlist+'</span>';
            }
        }
    }

    liveNotice += '</span>';
    return liveNotice;
}