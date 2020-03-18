@extends('site_app')

@section('head_title', $series_info->series_name.' | '.getcong('site_name') )

@section('head_description', Str::limit($series_info->series_info,160))

@section('head_image', URL::to('upload/source/'.$series_info->series_poster))

@section('head_url', Request::url())

@section('content')
  
 

 <div class="main-wrap">
  <div class="section section-padding vfx_video_single_section">
    <div class="container">
      <div class="series_episode">
    <div class="upcomming-featured">
      <img class="img-responsive" src="{{URL::to('upload/source/'.$series_info->series_poster)}}" alt="{{$series_info->series_name}}">
      <div class="play-icon-item">
        @if($series_latest_episode)
          
         @if(Auth::check())              
              <a class="icon" href="{{ URL::to('series/'.$series_info->series_slug.'/'.$series_latest_episode->video_slug.'/'.$series_latest_episode->id) }}">
          @else
             @if($series_latest_episode->video_access=='Paid')
              <a class="icon" href="Javascript::void();" data-toggle="modal" data-target="#loginAlertModal">
             @else
              <a class="icon" href="{{ URL::to('series/'.$series_info->series_slug.'/'.$series_latest_episode->video_slug.'/'.$series_latest_episode->id) }}">
             @endif  
          @endif   
            
          <i class="icon fa fa-play"></i><span class="ripple"></span>
        </a> 
        @else
          <a class="icon" href="">
          <i class="icon fa fa-play"></i><span class="ripple"></span>
        </a> 
        @endif
             
      </div>
      <div class="upcomming-details">
        <div class="col-md-6">
          @if($series_latest_episode)
          <h4 class="video-title">
            
            @if(Auth::check())              
              <a href="{{ URL::to('series/'.$series_info->series_slug.'/'.$series_latest_episode->video_slug.'/'.$series_latest_episode->id) }}">
            @else
             @if($series_latest_episode->video_access=='Paid')
              <a href="Javascript::void();" data-toggle="modal" data-target="#loginAlertModal">
             @else
              <a href="{{ URL::to('series/'.$series_info->series_slug.'/'.$series_latest_episode->video_slug.'/'.$series_latest_episode->id) }}">
             @endif  
          @endif  

              {{$series_info->series_name}}</a></h4>

          @else
          <h4 class="video-title"><a href="">{{$series_info->series_name}}</a></h4>
          @endif
          <ul class="channel_content_info">
            <li>{{\App\Series::getSeriesTotalSeason($series_info->id)}} Seasons</li>
            <li>{{\App\Series::getSeriesTotalEpisodes($series_info->id)}} Episodes</li>
            <li><a href="{{ URL::to('language/series/'.App\Language::getLanguageInfo($series_info->series_lang_id,'language_slug')) }}">{{\App\Language::getLanguageInfo($series_info->series_lang_id,'language_name')}}</a></li>
            @foreach(explode(',',$series_info->series_genres) as $genres_ids)
              <li><a href="{{ URL::to('genres/series/'.App\Genres::getGenresInfo($genres_ids,'genre_slug')) }}">{{App\Genres::getGenresInfo($genres_ids,'genre_name')}}</a></li>
            @endforeach
            </ul>
          <span>{{Str::limit($series_info->series_info,180)}}</span>
        </div>  
      </div>
    </div>
    </div>
    </div>
  </div>
  
  <div class="section section-padding top-padding-normal vfx_movie_section_block">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <div class="vfx_section_header">
            <h2 class="vfx_section_title">{{trans('words.seasons_text')}}</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="owl-carousel video-carousel" id="video-carousel">
          
          @foreach($season_list as $season_data)
          <a href="{{ URL::to('series/'.$series_info->series_slug.'/seasons/'.$season_data->season_slug.'/'.$season_data->id) }}">
          <div class="vfx_video_item">
            <div class="thumb-wrap vfx_upcomming_item_block"> 
              <img src="{{URL::to('upload/source/'.$season_data->season_poster)}}" alt="{{$season_data->season_name}}">                             
            </div>
            <div class="vfx_video_detail">
              <h4 class="vfx_video_title">{{Str::limit($season_data->season_name,25)}}</h4>
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