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
        <a href="{{route('dashboard.service.index')}}"><button class="btn btn-primary" type="submit">Back</button></a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Create singles</h5>
                </div>
                <form action="{{ route('dashboard.servicesingle.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" value="{{ $service_id }}" name="service_id">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Photo </label>
                                    <input class="form-control" id="exampleFormControlInput1" type="file" required
                                        name="photo">
                                </div>
                            </div>
                            <div class="col-4">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Name</label>
                                    <input class="form-control" id="exampleFormControlInput1" required type="text"
                                        name="name">
                                </div>
                            </div>
                            <div class="col-4">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Icon</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="file" name="icon">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-12">
                                <label class="form-label">Discription</label>
                                <textarea class="ckeditor" name="discription" id="exampleFormControlTextarea4" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Сохранить</button>
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
                            <h5>All singles</h5>
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
                                <th scope="col">Icon</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($singles as $key => $single)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td><img src="{{ $single->photo }}" alt=""
                                            style="height: 100px; width: 100px"></td>
                                    <td>{{ $single->name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-success" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $single->id }}Edit"><i
                                                class="bx bx-pencil"></i>Изменить</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $single->id }}Edit"
                                            tabindex="-1" aria-labelledby="exampleModalCenter" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document"
                                                style="max-width: 50vw">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Изменить</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('dashboard.servicesingle.update', $single) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{ method_field('put') }}
                                                            <div class="card-body">
                                                                <input type="hidden" value="{{ $service_id }}" name="service_id">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Photo
                                                                            </label>
                                                                            <div class="col-6 text-center">
                                                                                <img style="height: 100px; width: 100px"
                                                                                    src="{{ $single->photo }}">
                                                                            </div>
                                                                            <input class="form-control mt-1"
                                                                                id="exampleFormControlInput1" type="file"
                                                                                name="photo">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div style="margin-top: 6.5rem">
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Name</label>
                                                                            <input class="form-control"
                                                                                id="exampleFormControlInput1" required
                                                                                type="text" name="name"
                                                                                value="{{ $single->name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="exampleFormControlInput1">Icon
                                                                            </label>
                                                                            <div class="col-6 text-center">
                                                                                <img style="height: 100px; width: 100px"
                                                                                    src="{{ $single->icon }}">
                                                                            </div>
                                                                            <input class="form-control mt-1"
                                                                                id="exampleFormControlInput1" type="file"
                                                                                name="icon">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col mb-12">
                                                                        <label class="form-label">Discription</label>
                                                                        <textarea class="ckeditor" name="discription" id="exampleFormControlTextarea4" rows="3">{{ $single->discription }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-end">
                                                                <button class="btn btn-primary"
                                                                    type="submit">Изменить</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-xs btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $single->id }}"><i
                                                class="bx bx-trash"></i>Удалить</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $single->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalCenter" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Удалить?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('dashboard.servicesingle.destroy', $single->id) }}"
                                                            method="post">
                                                            @csrf
                                                            {{ method_field('delete') }}
                                                            <button class="btn btn-primary" type="submit"
                                                                data-bs-original-title="" title="">Да</button>
                                                        </form>
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal" data-bs-original-title=""
                                                            title="">Нет</button>
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
