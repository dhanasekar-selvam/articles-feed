@extends('layout')

@section('content')


<!-- Middle Column -->



<div class="w3-container w3-card w3-white w3-round w3-margin ">
    <br />

    <form action="{{route('articles.update')}}" method="post">
        <!-- <input class="w3-mobile w3-input w3-border w3-round" type="text" name="name" value="{{$post->name}}" placeholder="Enter Article Name" style="width: 100%" /><br /> -->
        Article Name:<h5 class="w3-blue"><?php echo $post->name; ?></h5><br>
        Article Description:<br>
        <textarea class="w3-mobile w3-border-black" style="width: 100%;" name="description" cols="5" rows="4"><?php echo $post->description; ?></textarea><br /><br>

        <select id="catagory" name="catagory" style="width: 400px;" value="{{$post->catagory}}" class="w3-input w3-mobile w3-border w3-round-large">
            <option value="">Choose articles</option>
            <option value="Tech Articles" <?php echo ($post->catagory == 'Tech Articles') ? 'selected' : ''; ?>>Tech articles</option>
            <option value="Job Articles" <?php echo ($post->catagory == 'Job Articles') ? 'selected' : ''; ?>>Job articles</option>
            <option value="Game Articles" <?php echo ($post->catagory == 'Game Articles') ? 'selected' : ''; ?>>Game Articles</option>
            <option value="Education Articles" <?php echo ($post->catagory == 'Education Articles') ? 'selected' : ''; ?>>Education Articles</option>
        </select><br /><br />
        <br>
        <button type="submit" class="w3-button w3-cyan w3-mobile w3-text-white w3-block">
            <input type="hidden" name="id" value="<?php echo $post->id; ?>">

            Post Article </button><br>
        {{ csrf_field() }}

    </form>
</div>

<!-- End Middle Column -->
</div>

@endsection