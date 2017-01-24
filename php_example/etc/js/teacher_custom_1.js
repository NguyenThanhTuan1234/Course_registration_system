$(document).ready(function(){
    $(".hide_show").click(function(){
        $($(this).data("target")).toggle();
    });
});