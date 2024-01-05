<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NewsApp - Register</title>
    <link rel="shortcut icon" href="{{ settings('favicon') ? asset(settings('favicon')) : Vite::asset(\App\Library\Enum::NO_IMAGE_PATH) }}">


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <!--Stylesheet-->
    <style media="screen">
        *,
        *:before,
        *:after{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-position: center;
            background-repeat: no-repeat;
            background: url( {{ Vite::asset(\App\Library\Enum::LOGIN_BACKGROUND_PATH) }} )no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body:before {
            content: " ";
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: -1;
            top: 0;
            left: 0;
            background: -webkit-radial-gradient(top center, ellipse cover, rgb(255 255 255 / 10%) 0%,rgb(69 90 70 / 50%) 100%);
        }
        .background{
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%,-50%);
            left: 50%;
            top: 50%;
        }
        form{
            height: auto;
            width: 400px;
            background-color: rgb(255 255 255 / 52%);
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 5px solid rgb(23 158 23 / 90%);
            box-shadow: 0 0 139px rgb(11 190 25 / 61%);
            padding: 10px 35px;
        }
        form *{
            font-family: 'Poppins',sans-serif;
            color: black;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }
        form h3{
            font-size: 30px;
            font-weight: 700;
            line-height: 25px;
            text-align: center;
            color: #409a40;
        }

        label{
            display: block;
            margin-top: 16px;
            font-size: 11px;
            font-weight: 500;
        }
        input{
            display: block;
            height: 25px;
            width: 100%;
            background-color: rgb(86 98 80 / 42%);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 10px;
            font-weight: 300;
        }
        ::placeholder{
            color: #e5e5e5;
        }
        button{
            margin-top: 10px;
            width: 100%;
            background-color: #cce0e1;
            color: black;
            padding: 4px 0;
            font-size: 12px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover{
            background-color: rgba(255,255,255,0.47);
        }
        button > a{
            text-decoration: none;
        }
        .social{
            margin-top: 30px;
            display: flex;
        }
        .social div{
            background: red;
            width: 100%;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255,255,255,0.27);
            color: #eaf0fb;
            text-align: center;
        }
        .social div:hover{
            background-color: rgba(255,255,255,0.47);
        }
        .danger{
            color: #e71313;
            font-weight: 400;
            font-size: 13px;
        }
        .is-invalid{
            border: 1px solid red;
        }
        .show-pass{
            float: right;
            color: black;
            z-index: 9999;
            margin: -20px 4px 0px 0px;
        }
        header {
	    width: 220px;
	    margin: auto;
	  }
      header img {
        max-width: 60%;
      }
    </style>

</head>
<body>
<div id="app">

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <header>
            <img src="{{ Vite::asset(\App\Library\Enum::LOGO_PATH) }}">
        </header>
        <h3>{{ __('Register') }}</h3>

        <div class="forFirstName">
            <label for="first_name">{{ __('First Name') }}</label>
            <input type="text" class="@error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="First Name">

            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong class="danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="forLastName">
            <label for="last_name">{{ __('Last Name') }}</label>
            <input type="text" class="@error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Last Name">

            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong class="danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="forPhone">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="text" class="@error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Phone">

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong class="danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="forEmail">
            <label for="email">{{ __('Email Address') }}</label>
            <input type="email" class="@error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong class="danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="forPassword">
            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <i class="fas fa-eye show-pass" id="show_pass"></i>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong class="danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
        <button type="button" class="btn btn-success" >
            <a href="{{route('login')}}"> {{ __('Login') }}</a>
        </button>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        $("#show_pass").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#password").attr("type", type);
        });
    });
</script>
</body>
</html>
