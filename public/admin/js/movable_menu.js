
$(document).ready(function()
{

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 0
    })
    .on('change', function(e){
      var current_object = $(this);
      var action = current_object.attr('ajax-url');
      console.log(action);

      //prevent event listening on the following tags
       if(e.target.tagName=='INPUT' ||e.target.tagName=='SELECT'){
          return false;
        }


        var list   = e.length ? e : $(e.target);
         var data = JSON.stringify(list.nestable('serialize'));

         var pos = [];

          $('#nestable ol:first-child')
            .children()
                .each(function(){
                    pos.push($( this ).data('id'));
                });

        var positions = JSON.stringify(pos);
        
           $.ajax({
                url: ajaxBasePath+action,
                type: "POST",
                data: {data, positions, _token:window.csrfToken},
                dataType: 'json',
                success: function(data){
                  new PNotify({
                          title: 'Done',
                          text: 'Menu Updated Succussfull.',
                          type: 'success'
                      });
                },
                error: function(data){
                  new PNotify({
                          title: 'Operation Failed',
                          text: 'Something Went Wrong.',
                          type: 'error'
                      });
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
