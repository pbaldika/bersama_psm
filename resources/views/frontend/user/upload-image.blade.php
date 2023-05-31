@extends('layouts.user')
@section('content')

<br>
<br>
<br>
<br>
<br>
<br>
@if(session('message'))
<h6 class="alert alert-success">
        {{ session('message') }}
    </h6>
@endif





<div class="container">
  <form method="post" action="{{route('proof-upload', $investment)}}" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="image">
      <label><h4>Add image</h4></label>
      <input type="file" class="form-control" required name="image">
    </div>


    <div class="post_button">
      <button type="submit" class="btn btn-success">Add</button>
    </div>
  </form>
</div>


<br>
<br>
<br>
<br>
<br>
<br>

@stop