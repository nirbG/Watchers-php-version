
// Get the modal
var modalI = document.getElementById('myInvitModal');

// Get the button that opens the modal
var btn = document.getElementById("addComics");

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
                var datas = {idComics : $($(e.currentTarget).closest( ".card-containerSearch" )).attr("ISBN"), idSerie : $(".idSerie").attr("idSerie")};
                var pr=$.ajax('../../admin/suppComics2Serie',
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
    FormCre.module.erreur.hide( $("#nom"));

    $("#nom").blur(function (e) {
        FormCre.module.name.init($("#nom"));
    });
    FormCre.module.suppCo.start();

        $("#comicsinput").autocomplete(
            {
                source : function(){ // la fonction anonyme permet de maintenir une requête AJAX directement dans le plugin

                    var pr=$.ajax('../../findComics/'+$("#comicsinput").val(),
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
                                var image="../../theme/ressources/livre/"+d[i].img;
                                var card=$(" <div class='col-lg-2 card-containerSearch' style='background: url("+image+") center no-repeat;background-size: 100% 100%;' ISBN='"+d[i].ISBN+"'>");

                                $(".comics fieldset").append(card);
                            }
                        }
                        //ajax
                        $(".card-containerSearch").click(function (comicsE) {
                            var datas = {idComics : $(comicsE.currentTarget).attr("ISBN"), idSerie : $(".idSerie").attr("idSerie")};
                            console.log(datas);
                            var pr=$.ajax('../../admin/addComics2Serie',
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
