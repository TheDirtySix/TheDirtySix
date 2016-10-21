//Menu Init
jQuery(function(){
    jQuery('ul.sf-menu').superfish();
});
jQuery(document).ready(function () {
    jQuery("#menu").meanmenu({
        meanMenuClose: "X",
        meanMenuCloseSize: "18px",
        meanMenuOpen: "<span /><span /><span />",
        meanRevealPosition: "right",
        meanRevealPositionDistance: "0",
        meanRevealColour: "",
        meanRevealHoverColour: "",
        meanScreenWidth: "1030",
        meanNavPush: "",
        meanShowChildren: true,
        meanExpandableChildren: true,
        meanExpand: "+",
        meanContract: "-",
        meanRemoveAttrs: true
    });
});





