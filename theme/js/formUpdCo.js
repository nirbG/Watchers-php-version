// Get the modal
var modalI = document.getElementById('myInvitModal');

// Get the button that opens the modal
var btn = document.getElementById("addHero");

// Get the <span> element that closes the modal
var span = $("#closeInvitModal");

// When the user clicks the button, open the modal
btn.onclick = function() {
    modalI.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.click(function() {
    modalI.style.display = "none";
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalI) {
        modalI.style.display = "none";
    }
};


var FormCre={
    module:{},
};

FormCre.module.submit=(function(){
    return{
        start : function(){
           console.log("gocrev");
            var var1=FormCre.module.name.init($("#ISBN"));
            var var2=FormCre.module.name.init($("#EAN"));
            var var3=FormCre.module.name.init($("#titre"));
            var var4=FormCre.module.date.init($("#date"));

            if(var1  && var2 && var3 && var4){
                console.log("ok");
                res=true;
            }else{
                console.log("erreur");
                res=false;
            }
            return res;
        },
    };
})();

FormCre.module.name=(function () {
    return{
        init : function (name) {
            var res=true;
            if(name.val()==""){
                FormCre.module.erreur.show(name);
                $(name.closest( ".form-group" )).addClass("has-error");
                res=false;
            }else{
                FormCre.module.erreur.hide(name);
                $(name.closest( ".form-group" )).removeClass("has-error");
            }
            //console.log(res);
            return res;
        }
    }
})();
FormCre.module.date=(function () {
    return{
        init : function (m2) {
            var champ=m2;
            var res=false;
            if(m2.val()!="") {
                res=true
            }else{
                res = false;
                FormCre.module.erreur.show(champ);
                $(champ.closest(".form-group")).addClass("has-error");
            }

            return res;
            // do something
        }
    }
})();
FormCre.module.erreur=(function () {
    return{
        show : function (champ) {
            $(champ.closest( ".form-group" )).find(".help-block").show();
            $(champ.closest( ".form-group" )).find(".help-block").css("display","initial");
        },
        hide : function (champ) {
            $(champ.closest( ".form-group" )).find(".help-block").hide();
        }
    }
})();

FormCre.module.suppCo=(function () {
    return{
        start : function () {
            $(".btnMinus").click(function (e) {
                var datas = {idHeros : $($(e.currentTarget).closest( ".card-containerSearch" )).attr("heros"), idComics : $(".idComics").attr("idComics")};
                var pr=$.ajax('../../admin/suppComics2hero',
                    {
                        type: 'POST',
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
                pr.done(function (d,s,jqXHR) {
                    console.log("done");
                    $($(e.currentTarget).closest( ".card-containerSearch" )).remove();
                });
                pr.fail(function(jqXHR, status, error){
                    console.log("status :"+status+" erreur :"+error);
                });
            });
        },
    }
})();



window.addEventListener("load",function () {
    $(".form-check input").attr("disabled",true);
    $(".form-check input").attr("checked",false);
    FormCre.module.erreur.hide( $("#ISBN"));
    FormCre.module.erreur.hide( $("#EAN"));
    FormCre.module.erreur.hide( $("#titre"));
    FormCre.module.erreur.hide($("#date"));
    $("#ISBN").blur(function (e) {
        FormCre.module.name.init($("#ISBN"));
    });
    $("#EAN").blur(function (e) {
        FormCre.module.name.init($("#EAN"));
    });
    $("#titre").blur(function (e) {
        FormCre.module.name.init($("#titre"));
    });
    $("#date").blur(function (e) {
        FormCre.module.name.init($("#date"));
    });
    FormCre.module.suppCo.start();


    $("#comicsinput").autocomplete(
        {
            source : function(){ // la fonction anonyme permet de maintenir une requête AJAX directement dans le plugin
                var isbn=$("#ISBN").attr("ISBN")
                var pr=$.ajax('../../findHero/'+$("#comicsinput").val()+"/"+isbn,
                    {type : 'GET',
                        dataType: "json",
                        context : this,
                        xhrFields:{withCredentials:true}
                    });
                pr.done(function (d,s,jqXHR) {
                    console.log("done");
                    console.log(d);
                    $(".comics fieldset").empty();
                    if(d.length==0){
                        $(".comics fieldset").append($("<p>il n'y a aucun comics qui a ce titre</P>"));
                    }else{
                        for(var i in d){
                            var image="../../theme/ressources/heros/"+d[i].img;
                            var card=$(" <div class='col-lg-2 card-containerSearch' style='background: url("+image+") center no-repeat;background-size: 100% 100%;' idHeros='"+d[i].id+"'>");
                            $(".comics fieldset").append(card);
                        }
                    }
                    //ajax
                    $(".card-containerSearch").click(function (comicsE) {
                        var datas = {idComics :  isbn, idHeros : $(comicsE.currentTarget).attr("idHeros")};
                        console.log(datas);
                        var pr=$.ajax('../../admin/addComics2hero',
                            {
                                type: 'POST',
                                context: this,
                                xhrFields: {withCredentials: true},
                                data: datas
                            });
                        pr.done(function (d,s,jqXHR) {
                            console.log("done");
                            $(comicsE.currentTarget).remove();
                        });
                        pr.fail(function(jqXHR, status, error){
                            console.log("status :"+status+" erreur :"+error);
                        });
                    })

                });
                pr.fail(function(jqXHR, status, error){
                    console.log("status :"+status+" erreur :"+error);
                });

            },
        });


});
