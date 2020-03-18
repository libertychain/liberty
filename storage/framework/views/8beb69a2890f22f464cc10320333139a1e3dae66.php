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
                

                 <?php echo Form::open(array('url' => array('admin/season/add_edit_season'),'class'=>'form-horizontal','name'=>'season_form','id'=>'season_form','role'=>'form','enctype' => 'multipart/form-data')); ?>  
                  
                  <input type="hidden" name="id" value="<?php echo e(isset($season_info->id) ? $season_info->id : null); ?>">
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.shows_text')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="series">
                                <option value=""><?php echo e(trans('words.select_show')); ?></option>
                                <?php $__currentLoopData = $series_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $series_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($series_data->id); ?>" <?php if(isset($season_info->id) && $series_data->id==$season_info->series_id): ?> selected <?php endif; ?>><?php echo e($series_data->series_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                      </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.season_title')); ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="season_name" value="<?php echo e(isset($season_info->season_name) ? $season_info->season_name : null); ?>" class="form-control">
                    </div>
                  </div>
           
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.season_poster')); ?> <small id="emailHelp" class="form-text text-muted">(<?php echo e(trans('words.recommended_resolution')); ?> : 650x350)</small></label>
                    <div class="col-sm-8">
                      <div class="input-group">

                        <input type="text" name="season_poster" id="season_poster" value="<?php echo e(isset($season_info->season_poster) ? $season_info->season_poster : null); ?>" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#model_poster">Select</button>
                      
                        </div>
                      </div>
                     
                    </div>
                  </div>

                  <?php if(isset($season_info->season_poster)): ?> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                                                                         
                           <img src="<?php echo e(URL::to('upload/source/'.$season_info->season_poster)); ?>" alt="video image" class="img-thumbnail" width="250">                        
                       
                    </div>
                  </div>
                  <?php endif; ?>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo e(trans('words.status')); ?></label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" <?php if(isset($season_info->status) AND $season_info->status==1): ?> selected <?php endif; ?>><?php echo e(trans('words.active')); ?></option>
                                <option value="0" <?php if(isset($season_info->status) AND $season_info->status==0): ?> selected <?php endif; ?>><?php echo e(trans('words.inactive')); ?></option>                            
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
 
<!--  Poster -->
<div id="model_poster" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 900px;">
        <div class="modal-content">             
            <div class="modal-body">
               <div class="iframe-container">
               <iframe src="<?php echo e(URL::to('responsive_filemanager/filemanager/dialog.php?type=2&sort_by=date&field_id=season_poster&relative_url=1')); ?>" frameborder="0"></iframe>
               </div>
            </div>
        </div> 
    </div> 
</div> 


<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\laravel6_video_script\resources\views/admin/pages/addeditseason.blade.php ENDPATH**/ ?>