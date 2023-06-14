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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Add Blog</h5>
                </div>
                {{-- @dd('asd') --}}
                <form action="{{ route('dashboard.service.update', $service) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Video</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="file"
                                        name="video">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Name</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" required
                                        name="name" value="{{$service->name}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Title</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" name="title" value="{{$service->title}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Second Video</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="file" 
                                        name="second_video">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="discription_uz" class="form-label">Discription</label>
                                <div class="form-group">
                                    <textarea class="ckeditor form-control" name="discription">{{$service->title}}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>Atribute | <button class="btn btn-xs btn-success" onclick="add()" type="button">+</button></h5>
                        <input type="hidden" id="id" @if ($service->atribute != null) value="{{ count($service->atribute)+1 }}" @else value="0" @endif>
                        <div class="row">
                            <div class="rooms">
                                @if ($service->atribute != null)
                                    @foreach ($service->atribute as $key=>$room)
                                        <div class="row mt-2" id="{{ $key }}">
                                            <div class="col-md-4">
                                                <label class="form-label">Name</label>
                                                <input class="form-control" type="text" name="rooms[{{ $key }}][name]" value="{{ $room['name'] }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Discription</label>
                                                <textarea class="form-control" type="text" name="rooms[{{ $key }}][discription]">{{ $room['discription'] }}</textarea>
                                            </div>
                                            <div class="col-md-1 mt-1">
                                                <div class="row mt-4">
                                                    <button class="btn btn-danger" onclick="remove({{ $key }})" type="button">-</button>
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
                        <input class="form-control" type="text" name="rooms[` + id + `][name]">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Discription</label>
                        <textarea class="form-control" type="text" name="rooms[` + id + `][discription]"></textarea>
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
