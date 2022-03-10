<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Upload CSV</title>
    </head>
    <body>
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
                            @if (session()->has('success'))
                                <div class="alert alert-success my-1">
                                    <strong>{{ session('success') }}</strong>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
