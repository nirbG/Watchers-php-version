var Env={
    module:{},
};


Env.module.interface=(function () {
    return{
        show : function (champ) {
            Env.module.interface.init($(".containerListButton"));
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

Env.module.event=(function () {
    return {
        init: function () {
            Env.module.event.add($(".btnAdd"));
            Env.module.event.suppE($(".fa-ban"));
        },

        suppE : function(champ){
            champ.click(function (e) {
                var cont= $(this).closest(".card-containerSearch");
                var cardCatalogue=$(this).closest(".card-catalogue");
                var div= $(this).closest("div");
                console.log($(cont));
                var datas = {isbn : cont.attr("isbn") };
                console.log(datas);
                var pr = $.ajax('suppComics2Env',
                    {
                        type: 'POST',
                        //dataType: "json",
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
                pr.done(function (d, s, jqXHR) {
                    $(cardCatalogue).remove();
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
        },
        add: function(champ){
            champ.click(function (e) {
                var cont= $(this).closest(".card-containerSearch");
                var cardCatalogue=$(this).closest(".card-catalogue");
                var div= $(this).closest("div");
                console.log($(cont));
                var datas = {isbn : cont.attr("isbn") };
                console.log(datas);
                var pr = $.ajax('addComics2Col',
                    {
                        type: 'POST',
                        //dataType: "json",
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
                pr.done(function (d, s, jqXHR) {
                    $(cardCatalogue).remove();
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
        }

    }
})();

window.addEventListener("load",function () {

    Env.module.interface.init($(".containerListButton"));
    Env.module.event.init($(".containerListButton"));

    $(".containerListButton").hover(function (event) {
        Env.module.interface.show(event.currentTarget);
        //console.log(event.target);
    });

    $($(".containerListButton").parent(".row")).mouseleave(function (event) {
        Env.module.interface.init(event.currentTarget);
        //console.log(event.target);
    });

});
