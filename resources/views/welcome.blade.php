@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">News</div>
<div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Títle</th>
                          <th>Category</th>
                          <th>Image</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($news as $report) { ?>
                            <tr>
<td><a href="show/<?php echo $report->id; ?>"><?php echo $report->id; ?></a></td>
                              <td><?php echo $report->title; ?></td>
                              <td><?php echo $report->categorydescription; ?></td>
                              <td><img src="{{url('/images/'.$report->image)}}" style="width:200px; heigth:200px;"></td>
                            </tr>
                        <?php } ?>
                      </tbody>
                    </table>
</div>
            </div>
        </div>
    </div>
</div>
@endsection