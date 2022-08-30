@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Report Details</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<form>
                      @csrf
                      <div class="form-group">
                        <label for="title"><b>Title</b></label>
                        <input type="text" readonly class="form-control-plaintext"  id="titulo" name="titulo" value="{{ $report->titulo }}">
                      </div>
                      <div class="form-group">
                        <label for="description"><b>Description</b></label>
                        <textarea  readonly class="form-control-plaintext"  id="description" name="description" rows="4" cols="80" required>{{ $news->description }}</textarea>
                      </div>
<div class="form-group">
                        <label for="category"><b>Category</b></label>
                        <input type="text" readonly class="form-control-plaintext"  id="category" name="category" value="{{ $report->categorydescription }}">
                      </div>
<div class="form-group">
                        <label for="status"><b>Status</b></label>
                        <input type="text" readonly class="form-control-plaintext"  id="status" name="status" value="<?php if($report->status==1){ echo "Active";} else { echo "Inactive";}  ?>">
                      </div>
<div class="form-group">
                        <label for="status"><b>Image</b></label>
                        <br>
                        <img src="{{url('/images/'.$report->image)}}" style="width:200px; heigth:200px;">
                      </div>
<div class="form-group">
                        <a href="{{ route('news.edit', $report->id) }}" class="btn btn-primary">Edit</a>
                      </div>
</form>
</div>
            </div>
        </div>
    </div>
</div>
@endsection