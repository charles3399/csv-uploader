@extends('layouts.app')

@section('content')
<div class="card w-50 my-3 mx-auto d-flex justify-content-center background-green">
    <div class="card-header">Upload csv file</div>
    <div class="card-body">
        <div class="container">
            <div class="p-1 mb-2">
                <form method="post" action="{{ route('upload-file') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="file" name="file" id="file">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger my-1">
                                @foreach ($errors->all() as $error)
                                    <strong>{{ $error }}</strong>
                                @endforeach
                            </div>
                        @endif
                        @if (session()->has('warning'))
                            <div class="alert alert-warning my-1">
                                <strong>{{ session('warning') }}</strong>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-sm btn-outline-success my-2" id="submit">Submit</button>
                        <a href="{{ route('table') }}" class="btn btn-sm btn-outline-primary my-2">Show table</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection