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
                    <h5>Create About discription</h5>
                </div>
                <form action="{{ route('dashboard.aboutdiscription.update', $aboutdiscriptions->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Name</label>
                                    <input class="form-control" id="exampleFormControlInput1" required type="text"
                                        name="name" value="{{$aboutdiscriptions->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-12">
                                <label class="form-label">Discription</label>
                                <textarea class="ckeditor" name="discription" id="exampleFormControlTextarea4" rows="3">{!!$aboutdiscriptions->discription!!}</textarea>
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
