<?php
use App\Settings;
use App\Pages;
use App\Transactions;
use App\Episodes;
use App\Movies;
use App\Sports;
use App\RecentlyWatched; 


if (! function_exists('recently_watched_info')) {

    function recently_watched_info($video_type,$video_id)
    {
        if($video_type=="Movies")
        {
            $recently_info = Movies::where('id',$video_id)->first();
        } 
        else if($video_type=="Sports")
        {
            $recently_info = Sports::where('id',$video_id)->first();
        }
        else
        {
            $recently_info = Episodes::where('id',$video_id)->first();
        }
        

        return $recently_info;
    }
}

if (! function_exists('putPermanentEnv')) {

 function putPermanentEnv($key, $value)
{
    $path = app()->environmentFilePath();

    $escaped = preg_quote('='.env($key), '/');

    file_put_contents($path, preg_replace(
        "/^{$key}{$escaped}/m",
        "{$key}={$value}",
        file_get_contents($path)
    ));
}

}

if (! function_exists('getcong')) {

    function getcong($key)
    {
    	 
        $settings = Settings::findOrFail('1'); 

        return $settings->$key;
    }
}
 

if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        $path = explode('.', $path);
        $segment = 2;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active';
    }
}

if (!function_exists('classActivePathSub')) {
    function classActivePathSub($path)
    {
        $path = explode('.', $path);
        $segment = 2;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' subdrop';
    }
}

if (!function_exists('classActivePathSub_Style')) {
    function classActivePathSub_Style($path)
    {
        $path = explode('.', $path);
        $segment = 2;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return 'display: block;';
    }
}

if (!function_exists('classActivePathSite')) {
    function classActivePathSite($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return 'active';
    }
}

if (!function_exists('generate_timezone_list')) {
function generate_timezone_list()
{
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );

    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    ksort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate( 'H:i', abs($offset) );

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

        $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
    }

    return $timezone_list;
}

} 

if (!function_exists('plan_count_by_month')) {
    function plan_count_by_month($plan_id,$month_name)
    {       
            //echo $month_name;

             $start_month = date('Y-m-d', strtotime('first day of '.$month_name.''));
             $finish_month = date('Y-m-d', strtotime('last day of '.$month_name.''));
             
            $monthly_plan_purchase = Transactions::where('plan_id',$plan_id)->whereBetween('date', array(strtotime($start_month), strtotime($finish_month)))->count();

            return $monthly_plan_purchase;
    }
}

if (! function_exists('check_verify_purchase')) {

    function check_verify_purchase()
    {

        if(env('BUYER_NAME')!='' AND env('BUYER_PURCHASE_CODE')!='')
        {
            return true;
        }
        else
        {
            \Redirect::to('admin/verify_purchase')->send();
            //return redirect()->route('verify_purchase');
            exit;
        }

         
    }
}

if (! function_exists('verify_envato_purchase_code')) {
function verify_envato_purchase_code($product_code)
    { 
      
        $url = "https://api.envato.com/v3/market/author/sale?code=".$product_code;
        $curl = curl_init($url);


        $personal_token = "M8tF6z8lzZBBkmZt4xm3dU4lw7Rlbrwp";
        $header = array();
        $header[] = 'Authorization: Bearer '.$personal_token;
        $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
        $header[] = 'timeout: 20';
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);

        $envatoRes = curl_exec($curl);
        curl_close($curl);
        $envatoRes = json_decode($envatoRes);
         

         return $envatoRes;
      
    }
}