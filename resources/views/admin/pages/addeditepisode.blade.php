@extends("admin.admin_app")

@section("content")

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
                 
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(Session::has('flash_message'))
                      <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                          {{ Session::get('flash_message') }}
                      </div>
                @endif
                

                 {!! Form::open(array('url' => array('admin/episodes/add_edit_episode'),'class'=>'form-horizontal','name'=>'episode_form','id'=>'episode_form','role'=>'form','enctype' => 'multipart/form-data')) !!}  
                  
                  <input type="hidden" name="id" value="{{ isset($episode_info->id) ? $episode_info->id : null }}">

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.episode_access')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="video_access">                               
                                <option value="Paid" @if(isset($episode_info->video_access) AND $episode_info->video_access=='Paid') selected @endif>Paid</option>
                                <option value="Free" @if(isset($episode_info->video_access) AND $episode_info->video_access=='Free') selected @endif>Free</option>                            
                            </select>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.shows_text')}}*</label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="series" id="episode_series_id">
                                <option value="">{{trans('words.select_show')}}</option>
                                @foreach($series_list as $series_data)
                                  <option value="{{$series_data->id}}" @if(isset($episode_info->id) && $series_data->id==$episode_info->episode_series_id) selected @endif>{{$series_data->series_name}}</option>
                                @endforeach
                            </select>
                      </div>
                  </div> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.seasons_text')}}*</label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="season" id="episode_season_id">
                                <option value="">Select Season</option>
                                @if(isset($episode_info->id)) 
                                  @foreach($season_list as $i => $season_data)    
                                      <option value="{{ $season_data->id }}" @if($season_data->id==$episode_info->episode_season_id) selected @endif>{{ $season_data->season_name }}</option>    
                                  @endforeach
                                @endif                                
                            </select>
                      </div>
                  </div>
                   
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.episode_title')}}*</label>
                    <div class="col-sm-8">
                      <input type="text" name="video_title" value="{{ isset($episode_info->video_title) ? $episode_info->video_title : null }}" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="webSite" class="col-sm-3 col-form-label">{{trans('words.description')}}</label>
                    <div class="col-sm-8">
                      <div class="card-box">
            
                      <textarea id="elm1" name="video_description">{{ isset($episode_info->video_description) ? stripslashes($episode_info->video_description) : null }}</textarea>
                     
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-sm-3">{{trans('words.release_date')}}</label>
                    <div class="col-sm-8">
                      <div class="input-group"> 
                        <input type="text" id="datepicker-autoclose" name="release_date" value="{{ isset($episode_info->release_date) ? date('m/d/Y',$episode_info->release_date) : null }}" class="form-control" placeholder="mm/dd/yyyy">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.duration')}}</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                      <input type="text" name="duration" value="{{ isset($episode_info->duration) ? $episode_info->duration : null }}" class="form-control" placeholder="1h 35m 54s">
                      <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                        </div>
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.video_upload_type')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="video_type" id="video_type">                               
                                <option value="Local" @if(isset($episode_info->video_type) AND $episode_info->video_type=="Local") selected @endif>Local</option>
                                <option value="URL" @if(isset($episode_info->video_type) AND $episode_info->video_type=="URL") selected @endif>URL</option>
                                <option value="Embed" @if(isset($episode_info->video_type) AND $episode_info->video_type=="Embed") selected @endif>Embed Code</option>                            
                            </select>
                      </div>
                  </div>
                  
                  <div class="form-group row" id="local_id" @if(isset($episode_info->video_type) AND $episode_info->video_type!="Local") style="display:none;" @endif>
                    <label class="col-sm-3 col-form-label">{{trans('words.video_file')}} <small id="emailHelp" class="form-text text-muted">(Supported : MP4 or MKV)</small></label>
                    <div class="col-sm-8">
                      <div class="input-group">

                        <input type="text" name="video_url_local" id="video_url" value="{{ isset($episode_info->video_url) ? $episode_info->video_url : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#model_video_url">Select</button>
                      
                        </div>
                      </div>
                     
                    </div>
                  </div>

                  <div class="form-group row" id="url_id" @if(isset($episode_info->video_type) AND $episode_info->video_type!="URL") style="display:none;" @endif @if(!isset($episode_info->id)) style="display:none;" @endif>
                    <label class="col-sm-3 col-form-label">{{trans('words.video_url')}} <small id="emailHelp" class="form-text text-muted">(Supported : MP4 or MKV)</small></label>
                     <div class="col-sm-8">
                      <input type="text" name="video_url" value="{{ isset($episode_info->video_url) ? $episode_info->video_url : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row" id="embed_id" @if(isset($episode_info->video_type) AND $episode_info->video_type!="Embed") style="display:none;" @endif @if(!isset($episode_info->id)) style="display:none;" @endif>
                    <label class="col-sm-3 col-form-label">{{trans('words.video_embed_code')}}</label>
                     <div class="col-sm-8">
                       <textarea class="form-control" name="video_embed_code">{{ isset($episode_info->video_url) ? $episode_info->video_url : null }}</textarea>
                    </div>
                  </div>

                  <!--<div class="form-group row">
                    <label class="col-sm-3 col-form-label">Movie Poster</label>
                    <div class="col-sm-8">
                      <input type="file" name="video_image" class="form-control">
                    </div>
                  </div>-->

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.episode_poster')}}* <small id="emailHelp" class="form-text text-muted">({{trans('words.recommended_resolution')}} : 650x350)</small></label>
                    <div class="col-sm-8">
                      <div class="input-group">

                        <input type="text" name="video_image" id="video_image" value="{{ isset($episode_info->video_image) ? $episode_info->video_image : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#model_movie_poster">Select</button>
                      
                        </div>
                      </div>
                     
                    </div>
                  </div>

                  @if(isset($episode_info->video_image)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                                                                         
                           <img src="{{URL::to('upload/source/'.$episode_info->video_image)}}" alt="video image" class="img-thumbnail" width="250">                        
                       
                    </div>
                  </div>
                  @endif
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.status')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" @if(isset($episode_info->status) AND $episode_info->status==1) selected @endif>{{trans('words.active')}}</option>
                                <option value="0" @if(isset($episode_info->status) AND $episode_info->status==0) selected @endif>{{trans('words.inactive')}}</option>                            
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                     
                  </div>

                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> {{trans('words.save')}} </button>                      
                    </div>
                  </div>
                {!! Form::close() !!} 
              </div>
            </div>            
          </div>              
        </div>
      </div>
      @include("admin.copyright") 
    </div> 


<!--  Movie Video file -->
<div id="model_video_url" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 900px;">
        <div class="modal-content">             
            <div class="modal-body">
               <div class="iframe-container">
               <iframe src="{{URL::to('responsive_filemanager/filemanager/dialog.php?type=2&sort_by=date&field_id=video_url&relative_url=1')}}" frameborder="0"></iframe>
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
               <iframe src="{{URL::to('responsive_filemanager/filemanager/dialog.php?type=2&sort_by=date&field_id=video_image&relative_url=1')}}" frameborder="0"></iframe>
               </div>
            </div>
        </div> 
    </div> 
</div> 


@endsection