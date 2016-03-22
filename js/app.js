$(document).ready(function(){
    $('.content').fitVids({
        customSelector: "iframe[src*='ustream.tv'], iframe[src*='livestream.com']"
    });
});