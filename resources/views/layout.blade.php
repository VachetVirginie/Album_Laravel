<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <style>
        body{
            padding-top: 50px;
        }
        #map{
            width: 100%;
            height: 500px;
            color:red;
       
        }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    

        @yield('content')

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDE24Sg4vYQzgP4y_Fq0fMw1iG_en6dgnU&signed_in=true&libraries=places"></script> 


        <script src="{{asset('js/jquery.geocomplete.js')}}"></script>

        <script> $('#address').geocomplete();</script>

        <script>

        </script>

        @if(Request::is('locations'))

            <script>
            var myLatLng = {lat: {{$points[0]->lat}}, lng: {{$points[0]->lng}}};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: myLatLng
                
                
            });

            @if($points)
                @foreach($points as $point)
                    var marker{{$point->id}} = new google.maps.Marker({
                        position: new google.maps.LatLng({{$point->lat}}, {{$point->lng}}),
                        map: map,
                        title: '{{$point->name}}'
                        
                    });
                    
                @endforeach
            @endif

            </script>

        @endif
    </body>
</html>