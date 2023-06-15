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
                    <h5>Create carrier</h5>
                </div>
                <form action="{{ route('dashboard.forcarriers.update', $carrier) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('put') }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Year</label>
                                    <input class="form-control" id="exampleFormControlInput1" required type="text"
                                        name="year" value="{{$carrier->year}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Customer</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" name="customer" required value="{{$carrier->customer}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div>
                                    <label class="form-label" for="exampleFormControlInput1">Carriers</label>
                                    <input class="form-control" id="exampleFormControlInput1" type="text" name="carriers" required value="{{$carrier->carriers}}">
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
