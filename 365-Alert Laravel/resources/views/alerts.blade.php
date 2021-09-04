{{-- Extending the template --}}
@extends('layouts.mytemplate')

{{-- Setting the Page title --}}
@section('title', 'Alerts')

{{-- CSS Link --}}
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/alerts.css') }}">
@endsection

{{-- Main Content Section --}}
@section('content')
<section class="flood-map">
    <h1>Luxembourg Flood Map</h1>
    <article class="map">
        <img src="{{URL::asset('pictures/Map_Vector_Blue-01.PNG')}}" alt="">
    </article>
</section>
<section class="map_main_container" >
    <article class="map_details_container">
        <h2>Locations</h2>
        <ol>
            <li>Bigonville</li>
            <li>Bissen</li>
            <li>Bollendorf</li>
            <li>Diekirch</li>
            <li>Ettelbrück</li>
            <li>Ettelbrück</li>
            <li>Hesperange</li>
            <li>Hunnebuer</li>
            <li>Mersch</li>
            <li>Pfaffenthal</li>
            <li>Reichlange</li>
            <li>Stadtbredimus</li>
            <li>Steinsel</li>
        </ol>
    </article>
    <article class="level_description">
        <h3>Levels</h3>
        <ul>
            <li><div id="red_circle"></div>Extreme Danger</li>
            <li><div id="orange_circle"></div>Danger</li>
            <li><div id="yellow_circle"></div>Potential Danger</li>
            <li><div id="green_circle"></div>Low Danger</li>
            <li><div id="brown_circle"></div>Dry</li>
        </ul>
    </article>   
</section>
<h2 class="alerts_title">Alerts</h2>
<section>
    @foreach ($alerts as $alert)
    <article class="alert_container">
        <div class="extreme_danger_sidebar" id="sidebar_color"></div>
        <div class="extreme_danger_icon" id="alert_icon"></div>
        {{-- <img src="{{URL::asset('pictures/Alert_Warning_Red.svg')}}" alt=""> --}}
        <div class="alert">
            <h4 id="location">{{$alert->location}}</h4>
            <p id="alert_type">{{$alert->type}}</p>
            <p id="description">The flood alert is in {{$alert->description}} status.</p>
            <p id="river">River {{$alert->river}}</p>
            <p id="water_level">Water Level: {{$alert->water_level . " cm"}}</p>
            <p id="updated">{{$alert->updated_at}}</p>
            <a href="{{ route('add-alert', ['alert_id' => $alert->id]) }}">
                <button class="buttons_container" type="submit">Add To List</button>
            </a>
        </div>
    </article>
    @endforeach
</section>
@endsection

{{-- Footer Section --}}
@section('footer')

@endsection

{{-- Scripts links --}}
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer">
    </script>
    <script>
        $(function (){
            $('form').submit(function(e) {
                e.preventDefault();

                // AJAX call
                $.ajax({
                    url: 'AlertsController.php',
                    method: 'post',
                    data: $("form").serialize(),
                    dataType: 'json'
                })

                .done(function(result){
                    console.log(result);
                })
                .fail(function(result) {
                        console.log('AJAX FAILED');
                })
            })
        })
    </script>
@endsection
