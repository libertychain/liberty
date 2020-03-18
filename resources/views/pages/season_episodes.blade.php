@extends('site_app')

@section('head_title', $series_name.' '.$season_info->season_name.' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
  
 
 <div class="main-wrap">
   
  <div class="section section-padding top-padding-normal vfx_movie_section_block">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <div class="vfx_section_header">
            <h2 class="vfx_section_title">{{$season_info->season_name}}</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="owl-carousel video-carousel" id="video-carousel">
          
          @foreach($episode_list as $episode_data)
          
          @if(Auth::check())              
              <a href="{{ URL::to('series/'.$series_slug.'/'.$episode_data->video_slug.'/'.$episode_data->id) }}">
          @else
             @if($episode_data->video_access=='Paid')
              <a class="icon" href="Javascript::void();" data-toggle="modal" data-target="#loginAlertModal">
             @else
              <a href="{{ URL::to('series/'.$series_slug.'/'.$episode_data->video_slug.'/'.$episode_data->id) }}">
             @endif  
          @endif  
          <div class="vfx_video_item">
            <div class="thumb-wrap vfx_upcomming_item_block"> 
              <img src="{{URL::to('upload/source/'.$episode_data->video_image)}}" alt="{{$episode_data->video_title}}">
              @if($episode_data->video_access=='Paid')<span class="premium_video"><i class="fa fa-lock"></i>Premium</span>@endif                             
            </div>
            <div class="vfx_video_detail">
              <h4 class="vfx_video_title">{{Str::limit($episode_data->video_title,25)}}</h4>
             </div>
          </div>
          </a>
          @endforeach
      
          
        </div>
      </div>
    </div>
  </div>
  
   
</div>
 

 
@endsection