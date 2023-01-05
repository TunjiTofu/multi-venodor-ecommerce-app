@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Blog</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Blogs</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Blog Category</th>
                                        <th>Blog Title</th>
                                        <th>Blog Tags</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $blog->blog_category_id }}</td>
                                            <td>{{ $blog->blog_title }}</td>
                                            <td>{{ $blog->blog_tags }}</td>
                                            <td><img src="{{ asset($blog->blog_image) }}"
                                                    style="width: 60px; height: 60px"></td>
                                            <td>
                                                <a href="{{ route('edit.portfolio', $blog->id) }}" class="btn btn-info sm" title="Edit Image"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('delete.portfolio', $blog->id) }}" class="btn btn-danger sm" title="Delete Image" id="delete"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection
