@extends('layouts.dashboard.main')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success') != null)
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Create team</h5>
                </div>
                <form action="{{ route('dashboard.team.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Photo </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="file" required
                                        name="photo">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Name</label>
                                    <input class="form-control" id="exampleFormControlInput1" required type="text"
                                        name="name">
                                </div>
                            </div>
                            <div class="col-4">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Email</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text"
                                        name="email">
                                </div>
                            </div>
                            <div class="col-4">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Phone</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" required
                                        name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h5>All teams</h5>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($teams as $key => $team)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td><img src="{{ $team->photo }}" alt=""
                                            style="height: 100px; width: 100px"></td>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $team->email }}</td>
                                    <td>{{ $team->phone }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-success" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $team->id }}Edit"><i
                                                class="bx bx-pencil"></i>Change</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $team->id }}Edit"
                                            tabindex="-1" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document"
                                                style="max-width: 50vw">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Change</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('dashboard.team.update', $team) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{ method_field('put') }}
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Photo
                                                                            </label>
                                                                            <div class="col-12 text-center">
                                                                                <img style="height: 100px; width: 100px"
                                                                                    src="{{ $team->photo }}">
                                                                            </div>
                                                                            <input class="form-control mt-1"
                                                                                id="exampleFormControlInput1" type="file"
                                                                                name="photo">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <div>
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Name</label>
                                                                            <input class="form-control"
                                                                                id="exampleFormControlInput1" required
                                                                                type="text" name="name"
                                                                                value="{{ $team->name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div>
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Email</label>
                                                                            <input class="form-control"
                                                                                id="exampleFormControlInput1" required
                                                                                type="text" name="email"
                                                                                value="{{ $team->email }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div>
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Phone</label>
                                                                            <input class="form-control"
                                                                                id="exampleFormControlInput1" required
                                                                                type="text" name="phone"
                                                                                value="{{ $team->phone }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-end">
                                                                <button class="btn btn-primary"
                                                                    type="submit">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-xs btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $team->id }}"><i
                                                class="bx bx-trash"></i>Delete</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $team->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalCenter" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('dashboard.team.destroy', $team->id) }}"
                                                            method="post">
                                                            @csrf
                                                            {{ method_field('delete') }}
                                                            <button class="btn btn-primary" type="submit"
                                                                data-bs-original-title="" title="">Yes</button>
                                                        </form>
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal" data-bs-original-title=""
                                                            title="">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
