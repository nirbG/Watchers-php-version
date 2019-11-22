
var SuppCo={
    module:{},
};

SuppCo.module.supp=(function() {
        return {
            start: function () {
                $(".btnMinus").click(function (e) {
                    var datas = {ISBN : $($(e.currentTarget).closest( ".card-containerSearch" )).attr("ISBN")};
                    var pr=$.ajax('../admin/suppComics',
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
            }
        }
    }
)();

window.addEventListener("load",function () {
    SuppCo.module.supp.start();
});

