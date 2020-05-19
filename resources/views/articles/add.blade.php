@extends('layout')

@section('content')


<!-- Middle Column -->


<div class="w3-container w3-card w3-white w3-round w3-margin ">
    <br />

    <form action="{{route('articles.store')}}" method="post">
        @error('field_name')
        <div class="error w3-red">{{ $message }}</div>
        @enderror
        <input class="w3-input w3-border w3-round w3-mobile" type="text" name="name" placeholder="Enter Article Name" style="width: 100%" /><br />
        Article Description:<br>
        <textarea class="w3-mobile w3-border-black" style="width: 100%;" name="description" cols="5" rows="4"></textarea><br /><br>

        <select id="catagory" name="catagory" style="width: 400px;" class="w3-input w3-mobile w3-border w3-round-large">
            <option value="">Choose articles catagory</option>
            <option value="Tech Articles">Tech articles</option>
            <option value="Job Articles">Job articles</option>
            <option value="Game Articles">Game Articles</option>
            <option value="Education Articles">Education Articles</option>
        </select><br /><br />
        <br>
        <button type="submit" class="w3-button w3-cyan w3-text-white w3-block">
            Post Article </button><br>
        {{ csrf_field() }}

    </form>
</div>

<!-- End Middle Column -->
</div>

@endsection