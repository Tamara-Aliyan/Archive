@extends('admin.master')
@section('title')
File
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
                <h4 class="page-title">File</h4>
            </div>

        </div>
    </div>
    <div>
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_file-modal">Add File</button>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <form action="{{ route('f_search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="search...." value="{{ isset($search) ? $search : '' }}">
                        <button type="submit" class="btn btn-primary">search</button>
                    </div>
                </form>
                </div>
            </div>
        <br>
    </div>
        <!-- add File-->
        <div id="add_file-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="primary-header-modalLabel">Add File</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">

                        <form class="ps-3 pe-3" enctype="multipart/form-data" action="{{ route('f_store') }}" method="POST">
                            {{ method_field('POST') }}
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label" >Subject</label>
                                <input name="subject" class="form-control" type="text" id="name"  placeholder="----">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label" >Filepath</label>
                                <input name="filepath" class="form-control" type="file" id="name"  placeholder="----">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label" >Filedate</label>
                                <input name="filedate" class="form-control" type="date" id="name" >
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label" >Keyword</label>
                                <select class="fancyselect form-control" name="keyword_id">
                                    @foreach ($keywords as $keyword)
                                    <option value="{{ $keyword->id }}">{{ $keyword->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label" >User</label>
                                <select class="fancyselect form-control" name="user_id">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
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
                    <th>Subject</th>
                    <th>Filepath</th>
                    <th>Filedate</th>
                    <th>Keyword</th>
                    <th>User</th>
                    {{-- <th>Viwe</th> --}}
                    {{-- <th>Download</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; ?>
                @foreach ($files as $file)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $file->subject }}</td>
                    <td>{{ $file->filepath }}</td>
                    <td>{{ $file->filedate }}</td>
                    <td>{{ $file->keyword->name }}</td>
                    <td>{{ $file->user->name }}</td>
                    {{-- <td><a href="{{ route('f_show',$file->id) }}">vv</a></td> --}}
                    {{-- <td><a href="{{ route('f_download',$file->filepath) }}">88</a></td> --}}
                    <td class="table-action">
                        <a href="{{ route('f_show',$file->id) }}" class="action-icon"> <i class="mdi mdi-eye-outline"></i></a>
                        <a href="{{ route('f_download',$file->filepath) }}" class="action-icon"> <i class="mdi mdi-arrow-collapse-down"></i></a>
                        <a href="javascript: void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#edit_file{{ $file->id }}"> <i class="mdi mdi-pencil"></i></a>
                        <a href="javascript: void(0);" class="action-icon"data-bs-toggle="modal" data-bs-target="#delete_file{{ $file->id }}"> <i class="mdi mdi-delete-outline"></i></a>
                    </td>
                </tr>

                <!-- edit File-->
                <div id="edit_file{{ $file->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-colored-header bg-primary">
                                <h4 class="modal-title" id="primary-header-modalLabel">Edit File</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">

                                <form class="ps-3 pe-3" action="{{ route('f_update') }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Subject</label>
                                        <input name="subject" class="form-control" type="text" id="name" value="{{ $file->subject }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label" >Filepath</label>
                                        <input name="filepath" class="form-control" type="file" id="name" value="{{ $file->filepath }}" required="" placeholder="----">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label" >Filedate</label>
                                        <input name="filedate" class="form-control" type="date" id="name" value="{{ $file->filedate }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label" >Keyword</label>
                                        <select class="fancyselect form-control" name="keyword_id">
                                            <option selected value="{{ $file->keyword_id }}">{{ $file->keyword->name }}</option>
                                            @foreach ($keywords as $keyword)
                                            <option value="{{ $keyword->id }}">{{ $keyword->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label" >User</label>
                                        <select class="fancyselect form-control" name="user_id">
                                            <option selected value="{{ $file->user_id }}">{{ $file->user->name }}</option>
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <input class="form-control" type="hidden" id="id" name="id" value="{{ $file->id }}">
                                    </div>

                                    <div class="mb-3 text-center">
                                        <button class="btn btn-primary" type="submit">Edit</button>
                                    </div>

                                </form>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- delete file-->
                <div id="delete_file{{ $file->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-colored-header bg-danger">
                                <h4 class="modal-title" id="danger-header-modalLabel">Delete File</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">

                                <form class="ps-3 pe-3" action="{{ route('f_destroy') }}" method="POST">
                                    {{ method_field('Delete') }}
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">delete {{ $file->subject }} </label>
                                        {{-- <input name="name" class="form-control" type="text" id="name" value="{{ $keyword->name }}"> --}}
                                    </div>

                                    <div class="mb-3">
                                        <input class="form-control" type="hidden" id="id" name="id" value="{{ $file->id }}">
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

@endsection
