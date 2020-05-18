@extends('layout')

@section('content')

<?php
$liked = Session::get('liked');
$disliked = Session::get('dislike');
$blocked = Session::get('block');
if ($liked != 'liked' || $disliked == 'disliked')    $liked = 'like';
if ($disliked != 'disliked' || $liked == 'liked')     $disliked = 'dislike';
if ($blocked != 'blocked')     $blocked = 'block';


?>
<!-- Middle Column -->
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
        <!-- <div class="w3-row-padding" style="margin: 0 -16px;">
            <div class="w3-half">
                <img src="/w3images/lights.jpg" style="width: 100%;" alt="Northern Lights" class="w3-margin-bottom" />
            </div>
            <div class="w3-half">
                <img src="/w3images/nature.jpg" style="width: 100%;" alt="Nature" class="w3-margin-bottom" />
            </div>
        </div> -->
        <p>
            <form action="{{route('user.like')}}" method="post" style="display: inline-block; ">
                <input type="hidden" name="id" value="{{$post->id}}">
                <button type="submit" class="w3-button w3-blue w3-margin-bottom">
                    <i class="fa fa-thumbs-up"></i> <?php echo $liked;  ?>
                </button>
                {{ csrf_field() }}
            </form>
            <form action="{{route('user.dislike')}}" method="post" style="display: inline-block; ">
                <input type="hidden" name="id" value="{{$post->id}}">
                <button type="submit" class="w3-button w3-red w3-margin-bottom" value="dislike">
                    <i class="fa fa-thumbs-down"></i> <?php echo $disliked; ?>
                </button>

                {{ csrf_field() }}

            </form>
            <form action="{{route('user.block')}}" method="post" style="display: inline-block; ">
                <input type="hidden" name="id" value="{{$post->id}}">
                <button type="submit" class="w3-button w3-black w3-margin-bottom" value="blocked">
                    <i class="fa fa-ban"></i> <?php echo $blocked; ?>
                </button>

                {{ csrf_field() }}

            </form>
        </p>
    </div>
    @endforeach

    <!-- End Middle Column -->
</div>
@endsection