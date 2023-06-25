
// redactor textarea upload
// $(document).ready(
//   function()
//   {
//     $('#redactor_en, #redactor_sw').redactor({
//        focus: true,
//
//        plugins: ['fullscreen', 'imagemanager', 'filemanager', 'video'],
//
//     	 imageUpload: window.location.origin +ajaxBasePath+'/cms/upload?_token='+window.csrfToken,
//        imageManagerJson: window.location.origin +ajaxBasePath+'/cms/getimages',
//
//       fileUpload: window.location.origin +ajaxBasePath+'/cms/upload_file?_token='+window.csrfToken,
//       fileManagerJson: window.location.origin +ajaxBasePath+'/cms/getfiles',
//
//     });
//
//   }
// );


$(document).ready(function(){

    // hide and show internal and external link
    // console.log(document.querySelector("input:not(.quick-link)[name$='link']"));
    // console.log($("input:not(.quick-link)[name$='link']:checked").val());

    if(document.querySelector("input:not(.quick-link)[name$='link']")){
        if($("input[name$='link']:checked").val() == 0){
            $('.internal').hide();
        }else{
            $(".external").hide();
        }
    }else{
        // Do something for quick links, if available (since they are many)
        var $more_links = document.querySelectorAll("input[name$='link']");
        if($more_links.length){
            $more_links.forEach($more_link => {
                if($more_link.getAttribute('checked') == 'checked'){
                    var value = $more_link.getAttribute('value');
                    var $target = $more_link.getAttribute('data-target');
                    
                    if (value == 1) {
                        $('.internal'+$target).show();
                        $('.internal'+$target).removeAttr('disabled');
                        $(".external"+$target).hide();
                    }else {
                        $(".external"+$target).show();
                        $('.external'+$target).removeAttr('disabled');
                        $('.internal'+$target).hide();
                    }
                }
            });
        }
    }
    


    $("input[name$='link']").click(function() {
        var value = $(this).val();
        var $target = ($(this).attr('data-target')) ?? '';
        console.log($target);
        
        if (value == 1) {
          $('.internal'+$target).show();
          $('.internal'+$target).removeAttr('disabled');
          $(".external"+$target).hide();
        }else {
          $(".external"+$target).show();
          $('.external'+$target).removeAttr('disabled');
          $('.internal'+$target).hide();
        }
    });

    // hide and show menu form edit ajax
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

           // alert(editpath + "/" + menuID +'/edit');

       $.get( ajaxBasePath+ '/menu/menu-items' + "/" + menuID +'/edit', function(data){
           $form.addClass('active');
           $form.html( data ).slideDown();

           // update_menus();
           $(".external").hide();

           $("input[name$='link']").click(function() {
               var value = $(this).val();
               if (value == 1) {
                 $('.internal').show();
                 $('.internal').removeAttr('disabled');
                 $(".external").hide();
               }else {
                 $(".external").show();
                 $('.external').removeAttr('disabled');
                 $('.internal').hide();
               }
           });

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

   // initialism datatable
   $('.dataTable').dataTable();

   // initialism selct2
   $('.select2').select2();

     $('.close-noty').click(function () {
         $(this).parent().fadeOut();
     });

     setTimeout(function () {
         $('.notification-panel').fadeOut();
     }, 10000);
});

// lightbox
lightbox.option({'resizeDuration': 200, 'wrapAround': true  });

$("body").on("click","a[data-method]",function(e){

 var current_object = $(this);
 e.preventDefault();
 // console.log(current_object.attr('href'));

 swal({
     title: "Are you sure?",
     text: "If you delete this file, you will not be able to recover it again",
     type: "error",
     showCancelButton: true,
     dangerMode: true,
     cancelButtonClass: '#DD6B55',
     confirmButtonColor: '#dc3545',
     confirmButtonText: 'Delete!',
 },function (result) {
     if (result) {
         var action = current_object.attr('href');
         var token = jQuery('meta[name="csrf-token"]').attr('content');
         var id = current_object.attr('data-id');

         $('a[data-method]').html("<form style='display:none' class='form-inline remove-form' method='post' action='"+action+"'></form>");
         $('a[data-method]').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
         $('a[data-method]').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
         $('a[data-method]').find('.remove-form').submit();
     }
 });
});
