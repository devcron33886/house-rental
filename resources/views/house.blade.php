<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('panel.site_title') }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Reggae+One&display=swap" rel="stylesheet">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body{
            background-color: rgb(240, 237, 240);
            font-family: 'PT Sans', sans-serif;
        }
        .navbar-brand{
            margin-left: 2.5rem;
            max-height: 15em;
            max-width:100%;
            font-family: 'Reggae One', cursive;
            font-weight: bold;
            font-size: 25px;
        }

        .navbar-nav{
            margin-left: 7em;
        }
        .nav-link{
            font-size: 18px;
            font-weight: 600;
            margin-left: 2em;
            color: aquamarine;
        }
        #footer{
        border-radius: 0px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a class="navbar-brand" href="/">{{ trans('panel.site_title') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Houses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('owners') }}" >Owners</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" >Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" >Blog</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ml-2">
                <a href="{{ route('login') }}" class="nav-link">{{ trans('global.login') }}</a>
            </li>
            <li class="nav-item ml-2">
                <a href="{{  route('register') }}" class="nav-link">{{ trans('global.register') }}</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container col-lg-11 mt-2 bg-light">
    <div class="row justify-content-center">
        <form class="col-md-12 form-inline mt-5" action="{{ route('welcome') }}" method="get">

                <select class="form-control col-4" style="border-radius: 0px;">
                    <option selected>--Choose Category ---</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"{{ old('category', request()->input('category')) == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <input class="form-control col-4 ml-2" name="search" value="{{ old('search', request()->input('search')) }}" placeholder="Ex: NYARUGENGE MUHIMA" style="border-radius: 0px;">
                <button class="btn btn-flat btn-primary ml-2"><i class="fas fa-search"></i> Search</button>
        </form>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-sm-6">
            <div class="col-12">
                @if($house->cover_photo)
                    <img src="{{ $house->cover_photo->getUrl('preview') }}" class="product-image" alt="Product Image">
                @endif
            </div>
            <div class="col-12 product-image-thumbs">
                @foreach($house->photos as $key => $media)
                <div class="product-image-thumb">
                    <img src="{{ $media->getUrl('preview') }}" alt="Product Image">
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="card card-widget widget-user-2 mt-2">
                <div class="card-header"><h5 class="text-center">HOUSE DETAILS</h5></div>
                <div class="card-body">
                    <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Price</b> <a class="float-right">{{ $house->price }}
                            @if ($house->currency==0)
                                RWF
                            @else
                                USD
                            @endif/
                            @if($house->payment_time==0)
                                Month
                            @elseif($house->payment_time==1)
                                Year
                            @elseif($house->payment_time==2)
                                Week
                            @elseif($house->payment_time==3)
                                Day
                            @elseif($house->payment_time==4)
                                Night
                            @endif

                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>Price status</b>
                        <p class="float-right">
                            @if($house->price_status==0)
                                <button class="btn btn-success">Negotiable</button>
                            @else
                                Not negotiable
                            @endif
                        </p>
                    </li>
                      <li class="list-group-item">
                        <b>Number of rooms</b> <a class="float-right">{{ $house->bedrooms }}</a>
                      </li>
                  <li class="list-group-item">
                    <b>Number of Bathrooms</b> <a class="float-right">{{ $house->bathrooms }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Number of Floors</b> <a class="float-right">{{ $house->floors }}</a>
                  </li>
                    <li class="list-group-item">
                        <b>House Address</b> <a class="float-right">{{ $house->address }}</a>
                    </li>


                </ul>
                </div>
            </div>

            <div class="card card-outline card-info">
                <div class="card-header"><h4>REQUEST HOUSE</h4></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('booking') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" name="house_id" value="{{ $house->id }}">
                        <div class="form-group">
                            <label for="names">Enter your names</label>
                            <input type="text" name="names" class="form-control @error('names') is-invalid @enderror" value="{{ old('names') }}" placeholder="Ex: John Smith">
                            @error('names')
                                <span class="invalid-feedback">
                                    {{  $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Ex:john@mail.com" value="{{ old('email')}}">
                            <span class="invalid-feedback">
                            @error('email')
                                {{ $message }}
                            @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile')}}" placeholder="Ex: +250 xxx xxx xxx">
                        </div>
                        <input type="hidden" class="form-control" name="created_by" value="{{ $house->created_by }}">
                        <hr>
                        <button class="btn btn-primary btn-flat float-lg-right" type="submit"><i class="fas fa-save"></i> Send</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="row mt-4">
        <div class="card col-md-12 card-primary card-outline" style="border-radius: 0px;">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#description" data-toggle="tab">Description</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#infrastructure" data-toggle="tab"><i class="fas fa-road"></i> Infrastructure</a></li>
                        <li class="nav-item"><a class="nav-link" href="#map" data-toggle="tab"><i class="fas fa-globe"></i> Map</a></li>
                        <li class="nav-item"><a class="nav-link" href="#working-hours" data-toggle="tab"><i class="fas fa-clock"></i> Infrastructure Working Hours</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane" id="description">
                            {{ $house->description }}
                        </div>

                        <div class="tab-pane active" id="infrastructure">

                                <ul class="list-group list-group-unbordered mb-3">
                                    @foreach ($house->infrastructures as $key =>$infrastructure)
                                        <li class="list-group-item">
                                            <b>{{ $infrastructure->name }}</b>
                                            @if($infrastructure->days->count())

                                                <p class="float-right text-success">{{ $infrastructure->working_hours->isOpen() ? 'Opened' : 'Closed' }} now</p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>

                        </div>

                        <div class="tab-pane" id="map">
                            @if($house->latitude && $house->longitude)
                                <div id="map-canvas" style="height: 425px; width: 100%; position: relative; overflow: hidden;">
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane" id="working-hours">
                            @foreach ($house->infrastructures as $key =>$infrastructure)
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ $infrastructure->name }}
                                        
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        @foreach($infrastructure->days as $day)
                                        <p>{{ ucfirst($day->name) }}: from {{ $day->pivot->from_hours }}:{{ $day->pivot->from_minutes }} to {{ $day->pivot->to_hours }}:{{ $day->pivot->to_minutes }}</p>
                                        
                                        @endforeach
                                        <hr>
                                    </div>
                                    
                                </div> 
                            @endforeach
                            
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
    </div>
<div class="container col-lg-11 jumbotron" id="footer">
    <h6 class="text-center display-4">Subscribe</h6>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="" method="POST">
                @csrf
                <div class="input-group">
                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Type your email">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fab fa-telegram-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
            <p class="pt-3"> Please subscibe for latest updates and free tips of how to get the property you need</p>
        </div>

    </div>
    <hr>
    <div class="row mt-5 pt-5">
        <div class="col-4">
            <h4 class="text-center">About Us</h4>
                <p class="text-center text-bold">This is the application that helps you to get the best property in the right area without passing through the commisioners.</p>
        </div>
        <div class="col-4">
            <h4 class="text-center">Contact</h4>
        </div>
        <div class="col-4">
            <h4 class="text-center">Follow</h4>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function () {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>
@if($house->latitude && $house->longitude)
    <script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'></script>
    <script defer>
        function initialize() {
            var latLng = new google.maps.LatLng({{ $house->latitude }}, {{ $house->longitude }});
            var mapOptions = {
                zoom: 14,
                minZoom: 6,
                maxZoom: 17,
                zoomControl:true,
                zoomControlOptions: {
                    style:google.maps.ZoomControlStyle.DEFAULT
                },
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                panControl:false,
                mapTypeControl:false,
                scaleControl:false,
                overviewMapControl:false,
                rotateControl:false
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var image = new google.maps.MarkerImage("{{ asset('images/pin.png') }}", null, null, null, new google.maps.Size(40,52));

            var content = `
                    <div class="card" style="border-radius: 0em; box-shadow: #0E1112; ">
                        @if($house->cover_photo)
                            <a href="/house/{{  $house->id }}">
                                <img class="card-img-top" src="{{ $house->cover_photo->getUrl('preview') }}" alt="House_picture" style="height:480px; width:480px;border-radius: 0px; border-color: #ffffff;">
                            </a>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <h4 class="card-title text-center">{{ $house->title }}</h4>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    {{ $house->bedrooms }} <i class="fas fa-bed"></i>
                                </div>
                                <div class="col-sm-4">
                                    {{ $house->bathrooms }} <i class="fas fa-shower"></i>
                                </div>
                                <div class="col-sm-4">
                                    {{ $house->floors }} <i class="fas fa-laptop-house"></i>
                                </div>
                             </div>
                         </div>
                        </div>
                    `;
            var marker = new google.maps.Marker({
                position: latLng,
                icon:image,
                map: map,
                title: '{{ $house->title }}'
            });
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker, 'click', (function (marker) {
                return function () {
                    infowindow.setContent(content)
                    infowindow.open(map, marker);
                }
            })(marker));
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endif
</body>
</html>


