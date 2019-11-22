var Supp={
    module:{},
};


Supp.module.interface=(function () {
    return{
        show : function (champ) {
            Supp.module.interface.init($(".containerListButton"));
            $(champ).find(".backcomics").show();
            $(champ).find(".btn").show();
        },
        hide : function (champ) {
            $(champ).find(".backcomics").hide();
            $(champ).find(".btn").hide();
        },
        init : function (champ) {
            $(champ).find(".backcomics").hide();
            $(champ).find(".btn").hide();
        }
    }
})();

Supp.module.event=(function () {
    return {
        init: function () {
            Supp.module.event.supp($(".btnSupp"));
        },

        supp : function(champ){
            champ.click(function (e) {
                var cont= $(this).closest(".comics");
                var div= $(cont).find(".listBtn");
                var listInfoBtn=$(cont).find(".listInfoBtn");
                var div= $(this).closest("div");
                console.log($(cont));
                var datas = {isbn : cont.attr("isbn") };
                console.log(datas);
                var pr = $.ajax('suppComics2Col',
                    {
                        type: 'POST',
                        //dataType: "json",
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
                pr.done(function (d, s, jqXHR) {
                    $(cont).remove();
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
        }
    }
})();

window.addEventListener("load",function () {

    Supp.module.interface.init($(".containerListButton"));
    Supp.module.event.init($(".containerListButton"));

    $(".containerListButton").hover(function (event) {
        Env.module.interface.show(event.currentTarget);
        //console.log(event.target);
    });
    /*$(".containerListButton").touchmove(function (event) {
        Env.module.interface.show(event.currentTarget);
        //console.log(event.target);
    });*/
    $($(".containerListButton").parent(".row")).mouseleave(function (event) {
        Supp.module.interface.init(event.currentTarget);
        //console.log(event.target);
    });

});
