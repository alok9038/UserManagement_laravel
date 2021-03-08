<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AGT || USER MANAGEMENT</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    @if(Request::url() == 'http://127.0.0.1:8000/user/profile')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    @endif
</head>
<body>
    <nav class="navbar navbar-expand-lg shadow-sm navbar-dark" style="background-color:#000;">
        <div class="container">
            <a href="{{ route('homepage') }}" class="navbar-brand">AGT USER MANAGEMENT</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link text-capitalize dropdown" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }} <i class="fa fa-angle-down ms-2"></i></a>
                    <ul class="dropdown-menu  rounded-0" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post" id="myFormName">
                                @csrf
                            </form>   
                            <a class="dropdown-item" href="#" onclick="document.forms['myFormName'].submit(); return false;"><i class="fa fa-power-off text-danger"></i> Logout</a> 
                        </li>
                      </ul>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')
    @if(Request::url() == 'http://127.0.0.1:8000/user/profile')
    <main>
        {{ $slot }}
    </main>  
    @endif
    
    @stack('modals')
    @livewireScripts
    <script>

        'use strict';

        ;( function ( document, window, index )
        {
            var inputs = document.querySelectorAll( '.inputfile' );
            Array.prototype.forEach.call( inputs, function( input )
            {
                var label	 = input.nextElementSibling,
                    labelVal = label.innerHTML;

                input.addEventListener( 'change', function( e )
                {
                    var fileName = '';
                    if( this.files && this.files.length > 1 )
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                    else
                        fileName = e.target.value.split( '\\' ).pop();

                    if( fileName )
                        label.querySelector( 'span' ).innerHTML = fileName;
                    else
                        label.innerHTML = labelVal;
                });

                // Firefox bug fix
                input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
                input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
            });
        }( document, window, 0 ));
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>