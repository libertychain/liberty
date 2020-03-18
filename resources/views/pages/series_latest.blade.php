@extends('site_app')

@section('head_title', trans('words.latest_shows').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')


<div class="page-header">
  <div class="vfx_page_header_overlay">
    <div class="container">
      <div class="vfx_breadcrumb">
      <ul>
      <li><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
      <li>{{trans('words.latest_shows')}}</li>
      </ul>  
    </div>
    </div>
  </div>
</div>

 <div class="main-wrap">
  <div class="section section-padding tv_show vfx_video_list_section text-white">
    <div class="container">
      <div class="row">
        <div class="show-listing series_listing_view">
      
        @foreach(explode(",",$home_sections->section2_latest_series) as $latest_series)            
          @if(App\Series::getSeriesInfo($latest_series,'status')==1)


            <a href="{{ URL::to('series/'.App\Series::getSeriesInfo($latest_series,'series_slug').'/'.App\Series::getSeriesInfo($latest_series,'id')) }}">
            <div class="col-md-3 col-sm-4 col-xs-6 sm-top-30">
            <div class="vfx_upcomming_item_block"> 
              <img class="img-responsive" src="{{URL::to('upload/source/'.App\Series::getSeriesInfo($latest_series,'series_poster'))}}" alt="show"> 
                <div class="vfx_upcomming_detail">
                  <h4 class="vfx_video_title">{{Str::limit(App\Series::getSeriesInfo($latest_series,'series_name'),25) }}</h4>
                 </div>            
             </div>                  
           </div>
           </a>  
          @endif
        @endforeach             
          
        </div>    
      </div>
    </div>
  </div>
</div>

 
@endsection