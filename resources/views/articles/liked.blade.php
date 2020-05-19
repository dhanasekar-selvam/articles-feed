@extends('layout')

@section('content')


<!-- Middle Column -->


@foreach ($posts as $post)

<div class="w3-container w3-card w3-white w3-round w3-margin">
    <br />

    <span class="w3-right w3-opacity">{{$post->created_at}}</span>
    <h4>{{ $post->name }}</h4>
    <br />
    <!-- <hr class="w3-clear" /> -->
    <p>
        {{ $post->description }}

    </p>
    <p class="w3-text-blue">{{ $post->catagory }}</p>
    </h4>

    <p>
        <form action="{{route('user.like')}}" method="post" style="display: inline-block; ">
            <input type="hidden" name="id" value="{{$post->id}}">
            <button type="submit" class="w3-button w3-blue w3-margin-bottom">
                <i class="fa fa-thumbs-up"></i> like
            </button>
            {{ csrf_field() }}
        </form>
        <form action="{{route('user.dislike')}}" method="post" style="display: inline-block; ">
            <input type="hidden" name="id" value="{{$post->id}}">
            <button type="submit" class="w3-button w3-red w3-margin-bottom" value="dislike">
                <i class="fa fa-thumbs-down"></i> dislike
            </button>

            {{ csrf_field() }}

        </form>
        <form action="{{route('user.block')}}" method="post" style="display: inline-block; ">
            <input type="hidden" name="id" value="{{$post->id}}">
            <button type="submit" class="w3-button w3-black w3-margin-bottom" value="blocked">
                <i class="fa fa-ban"></i> block
            </button>

            {{ csrf_field() }}

        </form>
    </p>
</div>
@endforeach

<!-- End Middle Column -->
</div>
@endsection