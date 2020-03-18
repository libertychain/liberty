<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo e(getcong('site_name')); ?> Admin">
  <meta name="author" content="Viaviwebtech">
  <link rel="shortcut icon" href="<?php echo e(URL::asset('upload/source/'.getcong('site_favicon'))); ?>">
  <title><?php echo e(getcong('site_name')); ?> Admin</title>

  <!-- App css -->
  <link href="<?php echo e(URL::asset('admin_assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('admin_assets/css/icons.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('admin_assets/plugins/multiselect/css/multi-select.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('admin_assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('admin_assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(URL::asset('admin_assets/css/style.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(URL::asset('admin_assets/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />  

  <script src="<?php echo e(URL::asset('admin_assets/js/modernizr.min.js')); ?>"></script>

 
</head>
  <body class="fixed-left">
    <div id="wrapper">
   
    <?php echo $__env->make("admin.topbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

    <?php echo $__env->make("admin.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent("content"); ?>

    </div>

         <!-- jQuery  -->
  <script src="<?php echo e(URL::asset('admin_assets/js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/popper.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/detect.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/fastclick.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/jquery.blockUI.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/waves.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/jquery.nicescroll.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/jquery.slimscroll.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/js/jquery.scrollTo.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/plugins/tinymce/tinymce.min.js')); ?>"></script>

  <script src="<?php echo e(URL::asset('admin_assets/plugins/jquery-knob/jquery.knob.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
 
  <script type="text/javascript" src="<?php echo e(URL::asset('admin_assets/plugins/multiselect/js/jquery.multi-select.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/plugins/select2/js/select2.min.js')); ?>" type="text/javascript"></script>
  
  <?php if(classActivePath('dashboard')): ?>
  <!-- Counter Up  -->
  <script src="<?php echo e(URL::asset('admin_assets/plugins/waypoints/jquery.waypoints.min.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('admin_assets/plugins/counterup/jquery.counterup.min.js')); ?>"></script>
  <?php endif; ?>

  <!-- App js -->
   <script src="<?php echo e(URL::asset('admin_assets/js/jquery.core.js')); ?>"></script>
   <script src="<?php echo e(URL::asset('admin_assets/js/jquery.app.js')); ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
      if ($("#elm1").length > 0) {
        tinymce.init({
          selector: "textarea#elm1",
          theme: "modern",
          height: 300,
          plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
          ],
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
          style_formats: [
            { title: 'Bold text', inline: 'b' },
            { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
            { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
            { title: 'Example 1', inline: 'span', classes: 'example1' },
            { title: 'Example 2', inline: 'span', classes: 'example2' },
            { title: 'Table styles' },
            { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
          ]
        });
      }
    });
  </script>
<script>
jQuery(document).ready(function () {
  $(".select2, .select3, .select4, .select5, .select6, .select7, .select8").select2();
  $(".select2-limiting, .select3-limiting, .select4-limiting, .select5-limiting, .select6-limiting, .select7-limiting, .select8-limiting").select2({
    maximumSelectionLength: 2
  });
});

jQuery('#datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true
            });
</script> 

<script>
 $(function(){
    // bind change event to select
    $('#movie_language_id').on('change', function () {
        var url = $(this).val(); // get selected value
       
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

    //Series
    $('#series_language_id').on('change', function () {
        var url = $(this).val(); // get selected value
       
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

    //Season
    $('#season_series_id').on('change', function () {
        var url = $(this).val(); // get selected value
       
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

    //Episodes
    $('#episodes_series_id').on('change', function () {
        var url = $(this).val(); // get selected value
       
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

    //Sports
    $('#sports_cat_id').on('change', function () {
        var url = $(this).val(); // get selected value
       
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

    //Users
    $('#plan_select').on('change', function () {
        var url = $(this).val(); // get selected value
       
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

    //Transactions
    $('#gateway_select').on('change', function () {
        var url = $(this).val(); // get selected value
       
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

  });

 //Add edit Movie
$("#video_type").change(function(){         
   var type=$("#video_type").val();
      //alert(type);
       if(type=="URL")
       {                 
         $("#local_id").hide();
         $("#url_id").show();
         $("#embed_id").hide();
         $("#movie_poster_id").show();
       }
      else if(type=="Embed")
       {                 
         $("#local_id").hide();
         $("#url_id").hide();
         $("#embed_id").show();

         $("#movie_poster_id").hide();
       }             
      else
      {   
        $("#local_id").show();
        $("#url_id").hide();
        $("#embed_id").hide(); 
        $("#movie_poster_id").show();        
      }    
      
 });

$("#admin_usertype").change(function(){         
   var type=$("#admin_usertype").val();

       if(type=="Admin")
       {
          $("#master_admin_id").show();
          $("#sub_admin_id").hide();
       }
       else
       {
          $("#master_admin_id").hide();
          $("#sub_admin_id").show();
       }

 });
</script>

<script type="text/javascript">
  $(document).ready(function(e) {
      
     $("#episode_series_id").change(function(){
         var series_id=$("#episode_series_id").val();
      $.ajax({
      type: "GET",
       url: "<?php echo e(URL::to('admin/ajax_get_season')); ?>/"+series_id,
       //data: "cat=" + cat,
       success: function(result){

           $("#episode_season_id option").remove();
            
           $("#episode_season_id").html(result);

        }
      });
      
         });
  });
</script>
<script type="text/javascript">
  
  //$("select").select2();

$("select").on("select2:select", function (evt) {
  var element = evt.params.data.element;
  var $element = $(element);
  
  $element.detach();
  $(this).append($element);
  $(this).trigger("change");
});

</script>
    </body>
</html><?php /**PATH G:\xampp\htdocs\laravel6_video_script\resources\views/admin/admin_app.blade.php ENDPATH**/ ?>