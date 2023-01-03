@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">About - Edit Multi Image Page</h4> <br>
                            <form action="{{ route('update.multi.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $multiImage->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Edit Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="multi_image" name="multi_image" >
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id='showImage' class="rounded avatar-lg"
                                            src="{{ asset($multiImage->multi_image)  }}"
                                            alt="About Page Image" data-holder-rendered="true">
                                    </div>
                                </div>
                                <!-- end row -->

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Image">
                            </form>

                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#multi_image').change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#showImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>
    @endsection
