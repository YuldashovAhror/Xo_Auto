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
                    <h5>Add Date</h5>
                </div>
                <form action="{{ route('dashboard.year.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Date</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" required
                                        name="date">
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Add About</h5>
                </div>
                <form action="{{ route('dashboard.about.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Name</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" required
                                        name="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Link</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" name="link">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="exampleFormControlInput1">Date</label>
                                <div class="mb-3">
                                    <select  class="calc__type" name="year_id"  id="calc__type" style="font-size: 26px">
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id }}">{{ $year->date }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="discription" class="form-label">Discription</label>
                                <div class="form-group">
                                    <textarea class="ckeditor form-control" name="discription"></textarea>
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
