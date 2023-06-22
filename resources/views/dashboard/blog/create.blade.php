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
                <form action="{{ route('dashboard.blog.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Photo</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="file" required
                                        name="photo">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Name</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" required
                                        name="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Date</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" name="date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="discription_uz" class="form-label">Discription</label>
                                <div class="form-group">
                                    <textarea class="ckeditor form-control" name="discription"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="discription_uz" class="form-label">Second Discription</label>
                                <div class="form-group">
                                    <textarea class="ckeditor form-control" name="second_discription"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Second Photo</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="file"
                                        name="second_photo">
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
@endsection
