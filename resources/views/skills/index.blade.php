@extends('layouts.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
            </div>

            <!-- Button trigger modal -->
            <button type="button" style="margin-left: 90%; margin-top: 20px" class="btn btn-success" data-toggle="modal"
                data-target="#createUser">
                ADD
            </button>

            <!-- Modal -->
            <div class="modal fade" id="createUser" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('skills.store') }}" method="post" id="createSkill">
                                @csrf
                                <input type="type" class="form-control @error('name') border border-danger @enderror"
                                    style="margin-bottom: 10px" placeholder="Name" name="name">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('createSkill').submit();">Create</button>
                        </div>
                    </div>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @error('error')
                <div class="alert alert-danger">
                    {{ $messages['error'] }}
                </div>
            @enderror
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr>
                                <td>{{ $skill->id }}</td>
                                <td>{{ $skill->name }}</td>
                                <td>{{ $skill->created_at }}</td>
                                <td>{{ $skill->updated_at }}</td>
                                <td>
                                    <form action="{{ route('skills.destroy', $skill->id) }}" method="post">
                                        <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-primary">Edit</a>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.content -->
    </div>
@endsection
