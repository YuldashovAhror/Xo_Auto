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
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h5>All feedbacks</h5>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Discription</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($feedbacks as $key => $feedback)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    @if ($feedback->type != null)
                                        <td>{{ $feedback->type->name }}</td>
                                    @endif
                                    @if ($feedback->type == null)
                                        <td>
                                            <h3>Null</h3>
                                        </td>
                                    @endif
                                    <td>{{ $feedback->name }}</td>
                                    <td>{{ $feedback->phone }}</td>
                                    <td>{{ $feedback->discription }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $feedback->id }}"><i
                                                class="bx bx-trash"></i>Delete</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $feedback->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalCenter" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('dashboard.feedback.destroy', $feedback->id) }}"
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
