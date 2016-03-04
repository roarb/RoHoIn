
function doesModelImageExist(name){
    $.ajax({
        url:'http://roho.in/res/unit_images/'+name+'.jpg',
        type:'HEAD',
        error: function()
        {
            //file not exists
            return false;
        },
        success: function()
        {
            //file exists
            return true;
        }
    });
}

function doesModelImageThumbnailExist(name){
    $.ajax({
        url:'http://roho.in/res/unit_images/thumbs/'+name+'.jpg',
        type:'HEAD',
        error: function()
        {
            //file not exists
            return false;
        },
        success: function()
        {
            //file exists
            return true;
        }
    });
}