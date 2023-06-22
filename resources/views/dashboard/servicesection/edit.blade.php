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
    <h3>
        <div class="card-footer text-end">
            <a href="{{ route('dashboard.service.index') }}"><button class="btn btn-primary" type="submit">Add</button></a>
        </div>
    </h3>
    {{-- @dd($section) --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Edit Blog</h5>
                </div>
                {{-- @dd('asd') --}}
                <form action="{{ route('dashboard.servicesection.update', $section) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" value="{{$section->service_id}}" name="service_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="exampleFormControlInput1">Photo
                                    </label>
                                    <div class="col-6 text-center; mb-3">
                                        <img style="height: 100px; width: 100px" src="{{ $section->photo }}">
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control" id="exampleFormControlInput1" type="file"
                                            name="photo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3" style="margin-top: 7.2rem">
                                        <label class="form-label" for="exampleFormControlInput1">Name</label>
                                        <input class="form-control" id="exampleFormControlInput1" type="text" required
                                            name="name" value="{{ $section->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="discription_uz" class="form-label">Discription</label>
                                    <div class="form-group">
                                        <textarea class="ckeditor form-control" name="discription">{{ $section->discription }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5>Atribute | <button class="btn btn-xs btn-success" onclick="add()" type="button">+</button>
                            </h5>
                            <input type="hidden" id="id"
                                @if ($section->atribute != null) value="{{ count($section->atribute) + 1 }}" @else value="0" @endif>
                            <div class="row">
                                <div class="rooms">
                                    @if ($section->atribute != null)
                                        @foreach ($section->atribute as $key => $room)
                                            <div class="row mt-2" id="{{ $key }}">
                                                <div class="col-md-4">
                                                    <label class="form-label">Name</label>
                                                    <input class="form-control" type="text"
                                                        name="atribute[{{ $key }}][name]"
                                                        value="{{ $room['name'] }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Discription</label>
                                                    <textarea class="form-control" type="text" name="atribute[{{ $key }}][discription]">{{ $room['discription'] }}</textarea>
                                                </div>
                                                <div class="col-md-1 mt-1">
                                                    <div class="row mt-4">
                                                        <button class="btn btn-danger"
                                                            onclick="remove({{ $key }})" type="button">-</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
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
                        <textarea class="form-control" type="text" name="atribute[` + id + `][discription]"></textarea>
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
