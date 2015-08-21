
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
        console.log(val);
    });
    if (level > 1){ // run the tier 2 level rules
        var tier2BonusRules = tierObject['tier2_bonus'].substring(1,(tierObject['tier2_bonus'].length - 1)); // remove the open and close []
        tier2BonusRules = tier2BonusRules.split(']['); // create an array of the rules
        $(tier2BonusRules).each(function(key, val){
            applyBonusRules(val,2); // val = rule to apply, 2 = tier level
            console.log(val); // will display the rule to be applied
        });
        // populate requirements block
        processTierReq(tierObject['tier2_req'], level); // tierObject['tier2_req'] = tier 2 requirement rule, level = tier level set
    }
    if (level > 2){ // run the tier 3 level rules
        var tier3BonusRules = tierObject['tier3_bonus'].substring(1,(tierObject['tier3_bonus'].length - 1)); // remove the open and close []
        tier3BonusRules = tier3BonusRules.split(']['); // create an array of the rules
        $(tier3BonusRules).each(function(key, val){
            applyBonusRules(val,3); /// val = rule to apply, 3 = tier level
            console.log(val); // will display the rule to be applied
        });
        // populate requirements block
        processTierReq(tierObject['tier3_req'], level); // tierObject['tier2_req'] = tier 2 requirement rule, level = tier level set
    }
    if (level > 3){ // run the tier 4 level rules
        var tier4BonusRules = tierObject['tier4_bonus'].substring(1,(tierObject['tier4_bonus'].length - 1)); // remove the open and close []
        tier4BonusRules = tier4BonusRules.split(']['); // create an array of the rules
        $(tier4BonusRules).each(function(key, val) {
            applyBonusRules(val, 4); /// val = rule to apply, 4 = tier level
            console.log(val); // will display the rule to be applied
        });
        // populate requirements block
        processTierReq(tierObject['tier4_req'], level); // tierObject['tier2_req'] = tier 2 requirement rule, level = tier level set
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
        var opp = rule.substring(3,2); // gets the opperand, we're assuming this is a single character
        var val = parseInt(rule.substring(4,3)); // gets the new FA value to adjust by, we're assuming this is a single character
        if (!$(loc).hasClass('tier-rule-applied-level'+level)){
            $(loc).addClass('tier-rule-applied-level'+level);
            var currentVal = parseInt($(loc).find('.field-allowance').text());
            var newVal = '';
            if (opp == '+'){ newVal = currentVal + val;}
            else if (opp == '='){ newVal = val;}
            else if (opp == '-'){ newVal = currentVal - val;}
            $(loc).find('.field-allowance').text(newVal);

            getModelObjectAndAdjusts(loc, id, field, newVal, level);
        }
    } else if (rule.indexOf('special_ability') > -1 || rule.indexOf('new_ability') > -1){ // check if the action is to add a special ability or a new ability
        var ruleMsg = rule.substr(rule.indexOf('|')+1);
        if (!$(loc).hasClass('tier-rule-applied-level'+level)){
            $(loc).addClass('tier-rule-applied-level'+level);
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
        console.log(val);
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
    var reqBlock = $('#requirements');
    if (tierBreakdown[0] > 1){ // denotes that the first part of the rule is a modelID
        if ($(reqBlock).find('#tier-'+level+'-req').length == 0){
            // this first bit is forward facing ====
            var tierBlock = '<div id="tier-'+level+'-req">'+tierReq+'</div>';
            $(reqBlock).removeClass('hidden').addClass('active');
            $(reqBlock).append().html(tierBlock);

        }
        // second attempt - write a JSON object into the page on initial load - leave it empty
        // access that on each new requirement to added, check it's there already
        // access it each time a unit is added to the list and adjust if needed
        // access it each time a unit is removed from the list and adjust if needed
        //
        // then after each of those changes, if a change is made rebuild the '#requirements' div
        listBuildingRequirements['tier'+level] = []; // build subarray
        listBuildingRequirements['tier'+level]['modelId'] = tierBreakdown[0]; //add model id to tierLevel subarray
        listBuildingRequirements['tier'+level]['rule'] = tierBreakdown[1]; // add rule to tierLevel subarray

        console.log(listBuildingRequirements);

    }
}