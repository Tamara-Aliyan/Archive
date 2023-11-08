@extends('admin.master')
@section('title')
Dashboard
@endsection
@section('css')

@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                @if ($errors->any())
                <div class="alert alert-danger bg-white text-danger" role="alert" >
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>

                </div>
                @endif
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                <i class="mdi mdi-calendar-range font-13"></i>
                            </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-primary ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Files</h5>
                            <h3 class="my-2 py-1">Files</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>{{ $fileCount }}</span>
                            </p>
                        </div>

                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Total KeyWords</h5>
                            <h3 class="my-2 py-1">KeyWords</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>{{ $keywordCount }}</span>
                            </p>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Total Users</h5>
                            <h3 class="my-2 py-1">Users</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>{{ $userCount }}</span>
                            </p>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('script')

@endsection
