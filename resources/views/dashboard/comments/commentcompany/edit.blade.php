@extends('layouts.dashboard.main')

@section('content')

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
                    <h5>Update Company comment</h5>
                </div>
                {{-- @dd('asd') --}}
                <form action="{{ route('dashboard.commentcompany.update', $comment) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                    <div class="card-body">
                        <div class="col-md-3 text-center mt-3">
                            <img style="height: 200px; width: 300px" src="{{ $comment->photo }}">
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Photo</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="file" name="photo">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Name</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" required
                                        name="name" value="{{ $comment->name }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Star</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="number" name="star"
                                        min="1" max="5" value="{{ $comment->star }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="name_en">Ok/No</label>
                                <div class="input-group" style="font-size: 15px">
                                    <input type="checkbox" id="ok" name="ok"
                                        @if ($comment->ok != 0) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="discription_uz" class="form-label">Discription</label>
                                <div class="form-group">
                                    <textarea class="ckeditor form-control" name="discription">{{ $comment->discription }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
