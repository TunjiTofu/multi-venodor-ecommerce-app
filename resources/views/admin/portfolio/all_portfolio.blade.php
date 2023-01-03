@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Portfolio</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Portfolio</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($portfolios as $portfolio)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $portfolio->portfolio_name }}</td>
                                            <td>{{ $portfolio->portfolio_title }}</td>
                                            <td><img src="{{ asset($portfolio->portfolio_image) }}"
                                                    style="width: 60px; height: 60px"></td>
                                            <td>
                                                <a href="{{ route('edit.multi.image', $portfolio->id) }}" class="btn btn-info sm" title="Edit Image"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('delete.multi.image', $portfolio->id) }}" class="btn btn-danger sm" title="Delete Image" id="delete"><i class="fas fa-trash-alt"></i></a>
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
