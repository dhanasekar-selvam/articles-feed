<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/w3.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />

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
    <script src="animation.js"></script>


    <div class="w3-top">
        <div class="w3-bar w3-card w3-container w3-text-white w3-mobile">
            <a href="{{route('user.index')}}" class="w3-bar-itemw 3-mobile w3-button w3-padding-large w3-hide-small w3-left w3-hover-indigo">TeachEdison Solutions Private Limited</a>

            <a href="{{route('user.create')}}" class="w3-bar-item w3-mobile w3-button w3-padding-large w3-hide-small w3-right w3-hover-indigo">Register</a>
        </div>
    </div>
    <div class="w3-display-middle w3-padding-large w3-card-4 w3-mobile w3-container w3-white">
        @foreach($users as $user)
        <form action="{{route('user.store')}}" method="post">
            <h2>Sign Up</h2>
            @error('first_name')
            <div class="error w3-red">{{ $message }}</div>
            @enderror
            <input class="w3-input w3-border w3-round w3-mobile" type="text" placeholder="Enter First Name" name="first_name" style="width: 400px;" value="{{$user->first_name}}" /><br />
            @error('last_name')
            <div class="error w3-red">{{ $message }}</div>
            @enderror
            <input class="w3-input w3-border w3-round-large w3-mobile" type="text" placeholder="Enter Last Name" name="last_name" style="width: 400px;" value="{{$user->last_name}}" /><br />
            @error('dob')
            <div class="error w3-red">{{ $message }}</div>
            @enderror
            Date of Birth: <input class="w3-input w3-border w3-round-large w3-mobile" type="date" placeholder="Enter Date Of Birth" name="dob" style="width: 400px;" value="{{$user->dob}}" /><br />
            @error('mobile_number')
            <div class="error w3-red">{{ $message }}</div>
            @enderror
            <input class="w3-input w3-border w3-round-large w3-mobile" type="text" placeholder="Enter Mobile Number" name="mobile_number" style="width: 400px;" value="{{$user->mobile_number}}" /><br />
            @error('email')
            <div class="error w3-red">{{ $message }}</div>
            @enderror
            <input class="w3-input w3-border w3-round-large w3-mobile" type="text" placeholder="Enter Email" name="email" style="width: 400px;" value="{{$user->email}}" /><br />
            @error('password')
            <div class="error w3-red">{{ $message }}</div>
            @enderror
            <input class="w3-input w3-border w3-round-large w3-mobile" type="text" placeholder="Enter Password" name="password" style="width: 400px;" value="{{$user->password}}" /><br />
            @error('password_confirmation')
            <div class="error w3-red">{{ $message }}</div>
            @enderror
            <input class="w3-input w3-border w3-round-large w3-mobile" type="password" placeholder="Enter Confirm Password" name="password_confirmation" style="width: 400px;" /><br />
            @error('articles')
            <div class="error w3-red">{{ $message }}</div>
            @enderror
            <select id="articles" name="articles" style="width: 400px;" value="{{$user->article}}" class="w3-input w3-mobile w3-border w3-round-large">
                <option value="">Choose articles</option>
                <option value="Tech Articles" <?php echo ($user->article == 'Tech Articles') ? 'selected' : ''; ?>>Tech articles</option>
                <option value="Job Articles" <?php echo ($user->article == 'Job Articles') ? 'selected' : ''; ?>>Job articles</option>
                <option value="Game Articles" <?php echo ($user->article == 'Game Articles') ? 'selected' : ''; ?>>Game Articles</option>
                <option value="Education Articles" <?php echo ($user->article == 'Education Articles') ? 'selected' : ''; ?>>Education Articles</option>
            </select><br /><br />

            <input type="hidden" name="id" value="{{$user->id}}">

            <input type="submit" class="w3-button w3-mobile w3-cyan w3-text-white w3-block" value="Update">
            </input>
            {{ csrf_field() }}

        </form>

        @endforeach
        <form action="{{route('dashboard.list')}}">
            <button type="submit" class="w3-button w3-mobile w3-cyan w3-text-white w3-block">cancel</button>
        </form>
    </div>
</body>

</html>