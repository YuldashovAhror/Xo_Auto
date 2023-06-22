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
                    <h5>All about</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Link</th>
                                <th scope="col">Date</th>
                                <th scope="col" class="text-center">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($abouts) --}}
                            @php($k = 1)
                            @foreach ($abouts as $about)
                                <tr>
                                    <th scope="row">{{ $k }}</th>
                                    <td>{{ $about->name }}</td>
                                    <td>{{ $about->link }}</td>
                                    @if ($about->year != null)
                                    <td>{{ $about->year->date }}</td>
                                        
                                    @endif
                                    @if ($about->year == null)
                                        <td><h4>Null</h4></td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ route('dashboard.about.edit', $about) }}">
                                            <button class="btn btn-xs btn-success">Change
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-xs btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $about->id }}"><i
                                                class="bx bx-trash"></i>Delete</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $about->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalCenter" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('dashboard.about.destroy', $about) }}"
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
