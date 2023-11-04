@extends('admin.master')
@section('title')
Keyword
@endsection
@section('css')
@toastr_css
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
                <h4 class="page-title">Keyword</h4>
            </div>
        </div>
    </div>
    <div>
        <!-- add keyword-->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_keyword-modal">Add Keyword</button>
        <div id="add_keyword-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="primary-header-modalLabel">Add Keyword</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">

                        <form class="ps-3 pe-3" action="{{ route('k_store') }}" method="POST">
                            {{ method_field('POST') }}
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label" >Name</label>
                                <input name="name" class="form-control" type="text" id="name"  placeholder="----">
                            </div>

                            <div class="mb-3 text-center">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>

                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <div>
        <table class="table table-striped table-centered mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; ?>
                @foreach ($keywords as $keyword)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $keyword->name }}</td>
                    <td class="table-action">
                        <a href="javascript: void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#edit_keyword{{ $keyword->id }}"> <i class="mdi mdi-pencil"></i></a>
                        <a href="javascript: void(0);" class="action-icon"data-bs-toggle="modal" data-bs-target="#delete_keyword{{ $keyword->id }}"> <i class="mdi mdi-delete"></i></a>
                    </td>
                </tr>

                <!-- edit keyword-->
                <div id="edit_keyword{{ $keyword->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-colored-header bg-primary">
                                <h4 class="modal-title" id="primary-header-modalLabel">Edit Keyword</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">

                                <form class="ps-3 pe-3" action="{{ route('k_update') }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input name="name" class="form-control" type="text" id="name" value="{{ $keyword->name }}">
                                    </div>

                                    <div class="mb-3">
                                        <input class="form-control" type="hidden" id="id" name="id" value="{{ $keyword->id }}">
                                    </div>

                                    <div class="mb-3 text-center">
                                        <button class="btn btn-primary" type="submit">Edit</button>
                                    </div>

                                </form>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- delete keyword-->
                <div id="delete_keyword{{ $keyword->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-colored-header bg-danger">
                                <h4 class="modal-title" id="danger-header-modalLabel">Delete Keyword</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">

                                <form class="ps-3 pe-3" action="{{ route('k_destroy') }}" method="POST">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">delete {{ $keyword->name }} </label>
                                        {{-- <input name="name" class="form-control" type="text" id="name" value="{{ $keyword->name }}"> --}}
                                    </div>

                                    <div class="mb-3">
                                        <input class="form-control" type="hidden" id="id" name="id" value="{{ $keyword->id }}">
                                    </div>

                                    <div class="mb-3 text-center">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </div>

                                </form>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
@toastr_js
@toastr_render
@endsection
