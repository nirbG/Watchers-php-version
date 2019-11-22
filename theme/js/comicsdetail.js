
var comicsDetail={
    module:{},
};

comicsDetail.module.modal=(function(){
    return{
        start : function(){
            comicsDetail.module.modal.eventAdd($("#popAdd"));
            comicsDetail.module.modal.eventSupp($("#popSupp"));
            comicsDetail.module.modal.eventAEnv($("#popAEnv"));
            comicsDetail.module.modal.eventSEnv($("#popSEnv"));
        },
        eventAdd : function(node){
            var ISBN=$("#ISBN").text();
            node.click(function (e) {
                comicsDetail.module.modal.createform("ajouter le comics");
                comicsDetail.module.modal.add(ISBN);
            });
        },
        eventSupp : function(node){
            var ISBN=$("#ISBN").text();
            node.click(function (e) {
                comicsDetail.module.modal.create("supprimer le comics");
                comicsDetail.module.modal.supp(ISBN);
            });
        },
        eventAEnv : function(node){
            var ISBN=$("#ISBN").text();
            node.click(function (e) {
                comicsDetail.module.modal.addEnvie(ISBN);
            });
        },
        eventSEnv : function(node){
            var ISBN=$("#ISBN").text();
            node.click(function (e) {
                comicsDetail.module.modal.create("supprimer le comics de vos envie","Voulez vous supprimez ce comics de votre liste d'envie ? ");
                comicsDetail.module.modal.suppEnvie(ISBN);
            });
        },
        create : function (string,message) {
            var myPop =$("<div id='myPop' class='POP'>");
            var popContent=$("<div class='POP-content'>");
            var popheader=$(" <div class='POP-header'>");
            popheader.append($("<h2 style='text-align: left;width: 50%;display: inline-block;'>"+string+"</h2>"+
                "<span class='close' style='float: right'>&times;</span>"));
            var popbody=$("<div class='POP-body' style='max-height: 500px;overflow-y : scroll;'>");
            popbody.append($("<header class='page-header AcButton'>"
                +"<p>"+message+"</p>"
                +"<btn class='offset-5 col-lg-3 btn btn-default btn-lg waves-effect waves-light' id='annuler'>Annuler</btn>"
                +"<btn class='offset-1 col-lg-3 btn btn-default btn-lg waves-effect waves-light' id='valider'>Valider</btn>"
                +"</header>"))
            var popfooter=$("<div class='POP-footer'>");
            popContent.append(popheader);
            popContent.append(popbody);
            popContent.append(popfooter);
            myPop.append(popContent);
            $("#myModal").append(myPop);
            myPop.fadeToggle( "slow", function() {
                // Animation complete
            });
            $(".close").click(function (e) {
                $("#myPop").remove();
            });
            
        },
        createform : function (string,message) {
            var myPop =$("<div id='myPop' class='POP'>");
            var popContent=$("<div class='POP-content'>");
            var popheader=$(" <div class='POP-header'>");
            popheader.append($("<h2 style='text-align: left;width: 50%;display: inline-block;'>"+string+"</h2>"+
                "<span class='close' style='float: right'>&times;</span>"));
            var popbody=$("<div class='POP-body' style='max-height: 500px;overflow-y : scroll;'>");
            popbody.append($("<header class='page-header AcButton'>"
                +"<p>"+message+"</p>"
                +"<input style='color: black' name='prix' type='number' id='prix' value='"+$("#prixDef").text()+"'>€</input>"
                +"<btn class='offset-1 col-lg-3 btn btn-default btn-lg waves-effect waves-light' id='valider'>Valider</btn>"
                +"</header>"))
            var popfooter=$("<div class='POP-footer'>");
            popContent.append(popheader);
            popContent.append(popbody);
            popContent.append(popfooter);
            myPop.append(popContent);
            $("#myModal").append(myPop);
            myPop.fadeToggle( "slow", function() {
                // Animation complete
            });
            $(".close").click(function (e) {
                $("#myPop").remove();
            });

        },
        addEnvie : function (isbn) {
            var datas = {isbn : isbn };
            console.log(datas);
            var pr = $.ajax('../addComics2Env',
                {
                        type: 'POST',
                        //dataType: "json",
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
            pr.done(function (d, s, jqXHR) {
                comicsDetail.module.modal.button("envie");
                $(".alert").remove();
                $(".infopopup").append("<div class='alert  alert-success alerte-css'style='color: white;display: none' role='alert'>"
                    +"<strong>Vous avez ajouté ce comics a vos envie</strong>"
                    +"</div>");
                $(".alert").slideDown('slow');
                setTimeout(function() {$(".info").remove();$(".alert").slideUp('slow');}, 2000);
                $("#myModal").empty();


               /* $(".infopopup").append("<p class='info'> Vous avez ajouté ce comics a vos envie </p>")
                setTimeout(function() {$(".info").remove()}, 2000);
                $("#myPop").remove();*/
            });
            pr.fail(function (jqXHR, status, error) {
                console.log("error  :" + status + " " + error);
            });
        },
        suppEnvie : function (isbn) {
            $("#valider").click(function (e) {
                var datas = {isbn : isbn };
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
                    comicsDetail.module.modal.button("enviesupp");
                    $(".infopopup").append("<div class='alert  alert-danger alerte-css'style='color: white;display: none' role='alert'>"
                        +"<strong>Vous avez supprimer ce comics</h1>"
                        +"</div>");
                    $(".alert").slideDown('slow');
                    setTimeout(function() {$(".info").remove();$(".alert").slideUp('slow');}, 2000);
                    $("#myModal").empty();

                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
            $("#annuler").click(function (e) {
                $("#myPop").remove();
            });
        },
        supp : function (isbn) {
            $("#valider").click(function (e) {
                var datas = {isbn : isbn };
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
                    comicsDetail.module.modal.button("supp");
                    $(".alert").remove();
                    $(".infopopup").append("<div class='alert  alert-danger alerte-css'style='color: white;display: none' role='alert'>"
                        +"<strong>Vous avez supprimer ce comics</h1>"
                        +"</div>");
                    $(".alert").slideDown('slow');
                    setTimeout(function() {$(".info").remove();$(".alert").slideUp('slow');}, 2000);
                    $("#myModal").empty();
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
            $("#annuler").click(function (e) {
                $("#myPop").remove();
            });
        },
        add : function (isbn) {
            $("#valider").click(function (e) {
                var prix=$("#prix").val();
                if(prix<=0.0){
                    prix=0.0;
                }
                var datas = {isbn : isbn ,prix :prix};
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
                    comicsDetail.module.modal.button("add");
                    $(".alert").remove();
                    $(".infopopup").append("<div class='alert  alert-success alerte-css'style='color: white;display: none' role='alert'>"
                        +"<strong>Vous avez ajouté ce comics</strong>"
                        +"</div>");
                    $(".alert").slideDown('slow');
                    setTimeout(function() {$(".info").remove();$(".alert").slideUp('slow');}, 2000);
                    $("#myModal").empty();
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
            $("#annuler").click(function (e) {
                $("#myPop").remove();
            });
        },
        button : function (type) {
            switch (type){
                case "add":
                    $(".AcButton").empty();
                    var span="<span>acheté pour <input type='number'> €</span>";
                    var s="<btn id='popSupp' type='button'  style='margin-top: 2%' class='col-lg-12 btn btn-default btn-lg waves-effect waves-light'>supprimer de la bedetheque</btn>";
                    $(".AcButton").append($(span));
                    $(".AcButton").append($(s));
                    comicsDetail.module.modal.eventSupp($("#popSupp"));
                break;
                case "envie":
                    $("#popAEnv").remove();
                    var s="<btn id='popSEnv' type='button' class='col-lg-12 btn btn-default btn-lg waves-effect waves-light'>supprimer de votre liste d'envie</btn>";
                    $(".AcButton").prepend($(s));
                    comicsDetail.module.modal.eventSEnv($("#popSEnv"));
                    break;
                case "enviesupp":
                    $("#popSEnv").remove();
                    var s="<btn id='popAEnv' type='button' class='col-lg-12 btn btn-default btn-lg waves-effect waves-light'>ajouter à votre liste d'envie</btn>"
                    $(".AcButton").prepend($(s));
                    comicsDetail.module.modal.eventAEnv($("#popAEnv"));
                    break;
                case "supp":
                    $(".AcButton").empty();
                    var s="<btn id='popAEnv' type='button' class='col-lg-12 btn btn-default btn-lg waves-effect waves-light'>ajouter à votre liste d'envie</btn>"
                    var d="<btn id='popAdd' type='button'  style='margin-top: 2%' class='col-lg-12 btn btn-default btn-lg waves-effect waves-light'>ajouter à la bedetheque</btn>";
                    $(".AcButton").append($(s));
                    $(".AcButton").append($(d));
                    comicsDetail.module.modal.eventAEnv($("#popAEnv"));
                    comicsDetail.module.modal.eventAdd($("#popAdd"));
                    break;
            }
        }
    };
})();


comicsDetail.module.note=(function(){
    return{
        start : function(){
            $(".star").click(function (e) {
                var note=$(e.currentTarget).attr("data-value");
                var ISBN=$("#ISBN").text();
                datas={"note" : note };
                var pr = $.ajax(ISBN+'/note',
                    {
                        type: 'POST',
                        //dataType: "json",
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
                pr.done(function (d, s, jqXHR) {
                    $(".alert").remove();
                    $(".infopopup").append("<div class='alert  alert-success alerte-css'style='color: white;display: none' role='alert'>"
                        +"<strong>Nous avons ajouté votre note</strong>"
                        +"</div>");
                    $(".alert").slideDown('slow');
                    setTimeout(function() {$(".info").remove();$(".alert").slideUp('slow');}, 2000);
                    $("#myModal").empty();
                    console
                    $(".rating-widget h5").text(d);
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
            });
        }
    };
})();
window.addEventListener("load",function () {
    comicsDetail.module.modal.start();
    comicsDetail.module.note.start();
});

/* Works best in Webkit */

/* Inline XML data URI fix */
/* Some browsers (most browsers) don't render inline XML data URI's unless they are escaped. */
(function() {

    if(!window.StyleFix) return;
    if(hasxmldatauri()) return;

// Test unescaped XML data uri
    function hasxmldatauri() {
        var img = new Image();
        datauri = 'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0,0 1,1" fill="#000"></svg>';
        img.src = datauri;
        return (img.width == 1 && img.height == 1);
    }

    StyleFix.register(function(css) {

        return css.replace(RegExp(/url\(\'data:image\/svg\+xml,(.*)\'\)/gi), function($0, svg) {
            return "url('data:image/svg+xml," + escape(svg) + "')";
        });

    });

})();



