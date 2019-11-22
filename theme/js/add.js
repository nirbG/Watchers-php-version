var Add={
    module:{},
};


Add.module.interface=(function () {
    return{
        show : function (champ) {
            Add.module.interface.init($(".containerListButton"));
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

Add.module.event=(function () {
    return {
        init: function () {
            Add.module.event.supp($(".btnSupp"));
            Add.module.event.add($(".btnAdd"));
            Add.module.event.envie($(".btnEnvie"));
            Add.module.event.suppE($(".btnBanEnvie"));
        },
        envie: function(champ) {
            champ.click(function (e) {
                var cont= $(this).closest(".comics");
                console.log($(cont));
                var div= $(cont).find(".listBtn");
                var listInfoBtn=$(cont).find(".listInfoBtn");
                var datas = {isbn : cont.attr("isbn") };
                console.log(datas);
                var pr = $.ajax('../addComics2Env', {
                    type: 'POST',
                    //dataType: "json",
                    context: this,
                    xhrFields: {withCredentials: true},
                    data: datas
                });
                pr.done(function (d, s, jqXHR) {
                    div.find(".btnEnvie").remove();
                    div.find(".btnAdd").remove();
                    listInfoBtn.find(".btnEnvie").remove();
                    listInfoBtn.find(".btnAdd").remove();

                    div.append("<button class='btn btnBanEnvie col-12'><i class='fas fa-ban'></i></button>");
                    div.append("<button class='btn btnAdd col-12'><i class='fas fa-plus'></i></button>");
                    listInfoBtn.append("<button class='btn btnBanEnvie col-12'><i class='fas fa-ban'></i></button>");
                    listInfoBtn.append("<button class='btn btnAdd col-12'><i class='fas fa-plus'></i></button>");
                    Add.module.event.suppE(cont.find(".btnBanEnvie"));
                    Add.module.event.add(cont.find(".btnAdd "));

                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
        },
        suppE : function(champ){
            champ.click(function (e) {
                var cont= $(this).closest(".comics");
                var div= $(cont).find(".listBtn");
                var listInfoBtn=$(cont).find(".listInfoBtn");
                console.log($(cont));
                var datas = {isbn : cont.attr("isbn") };
                console.log(datas);
                var pr = $.ajax('../suppComics2Env',
                    {
                        type: 'POST',
                        //dataType: "json",
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
                pr.done(function (d, s, jqXHR) {
                    div.find(".btnBanEnvie").remove();
                    div.find(".btnAdd").remove();
                    listInfoBtn.find(".btnBanEnvie").remove();
                    listInfoBtn.find(".btnAdd").remove();

                    div.append("<button class='btn btnEnvie col-12'><i class='fas fa-heart'></i></button>");
                    div.append("<button class='btn btnAdd col-12'><i class='fas fa-plus'></i></button>");
                    listInfoBtn.append("<button class='btn btnEnvie col-12'><i class='fas fa-heart'></i></button>");
                    listInfoBtn.append("<button class='btn btnAdd col-12'><i class='fas fa-plus'></i></button>");
                    Add.module.event.envie(cont.find(".btnEnvie "));
                    Add.module.event.add(cont.find(".btnAdd "));
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
        },
        add: function(champ){
            champ.click(function (e) {
                var cont= $(this).closest(".comics");
                var div= $(cont).find(".listBtn");
                var listInfoBtn=$(cont).find(".listInfoBtn");
                console.log($(cont));
                var datas = {isbn : cont.attr("isbn"),prix:-1};
                console.log(datas);
                var pr = $.ajax('../addComics2Col',
                    {
                        type: 'POST',
                        //dataType: "json",
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
                pr.done(function (d, s, jqXHR) {
                    $(cont).addClass("possede");
                    div.find(".btnAdd").remove();
                    div.find(".btnEnvie").remove();
                    div.find(".btnBanEnvie").remove();
                    listInfoBtn.find(".btnAdd").remove();
                    listInfoBtn.find(".btnEnvie").remove();
                    listInfoBtn.find(".btnBanEnvie").remove();

                    div.append("<button class='btn btnSupp col-12'><i class='fas fa-minus'></i></button>");
                    listInfoBtn.append("<button class='btn btnSupp col-12'><i class='fas fa-minus'></i></button>");
                    Add.module.event.supp(cont.find(".btnSupp"));
                    if($("#albM").hasClass("active")){
                        $(cont).hide();
                    }else{
                        $(cont).show();
                    }
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
        },
        supp : function(champ){
            champ.click(function (e) {
                var cont= $(this).closest(".comics");
                var div= $(cont).find(".listBtn");
                var listInfoBtn=$(cont).find(".listInfoBtn");
                console.log($(cont));
                console.log($(listInfoBtn));
                var datas = {isbn : cont.attr("isbn")};
                console.log(datas);
                var pr = $.ajax('../suppComics2Col',
                    {
                        type: 'POST',
                        //dataType: "json",
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
                pr.done(function (d, s, jqXHR) {
                    $(cont).removeClass("possede");
                    div.find(".btnSupp").remove();
                    listInfoBtn.find(".btnSupp").remove();

                    div.append("<button class='btn btnEnvie col-12'><i class='fas fa-heart'></i></button>");
                    div.append("<button class='btn btnAdd col-12'><i class='fas fa-plus'></i></button>");
                    listInfoBtn.append("<button class='btn btnEnvie col-12'><i class='fas fa-heart'></i></button>");
                    listInfoBtn.append("<button class='btn btnAdd col-12'><i class='fas fa-plus'></i></button>");
                    Add.module.event.envie(cont.find(".btnEnvie "));
                    Add.module.event.add(cont.find(".btnAdd "));
                    if($("#alb").hasClass("active")){
                        $(cont).hide();
                    }else{
                        $(cont).show();
                    }
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
        }

    }
})();

window.addEventListener("load",function () {

    Add.module.interface.init($(".containerListButton"));
    Add.module.event.init($(".containerListButton"));

    $(".containerListButton").hover(function (event) {
        Add.module.interface.show(event.currentTarget);
        //console.log(event.target);
    });

    $($(".containerListButton").parent(".row")).mouseleave(function (event) {
        Add.module.interface.init(event.currentTarget);
        //console.log(event.target);
    });

});
