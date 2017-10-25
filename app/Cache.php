<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cache extends Model
{
    public $timestamps = false;

    protected $table = "cache";

    protected $fillable = [
        'weather',
        'temp',
        'created_at',
        'sunrise_at',
        'sunset_at'
    ];

    /**
     * take last record from db
     * @return Model|null|static
     */
    private function takeLastFromDB()
    {
        return self::orderBy('created_at','DESC')->first();
    }

    /**
     * making request to api with weather_map by curl
     * @return Cache
     */
    public function askApiAboutWeather()
    {
        $url = 'api.openweathermap.org/data/2.5/weather?id=7531926&APPID='.env('OPEN_WEATHER_MAP_KEY') .'&units=metric';
        //init curl
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        $resp = curl_exec($curl);
        //show errors if something.
        if(!curl_exec($curl)){
            die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }
        // we want to take only actual temperature so we are taking from json take only actual temp and save it to db
        $details = json_decode($resp);
        $temperature = $details->main->temp;
        $cacheWeather = new Cache();
        $cacheWeather->temp = $temperature;
        $cacheWeather->sunrise_at = $details->sys->sunrise;
        $cacheWeather->sunset_at = $details->sys->sunset;
        $cacheWeather->save();
        // close curl
        curl_close($curl);
        return $cacheWeather;
    }

    /**
     * showing info about last record in db from api
     * if record is older then 1 hour then delete it and call for new one to api
     * @return Cache|Model|null
     */
    public function showInfo()
    {
        $lastRecord = $this->takeLastFromDB();
        //if is in db some data take it
        if($lastRecord){
            // if last info about weather is older then 1 hour then take info about it from api
            if(strtotime($lastRecord->created_at) <= strtotime('-1 hours')){
                //delete latest record and make api call to take new one
                $lastRecord->delete();
                return $this->askApiAboutWeather();
            //else return inf about current weather from DB
            }else{
                return $lastRecord;
            }
        //else make api call
        }else{
            return $this->askApiAboutWeather();
        }
    }


}
