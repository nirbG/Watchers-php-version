/**
 * Created by User on 26/06/2019.
 */
var serieDetail={

    module:{},

};

serieDetail.module.event=(function(){

    return{
        list : function(){
            $("#list").addClass("active");
            $("#card").removeClass("active");
            var card=$(".card-catalogue");
            card.removeClass( "col-lg-2 card-catalogue" );
            card.addClass("row col-12 list-containerSearch");
            var card2=$(".card-containerSearch");
            card2.removeClass( "col-lg-12 card-containerSearch" );
            card2.addClass("col-lg-1 list-img");

        },
        card : function(){
            $("#list").removeClass("active");
            $("#card").addClass("active");
            var list=$(".list-containerSearch");
            list.removeClass("row col-12 list-containerSearch");
            list.addClass( "col-lg-2 card-catalogue" );
            var list2=$(".list-img");
            list2.removeClass("col-lg-1 list-img");
            list2.addClass( "col-lg-12 card-containerSearch" );
        },
    };

})();

window.addEventListener("load",function () {
    $("#list").click(function (e) {
        serieDetail.module.event.list();
        $("#button").show();
    });
    $("#card").click(function (e) {
        $("#button").hide();
        serieDetail.module.event.card();
    });

    $(".serie .possede").show();
    $("#albM").click(function (e) {
        $(".comics ").show();
        $(".comics ").css("display","inherit");
        $(".serie .possede").hide();
        $("#alb").removeClass("active");
        $("#albM").addClass("active");
    });
    $("#alb").click(function (e) {
        console.log($(".serie .possede"));
        $(".comics ").hide();
        $(".serie .possede").show();
        $(".serie .possede").css("display","inherit");
        $("#albM").removeClass("active");
        $("#alb").addClass("active");
    });

});