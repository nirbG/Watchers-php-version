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


window.addEventListener("load",function () {
    $(".form-check input").attr("disabled",true);
    $(".form-check input").attr("checked",false);
    FormCre.module.erreur.hide( $("#nom"));
    $("#nom").blur(function (e) {
        FormCre.module.name.init($("#nom"));
    });


});
