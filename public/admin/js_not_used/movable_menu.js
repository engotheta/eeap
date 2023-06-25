
$(document).ready(function()
{

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 0
    })
    .on('change', function(e){

      //prevent event listening on the following tags
       if(e.target.tagName=='INPUT' ||e.target.tagName=='SELECT'){
          return false;
        }


        var list   = e.length ? e : $(e.target);
         var data = JSON.stringify(list.nestable('serialize'));
  
            console.log(data);

         var pos = [];

          $('#nestable ol:first-child')
            .children()
                .each(function(){
                    pos.push($( this ).data('id'));
                });
                console.log(pos);

        var positions = JSON.stringify(pos);
        console.log(positions);

           $.ajax({
                url: ajaxBasePath+"cms/ajax_menu_update",
                type: "POST",
                data: {data, positions, _token:window.csrfToken},
                dataType: 'json',   
                success: function(data){
                    console.log('ajax');
                },
                error: function(data){
                    console.log('data');
                },

            });
    });
    


    $('#nestable-menu').on('click',  function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

});