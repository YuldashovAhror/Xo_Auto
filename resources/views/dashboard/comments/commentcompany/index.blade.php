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
                <div class="card-footer text-end">
                    <a href="{{ route('dashboard.commentcompany.create') }}">
                        <button class="btn btn-primary" type="submit">Add</button>
                    </a>
                </div>
                <div class="card-header">
                    <h5>All comment</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Star</th>
                                <th scope="col" class="text-center">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($comments) --}}
                            @php($k = 1)
                            @foreach ($comments as $comment)
                                <tr>
                                    <th scope="row">{{ $k }}</th>
                                    <td><img src="{{ $comment->photo }}" alt="" style="height: 100px; width: 200px">
                                    </td>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ $comment->star }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('dashboard.commentcompany.edit', $comment) }}">
                                            <button class="btn btn-xs btn-success">Change
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-xs btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $comment->id }}"><i
                                                class="bx bx-trash"></i>Delete</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $comment->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalCenter" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('dashboard.commentcompany.destroy', $comment) }}"
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
                                @php($k++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
