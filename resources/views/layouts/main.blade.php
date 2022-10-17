<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DevBlog - Julia Walker's Personal Blog</title>

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="{{asset('frontend/images/favicon.ico')}}" type="image/x-icon">
<!-- <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}"> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">


  <!--
    - custom css link
  -->
  <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
  <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
  
  <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
  <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">


  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="light-theme">

  <!--
    - #HEADER
  -->

  <header>

    <div class="container">

      <nav class="navbar">

        <a href="#">
          <img src="{{asset('frontend/images/logo-light.svg')}}" alt="Devblog's logo" width="150" class="logo-light">
          <img src="{{asset('frontend/images/logo-dark.svg')}}" alt="Devblog's logo" width="150" class="logo-dark">
        </a>

        <div class="btn-group">

          <button class="theme-btn theme-btn-mobile light">
            <ion-icon name="moon" class="moon"></ion-icon>
            <ion-icon name="sunny" class="sun"></ion-icon>
          </button>

          <button class="nav-menu-btn">
            <ion-icon name="menu-outline"></ion-icon>
          </button>

        </div>

        <div class="flex-wrapper">

          <ul class="desktop-nav">

          @php 
          $allMainMenu = App\Models\Menu::where('location','main')->where('status', 1)->get();
          @endphp
          @foreach($allMainMenu as $mainmenu)
            <li>
              <a href="{{$mainmenu->menu_url}}" class="nav-link">{{$mainmenu->menu_name}}</a>
            </li>
          @endforeach


                    @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                
                                    <img class="" src="{{ asset(Auth::user()->image) }}" alt="" style="width:40px; border-radius:50%">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
            <!--            
              <li>
                <a href="#" class="nav-link">About Me</a>
              </li>

              <li>
                <a href="#" class="nav-link">Contact</a>
              </li> 
            -->

          </ul>

          <button class="theme-btn theme-btn-desktop light">
            <ion-icon name="moon" class="moon"></ion-icon>
            <ion-icon name="sunny" class="sun"></ion-icon>
          </button>

        </div>

        <div class="mobile-nav">

          <button class="nav-close-btn">
            <ion-icon name="close-outline"></ion-icon>
          </button>

          <div class="wrapper">

            <p class="h3 nav-title">Main Menu</p>

            <ul>
            @php 
          $allMainMenu = App\Models\Menu::where('location','main')->where('status', 1)->get();
          @endphp
          @foreach($allMainMenu as $mainmenu)
            <li class="nav-item">
              <a href="{{$mainmenu->menu_url}}" class="nav-link">{{$mainmenu->menu_name}}</a>
            </li>
          @endforeach
              
            </ul>

          </div>

          <div>

            <p class="h3 nav-title">Topics</p>

            <ul>
              <li class="nav-item">
                <a href="#" class="nav-link">Database</a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">Accessibility</a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">Web Performance</a>
              </li>
            </ul>

          </div>

        </div>

      </nav>

    </div>

  </header>




@yield('content')





  <!--
    - #FOOTER
  -->

  <footer>

    <div class="container">

      <div class="wrapper">

        <a href="#" class="footer-logo">
          <img src="{{asset('frontend/images/logo-light.svg')}}" alt="DevBlog's Logo" width="150" class="logo-light">
          <img src="{{asset('frontend/images/logo-dark.svg')}}" alt="DevBlog's Logo" width="150" class="logo-dark">
        </a>

        <p class="footer-text">
          Learn about Web accessibility, Web performance, and Database management.
        </p>

      </div>

      <div class="wrapper">

        <p class="footer-title">Quick Links</p>

        <ul>

        @php 
        $foterfirstmenus = App\Models\Menu::where('location','footer1')->where('status',1)->get();
        $fotersecondmenus = App\Models\Menu::where('location','footer2')->where('status',1)->get();

        @endphp

        @foreach($foterfirstmenus as $foterfirstmenu)
        <li>
            <a href="{{$foterfirstmenu->menu_url}}" class="footer-link">{{$foterfirstmenu->menu_name}}</a>
          </li>
        @endforeach

          <!-- <li>
            <a href="#" class="footer-link">Advertise with us</a>
          </li>

          <li>
            <a href="#" class="footer-link">About Us</a>
          </li>

          <li>
            <a href="#" class="footer-link">Contact Us</a>
          </li> -->

        </ul>

      </div>

      <div class="wrapper">

        <p class="footer-title">Legal Stuff</p>

        <ul>

        @foreach($fotersecondmenus as $fotersecondmenu)
        <li>
            <a href="{{$fotersecondmenu->menu_url}}" class="footer-link">{{$fotersecondmenu->menu_name}}</a>
          </li>
        @endforeach

          <!-- <li>
            <a href="#" class="footer-link">Privacy Notice</a>
          </li>

          <li>
            <a href="#" class="footer-link">Cookie Policy</a>
          </li>

          <li>
            <a href="#" class="footer-link">Terms Of Use</a>
          </li> -->

        </ul>

      </div>

    </div>

    <p class="copyright">
      &copy; Copyright 2022 <a href="#">DevBlog</a>
    </p>

  </footer>




  
  <!--
    - custom js link
  -->
  <script src="{{asset('js/app.js')}}"></script>
  <script src="{{asset('frontend/js/script.js')}}"></script>
  
  <script src="{{asset('js/pusher.min.js')}}"></script>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  <!-- <script src="{{asset('js/toastr.js')}}"></script> -->
  <script src="{{asset('js/moment.min.js')}}"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script> -->

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>

function validateContact() {
    var valid = true;	
   
    if(!$("#subscribeemail").val()) {
        $("#email-info").html("(*Email fieldrequired)");
        $("#subscribeemail").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#subscribeemail").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
        $("#email-info").html("(invalid)");
        $("#subscribeemail").css('background-color','#FFFFDF');
        valid = false;
    }
    return valid;
}

function sendSubscription() {
    var valid;	
    valid = validateContact();
    if(valid) {
       var email=$("#subscribeemail").val();

        axios.post('/subscribe',{email:email}).then(function(response){

            console.log(response.data);
            if(response.data == 1){
                toastr.success('Subscription added successfull!!');
                $("#subscribeemail").val('');
            }

            if(response.data==0){
                toastr.warning('Already subscribed using this email!!');
                $("#subscribeemail").val('');
            }
           
        }).catch(function(error){

        })
    }
}


    $('#hashtag').click(function(){
      var id = $(this).data('id');
      console.log(id);
      // axios.post('/postByTag',{id:id}).then(function(response){
      axios.get('/postByTag/'+id).then(function(response){
          console.log(response.data);
      }).catch(function(error){

      })
    })
  </script>
  @yield('script')
</body>

</html>