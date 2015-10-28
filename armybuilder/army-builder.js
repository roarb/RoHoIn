/**
 * Created by RMP2 on 5/3/2015.
 */

function armyListBuilderShortSave(modelId){

    if (typeof modelId != "undefined"){
        var i = 1;
        while (i <= tempList['tierListLevelSet']){
            $(tempList['tierList'+i+'Ben']).each(function(key, val){
                if (val.modelId == modelId){ // found a matching id in the tempList object under tier benefits
                    processShortSaveTierBen(val);
                }
            });
            i++;
        }
        runTierRequirements(true); // states this comes from the shortsave unit addition function
    }
}

function armyListBuilderBoot(faction, points, armyName){
    $.post("/ajax/army-builder.php?faction="+faction+"&points="+points+"&name="+armyName)
        .done(function(data){
            $('#ajax-armybuilder').html(data);
            addBattleGroup(faction, 1);
            $('#input-points').val(points);
            hideAjaxLoading();
            infoBlockResize();
            infoBlockToolsResize();
        });
}

function addBattleGroup(faction, count){
    $.post("/ajax/battlegroup-build.php?faction="+faction+"&count="+count)
        .done(function(data){
            $('#battlegroup-'+count).html(data);
            infoBlockResize();
            infoBlockToolsResize();
    });
}

// functions for creating new army lists
function setActiveFaction(id, e, name){
    $('.faction-block').removeClass('active');
    $(e.target).parent().addClass('active');
    $('#'+id).attr('checked', 'checked');
    tempList['faction'] = id;
    // update army name with the faction name
    var cArmyName = $('#army-list-name').attr('value');
    if (cArmyName.indexOf('Army') > -1){
        cArmyName = cArmyName.substring(0, (cArmyName.indexOf("'s")+3)) + name + " Army";
    } else {
        cArmyName = name+" Army";
    }
    $('#army-list-name').attr('value', cArmyName);
}


function setActivePoints(val, e){
    $('.points-block-item').removeClass('primary-focus');
    $(e).addClass('primary-focus');
    $('#points-'+val).attr('checked', 'checked');
    tempList['points'] = val;
    // update army name with the faction name
    var cArmyName = $('#army-list-name').attr('placeholder');
    //if (cArmyName.indexOf('Army') > -1){
    //    console.log($(name));
    //    cArmyName = cArmyName.substring(0, (cArmyName.indexOf("'s")+3)) + name + " Army";
    //} else {
        //cArmyName = id+" Army";
    //}
    //$('#army-list-name').attr('placeholder', cArmyName);
}

function startArmyListBuilder(){
    // remove these two lines when you want this running
    //displayNotice('This section is not complete yet, please check back later.',true);

    // need to add in a validator, if that's true then proceed.
    showAjaxLoading();
    var faction = "";
    var selectedFaction = $("input[type='radio'][name='faction']:checked");
    if (selectedFaction.length > 0) {
        faction = selectedFaction.val();
    }
    var points = "";
    var selectedPoints = $("input[type='radio'][name='pointsValue']:checked");
    if (selectedPoints.length > 0) {
        points = selectedPoints.val();
    }

    var armyName = $('#army-list-name').val();
    if (armyName == ''){
        armyName = 'Random Army Name Picker Here';
    }
    // update tempList with the army name
    tempList['name'] = armyName;
    armyListBuilderBoot(faction, points, armyName);
    hideArmyListCreationStartScreen(faction, points, armyName);
}

function hideArmyListCreationStartScreen(faction, points, armyName){
    // first run a hide function on the previous screen
    $('#army-name').hide();
    $('#army-faction').hide();
    $('#army-points').hide();
    $('#start-building').hide();
    // then load in the army name, points and faction into the toolbar.
    $('.army-builder-toolbar').removeClass('hidden');
    $('#display-army-name').html(armyName);
    $('#display-faction').html(faction);
    $('#display-army-points').html(points);
}

// add a leader to its battlegroup
function leaderSelected(e, count, object){ // count = battle group 1-4, object = model object
    if ($(e).parents('.unit').hasClass('barracks-active') && !$(e).parents('.unit').hasClass('in-barracks')){
        document.querySelector('#not-in-barracks').show();
        return false;
    }
    applyBGPointsToToolbar(parseInt(object['bg_points']));
    showBattleGroup(count);
    $('.battlegroup'+count+'-title .leader-name').html(object['name']+"'s Batlle Group");
    $('.warcaster'+count+'-title').hide();
    $('.warcaster-'+count).find('.single-caster').removeClass('chosen');
    $('.'+object['id']+'-'+count).addClass('chosen');
    $('.warcaster-'+count).hide();
    // display unit - solo - battle engine options after a warcaster is selected.
    $('#unit-picker').show();
    $('#solo-picker').show();
    $('#battle-engine-picker').show();
    addLeaderToBattleGroup(count,object);
    //armyListBuilderShortSave();
}

// add a model to the list by model id
function addNewModelToList(rule){
    $.getJSON('/ajax/get-unit-by-id.php?id='+rule, function(data) {
        // set variables
        var model = data[0];
        console.log(model);
        $.get('/ajax/unit-model-stats.php?id='+model.id, function(stats) {
            var pickerBlock = '',
                wrapperClass = '',
                modelBlock = '',
                addUnitToArmy = '';
            // find the correct picker block
            if (model.type.indexOf('Unit') > -1) { // found a unit model
                pickerBlock = $('#unit-picker');
                unitModelObject.push(model);
                wrapperClass += 'unit unit-model-option model-id-'+model.id;
                addUnitToArmy += 'addUnitToArmy(unitModelObject, '+(unitModelObject.length - 1)+');';
            } else if (model.type.indexOf('Heavy') > -1 || model.type.indexOf('Light') > -1 || model.type.indexOf('Lesser') > -1){ // found a battle group model - assuming battle group one
                pickerBlock = $('#battlegroup-1 .battlegroup-1');
                bgUnitObject.push(model);
                wrapperClass += 'unit battle-group-unit model-id-'+model.id;
                addUnitToArmy += 'addToBattleGroup(1, bgUnitObject, '+(bgUnitObject.length - 1)+');';
            } else if (model.type.indexOf('Solo') > -1){ // found a solo model
                pickerBlock = $('#solo-picker');
                soloModelObject.push(model);
                wrapperClass += 'unit solo-model model-id-'+model.id;
                addUnitToArmy += 'addUnitToArmy(soloModelObject, '+(soloModelObject.length - 1)+');';
            } else if (model.type.indexOf('Engine') > -1){ // found a battle engine
                pickerBlock = $('#battle-engine-picker');
                battleEngineModelObject.push(model);
                wrapperClass += 'unit battle-engine-model model-id-'+model.id;
                addUnitToArmy += 'addUnitToArmy(battleEngineModelObject, '+(battleEngineModelObject.length - 1)+');';
            }

            // apply updates to the correct block
            modelBlock += '<div class="'+wrapperClass+'">';
            modelBlock += '<div class="add-model-to-list" onclick="'+addUnitToArmy+'" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
            modelBlock += '<paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button>';
            modelBlock += '<span class="mo-notice hidden">Add to List</span></div>';
            modelBlock += '<div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">';
            modelBlock += '<paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>';
            modelBlock += '<span class="mo-notice hidden">View Stats</span></div>';
            modelBlock += '<div class="focus-circle">';
            modelBlock += '<span class="in-army" style="display:none;">0</span><span class="divider" style="display:none;">/</span>';
            modelBlock += '<span class="field-allowance">';
            if (model.field_allowance == 'U'){
                modelBlock += '&#x221e;</span></div>';
            } else {
                modelBlock += model.field_allowance + '</span></div>';
            }
            modelBlock += '<label for="'+ model.name+'" class="unit-label">';
            modelBlock += '<span class="unit-name">'+ model.name+'</span><br /><span class="unit-title">'+ model.title+'</span></label>';
            modelBlock += '<div class="unit-cost">';
            var pts = model.cost.split(',');
            modelBlock += pts[0]+'pts';
            if (pts[1] != undefined){
                modelBlock += ' | '+pts[1]+'pts';
            }
            modelBlock += '</div>';
            modelBlock += '<div class="clearer"></div>';
            modelBlock += '<div class="additional-model-info" style="display:none;">';
            modelBlock += stats+'</div></div>';

            $(pickerBlock).append(modelBlock);

        });
    });
}

function applyBGPointsToToolbar(bg){
    var points = "";
    var selectedPoints = $("input[type='radio'][name='pointsValue']:checked");
    if (selectedPoints.length > 0) {
        points = parseInt(selectedPoints.val());
    }
    var finalPoints = bg + points;
    // update tempList object
    tempList['points'] = finalPoints;
    var startBGPoints = '<span class="total-army-points-block"><span id="points-count-up">0</span>/<span id="total-points-allowed">'+finalPoints+'</span> ('+points+')</span>';
    $('#display-army-points').html(startBGPoints);
}

// add a model/unit points cost to the army total, flag with class error if it exceeds the army total
function addUnitPointsToToolbar(points){
    tempList['points_used'] = parseInt(points) + tempList['points_used'];
    var totalPoints = $('#total-points-allowed').text();
    if (tempList['points_used'] <= parseInt(totalPoints)){
        var htmlOutput = '<span>'+tempList['points_used']+'</span>';
        $('#points-count-up').html(htmlOutput);
    }
    else {
        var htmlOutput = '<span class="error">'+tempList['points_used']+'</span>';
        $('#points-count-up').html(htmlOutput);
    }

}

// add a model/unit points cost to the army total, flag with class error if it exceeds the army total
function removeUnitPointsFromToolbar(points){
    tempList['points_used'] = tempList['points_used'] - parseInt(points);
    var totalPoints = $('#total-points-allowed').text();
    if (tempList['points_used'] <= parseInt(totalPoints)){
        var htmlOutput = '<span>'+tempList['points_used']+'</span>';
        $('#points-count-up').html(htmlOutput);
    }
    else {
        var htmlOutput = '<span class="error">'+tempList['points_used']+'</span>';
        $('#points-count-up').html(htmlOutput);
    }

}

// add a model to a warcaster's battlegroup - called from battlegroup-build
function addToBattleGroup(e, count, object, pos){ // count = battle group 1-4, object = model object
    if ($(e).parents('.unit').hasClass('barracks-active') && !$(e).parents('.unit').hasClass('in-barracks')){
        document.querySelector('#not-in-barracks').show();
        return false;
    }
    object = cleanUnitEntry(object[pos]); // currently updating the field_allowance to a numerical value
    if (canThisModelBeAddedToBattleGroup(object) == true) {
        addUnitPointsToToolbar(object['cost']);
        addUnitToBattleGroup(count, object);
        updateFAonAddedUnit(object); // update the unit selected to .active - if FA is matched update the unit selected to .full
        //armyListBuilderShortSave();
    }
}

// creates the visual block for the new leader model in it's battlegroup , called from leaderSelected()
function addLeaderToBattleGroup (count, object){ // count = battlegroup 1-4, object = model object
    //console.log('addLeaderToBattleGroup function fires');
    var uaOptions = false;
    var modelIdDisplay = 'model-id-'+object["id"];
    if (object['possible_ua'] != '') {
        uaOptions = true;
        tempList['ua-'+object["id"]] = object['possible_ua'];
        var uaScriptWrite = 'onclick="displayUnitAttachmentChoice(\'ua-'+object["id"]+'\', \''+modelIdDisplay+'\')"';
        //displayUnitAttachmentChoice(object['possible_ua'], object['id']); // pass the returned unit models to the popup builder, then this model's id
    }
    // update tempList with leader(x) = modelId
    if (count == 1){
        tempList['leader1id'] = object['id'];
    } if (count == 2){
        tempList['leader2id'] = object['id'];
    } if (count == 3){
        tempList['leader3id'] = object['id'];
    } if (count == 4){
        tempList['leader4id'] = object['id'];
    }

    var bgBlock = $('#battlegroup-'+count+'-built');
    var innerHtml = '<paper-material elevation="1" class="leader" id="model-id-'+object["id"]+'">';
    innerHtml += '<div class="model-image model-in-list">'+object["thumb_img"]+'</div>';
    innerHtml += '<div class="model-added-basics"><span class="unit-name">'+object["name"]+'</span><br /><span class="unit-title">';
    innerHtml += object['title'] + '</span></div>';
    innerHtml += '<div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">';
    innerHtml += '<paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>';
    innerHtml += '<span class="mo-notice hidden">View Stats</span></div>';
    if (uaOptions == true){
        innerHtml += '<div class="unit-attachments select-unit-attachment" '+uaScriptWrite+' onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
        innerHtml += '<paper-icon-button icon="attach-file" class="optional-unit-attachments"></paper-icon-button><span class="mo-notice hidden">Unit Attachments</span></div>';
        //onclick="displayUnitAttachmentChoice('+data+', \''+modelIdDisplay+'\')
    }
    var tiers = '';
    if (object['tiers'] != ''){
        innerHtml += '<div class="tier-options" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="displayTierListSelection(this';
        var i = 0;
        $(object['tiers']).each(function(){ // loop through all possible tiers and display each as a new object to the displayTierListSelection function
            innerHtml += ','+object["tiers"][i]["id"];
            i++;
        });
        casterTierListObj.push(object["tiers"]); // load the active caster's tier object to a page variable
        innerHtml += ')">';
        innerHtml += '<paper-icon-button icon="class" class="view-tiers"></paper-icon-button><span class="mo-notice hidden">View Tier Lists</span></div>';
    }
    innerHtml += '<div class="clearer"></div>';
    // get the model stats and display in a slide down
    $.get('http://roho.in/ajax/display-army-builder-stats.php?id='+object["id"], function(data){
        innerHtml += data;
        innerHtml += '</paper-material>';
        innerHtml += '<input name="warcaster'+count+'" value="'+object["name"]+'" class="hidden" />';
        if (object['companion'] != null){
            innerHtml += '<paper-material elevation="1" class="unit-model-child"><span class="unit-name">'+object['companion']+'</span><br /><span class="unit-title">';
            innerHtml += 'Companion Model</span></paper-material>';
        }
        $(bgBlock).html(innerHtml);
        armyListBuilderShortSave();
    });
}

// creates a model entry under the warcaster in its battlegroup - called from addToBattleGroup()
function addUnitToBattleGroup (count, object, free){ // count = battlegroup 1-4, object = model object, free = bool

    showAjaxLoading();
    $.getJSON('/ajax/get-unit-attachments.php?id='+object['id'], function(data) {
        var modelIdDisplay = 'model-id-'+object["id"];
        var uaOptions = false;
        if ($('.'+modelIdDisplay).length > 1){
            modelIdDisplay = modelIdDisplay+'-'+$('.'+modelIdDisplay).length;
        } else {
            modelIdDisplay = modelIdDisplay+'-1';
        }
        if (data){
            uaOptions = true;
            tempList['ua-'+object["id"]] = data;
            var uaScriptWrite = 'onclick="displayUnitAttachmentChoice(\'ua-'+object["id"]+'\', \''+modelIdDisplay+'\')"';
            //displayUnitAttachmentChoice(data, modelIdDisplay); // pass the returned unit models to the popup builder, then this model's id
        }
        // add battlegroup model to the tempList object
        if (count == 1){
            tempList['bg1Models'].push(object['id']);
        } if (count == 2){
            tempList['bg2Models'].push(object['id']);
        } if (count == 3){
            tempList['bg3Models'].push(object['id']);
        } if (count == 4){
            tempList['bg4Models'].push(object['id']);
        }

        var bgBlock = $('#battlegroup-' + count + '-built');
        var i = modelCountInCurrentBattleGroup(count);
        var innerHtml = '<span class="wrapper">';
        innerHtml += '<paper-material elevation="1" class="';
        if (free == true) {
            innerHtml += 'free-child-model';
        } else {
            innerHtml += 'child-model';
        }
        innerHtml += ' model-id-'+object["id"]+'" id="'+modelIdDisplay+'">';
        innerHtml += '<div class="model-image model-in-list">'+object["thumb_img"]+'</div>';
        innerHtml += '<div style="float:left;"><span class="unit-name">' + object["name"] + '</span><br /><span class="unit-title">';
        innerHtml += object["title"] + '</span> | <span class="points">';
        if (free == true) {
            innerHtml += 0;
        } else {
            innerHtml += object["cost"];
        }
        innerHtml += '</span> pts</div>';
        innerHtml += '<div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">';
        innerHtml += '<paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>';
        innerHtml += '<span class="mo-notice hidden">View Stats</span></div>';
        if (free != true) {
            innerHtml += '<div class="remove-unit remove-unit-from-army remove-' + object["id"] + '"onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
            innerHtml += '<paper-icon-button icon="backspace" class="remove"></paper-icon-button><span class="mo-notice hidden">Remove</span></div>';
        }
        if (uaOptions == true){
            innerHtml += '<div class="unit-attachments select-unit-attachment" '+uaScriptWrite+' onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
            innerHtml += '<paper-icon-button icon="attach-file" class="optional-unit-attachments"></paper-icon-button><span class="mo-notice hidden">Unit Attachments</span></div>';
            //onclick="displayUnitAttachmentChoice('+data+', \''+modelIdDisplay+'\')
        }
        $.get('http://roho.in/ajax/display-army-builder-stats.php?id='+object["id"], function(data){
            innerHtml += data;
            innerHtml += '<input name="battlegroup-' + count + '-' + i + '" value="' + object["name"] + '|1" class="hidden ' + object["id"] + '" /></paper-material>';
            innerHtml += '<script>$(window).ready(function(){$(".remove-' + object["id"] + '").on("touchstart click", function(){removeUnitFromArmy(' + object["id"] + ', this)});});</script>';
            innerHtml += '</span>';
            $(bgBlock).append(innerHtml);
            armyListBuilderShortSave(object["id"]);
            hideAjaxLoading();
        });
    });
}

// adds units / solos / battle engines to the army
function addUnitToArmy(e, object,pos){
    if ($(e).parents('.unit').hasClass('barracks-active') && !$(e).parents('.unit').hasClass('in-barracks')){
        document.querySelector('#not-in-barracks').show();
        return false;
    }
    object = cleanUnitEntry(object[pos]); // currently updating the field_allowance to a numerical value
    if (canThisModelBeAddedToArmy(object) == true) {
        // check for min - max unit possibilities - if it has then, launch pop up to ask min or max then on selection finish add to army with addMinMaxUnitToArmy()
        if (parseInt(object['purchased_low']) < parseInt(object['purchased_high'])) {
            console.log(object);
            displayMinMaxChoice(object['purchased_low'], object['purchased_high'], object['cost'], object);
        } else { // if there is no min / max option, add the unit to the army
            showAjaxLoading();
            var attachments = Array;
            $.getJSON('/ajax/get-unit-attachments.php?id='+object['id'], function(data) {
                var modelIdDisplay = 'model-id-'+object["id"];
                var uaOptions = false;
                if ($('.'+modelIdDisplay).length > 1){
                    modelIdDisplay = modelIdDisplay+'-'+$('.'+modelIdDisplay).length;
                } else {
                    modelIdDisplay = modelIdDisplay+'-1';
                }
                if (data) {
                    uaOptions = true;
                    tempList['ua-'+object["id"]] = data;
                    var uaScriptWrite = 'onclick="displayUnitAttachmentChoice(\'ua-'+object["id"]+'\', \''+modelIdDisplay+'\')"';
                }
                var unitBlock = '';
                var unitType = '';
                if (object['type'] == 'Solo') {
                    unitBlock = $('#solos-built');
                    unitType = 'solo';
                } else if (object['type'] == 'Battle Engine') {
                    unitBlock = $('#battle-engines-built');
                    unitType = 'battle-engine'
                } else {
                    unitBlock = $('#units-built');
                    unitType = 'unit';
                }
                $(unitBlock).show();
                var i = modelCountInArmy();
                var innerHtml = '<span class="wrapper">';
                innerHtml += '<paper-material elevation="1" class="unit-model model-id-'+object["id"]+'" id="'+modelIdDisplay+'">';
                innerHtml += '<div class="model-image model-in-list">'+object["thumb_img"]+'</div>';
                innerHtml += '<div style="float:left;"><span class="unit-name">' + object["name"] + '</span><br /><span class="unit-title">';
                if (object['purchased_low'] > 0) {
                    if (object['unit_leader'] == 'included') {
                        innerHtml += object['purchased_low'] + ' Grunts &amp; Leader for <span class="points">' + object['cost'] + '</span> pts</span>';
                    } else {
                        innerHtml += object['purchased_low'] + ' Grunts for <span class="points">' + object['cost'] + '</span> pts</span>';
                    }
                    // save army model choice to tempList object
                    var armyModel = {modelId: object['id'], qty: object['purchased_low']};
                    tempList['armyModels'].push(armyModel);
                } else {
                    if (object['unit_leader'] == 'included') {
                        innerHtml += 'Grunt &amp; Leader for <span class="points">' + object['cost'] + '</span> pts</span>';
                    } else {
                        innerHtml += '<span class="points">' + object['cost'] + '</span> pts</span>';
                    }
                    // save army model choice to tempList object
                    var armyModel = {modelId: object['id'], qty: object['purchased_high']};
                    tempList['armyModels'].push(armyModel);
                }
                innerHtml += '</div>';
                innerHtml += '<div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">';
                innerHtml += '<paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>';
                innerHtml += '<span class="mo-notice hidden">View Stats</span></div>';
                innerHtml += '<div class="remove-unit remove-unit-from-army remove-' + object["id"] + '"onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
                innerHtml += '<paper-icon-button icon="backspace" class="remove"></paper-icon-button><span class="mo-notice hidden">Remove</span></div>';
                if (uaOptions == true){
                    innerHtml += '<div class="unit-attachments select-unit-attachment" '+uaScriptWrite+' onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
                    innerHtml += '<paper-icon-button icon="attach-file" class="optional-unit-attachments"></paper-icon-button><span class="mo-notice hidden">Unit Attachments</span></div>';
                    //onclick="displayUnitAttachmentChoice('+data+', \''+modelIdDisplay+'\')
                }
                innerHtml += '<div class="clearer"></div>';
                $.get('http://roho.in/ajax/display-army-builder-stats.php?id='+object["id"], function(data){
                    innerHtml += data;
                    innerHtml += '<input name="' + unitType + '-' + i + '" value="' + object["name"] + '|';
                    if (object['purchased_low'] > 1) {
                        innerHtml += object['purchased_low'];
                    }
                    else {
                        innerHtml += '1';
                    }
                    innerHtml += '" class="hidden ' + object["id"] + '" /></paper-material>';
                    innerHtml += '<script>$(window).ready(function(){$(".remove-' + object["id"] + '").on("touchstart click", function(){removeUnitFromArmy(' + object["id"] + ', this)});});</script>';
                    if (object['unit_leader'] != null && object['unit_leader'] != 'included') {
                        innerHtml += '<paper-material elevation="1" class="unit-model-child"><span class="unit-name">' + object['unit_leader'] + '</span><br>';
                        innerHtml += '<span class="unit-title">Unit Leader</span></papaer-materia>';
                        innerHtml += '<input name="unit-' + i + '-leader" value="' + object["unit_leader"] + '" class="hidden" />';
                    }
                    innerHtml += '</span>';
                    $(unitBlock).append(innerHtml);
                    addUnitPointsToToolbar(object['cost']);
                    updateFAonAddedUnit(object);
                    if (typeof tierList !== 'undefined') { // check if a tier list has been defined
                        var tierStr = $('#display-army-tier span').text();
                        var tier = tierStr.substr(tierStr.length -1);
                        applyTierRules(tierList, tier, 'add'); // tierList = tier object, tier = tier level selected, 'add' means this is on a unit model addition run
                    }
                    armyListBuilderShortSave(object["id"]);
                    hideAjaxLoading();
                });
            });
        }
    }
}

function addMinMaxUnitToArmy(count, cost, id){ // this loads if there is a min / max unit option - selected on popup
    showAjaxLoading();
    $.getJSON('/ajax/get-unit-by-id.php?id='+id, function(data) {
        $.each(data, function(key, object){
            $.getJSON('/ajax/get-unit-attachments.php?id='+object['id'], function(data) {
                var modelIdDisplay = 'model-id-'+object["id"];
                var uaOptions = false;
                if ($('.model-id-'+object["id"]).length > 1){
                    modelIdDisplay = modelIdDisplay+'-'+$('.model-id-'+object["id"]).length;
                } else {
                    modelIdDisplay = modelIdDisplay+'-1';
                }
                if (data){
                    uaOptions = true;
                    tempList['ua-'+object["id"]] = data;
                    var uaScriptWrite = 'onclick="displayUnitAttachmentChoice(\'ua-'+object["id"]+'\', \''+modelIdDisplay+'\')"';
                    //displayUnitAttachmentChoice(data, modelIdDisplay); // pass the returned unit models to the popup builder, then this model's id
                }
                var unitBlock = $('#units-built');// need to switch this based on unit type.
                $(unitBlock).show();
                var i = modelCountInArmy();
                var innerHtml = '<span class="wrapper">';
                innerHtml += '<paper-material elevation="1" class="unit-model model-id-'+object["id"]+'" id="'+modelIdDisplay+'">';
                innerHtml += '<div class="model-image model-in-list">'+object["thumb_img"]+'</div>';
                innerHtml += '<div style="float:left;"><span class="unit-name">' + object["name"] + '</span><br /><span class="unit-title">';
                if (object['unit_leader'] == 'included') {
                    innerHtml += count + ' Grunts &amp; Leader for <span class="points">' + cost + '</span> pts</span>';
                } else {
                    innerHtml += count + ' Grunts for <span class="points">' + cost + '</span> pts</span>';
                }
                // save army model choice to tempList object
                var armyModel = {modelId: object['id'], qty: count};
                tempList['armyModels'].push(armyModel);

                innerHtml += '</div>';
                innerHtml += '<div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">';
                innerHtml += '<paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>';
                innerHtml += '<span class="mo-notice hidden">View Stats</span></div>';
                innerHtml += '<div class="remove-unit remove-unit-from-army remove-' + object["id"] + '"onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
                innerHtml += '<paper-icon-button icon="backspace" class="remove"></paper-icon-button><span class="mo-notice hidden">Remove</span></div>';
                if (uaOptions == true){
                    innerHtml += '<div class="unit-attachments select-unit-attachment" '+uaScriptWrite+' onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
                    innerHtml += '<paper-icon-button icon="attach-file" class="optional-unit-attachments"></paper-icon-button><span class="mo-notice hidden">Unit Attachments</span></div>';
                    //onclick="displayUnitAttachmentChoice('+data+', \''+modelIdDisplay+'\')
                }
                $.get('http://roho.in/ajax/display-army-builder-stats.php?id='+object["id"], function(data){
                    innerHtml += data;
                    innerHtml += '<input name="unit-' + i + '" value="' + object["name"] + '|' + count + '" class="hidden ' + object["id"] + '" /></paper-material>';
                    innerHtml += '<script>$(window).ready(function(){$(".remove-' + object["id"] + '").on("touchstart click", function(){removeUnitFromArmy(' + object["id"] + ', this)});});</script>';
                    if (object['unit_leader'] != null && object['unit_leader'] != 'included') {
                        innerHtml += '<paper-material elevation="1" class="unit-model-child"><span class="unit-name">' + object['unit_leader'] + '</span><br>';
                        innerHtml += '<span class="unit-title">Unit Leader</span></papaer-materia>';
                        innerHtml += '<input name="unit-' + i + '-leader" value="' + object["unit_leader"] + '" class="hidden" />';
                    }
                    innerHtml += '</span>';
                    $(unitBlock).append(innerHtml);
                    addUnitPointsToToolbar(cost);
                    updateFAonAddedUnit(object);
                    if (typeof tierList !== 'undefined') { // check if a tier list has been defined
                        var tierStr = $('#display-army-tier span').text();
                        var tier = tierStr.substr(tierStr.length -1);
                        applyTierRules(tierList, tier, 'add'); // tierList = tier object, tier = tier level selected, 'add' means this is on a unit model addition run
                    }
                    $('.shadow').remove();
                    $('.unit-min-max-choice').remove();
                    armyListBuilderShortSave(object["id"]);
                    hideAjaxLoading();
                });
            });
        });

    });

}

function showBattleGroup(count){
    // show all battlegroup models
    $('.battlegroup-'+count).removeClass('hidden');
    // then display the new battlegroup build block on the right column
    $('#battlegroup-'+count+'-built').show();
}

function modelCountInCurrentBattleGroup(count){
    var children = $('#battlegroup-'+count+'-built').find('.child-model');
    return children.length + 1;
}

function modelCountInArmy(){
    var children = $('#create-army-list').find('.unit-model');
    return children.length + 1;
}

function canThisModelBeAddedToBattleGroup(object){
    var bg = $('.battle-group-built');
    var countDuplicates = $(bg).find('.'+object['id']);
    if (countDuplicates.length >= object['field_allowance']){
        displayNotice('Sorry, '+object["name"]+' is already at its maximum Field Allowance', false);
        return false;
    }
    return true;
}

function canThisModelBeAddedToArmy(object){
    var armyList = $('#create-army-list');
    var countDuplicates = $(armyList).find('.'+object['id']);
    if (countDuplicates.length >= object['field_allowance']){
        displayNotice('Sorry, '+object["name"]+' is already at its maximum Field Allowance', false);
        return false;
    }
    return true;
}

function cleanUnitEntry(object){
    if (object['field_allowance'] == 'U'){
        object['field_allowance'] = 100;
    }
    if (object['field_allowance'] == 'C'){
        object['field_allowance'] = 1;
    }
    return object;
}

function backToCreateArmyStepOne(){
    $('#army-name').show();
    $('#army-faction').show();
    $('#army-points').show();
    $('#start-building').show();
    $('.army-builder-toolbar').addClass('hidden');
    $('#ajax-armybuilder').html('');
}

function displayMinMaxChoice(min, max, cost, unit){ // min = minimum unit count, max = maximum unit count, unit = unit object
    console.log(cost);
    var costArry = cost.split(',');
    var leader = ' ';
    if (unit['unit_leader'] != null){
        leader = ' &amp; ' + unit['unit_leader'] + ' ';
    }
    var msg = '<paper-button raised class="unit-count-select" id="add-min-unit">';
        msg += min+' grunts'+leader+'<br />for '+costArry[0]+' points</paper-button><br />';
        msg += '<paper-button raised class="unit-count-select" id="add-max-unit">';
        msg += max+' grunts'+leader+'<br />for '+costArry[1]+' points</paper-button>';
    var choiceBox = '<div class="ajax-loader unit-min-max-choice" id="choice-loader">'+msg;
        choiceBox += '<script>$(window).ready(function(){$("#add-min-unit").on("touchstart click", function(){addMinMaxUnitToArmy('+min+', '+costArry[0]+', '+unit["id"]+')})});</script>';
        choiceBox += '<script>$(window).ready(function(){$("#add-max-unit").on("touchstart click", function(){addMinMaxUnitToArmy('+max+', '+costArry[1]+', '+unit["id"]+')})});</script></div>';
        choiceBox += '<div class="shadow" id="notice-shadow"></div>';
        //choiceBox += '<script>$("#notice-shadow").on("touchstart click", function(){removeNotice();});</script>';
    $('body').append(choiceBox);
}

function displayUnitAttachmentChoice(attachedUnits, sourceId){ // attachedUnits = object returned from original model's possible_ua field, source is the original unit added id
    var msg = ''; var i = 0;
    var UAFAHit = false;
    attachedUnits = tempList[attachedUnits];
    $.each(attachedUnits, function(key, val){
        // add check to see if this unit has hit it's FA already.
        if (val.field_allowance <= $('.model-id-'+val.id).length){
            UAFAHit = true;
        }
        if (UAFAHit == false){
            msg += '<paper-fab mini icon="close" id="close-ua-choice" class="accent"></paper-fab>';
            msg += '<paper-button raised class="add-unit-attachment" id="add-attachment-'+i+'">';
            msg += 'Attach '+val.name+' for '+val.cost+'pts. to this unit.</paper-button><br />';
            i++;
        }
    });
    if (UAFAHit == false){
        msg += '<paper-button raised class="cancel" id="cancel-ua-choice">No Thanks</paper-button>';
        var choiceBox = '<div class="ajax-loader unit-attachment-choice" id="choice-loader">'+msg; var x = 0;
        $.each(attachedUnits, function(key, val){
            choiceBox += '<script>$(window).ready(function(){$("#add-attachment-'+x+'").on("touchstart click", function(){addUnitAttachmentToArmy('+val.id+',"'+val.name+'",'+val.cost+', "'+val.title+'","'+sourceId+'")})});</script>';
            x++;
        });
        choiceBox += '</div><div class="shadow" id="notice-shadow">';
        choiceBox += '<script>$("#notice-shadow").on("touchstart click", function(){removeNotice();});</script>';
        choiceBox += '<script>$("#cancel-ua-choice").on("touchstart click", function(){removeNotice();});</script>';
        choiceBox += '<script>$("#close-ua-choice").on("touchstart click", function(){removeNotice();});</script></div>';
        $('body').append(choiceBox);
    }
}

function addUnitAttachmentToArmy(unitId, unitName, unitCost, unitTitle, parentUnit){ // attached unit id, attached unit name, attached unit cost, attached unit title, parent model-id-XX
    // move the paperclip and make it non-clickable
    $('#'+parentUnit+' .unit-attachments').css({'top':'27px','z-index':2,'cursor':'default'}).attr('onclick','').attr('onmouseover','').attr('onmouseout','');
    $('#'+parentUnit+' .mo-notice').removeClass('active').addClass('hidden');
    // locate the paper-material of the parent unit and add this just below as an attachment
    var parentPaperMaterial = $('#'+parentUnit).parent();
    // get total number of existing ua models
    var uaCount = $('.unit-attachment').length;
    // build unit attachment paper-material
    var uaInsert = '<paper-material elevation="1" class="unit-attachment model-id-'+unitId+'">';
        uaInsert += '<span class="unit-name">'+unitName+'</span><br>';
        uaInsert += '<span class="unit-title">'+unitTitle+'</span> | <span class="unit-price"><span class="points">'+unitCost+'</span> pts.</span>';
        uaInsert += '<span class="remove-unit-from-army remove-'+unitId+'"></span>';
        // ua value to submit = ua model name-parent id
        uaInsert += '<input name="unit-attachment-' + uaCount + '" value="' + unitId + '|' + parentUnit + '" class="hidden ' + unitId + '" /></paper-material>';
        uaInsert += '<script>$(window).ready(function(){$(".remove-' + unitId + '").on("touchstart click", function(){removeUnitFromArmy(' + unitId + ', this)});});</script>';
    // add the unit attachment to the parent
    $(parentPaperMaterial).append(uaInsert);
    // save army model choice to tempList object
    var uaModel = {parentModelId: parentUnit, modelId: unitId};
    tempList['uaModel'].push(uaModel);

    addUnitPointsToToolbar(unitCost);
    armyListBuilderShortSave();
    removeNotice();
}

function getUnitById(id){
    showAjaxLoading();
    $.post('/ajax/get-unit-by-id.php?id='+id)
        .done(function(data){
            var object = data;
            return object;
            hideAjaxLoading();
        });
}

function updateFAonAddedUnit(object) {
    var modelIdBlock = $('.model-id-' + object["id"]);
    var alreadyInArmy = parseInt($(modelIdBlock).find('.in-army').text());
    var fieldAllowance = $(modelIdBlock).find('.field-allowance').text();
    var cleanFA = 0;
    if (fieldAllowance == 'C') {
        cleanFA = 1;
    } else if (fieldAllowance == '∞') {
        cleanFA = 999;
    } else {
        cleanFA = parseInt(fieldAllowance);
    }
    var newFA = 1 + alreadyInArmy;
    if (!$(modelIdBlock).hasClass('active')) {
        $(modelIdBlock).addClass('active');
    }
    if (newFA == cleanFA){
        $(modelIdBlock).addClass('full');
    }
    $(modelIdBlock).find('.in-army').show().html(newFA);
    $(modelIdBlock).find('.divider').show();
}

function removeUnitFromArmy(id, event){
    showAjaxLoading();
    $.getJSON('/ajax/get-unit-by-id.php?id='+id, function(data) {
        $.each(data, function(key, object){
            var unitSelector = $('.model-id-'+object["id"]);
            //remove the points from the army total
            var unitPoints = parseInt($(event).parent().find('.points').text());
            removeUnitPointsFromToolbar(unitPoints);
            //remove the clicked entry from the army list
            if ($(event).parent().find('.unit-model-child').length > 0) { // check for and remove a child element
                $(event).parent().find('.unit-model-child').remove();
            }
            if ($(event).parent().hasClass('unit-attachment')){ // if the event clicked is a unit attachment remove a single parent up
                $(event).parent().remove();
            } else { // else remove 2 parents up
                $(event).parent().parent().remove();
            }

            $(unitSelector).removeClass('full'); // remove class 'full' from the army unit selector
            var activeCount = $(unitSelector).find('.in-army').text();
            if (parseInt(activeCount) < 2){ // actions if the unit number selected is 0
                $(unitSelector).removeClass('active'); // remove class 'active' from the army unit selector if the number of units in the army is 0
                $(unitSelector).find('.in-army').html('0').hide();
                $(unitSelector).find('.divider').hide();
            } else { // actions if the unit is still in the army and just reduced by 1 entry
                var newCount = parseInt(activeCount) - 1;
                $(unitSelector).find('.in-army').html(newCount);
            }
            // remove modelId from tempList object
            removeModelIdFromTempList(id);
            armyListBuilderShortSave();
            hideAjaxLoading();
        });

    });
}

function moNoticeOver(el){
    $(el).find('.mo-notice').removeClass('hidden').addClass('active');
}
function moNoticeOut(el){
    $(el).find('.mo-notice').removeClass('active').addClass('hidden');
}

function removeModelIdFromTempList(id){
    console.log(tempList);
    $(tempList['armyModels']).each(function(key, val){
        var i = 0; // make sure to only remove 1 element from the list.
        if (val.modelId == id && i == 0){ /// removing just the first found match may lead to some unit size option varients that are mismatched on a save / reload
            delete tempList['armyModels'][key]; i++
        }
    });
    $(tempList['bg1Models']).each(function(key, val){
        var i = 0; // make sure to only remove 1 element from this list.
        if (val == id && i == 0){
            delete tempList['bg1Models'][key]; i++;
        }
    });
    $(tempList['bg2Models']).each(function(key, val){
        var i = 0; // make sure to only remove 1 element from this list.
        if (val == id && i == 0){
            delete tempList['bg2Models'][key]; i++;
        }
    });
    $(tempList['bg3Models']).each(function(key, val){
        var i = 0; // make sure to only remove 1 element from this list.
        if (val == id && i == 0){
            delete tempList['bg3Models'][key]; i++;
        }
    });
    $(tempList['bg4Models']).each(function(key, val){
        var i = 0; // make sure to only remove 1 element from this list.
        if (val == id && i == 0){
            delete tempList['bg4Models'][key]; i++;
        }
    });
    $(tempList['uaModel']).each(function(key, val){
        var i = 0;
        if (val.modelId == id && i == 0){ // need a piece that checks against the parent element yet to make sure the correct one is removed
            delete tempList['uaModel'][key]; i++;
        }
    });
    $(tempList['companionModel']).each(function(key, val){
        var i = 0;
        if (val.modelId == id && i == 0){ // need a piece that checks against the parent element yet to make sure the correct one is removed
            delete tempList['companionModel'][key]; i++;
        }
    });
}

function useOnlyBarracksModels(bool, obj){
    if (bool == true){
        $('.all-units-panel .unit').addClass('barracks-active');
        $('.all-units-panel .single-caster').addClass('barracks-active');
        tempList['barracksModelsOwned'] = obj;
        $(obj).each(function(key, val){
            $('.model-id-'+val.model_id).addClass('in-barracks');
        })
    } else {
        $('.all-units-panel .unit').removeClass('barracks-active').removeClass('in-barracks');
        $('.all-units-panel .single-caster').removeClass('barracks-active').removeClass('in-barracks');
    }
    console.log(tempList);
}