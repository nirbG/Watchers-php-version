/* exemple form*/

var Form={
    module:{},
};

Form.module.submit=(function(){
    return{
        start : function(){
            var var1=Form.module.email.init($("#email"));
            var var2=Form.module.name.init($("#password"));
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

Form.module.email=(function () {
    return{
        init : function (email) {
            var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
            if(!regex.test(email.val()))
            {
                Form.module.erreur.show(email);
                $(email.parent()).addClass("has-error");
                return false;
            }
            else
            {
                Form.module.erreur.hide(email);
                $(email.parent()).removeClass("has-error");
                return true;
            }
        }
    }
})();
Form.module.name=(function () {
    return{
        init : function (name) {
            console.log(name.val());
            var res=true;
            if(name.val()==""){
                Form.module.erreur.show(name);
                $(name.parent()).addClass("has-error");
                res=false;
            }else{
                Form.module.erreur.hide(name);
                $(name.parent()).removeClass("has-error");
            }
            return res;
        },
        changeType : function (x, type) {
            // x = élément du DOM, type = nouveau type à attribuer
                if(x.prop('type') == type)
                    return x; // ça serait facile.
                try {
                    // Une sécurité d'IE empêche ceci
                    return x.prop('type', type);
                }
                catch(e) {
                    // On tente de recréer l'élément
                    // En créant d'abord une div
                    var html = $("<div>").append(x.clone()).html();
                    var regex = /type=(\")?([^\"\s]+)(\")?/;
                    // la regex trouve type=text ou type="text"
                    // si on ne trouve rien, on ajoute le type à la fin, sinon on le remplace
                    var tmp = $(html.match(regex) == null ?
                        html.replace(">", ' type="' + type + '">') :
                        html.replace(regex, 'type="' + type + '"') );

                    // on rajoute les vieilles données de l'élément
                    tmp.data('type', x.data('type') );
                    var events = x.data('events');
                    var cb = function(events) {
                        return function() {
                            //Bind all prior events
                            for(i in events) {
                                var y = events[i];
                                for(j in y) tmp.bind(i, y[j].handler);
                            }
                        }
                    }(events);
                    x.replaceWith(tmp);
                    setTimeout(cb, 10); // On attend un peu avant d'appeler la fonction
                    return tmp;
                }
        }
    }
})();
Form.module.erreur=(function () {
    return{
        show : function (champ) {
            console.log(champ.parent());
            $(champ.parent()).find(".help-block").show();
            $(champ.parent()).find(".help-block").css("display","initial");
        },
        hide : function (champ) {
            console.log(champ.parent());
            $(champ.parent()).find(".help-block").hide();
        }
    }
})();

window.addEventListener("load",function () {
    console.log("a");
    Form.module.erreur.hide( $("#password"));
    Form.module.erreur.hide($("#email"));
    $("#email").blur(function (e) {
        Form.module.email.init($("#email"));
    });
    $("#password").blur(function (e) {
        Form.module.name.init($("#password"));
    });
    $('.unmask').on('click', function(){

        if($(this).prev('input').attr('type') == 'password')
            Form.module.name.changeType($(this).prev('input'), 'text');

        else
            Form.module.name.changeType($(this).prev('input'), 'password');

        return false;
    });
});
