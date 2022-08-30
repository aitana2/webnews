@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit news</div>
<div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<form action="{{ route('news.update',['id' => $report->id])}}" method="post" enctype="multipart/form-data">
                       <input type="hidden" name="_method" value="PUT">
                      @csrf
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
                      </div>
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea  class="form-control" id="description" name="description" rows="4" cols="80" required>{{ $news->description }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                          <option value="">Select</option>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->id; ?>" 
                                <?php if($category->id==$report->categories_id){ echo "selected";} ?>>
                                <?php echo $category->description; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                          <option value="">Select</option>
                          <option value="1" <?php if($report->status==1){ echo "selected";} ?>>Active</option>
                          <option value="0" <?php if($report->status==0){ echo "selected";} ?>>Inactive</option>
                        </select>
                      </div>
<div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                      </div>
<div class="form-group">
                        <label for="status"><b>Image</b></label>
                        <br>
                        <img src="{{url('/images/'.$news->image)}}" style="width:200px; heigth:200px;">
                      </div>
<button type="submit" class="btn btn-primary">Accept</button>
</form>
<hr>
                    <form action="{{ route('news.destroy',['id' => $report->id]) }}" method="post">
                      <input name="_method" type="hidden" value="DELETE">
                      @csrf
                      <input type="submit" class="btn btn-danger" name="Delete" value="Delete">
                    </form>
</div>
            </div>
        </div>
    </div>
</div>
@endsection


