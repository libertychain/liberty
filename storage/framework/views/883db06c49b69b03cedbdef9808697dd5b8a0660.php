<?php $__env->startSection("content"); ?>

<style type="text/css">
  .iframe-container {
  overflow: hidden;
  padding-top: 56.25% !important;
  position: relative;
}
 
.iframe-container iframe {
   border: 0;
   height: 100%;
   left: 0;
   position: absolute;
   top: 0;
   width: 100%;
}
</style>
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                 
                <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if(Session::has('flash_message')): ?>
                      <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                          <?php echo e(Session::get('flash_message')); ?>

                      </div>
                <?php endif; ?>
                

                 <?php echo Form::open(array('url' => array('admin/movies/add_edit_movie'),'class'=>'form-horizontal','name'=>'movie_form','id'=>'movie_form','role'=>'form','enctype' => 'multipart/form-data')); ?>  
                  
                  <input type="hidden" name="id" value="<?php echo e(isset($movie->id) ? $movie->id : null); ?>">

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.movie_access')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="video_access">                               
                                <option value="Paid" <?php if(isset($movie->video_access) AND $movie->video_access=='Paid'): ?> selected <?php endif; ?>>Paid</option>
                                <option value="Free" <?php if(isset($movie->video_access) AND $movie->video_access=='Free'): ?> selected <?php endif; ?>>Free</option>                            
                            </select>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.language_text')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="movie_language">
                                <option value=""><?php echo e(trans('words.select_lang')); ?></option>
                                <?php $__currentLoopData = $language_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($language_data->id); ?>" <?php if(isset($movie->id) && $language_data->id==$movie->movie_lang_id): ?> selected <?php endif; ?>><?php echo e($language_data->language_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                      </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.genres_text')); ?></label> 
                      <div class="col-sm-8">
                            <select name="genres[]" class="select2 select2-multiple" multiple="multiple" multiple name="movie_genre_id" data-placeholder="Select Genres...">
                                 <?php $__currentLoopData = $genre_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($genre_data->id); ?>" <?php if(isset($movie->id) && in_array($genre_data->id, explode(",",$movie->movie_genre_id))): ?> selected <?php endif; ?>><?php echo e($genre_data->genre_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                      </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.movie_name')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="video_title" value="<?php echo e(isset($movie->video_title) ? $movie->video_title : old('video_title')); ?>" class="form-control">
                    </div>
                  </div>                  
                  <div class="form-group row">
                    <label for="webSite" class="col-sm-3 col-form-label"> <?php echo e(trans('words.description')); ?></label>
                    <div class="col-sm-8">
                      <div class="card-box">
            
                      <textarea id="elm1" name="video_description"><?php echo e(isset($movie->video_description) ? stripslashes($movie->video_description) : old('video_description')); ?></textarea>
                     
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-sm-3"><?php echo e(trans('words.release_date')); ?></label>
                    <div class="col-sm-8">
                      <div class="input-group"> 
                        <input type="text" id="datepicker-autoclose" name="release_date" value="<?php echo e(isset($movie->release_date) ? date('m/d/Y',$movie->release_date) : old('release_date')); ?>" class="form-control" placeholder="mm/dd/yyyy">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.duration')); ?></label>
                    <div class="col-sm-8">
                      <div class="input-group">
                      <input type="text" name="duration" value="<?php echo e(isset($movie->duration) ? $movie->duration : old('duration')); ?>" class="form-control" placeholder="1h 35m 54s">
                      <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                        </div>
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.video_upload_type')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="video_type" id="video_type">                               
                                <option value="Local" <?php if(isset($movie->video_type) AND $movie->video_type=="Local"): ?> selected <?php endif; ?>>Local</option>
                                <option value="URL" <?php if(isset($movie->video_type) AND $movie->video_type=="URL"): ?> selected <?php endif; ?>>URL</option>
                                <option value="Embed" <?php if(isset($movie->video_type) AND $movie->video_type=="Embed"): ?> selected <?php endif; ?>>Embed Code</option>                            
                            </select>
                      </div>
                  </div>
                  
                  <div class="form-group row" id="local_id" <?php if(isset($movie->video_type) AND $movie->video_type!="Local"): ?> style="display:none;" <?php endif; ?>>
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.video_file')); ?> <small id="emailHelp" class="form-text text-muted">(Supported : MP4 or MKV)</small></label>
                    <div class="col-sm-8">
                      <div class="input-group">

                        <input type="text" name="video_url_local" id="video_url" value="<?php echo e(isset($movie->video_url) ? $movie->video_url : null); ?>" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#model_video_url">Select</button>
                      
                        </div>
                      </div>
                     
                    </div>
                  </div>

                  <div class="form-group row" id="url_id" <?php if(isset($movie->video_type) AND $movie->video_type!="URL"): ?> style="display:none;" <?php endif; ?> <?php if(!isset($movie->id)): ?> style="display:none;" <?php endif; ?>>
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.video_url')); ?> <small id="emailHelp" class="form-text text-muted">(Supported : MP4 or MKV)</small></label>
                     <div class="col-sm-8">
                      <input type="text" name="video_url" value="<?php echo e(isset($movie->video_url) ? $movie->video_url : null); ?>" class="form-control" placeholder="http://example.com/demo.mp4">
                    </div>
                  </div>

                  <div class="form-group row" id="embed_id" <?php if(isset($movie->video_type) AND $movie->video_type!="Embed"): ?> style="display:none;" <?php endif; ?> <?php if(!isset($movie->id)): ?> style="display:none;" <?php endif; ?>>
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.video_embed_code')); ?></label>
                     <div class="col-sm-8">
                       <textarea class="form-control" name="video_embed_code"><?php echo e(isset($movie->video_url) ? $movie->video_url : null); ?></textarea>
                    </div>
                  </div>

                  <!--<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Movie Poster</label>
                    <div class="col-sm-8">
                      <input type="file" name="video_image" class="form-control">
                    </div>
                  </div>-->
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Movie Thumbnail <small id="emailHelp" class="form-text text-muted">(<?php echo e(trans('words.recommended_resolution')); ?> : 270X390)</small></label>
                    <div class="col-sm-8">
                      <div class="input-group">

                        <input type="text" name="video_image_thumb" id="video_image_thumb" value="<?php echo e(isset($movie->video_image_thumb) ? $movie->video_image_thumb : null); ?>" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#model_movie_thumb">Select</button>
                      
                        </div>
                      </div>
                     
                    </div>
                  </div>

                  <?php if(isset($movie->video_image_thumb)): ?> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                                                                         
                           <img src="<?php echo e(URL::to('upload/source/'.$movie->video_image_thumb)); ?>" alt="video thumb" class="img-thumbnail" width="250">                        
                       
                    </div>
                  </div>
                  <?php endif; ?>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.movie_poster')); ?> <small id="emailHelp" class="form-text text-muted">(<?php echo e(trans('words.recommended_resolution')); ?> : 650x350)</small></label>
                    <div class="col-sm-8">
                      <div class="input-group">

                        <input type="text" name="video_image" id="video_image" value="<?php echo e(isset($movie->video_image) ? $movie->video_image : null); ?>" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#model_movie_poster">Select</button>
                      
                        </div>
                      </div>
                     
                    </div>
                  </div>

                  <?php if(isset($movie->video_image)): ?> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                                                                         
                           <img src="<?php echo e(URL::to('upload/source/'.$movie->video_image)); ?>" alt="video image" class="img-thumbnail" width="250">                        
                       
                    </div>
                  </div>
                  <?php endif; ?>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.status')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" <?php if(isset($movie->status) AND $movie->status==1): ?> selected <?php endif; ?>><?php echo e(trans('words.active')); ?></option>
                                <option value="0" <?php if(isset($movie->status) AND $movie->status==0): ?> selected <?php endif; ?>><?php echo e(trans('words.inactive')); ?></option>                            
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                     
                  </div>

                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> <?php echo e(trans('words.save')); ?> </button>                      
                    </div>
                  </div>
                <?php echo Form::close(); ?> 
              </div>
            </div>            
          </div>              
        </div>
      </div>
      <?php echo $__env->make("admin.copyright", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </div> 


<!--  Movie Video file -->
<div id="model_video_url" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 900px;">
        <div class="modal-content">             
            <div class="modal-body">
               <div class="iframe-container">
               <iframe src="<?php echo e(URL::to('responsive_filemanager/filemanager/dialog.php?type=2&sort_by=date&field_id=video_url&relative_url=1')); ?>" frameborder="0"></iframe>
               </div>
            </div>
        </div> 
    </div> 
</div> 



<!--  Movie Thumb -->
<div id="model_movie_thumb" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 900px;">
        <div class="modal-content">             
            <div class="modal-body">
               <div class="iframe-container">
               <iframe src="<?php echo e(URL::to('responsive_filemanager/filemanager/dialog.php?type=2&sort_by=date&field_id=video_image_thumb&relative_url=1')); ?>" frameborder="0"></iframe>
               </div>
            </div>
        </div> 
    </div> 
</div> 

<!--  Movie Poster -->
<div id="model_movie_poster" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 900px;">
        <div class="modal-content">             
            <div class="modal-body">
               <div class="iframe-container">
               <iframe src="<?php echo e(URL::to('responsive_filemanager/filemanager/dialog.php?type=2&sort_by=date&field_id=video_image&relative_url=1')); ?>" frameborder="0"></iframe>
               </div>
            </div>
        </div> 
    </div> 
</div> 


<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\laravel6_video_script\resources\views/admin/pages/addeditmovie.blade.php ENDPATH**/ ?>