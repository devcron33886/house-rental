<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('panel.site_title') }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Reggae+One&display=swap" rel="stylesheet">
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
            font-weight: 400;
            margin-left: 2em;

        }
        #footer{
            background-color: #f8e1c5;
        }
    </style>
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="" class="navbar-brand">
                    <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
                </a>
        
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('owners') }}" class="nav-link">Owners</a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">Properties</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact') }}}" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Blog</a>
                        </li>

                    </ul>
                </div>
        
              <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    @if (Route::has('login'))
                        @auth
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}" class="nav-link">Dashboard</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link ml-4">Register</a>
                            </li>
                            @endif
                        @endauth

                    @endif
                
            </ul>
        </nav>
    
 

        <div class="content-wrapper">
            <div class="content mt-5 pt-5" >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 text-center d-flex align-items-center justify-content-center">
                            <div class="">
                                <h2>{{ trans('panel.site_title') }}</strong></h2>
                                <p class="lead mb-5">123 Testing Ave, Testtown, 9876 NA<br>
                                Phone: +1 234 56789012
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form action="{{  route('contact') }}" method="post" class="card card-outline card-primary shadow-lg">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">Name</label>
                                        <input type="text" id="inputName" name="name" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="invalid-feedback">
                                                {{ $message }}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">E-Mail</label>
                                        <input type="email" id="inputEmail" name="email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSubject">Subject</label>
                                        <input type="text" name="subject" id="inputSubject" class="form-control @error('subject') is-invalid @enderror">
                                        @error('subject')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMessage">Message</label>
                                        <textarea id="inputMessage" name="message" class="form-control @error('message') is-invalid @enderror" rows="4"></textarea>
                                        @error('message')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Send message">
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
    
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
</div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>