@extends('layout')

@section('content')


<!-- Middle Column -->


<div class="w3-container w3-card w3-white  w3-round w3-margin ">
    <br />
    <div style="overflow-x:auto;">

        <table class="w3-table  w3-striped">

            <tr>
                <th>Sno</th>
                <th>PostName </th>
                <th>Catagory</th>
                <th>Created_at</th>
                <th>Action</th>
            </tr>
            <?php $i = 0; ?>
            @foreach ($posts as $post)
            <?php $i++; ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$post->name}} </td>
                <td> {{$post->catagory}}</td>
                <td>{{$post->created_at}}</td>
                <td>
                    <a href="{{route('articles.editNext',$post->id)}}" class="w3-mobile w3-button w3-cyan w3-text-white">edit</a>
                    <a href="{{route('articles.delete',$post->id)}}" class="w3-mobile w3-button w3-red">delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

<!-- End Middle Column -->
</div>

@endsection