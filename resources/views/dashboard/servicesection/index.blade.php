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
                {{-- <h3 class="card-footer text-end">
                    <a href="{{ route('dashboard.servicesections.create', $service) }}">
                        <button type="submit" style="background-color: green; color: white;">Add</button>
                    </a>
                </h3> --}}
                <div class="card-footer text-end">
                    <a href="{{ route('dashboard.servicesections.create', $service) }}"><button class="btn btn-primary" type="submit">Add</button></a>
                </div>
                <div class="card-header">
                    <h5>All section</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Photo</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($sections) --}}
                            @php($k = 1)
                            @foreach ($sections as $section)
                                <tr>
                                    <th scope="row">{{ $k }}</th>
                                    <td>{{ $section->name }}</td>
                                    <td><img src="{{ $section->photo }}" alt="" style="height: 100px; width: 100px">
                                    <td class="text-center">
                                        <a href="{{ route('dashboard.servicesection.edit', $section) }}">
                                            <button class="btn btn-xs btn-success">Изменить
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-xs btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalCenter{{ $section->id }}"><i
                                                class="bx bx-trash"></i>Удалить</button>
                                        <div class="modal fade" id="exampleModalCenter{{ $section->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalCenter" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Удалить?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('dashboard.servicesection.destroy', $section) }}"
                                                            method="post">
                                                            @csrf
                                                            {{ method_field('delete') }}
                                                            <button class="btn btn-primary" type="submit"
                                                                data-bs-original-title="" title="">Да</button>
                                                        </form>
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal" data-bs-original-title=""
                                                            title="">Нет</button>
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
