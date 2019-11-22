
// Get the modal
var modal = document.getElementById('MyModal');

// Get the button that opens the modal
var btn = document.getElementById("ModCompte");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

var upCompte={
    module:{},
};

upCompte.module.submit=(function(){
    return{
        start : function(){
            console.log("gocrev");
            var var1=upCompte.module.name.init($("#pseudo"));
            var var2=upCompte.module.email.init($("#email"));
            if(var1 && var2){
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

upCompte.module.name=(function () {
    return{
        init : function (name) {
            var res=true;
            if(name.val()==""){
                upCompte.module.erreur.show(name);
                $(name.closest( ".form-group" )).addClass("has-error");
                res=false;
            }else{
                upCompte.module.erreur.hide(name);
                $(name.closest( ".form-group" )).removeClass("has-error");
            }
            //console.log(res);
            return res;
        }
    }
})();
upCompte.module.email=(function () {
    return{
        init : function (email) {
            var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
            if(!regex.test(email.val()))
            {
                return false;
            }
            else
            {
                return true;
            }
        }
    }
})();
upCompte.module.erreur=(function () {
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


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
upCompte.module.showMess=(function () {
    return{
        show : function (champ) {
            $("#messagediv").find("#message").text(champ);
            setTimeout(function() {
                $("#messagediv").find("#message").text("");
            },2000);
        }
    }
})();

window.addEventListener("load",function () {
    $("#update").click(function (e) {
        if(upCompte.module.submit.start()){
            var datas = {pseudo : $("#pseudo").val(), email : $("#email").val()};
            var pr=$.ajax('updateInfo',
                {
                    type: 'POST',
                    context: this,
                    xhrFields: {withCredentials: true},
                    data: datas
                });
            pr.done(function (d,s,jqXHR) {
                upCompte.module.showMess.show("Vos données on était modifié.");

            });
            pr.fail(function(jqXHR, status, error){
                console.log("status :"+status+" erreur :"+error);
            });
        }else{
            upCompte.module.showMess.show("Echec des modifications des données.");
        }
    });
});
