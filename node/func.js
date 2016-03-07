var express = require('express');
var jQuery = require('jquery');
var m = ('./db/models_db.js');

// add a model to the army list - step 1
exports.addModelToArmyList = function (input){

    var rtn = {
        army_name_update: false,
        army_points_update: true
    };

    var html = '';

    if (input.model.block_type == 'leader'){

        html = '<paper-material elevation="1" class="leader" id="model-id-'+input.model.id+'">';
        html += '<div class="model-image model-in-list"><img src="'+input.model.img_thumb_src+'" alt="'+input.model.name+'" class="unit-image unit-thumbnail" /></div>';
        html += '<div class="model-added-basics"><span class="unit-name">'+input.model.name+'</span><br /><span class="unit-title">';
        html += input.model.title + '</span></div>';
        html += '<div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">';
        html += '<paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>';
        html += '<span class="mo-notice hidden">View Stats</span></div>';
        html += '<div class="clearer"></div>';
        html += '<div class="additional-model-info stats-wrapper" style="display:none;"></div>';
        html += '</paper-material>';

        rtn.location_block = '#battlegroup-built';
        rtn.army_name_update = true; // could add the caster name to the army name on addition to list
        rtn.army_points_update_caster_mod = parseInt(input.model.bg_points);
        rtn.army_models_added_leader = input.model;
    } else if (input.model.block_type == 'battle-group'){

        html = '<paper-material elevation="1" class="child-model" id="model-id-'+input.model.id+'">';
        html += '<div class="model-image model-in-list"><img src="'+input.model.img_thumb_src+'" alt="'+input.model.name+'" class="unit-image unit-thumbnail" /></div>';
        html += '<div class="model-added-basics"><span class="unit-name">'+input.model.name+'</span><br /><span class="unit-title">';
        html += input.model.title + '</span></div>';
        html += '<div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">';
        html += '<paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button>';
        html += '<span class="mo-notice hidden">View Stats</span></div>';
        html += '<div class="clearer"></div>';
        html += '<div class="additional-model-info stats-wrapper" style="display:none;"></div>';
        html += '</paper-material>';

        rtn.location_block = '#battlegroup-built';
        rtn.army_points_update_model_cost = parseInt(input.model.cost);
    }

    rtn.html_block = html;

    return rtn;
};

exports.modelHtmlBlock = function (obj){
    var rtn = '';
    if (obj.block_type == 'leader'){
        rtn += '<div class="single-caster unit model-id-'+obj.id+'">';
        rtn += '<div class="focus-circle warcaster-portrait">';
        rtn += '<img src="'+obj.img_thumb_src+'" alt="'+obj.name+'" class="unit-image unit-thumbnail" id="model-'+obj.id+'-thumbnail" /></div>';
        rtn += '<label for="'+obj.name+'" class="warcaster"><span class="unit-name">'+obj.name+'</span><br />';
        rtn += '<span class="unit-title">'+obj.title+'</span><div class="bg-points">BG+'+obj.bg_points+'</div><br />';
        rtn += '<div class="barracks-qty-wrapper"></div></label>';
        rtn += '<div class="add-model-to-list" onclick="leaderSelected(this, '+obj.id+')" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
        rtn += '<paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button>';
        rtn += '<span class="mo-notice hidden">Add to List</span></div>';
        rtn += '<div class="tier-wrapper"></div>';
        rtn += '<div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">';
        rtn += '<paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button><span class="mo-notice hidden">View Stats</span></div>';
        rtn += '<div class="clearer"></div>';
        rtn += '<div class="additional-model-info stats-wrapper" style="display:none;"></div>';
        rtn += '</div>';
    } else {
        if (obj.block_type == 'battle-group') {
            rtn += '<div class="battle-group-unit unit model-id-'+obj.id+'">';
        } else if (obj.block_type == 'unit'){
            rtn += '<div class="unit unit-model-option model-id-'+obj.id+'">';
        } else if (obj.block_type == 'solo'){
            rtn += '<div class="solo-model unit model-id-'+obj.id+'">';
        } else if (obj.block_type == 'battle-engine'){
            rtn += '<div class="battle-engine-model unit model-id-'+obj.id+'">';
        }
        rtn += '<div class="add-model-to-list" onclick="addNewUnitModelToList(this, '+obj.id+');" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)">';
        rtn += '<paper-icon-button icon="add-circle-outline" class="add-model"></paper-icon-button><span class="mo-notice hidden">Add to List</span></div>';
        rtn += '<div class="show-additional" onmouseover="moNoticeOver(this)" onmouseout="moNoticeOut(this)" onclick="expandUnitDisplay(this)">';
        rtn += '<paper-icon-button icon="visibility" class="view-added-model-additional"></paper-icon-button><span class="mo-notice hidden">View Stats</span></div>';
        rtn += '<div class="focus-circle"><span class="in-army" style="display:none;">0</span><span class="divider" style="display:none;">/</span>';
        rtn += '<span class="field-allowance">';
        if (obj.field_allowance == 'U'){rtn += '&#x221e;';} else {rtn += obj.field_allowance;}
        rtn += '</span></div>';
        rtn += '<div class="model-image"><img src="'+obj.img_thumb_src+'" alt="'+obj.name+'" class="unit-image unit-thumbnail" id="model-'+obj.id+'-thumbnail" /></div>';
        rtn += '<label for="'+obj.name+'" class="unit-label"><span class="unit-name">'+obj.name+'</span><br />';
        rtn += '<span class="unit-title">'+obj.title+'</span><br /><div class="barracks-qty-wrapper"></div></label>';
        rtn += '<div class="unit-cost"><span class="cost">'+obj.cost+'</span> pts</div><div class="clearer"></div>';
        rtn += '<div class="additional-model-info" style="display:none;"></div></div>';
    }

    return rtn;
};

exports.getAllModelsForFaction = function (faction, db){
    var factionModels = [];
    for (i = 0; i < db.length; i++) {
        if (db[i].faction == faction){
            factionModels.push(db[i]);
        }
    }
    return factionModels;
};