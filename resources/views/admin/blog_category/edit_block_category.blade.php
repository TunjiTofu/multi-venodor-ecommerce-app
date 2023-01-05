@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Block Category</h4>
                            <form action="{{ route('update.blog.category', $blogCategory->id) }}" method="POST">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Add Blog Category"
                                            id="category" name="category" value="{{ $blogCategory->category }}">
                                        @error('category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                    value="Update Blog Category">
                            </form>

                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    @endsection
