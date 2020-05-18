@extends('layout')

@section('content')


<!-- Middle Column -->
<div class="w3-col m7">
    <div class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                    <h6> <i class="w3-text-red w3-mobile">Edit <?php echo Session::get('name'); ?>!!</i></h6>
                </div>
            </div>
        </div>
    </div>


    <div class="w3-container w3-card w3-white w3-round w3-margin ">
        <br />
        @foreach ($posts as $post)

        <form action="{{route('dashboard.store')}}" method="post">
            <input class="w3-mobile w3-input w3-border w3-round" type="text" name="name" value="{{$post->name}}" placeholder="Enter Article Name" style="width: 100%" /><br />
            Article Description:<br>
            <textarea class="w3-mobile w3-border-black" style="width: 100%;" name="description" cols="5" rows="4"><?php echo $post->description; ?></textarea><br /><br>
            <!-- <input
              class="w3-input w3-border w3-round"
              type="text"
              placeholder="Enter tags"
              style="width: 100%"
            /><br /> -->
            <select id="catagory" name="catagory" style="width: 400px;" value="{{$post->catagory}}" class="w3-input w3-mobile w3-border w3-round-large">
                <option value="">Choose articles</option>
                <option value="Tech Articles" <?php echo ($post->catagory == 'Tech Articles') ? 'selected' : ''; ?>>Tech articles</option>
                <option value="Job Articles" <?php echo ($post->catagory == 'Job Articles') ? 'selected' : ''; ?>>Job articles</option>
                <option value="Game Articles" <?php echo ($post->catagory == 'Game Articles') ? 'selected' : ''; ?>>Game Articles</option>
                <option value="Education Articles" <?php echo ($post->catagory == 'Education Articles') ? 'selected' : ''; ?>>Education Articles</option>
            </select><br /><br />
            <!-- <div id="yes">
                Upload Image:
                <input type="file" name="fileToUpload" id="fileToUpload" />

                <a onclick="cancel()" class="w3-button w3-blue">Cancel</a>

            </div>
            <span id="afteryes">To Upload Image

                <a onclick="yes()" class="w3-button w3-blue">Click here</a>

            </span><br><br> --><br>
            <button type="submit" class="w3-button w3-cyan w3-mobile w3-text-white w3-block">
                <input type="hidden" name="id" value="<?php echo $post->id; ?>">

                Post Article </button><br>
            {{ csrf_field() }}

        </form>
        @endforeach
    </div>

    <!-- End Middle Column -->
</div>

@endsection