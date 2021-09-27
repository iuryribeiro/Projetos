$(function () {
    $(".j_mask").mask("#.###.###,##", {reverse: true})
    $(".j_mask_porc").mask("##%", {reverse: true})

    $("input[type=reset]").click(function () {
        var vlrTotal = $("h4.j_total");
        vlrTotal.html("R$ 0,00");
    })

    /*
      * AJAX FORM
      */
    $("form:not('.ajax_off')").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var load = $(".ajax_load");
        var flashClass = "ajax_response";
        var flash = $("." + flashClass);


       
        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                
                load.fadeIn(200).css("display", "flex");
                console.log(form.attr("action"));

               

            },
            uploadProgress: function (event, position, total, completed) {
                var loaded = completed;
                var load_title = $(".ajax_load_box_title");
                load_title.text("Enviando (" + loaded + "%)");

                form.find("input[type='file']").val(null);
                if (completed >= 100) {
                    load_title.text("Aguarde, carregando...");
                }

            },
            success: function (response) {
                //redirect

                
                if (response.redirect) {
                   $.notify('Acesso permitido', 'success');
                    window.location.href = response.redirect;

                    
                    

                } else {
                    load.fadeOut(200);
                }

                //reload
                if (response.reload) {
                    window.location.reload();
                } else {
                    load.fadeOut(200);
                }

                //message
                if (response.message) {
                    if (flash.length) {
                        // $.notify('Acesso negado', 'error');
                        $(".incor").notify(
                          "Senha Incorreta", "error", 
                          { position:"right" }
                        );
                       
                        flash.html(response.message).fadeIn(100).effect("bounce", 300);
                        
                    } else {                             
                         
                        // form.prepend("<div class='" + flashClass + "'>" + response.message + "</div>")
                        //     .find("." + flashClass).effect("bounce", 300);
                    }
                } else {
                    flash.fadeOut(100);
                }
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            },
            error: function () {
                var message = "<div class='message error icon-warning'>Desculpe mas não foi possível processar a requisição. Favor tente novamente!</div>";

                if (flash.length) {
                    flash.html(message).fadeIn(100).effect("bounce", 300);
                } else {
                    form.prepend("<div class='" + flashClass + "'>" + message + "</div>")
                        .find("." + flashClass).effect("bounce", 300);
                }
            }
        });
    });

    $(".print").click(function () {
        alert("Em Desenvolvimento");
    });

    /*
     * APP INVOICE REMOVE
     */
    $("[data-remove]").click(function (e) {
        var remove = confirm("WARNING: This action cannot be undone! Are you sure you want to delete this posting?");
        var load = $(".ajax_load");

        if (remove === true) {
            load.fadeIn(200).css("display", "flex");
            $.post($(this).data("remove"), function (response) {
                //redirect
                if (response.redirect) {
                    window.location.href = response.redirect;
                    load.fadeOut(200);
                }
            }, "json");
        }
    })
});