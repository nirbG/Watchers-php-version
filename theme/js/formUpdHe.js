
// Get the modal
var modal = document.getElementById('myInvitModal');

// Get the button that opens the modal
var btn = document.getElementById("addSerie");

// Get the <span> element that closes the modal
var span = $("#closeInvitModal");

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.click(function() {
    modal.style.display = "none";
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};


// Get the modal
var modalI = document.getElementById('myInvitModal2');

// Get the button that opens the modal
var btnI = document.getElementById("addComics");

// Get the <span> element that closes the modal
var spanI = $("#closeInvitModalI");

// When the user clicks the button, open the modal
btnI.onclick = function() {
    modalI.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanI.click(function() {
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
            var var1=FormCre.module.name.init($("#nom"));

            if(var1){
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
                var datas = {idComics : $($(e.currentTarget).closest( ".card-containerSearch" )).attr("isbn"), idHeros : $("#idHeros").attr("idHeros")};
                var pr=$.ajax('../../admin/suppComics2hero',
                    {
                        type: 'POST',
                        context: this,
                        xhrFields: {withCredentials: true},
                        data: datas
                    });
                pr.done(function (d,s,jqXHR) {
                    if(d=="true") {
                        $($(e.currentTarget).closest(".card-containerSearch")).remove();
                    }
                });
                pr.fail(function(jqXHR, status, error){
                    console.log("status :"+status+" erreur :"+error);
                });
            });
        },
    }
})();

FormCre.module.hideShow=(function () {
    return{
        start : function () {
            $(".sectionWatchers .fa-minus").click(function (e) {
                var section=$(e.currentTarget).closest(".sectionWatchers");
                $($($(section).closest(".row")).find(".row")).slideUp("slow");
                $($(section).find(".fa-plus")).show();
                $($(section).find(".fa-minus")).hide();
            });
            $(".sectionWatchers .fa-plus").click(function (e) {
                var section=$(e.currentTarget).closest(".sectionWatchers");
                $($($(section).closest(".row")).find(".row")).slideDown("slow");
                $($(section).find(".fa-plus")).hide();
                $($(section).find(".fa-minus")).show();
            });
        },
    }
})();

FormCre.module.AddCo=(function () {
    return {
        start: function () {
            $("#comicsinput").autocomplete(
                {
                    source: function () { // la fonction anonyme permet de maintenir une requête AJAX directement dans le plugin
                        var idHeros = $("#idHeros").attr("idHeros")
                        var pr = $.ajax('../../findComicsToHero/' + $("#comicsinput").val() + "/" + idHeros,
                            {
                                type: 'GET',
                                dataType: "json",
                                context: this,
                                xhrFields: {withCredentials: true}
                            });
                        pr.done(function (d, s, jqXHR) {
                            console.log("done");
                            console.log(d);
                            $(".comics fieldset").empty();
                            if (d.length == 0){
                                $(".comics fieldset").append($("<p>il n'y a aucun comics qui a ce titre</P>"));
                            } else {
                                for (var i in d) {
                                    var image = "../../theme/ressources/livre/" + d[i].img;
                                    var card = $(" <div class='col-lg-2 card-containerSearch' style='background: url(" + image + ") center no-repeat;background-size: 100% 100%;' ISBN='" + d[i].ISBN + "'>");
                                    $(".comics fieldset").append(card);
                                }
                            }
                            //ajax
                            $(".card-containerSearch").click(function (comics) {
                                var datas = {idComics: $(comics.currentTarget).attr("ISBN"), idHeros:idHeros};
                                console.log(datas);
                                var pr = $.ajax('../../admin/addComics2hero',
                                    {
                                        type: 'POST',
                                        context: this,
                                        xhrFields: {withCredentials: true},
                                        data: datas
                                    });
                                pr.done(function (d, s, jqXHR) {
                                    console.log("done");
                                    $(comics.currentTarget).remove();
                                });
                                pr.fail(function (jqXHR, status, error) {
                                    console.log("status :" + status + " erreur :" + error);
                                });
                            })

                        });
                        pr.fail(function (jqXHR, status, error) {
                            console.log("status :" + status + " erreur :" + error);
                        });

                    },
                });
            }
        }
    })();
FormCre.module.AddSerie=(function () {
    return {
        start: function () {
            $("#seriesinput").autocomplete(
                {
                    source: function () { // la fonction anonyme permet de maintenir une requête AJAX directement dans le plugin
                        var idHeros = $("#idHeros").attr("idHeros")
                        var pr = $.ajax('../../findSeriesToHero/' + $("#seriesinput").val() + "/" + idHeros,
                            {
                                type: 'GET',
                                dataType: "json",
                                context: this,
                                xhrFields: {withCredentials: true}
                            });
                        pr.done(function (d, s, jqXHR) {
                            console.log("done");
                            console.log(d);
                            $(".serie fieldset").empty();
                            if (d.length == 0){
                                $(".serie fieldset").append($("<p>il n'y a aucune serie qui a ce nom</P>"));
                            } else {
                                for (var i in d) {
                                    var card = $(" <div class='col-lg-12 serie card serieSearch '  id='"+d[i].id+"' style='padding: 0'>");
                                    card.append(" <h5 class='col-12' style='margin: 1% 0%;color: black;text-align: left' >"+d[i].nom+"<strong class='serieNONComplete'>"+d[i].nblivre+"</strong></h5>")
                                    $(".serie fieldset").append(card);
                                }
                            }
                            //ajax
                            $(".serieSearch").click(function (serie) {
                                var datas = {idSerie: $(serie.currentTarget).attr("id"), idHeros:idHeros};
                                console.log(datas);
                                var pr = $.ajax('../../admin/addSerie2hero',
                                    {
                                        type: 'POST',
                                        context: this,
                                        xhrFields: {withCredentials: true},
                                        data: datas
                                    });
                                pr.done(function (d, s, jqXHR) {
                                    console.log("done");
                                    $(serie.currentTarget).remove();
                                });
                                pr.fail(function (jqXHR, status, error) {
                                    console.log("status :" + status + " erreur :" + error);
                                });
                            })

                        });
                        pr.fail(function (jqXHR, status, error) {
                            console.log("status :" + status + " erreur :" + error);
                        });

                    },
                });
        }
    }
})();

FormCre.module.suppSerie=(function () {
    return{
        start: function () {
            $(".supprimerSerie").click(function (e) {
                var idSerie = $(e.currentTarget).closest(".serie").attr("idSe");
                var idHeros = $("#idHeros").attr("idHeros");
                var modal = $(".modal2");
                $(modal).empty()
                var head = $("<div class='modal-header'>");
                head.append($(" <h5 class='modal-title'>Suprimer la serie</h5>"));
                head.append($("<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"))
                var body = $("<div class='modal-body'>");
                body.append($("<p>Êtes-vous sur de vouloir supprimer cette serie ?</p>"));
                body.append($("<button type='button'  class='btn btnchoose suppSerie'  style='margin-right: 2px' idSerie='" + idSerie + "'>Confirmer</button>"));
                body.append($("<button type='button'  class='btn btnchoose cancelSerie' data-dismiss='modal'>Annuler</button>"));
                var footer = $("<div class='modal-footer'>");
                var content = $("<div class='modal-content'>");
                content.append(head);
                content.append(body);
                content.append(footer);
                var dial = $(" <div class='modal-dialog' role='document'>");
                dial.append(content);
                modal.append(dial);
                $(".modal2").show();
                $("#modalQuitter2").click(function () {
                    $(".modal2").hide();
                });
                $(".cancelSerie").click(function () {
                    $(".modal2").hide();
                });
                window.onclick = function (event) {
                    if (event.target == modal) {
                        $(".modal2").hide();
                    }
                };
                $(".suppSerie").click(function (serie) {
                    var datas = {idSerie: $(serie.currentTarget).attr("idSerie"), idHeros: idHeros};
                    console.log(datas);
                    var pr = $.ajax('../../admin/suppSerie2Hero',
                        {
                            type: 'POST',
                            context: this,
                            xhrFields: {withCredentials: true},
                            data: datas
                        });
                    pr.done(function (d, s, jqXHR) {
                        console.log("done");
                        $(".modal2").hide();
                        $(e.currentTarget).closest(".serie").remove();
                    });
                    pr.fail(function (jqXHR, status, error) {
                        console.log("status :" + status + " erreur :" + error);
                        $(".modal2").show();
                    });
                })
            })
        },
    }
})();

window.addEventListener("load",function () {
    $(".form-check input").attr("disabled",true);
    $(".form-check input").attr("checked",false);
    FormCre.module.erreur.hide( $("#nom"));
    $("#nom").blur(function (e) {
        FormCre.module.name.init($("#nom"));
    });

    FormCre.module.suppSerie.start();
    FormCre.module.hideShow.start();
    FormCre.module.AddCo.start();
    FormCre.module.AddSerie.start();
    FormCre.module.suppCo.start();

});
