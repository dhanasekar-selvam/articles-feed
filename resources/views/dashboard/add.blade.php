@extends('layout')

@section('content')

<!-- <script>
    window.onload = function() {
        document.getElementById("yes").style.display = "none";
    };

    function yes() {
        document.getElementById("yes").style.display = "block";
        document.getElementById("afteryes").style.display = "none";

    }

    function cancel() {
        document.getElementById("yes").style.display = "none";
        document.getElementById("afteryes").style.display = "block";

    }
    // Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script> -->
<!-- Middle Column -->
<div class="w3-col m7">
    <div class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                    <h6> <i class="w3-text-green">Create <?php echo Session::get('name'); ?>!!</i></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="w3-container w3-card w3-white w3-round w3-margin ">
        <br />

        <form action="{{route('dashboard.store')}}" method="post">
            <input class="w3-input w3-border w3-round w3-mobile" type="text" name="name" placeholder="Enter Article Name" style="width: 100%" /><br />
            Article Description:<br>
            <textarea class="w3-mobile w3-border-black" style="width: 100%;" name="description" cols="5" rows="4"></textarea><br /><br>
            <!-- <input
              class="w3-input w3-border w3-round"
              type="text"
              placeholder="Enter tags"
              style="width: 100%"
            /><br /> -->
            <select id="catagory" name="catagory" style="width: 400px;" class="w3-input w3-mobile w3-border w3-round-large">
                <option value="">Choose articles catagory</option>
                <option value="Tech Articles">Tech articles</option>
                <option value="Job Articles">Job articles</option>
                <option value="Game Articles">Game Articles</option>
                <option value="Education Articles">Education Articles</option>
            </select><br /><br />
            <!-- <div id="yes">
                Upload Image:
                <input type="file" name="fileToUpload" id="fileToUpload" />

                <a onclick="cancel()" class="w3-button w3-blue">Cancel</a>

            </div>
            <span id="afteryes">To Upload Image

                <a onclick="yes()" class="w3-button w3-blue">Click here</a>

            </span><br><br> --><br>
            <button type="submit" class="w3-button w3-cyan w3-text-white w3-block">
                Post Article </button><br>
            {{ csrf_field() }}

        </form>
    </div>

    <!-- End Middle Column -->
</div>

@endsection