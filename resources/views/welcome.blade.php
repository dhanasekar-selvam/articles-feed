<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/w3.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3pro.css">


    <style>
        body {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 1000% 1000%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body>
    <!-- Used For Animation purpose -->
    <canvas id="c"> </canvas>

    <div class="w3-top w3-mobile">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
        <div class="w3-bar w3-card w3-container w3-text-white">
            <a href="{{route('user.index')}}" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-left w3-hover-indigo">TeachEdison Solutions Private Limited</a>

            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-blue" title="My Account">
                <img src="logo.png" style="height: 23px; width: 23px;" />
            </a> </div>
    </div>
    <div class="w3-top w3-mobile " id="navDemo">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
        <div class="w3-bar w3-card w3-container w3-text-white">
            <a href="{{route('user.index')}}" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-left w3-hover-indigo">TeachEdison Solutions Private Limited</a>

            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-blue" title="My Account">
                <img src="logo.png" style="height: 23px; width: 23px;" />
            </a> </div>
    </div>



    <div class="w3-display-middle w3-padding-large w3-card-4 w3-container w3-white w3-mobile">
        <form action="{{route('user.login')}}" method="get">
            <h2>Sign In</h2>
            @if($errors->any())
            {!! implode('', $errors->all('<div class="w3-red">:message</div>')) !!}
            @endif
            <input class="w3-mobile w3-input w3-border w3-round" type="text" name="login" placeholder="Email or Phone" style="width: 400px;" /><br />
            <input class="w3-mobile w3-input w3-border w3-round-large" type="password" name="password" placeholder="Password" style="width: 400px;" /><br />
            <button type="submit" class="w3-mobilew3-button w3-cyan w3-text-white w3-block">
                LOG IN
            </button><br>
            <p>To Create Account?<a href="{{route('user.create')}}" class="w3-mobile w3-text-blue">Signup</a></p>
            {{ csrf_field() }}

            <!-- <a href="#" class="w3-right">Forgot Your Password?</a> -->
        </form>
    </div>
    <script>
        // Used to toggle the menu on smaller screens when clicking on the menu button
        function openNav() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>
</body>

</html>