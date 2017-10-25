@extends('layouts.index')
@section('title')
    {{trans('language_translate.title')}}
@stop
@section('content')
    <div id="content">
        <div class="desc">
            <div class="inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            @if(isset($data))
                            <div class="app">
                                <div class="heading">
                                    {{trans('language_translate.city')}}
                                </div>
                                <div class="main">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 temp">
                                                <i class="fa fa-thermometer-full" aria-hidden="true"></i>
                                                {{trans('language_translate.actual_temperature')}} : {{$data->temp}} &#186{{trans('language_translate.sign_temperature')}}
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 sunrise">
                                                <i class="fa fa-sun-o" aria-hidden="true"></i>
                                                {{trans('language_translate.sunrise')}}: {{date('H:i:s',$data->sunrise_at)}}
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 sunrise">
                                                <i class="fa fa-moon-o" aria-hidden="true"></i>
                                                {{trans('language_translate.sunset')}}: {{date('H:i:s',$data->sunset_at)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    {{trans('language_translate.last_date')}}: <span>{{date('H:i:s F d, Y', strtotime($data->created_at))}}</span>.
                                </div>
                            </div>
                            @else
                                {{trans('language_translate.no_data')}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection