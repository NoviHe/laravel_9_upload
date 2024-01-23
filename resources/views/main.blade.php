@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed!</strong> {{ session('failed') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload File</label>
                    <input class="form-control @error('file') is-invalid @enderror" type="file" id="formFile"
                        name="file">
                    @error('file')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Upload</button>
            </form>
        </div>
    </div>
    <div class="row mt-4">
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>File</th>
                <th>Action</th>
            </tr>
            @forelse ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>
                        <img class="image" width="100px" src="{{ asset('uploads') }}/{{ $data->name }}" alt="">
                    </td>
                    <td>
                        <a href="{{ route('upload.download', $data->id) }}" class="btn btn-info">
                            Downloads
                        </a>
                        <a href="{{ route('upload.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Data Empty</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
