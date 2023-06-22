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
    
    <div class="mb-2">
        <a href="{{ route('dashboard.service.index') }}"><button class="btn btn-primary" type="submit">Back</button></a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Create Section</h5>
                </div>
                <form action="{{ route('dashboard.servicesection.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" value="{{ $service_id }}" name="service_id">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Photo </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="file" required
                                        name="photo">
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Name</label>
                                    <input class="form-control" id="exampleFormControlInput1" required type="text"
                                        name="name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-12">
                                <label class="form-label">Discription</label>
                                <textarea class="ckeditor" name="discription" id="exampleFormControlTextarea4" rows="3"></textarea>
                            </div>
                        </div>
                        <hr>
                        <h5>Atribute | <button class="btn btn-xs btn-success" onclick="add()" type="button">+</button></h5>
                        <input type="hidden" id="id" value="0">
                        <div class="row">
                            <div class="rooms">

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
                            <h5>All Section</h5>
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
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $key => $section)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td><img src="{{ $section->photo }}" alt="" style="height: 100px; width: 100px">
                                    </td>
                                    <td>{{ $section->name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-success" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $section->id }}Edit"><i
                                                class="bx bx-pencil"></i>Change</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $section->id }}Edit"
                                            tabindex="-1" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document"
                                                style="max-width: 50vw">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Change</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('dashboard.servicesection.update', $section) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{ method_field('put') }}
                                                            <div class="card-body">
                                                                <input type="hidden" value="{{ $service_id }}"
                                                                    name="service_id">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Photo
                                                                            </label>
                                                                            <div class="col-6 text-center">
                                                                                <img style="height: 100px; width: 100px"
                                                                                    src="{{ $section->photo }}">
                                                                            </div>
                                                                            <input class="form-control mt-1"
                                                                                id="exampleFormControlInput1"
                                                                                type="file" name="photo">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div style="margin-top: 6.5rem">
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Name</label>
                                                                            <input class="form-control"
                                                                                id="exampleFormControlInput1" required
                                                                                type="text" name="name"
                                                                                value="{{ $section->name }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col mb-12">
                                                                        <label class="form-label">Discription</label>
                                                                        <textarea class="ckeditor" name="discription" id="exampleFormControlTextarea4" rows="3">{{ $section->discription }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <h5>Atribute | <button class="btn btn-xs btn-success"
                                                                        onclick="add()" type="button">+</button></h5>
                                                                <input type="hidden" id="id" @if ($section->atribute != null) value="{{ count($section->atribute)+1 }}" @else value="0" @endif>
                                                                <div class="row">
                                                                    <div class="rooms">
                                                                        @if ($section->atribute != null)
                                                                            @foreach ($section->atribute as $key => $room)
                                                                                <div class="row mt-2"
                                                                                    id="{{ $key }}">
                                                                                    <div class="col-md-4">
                                                                                        <label
                                                                                            class="form-label">Name</label>
                                                                                        <input class="form-control"
                                                                                            type="text"
                                                                                            name="rooms[{{ $key }}][name]"
                                                                                            value="{{ $room['name'] }}">
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label
                                                                                            class="form-label">Discription</label>
                                                                                        <textarea class="form-control" type="text" name="rooms[{{ $key }}][discription]">@if ( $room['discription'] != null ) {{ $room['discription'] }} @endif</textarea>
                                                                                    </div>
                                                                                    <div class="col-md-1 mt-1">
                                                                                        <div class="row mt-4">
                                                                                            <button class="btn btn-danger"
                                                                                                onclick="remove({{ $key }})"
                                                                                                type="button">-</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
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
                                            data-bs-target="#exampleModalCenter{{ $section->id }}"><i
                                                class="bx bx-trash"></i>Delete</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $section->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalCenter" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('dashboard.servicesection.destroy', $section->id) }}"
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
@section('scripts')
    <script>
        let id = $('#id').val();

        function add() {
            $('.rooms').append(
                `
                <div class="row mt-2" id="` + id + `">
                    <div class="col-md-4">
                        <label class="form-label">Name</label>
                        <input class="form-control" type="text" name="atribute[` + id + `][name]">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Discription</label>
                        <textarea class="form-control" type="text" name="   [` + id + `][discription]"></textarea>
                    </div>
                    <div class="col-md-1 mt-1">
                        <div class="row mt-4">
                            <button class="btn btn-danger" onclick="remove(` + id + `)"
                                type="button">-</button>
                        </div>
                    </div>
                </div>
            `
            )
            id++;
        }

        function remove(id) {
            $('#' + id).remove();
        }
    </script>
@endsection
