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
                

                 {!! Form::open(array('url' => array('admin/series/add_edit_series'),'class'=>'form-horizontal','name'=>'series_form','id'=>'series_form','role'=>'form','enctype' => 'multipart/form-data')) !!}  
                  
                  <input type="hidden" name="id" value="{{ isset($series_info->id) ? $series_info->id : null }}">
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.language_text')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="language">
                                <option value="">{{trans('words.select_lang')}}</option>
                                @foreach($language_list as $language_data)
                                  <option value="{{$language_data->id}}" @if(isset($series_info->id) && $language_data->id==$series_info->series_lang_id) selected @endif>{{$language_data->language_name}}</option>
                                @endforeach
                            </select>
                      </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.genres_text')}}</label> 
                      <div class="col-sm-8">
                            <select name="series_genres[]" class="select2 select2-multiple" multiple="multiple" multiple name="movie_genre_id" data-placeholder="{{trans('words.select_genres')}}">
                                 @foreach($genre_list as $genre_data)
                                  <option value="{{$genre_data->id}}" @if(isset($series_info->id) && in_array($genre_data->id, explode(",",$series_info->series_genres))) selected @endif>{{$genre_data->genre_name}}</option>
                                @endforeach
                            </select>
                      </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.show_name')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="series_name" value="{{ isset($series_info->series_name) ? $series_info->series_name : null }}" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.show_sort_info')}}</label>
                    <div class="col-sm-8">
                       <textarea name="series_info" class="form-control">{{ isset($series_info->series_info) ? stripslashes($series_info->series_info) : null }}</textarea>
                    </div>
                  </div>
           
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.show_poster')}} <small id="emailHelp" class="form-text text-muted">({{trans('words.recommended_resolution')}} : 1200x500)</small></label>
                    <div class="col-sm-8">
                      <div class="input-group">

                        <input type="text" name="series_poster" id="series_poster" value="{{ isset($series_info->series_poster) ? $series_info->series_poster : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#model_poster">Select</button>
                      
                        </div>
                      </div>
                     
                    </div>
                  </div>

                  @if(isset($series_info->series_poster)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                                                                         
                           <img src="{{URL::to('upload/source/'.$series_info->series_poster)}}" alt="video image" class="img-thumbnail" width="250">                        
                       
                    </div>
                  </div>
                  @endif
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.status')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" @if(isset($series_info->status) AND $series_info->status==1) selected @endif>{{trans('words.active')}}</option>
                                <option value="0" @if(isset($series_info->status) AND $series_info->status==0) selected @endif>{{trans('words.inactive')}}</option>                            
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
 
<!--  Poster -->
<div id="model_poster" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 900px;">
        <div class="modal-content">             
            <div class="modal-body">
               <div class="iframe-container">
               <iframe src="{{URL::to('responsive_filemanager/filemanager/dialog.php?type=2&sort_by=date&field_id=series_poster&relative_url=1')}}" frameborder="0"></iframe>
               </div>
            </div>
        </div> 
    </div> 
</div> 


@endsection