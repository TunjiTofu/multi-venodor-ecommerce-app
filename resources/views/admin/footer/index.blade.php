@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Footer Setup Page</h4>
                            <form action="{{ route('update.footer') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id" value="{{ $footer->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Phone Number" id="phone"
                                            name="phone" value="{{ $footer->number }}">
                                    </div>
                                </div>
                                <!-- end row -->

                               

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short
                                        Description</label>
                                    <div class="col-sm-10">
                                        <textarea required="" name="short_description" class="form-control" rows="5">{{ $footer->short_description }}</textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                                 <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Address"
                                            id="address" name="address" value="{{ $footer->address }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" placeholder="Email Address"
                                            id="address" name="email" value="{{ $footer->email }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Facebook</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Facebook Address"
                                            id="facebook" name="facebook" value="{{ $footer->facebook }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Twitter</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Twitter Address"
                                            id="twitter" name="twitter" value="{{ $footer->twitter }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Copyright</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Copyright"
                                            id="copyright" name="copyright" value="{{ $footer->copyright }}">
                                    </div>
                                </div>
                                <!-- end row -->


                                {{-- <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">About Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="about_image" name="about_image">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id='showImage' class="rounded avatar-lg"
                                            src="{{ !empty($aboutPage->about_image) ? url($aboutPage->about_image) : url('upload/no_image.jpg') }}"
                                            alt="About Page Image" data-holder-rendered="true">
                                    </div>
                                </div>
                                <!-- end row --> --}}

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Footer Page">
                            </form>

                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>

        {{-- <script type="text/javascript">
            $(document).ready(function() {
                $('#about_image').change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#showImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script> --}}
    @endsection
