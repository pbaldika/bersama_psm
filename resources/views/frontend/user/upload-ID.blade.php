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
  <form method="post" action="{{route('verification-upload')}}" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="image">
      <label><h4>ID Number</h4></label>
      <input type="text" class="form-control" required name="IDNumber">
      <label><h4>Add ID Photo</h4></label>
      <input type="file" class="form-control" required name="IDPhoto">
      <label><h4>Add Selfie With ID</h4></label>
      <input type="file" class="form-control" required name="SelfieIDPhoto">
      <input id="verified" type="hidden" name="verified" value="request">
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