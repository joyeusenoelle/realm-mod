/*-----------------------------------------------------------------------------------*/
/*	MENU
/*-----------------------------------------------------------------------------------*/

ddsmoothmenu.init({
    mainmenuid: "menu",
    orientation: 'h',
    classname: 'menu',
    contentsource: "markup"
})

jQuery.fn.textEquals = function (text) {
    var match = false;
    var values="";
    jQuery(this).each(function () {
        if (jQuery(this).text().match("^" + text + "$")) {
            values=jQuery(this).val();
            match = true;
            return false;
        }
    });
    return values;
};