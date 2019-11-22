/**
 * Created by quent on 21/02/2017.
 */

//var lastId = lastIdPage;
//var lastIdSegment = 0;
var newscrollHeight;

var app = {};
app.modules = {};
app.modules.chat = {
    getMessages: (function () {
        return {
            modulerecv: function () {
                app.modules.chat.getMessages.recevoir();
                setTimeout(function() {app.modules.chat.getMessages.modulerecv();}, 10000);
            },
            recevoir: function () {
                console.log("recv");
                var ISBN=$("#ISBN").text();
                var lastIdCom=$(".commentaireDetail").attr("lastid");
                var pr= $.ajax(ISBN+'/afficheCom', {
                    type: 'POST',
                    data: "lastId=" + lastIdCom,
                    dataType: "json",
                    xhrFields: {withCredentials: true}
                });
                pr.fail(function (jqXHR, status, error) {
                    console.log("error  :" + status + " " + error);
                });
                pr.done(function (reponse, status, jqXHR) {
                    if(reponse.id>0) {
                        $(".commentaireDetail").attr("lastid", reponse.id);
                        $(".commentaireDetail").append(reponse.message);
                    }
                });

            },
            init: function () {
                app.modules.chat.getMessages.modulerecv();
            }
        }
    })(),

    sendMessage: (function () {
        return {
            envoyer: function (message) {
                app.modules.chat.getMessages.recevoir();
                var ISBN=$("#ISBN").text();

                return jQuery.ajax(ISBN+'/addCom', {
                    type: 'POST',
                    data: "commentaire=" + message,
                    dataType: "json",
                    xhrFields: {withCredentials: true}
                })
                    .done(function (reponse, status, jqXHR) {
                        $(".commentaireDetail").attr("lastid",reponse.id);
                        var com="<div class='offset-3 col-9 talk-bubble tri-right border-bubble round btm-right-in' id='"+reponse.id+"'>"
                                    +"<div class='talktext'>"
                                        +"<h4>Vous</h4>"
                                        +"<p>"+message+"</p>"
                                        +"<p style='text-align: right;margin-bottom: 0%;'>"+reponse.date+"</p>"
                                    +"</div>"
                                +"</div>";
                        $(".commentaireDetail").append(com);
                        console.log(reponse);
                    })
                    .fail(function () {

                    });

            },

            init: function () {
                $("#submitmsg").on('click', function () {
                    var message = $("#usermsg").val();
                    app.modules.chat.sendMessage.envoyer(message);
                    $("#usermsg").val("");
                    return false;
                });
            }

        }
    })()

};


$('document').ready(function () {

   // newscrollHeight = $("#chatbox")[0].scrollHeight - 20;
    //$("#chatbox").scrollTop(newscrollHeight);


    app.modules.chat.sendMessage.init();

    app.modules.chat.getMessages.init();


});

