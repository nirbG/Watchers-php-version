
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

});
