<?php
$email = Session::get('username');
$mobile = Session::get('mobile');
$article = Session::get('article');
$username = Session::get('name');
$id = Session::get('id');
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
        font-family: "Open Sans", sans-serif;
    }
</style>

<body class="w3-theme-l5">
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-blue w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
            <a href="{{route('articles.logout')}}" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-home w3-margin-right"></i>Home</a>
            <a href="{{route('articles.list')}}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"><i class="fa fa-snowflake-o">All Articles</i></a>
            <a href="{{route('articles.create')}}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"><i class="fa fa-plus">Create Articles</i></a>
            <a href="{{route('articles.view')}}" class=" w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" \><i class="fa fa-eye">View My Articles</i></a>
            <a href="{{route('articles.edit')}}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"><i class="fa fa-pencil">Edit Articles</i></a>


            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
                <img src="logo.png" alt="LOGO" style="height: 23px; width: 23px;" />
            </a>
            <a href="{{route('articles.logout')}}" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white"><i class="fa fa-sign-out">Log out</i></a>

        </div>
    </div>

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="{{route('articles.create')}}" class="w3-bar-item w3-button w3-padding-large">Create Articles</a>
        <a href="{{route('articles.create')}}" class="w3-bar-item w3-button w3-padding-large fa-fa-plus">Create Articles</a>
        <a href="{{route('articles.view')}}" class="w3-bar-item w3-button w3-padding-large fa-fa-eye">View Articles</a>
        <a href="{{route('articles.edit')}}" class="w3-bar-item w3-button w3-padding-large fa-fa-pencil">Edit Articles</a>
        <a href="{{route('articles.logout')}}" class="w3-bar-item w3-button w3-padding-large fa-fa-pencil">Log out</a>

    </div>


    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width: 1400px; margin-top: 80px;">
        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3">
                <!-- Profile -->
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container">
                        <form action="{{route('user.edit')}}" method="post">
                            <h4 class="w3-center">My Profile</h4>
                            <p class="w3-center">
                                <img src="profile.jpg" class="w3-circle" alt="PROFILE" style="height: 106px; width: 106px;" />
                            </p>
                            <hr />
                            <p>
                                <h3> <i class="fa fa-male fa-fw w3-margin-right w3-text-green"><?php echo $username; ?></i> </h3>
                            </p>

                            <p>
                                Email: <i class="fa fa-envelope fa-fw w3-margin-right w3-text-black"><?php echo $email; ?></i> </p>
                            <p>
                                Mobile: <i class="fa fa-mobile fa-fw w3-margin-right w3-text-theme"><?php echo $mobile; ?></i>
                            </p>
                            <p>
                                Interest Articles: <i class="fa fa-search fa-fw w3-margin-right w3-text-theme"><?php echo $article; ?></i>
                            </p>

                            <input type="hidden" name="idd" value="<?php echo $id; ?>">
                            <input type="submit" class="w3-button w3-block w3-theme-l4" value="Edit Profile"><br>
                            {{ csrf_field() }}

                        </form>

                    </div>
                </div>
                <br />


                <!-- End Left Column -->
            </div>
            <div class="w3-col m7">
                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-padding">
                                <h6> <i class="w3-text-blue">welcome <?php echo Session::get('name'); ?>!!</i></h6>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')

                <!-- Right Column -->
                <div class="w3-col m2">
                    <div class="w3-card w3-round w3-white w3-center">
                        <div class="w3-container">
                            <p>Articles</p>
                            <img src="article.jpg" alt="Forest" style="width: 100%;" />
                            <p><strong> Articles</strong></p>

                            <span class="w3-tag w3-small w3-theme-d5">Game</span>
                            <span class="w3-tag w3-small w3-theme-d3">tech</span>
                            <span class="w3-tag w3-small w3-theme-d2">job</span>
                            <span class="w3-tag w3-small w3-theme-d1">Education</span>
                            <span class="w3-tag w3-small w3-theme-l1">Friends</span>
                            <span class="w3-tag w3-small w3-theme-l2">Food</span>
                            <span class="w3-tag w3-small w3-theme-l3">Design</span>
                            <span class="w3-tag w3-small w3-theme-l4">Art</span>
                            <span class="w3-tag w3-small w3-theme-l5">Photos</span>
                            <p> </p>

                            <!-- <p>
                            <button class="w3-button w3-block w3-theme-l4">Edit</button>
                        </p> -->
                        </div>
                    </div>
                    <br />
                    <!-- <div class="w3-card w3-round w3-white w3-center">
                        <form action="{{route('articles.like')}}" method="post">
                            <div class="w3-container"><br>
                                <span>Articles You Have Liked </span>
                                <div class="w3-row w3-opacity"><br>
                                    <input type="hidden" name="idd" value="<?php echo $email; ?>">
                                    <button type="submit" class="w3-button w3-block w3-green">Click Here</button>

                                    <div class="w3-half">
                                        <br>

                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{ csrf_field() }}

                        </form>
                    </div> -->

                    <!-- End Right Column -->
                </div>

                <!-- End Grid -->
            </div>

            <!-- End Page Container -->
        </div>
        <br />



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