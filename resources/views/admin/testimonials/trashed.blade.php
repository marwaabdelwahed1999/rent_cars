@extends('admin.layouts.main_admin_layout')

@section('admin_content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Trashed Testimonials</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Trashed Testimonials List</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="#">Settings 1</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Published</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr id="{{$testimonial->id}}">
                                        <td>{{$testimonial->id}}</td>
                                        <td>{{$testimonial->name}}</td>
                                        <td>{{$testimonial->position}}</td>
                                        <td>{{$testimonial->content}}</td>
                                        <td><img src="{{ asset('storage/testimonials/' . $testimonial->image) }}" alt="{{$testimonial->name}}" style="width: 100px; height: 100px;"></td>                                        <td>
                                            @if ($testimonial->published)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('testimonials.restore', $testimonial->id)}}" class="btn btn-success btn-xs" title="Restore" onclick="return confirm('Are you sure you want to restore?')"><i class="fa fa-undo"></i></a>
                                            <form action="{{ route('admin.testimonials.forceDelete', $testimonial->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs" title="Force Delete" onclick="return confirm('Are you sure you want to force delete?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>                                        </td>
                                        <td>
                                    @endforeach
                                    </tr>

                                    @endsection