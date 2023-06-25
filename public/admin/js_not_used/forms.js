 $(document).ready(function(){

         $('.dropd').click(function(){
            var $form = $(this).next();
            console.log();

            var menuID = $(this).parent().data('id');

            //var editpath = document.getElementById("pathedit").value;

            $('.render-forms').html("").hide();

                if($form.hasClass('active')){
                    $form.removeClass('active');
                    $form.html('').slideUp();
                    return false;
                }

                // cms/menu-items/list/cms/ajax_menu_update
                // cms/menu-items/list/menu/menu-items/1/edit
            $.get( ajaxBasePath+ 'cms/menu-items' + "/" + menuID +'/edit', function(data){
                
                $form.addClass('active');
                $form.html( data ).slideDown();
                
                update_menus();
                //reload_delete();
                if ($("ol .int_link").is(":checked")){
                    $('ol .internal').removeAttr('disabled');
                    $("ol .external").hide().attr("disabled", "disabled");
                    $('ol .internal').show();
                }
                else{
                    $('ol .external').removeAttr("disabled");
                    $("ol .internal").hide().attr("disabled", "disabled");
                    $("ol .external").show();
                }


            });            
        });

    });