@extends('layouts.app')

@section('content')
<div class="container my-3">
    <div class="card">
        <div class="card-header">
            <div class="p-1 d-flex flex-row justify-content-start">
                <div class="mx-2">
                    <form action="{{route('filter')}}" method="get">
                        <div class="d-flex justify-content-start">
                            <select class="form-select" name="sort" aria-label="Default select example">
                                <option value="year">Year</option>
                                <option value="rank">Rank</option>
                                <option value="recipient">Recipient</option>
                                <option value="country">Country</option>
                                <option value="career">Career</option>
                                <option value="tied">Tied</option>
                                <option value="title">Title</option>
                            </select>
                            <button class="btn btn-outline-secondary mx-2" type="submit">Sort</button>
                        </div>
                    </form>
                </div>
                <div class="mx-2">
                    <form action="{{route('search')}}" method="get">
                        <div class="d-flex justify-content-between">
                            <input type="text" class="form-control" name="search" required aria-describedby="helpId" placeholder="Search..">
                            <button class="btn btn-outline-secondary mx-2" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="mx-auto">
                    <a href="{{ url('table') }}" class="btn btn-outline-secondary">Reset search</a>
                    <a href="{{ url('/') }}" class="btn btn-outline-success">Back to homepage</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session()->has('warning'))
                <div class="alert alert-danger my-1">
                    <strong>{{ session('warning') }}</strong>
                </div>
            @endif
            <table class="table table-striped table-bordered table-dark table-responsive text-center">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Rank</th>
                        <th>Recipient</th>
                        <th>Country</th>
                        <th>Career</th>
                        <th>Tied</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($posts) > 0)
                    @foreach ($posts as $row)
                        <tr>
                            <td>{{$row->year}}</td>
                            <td>{{$row->rank}}</td>
                            <td>{{$row->recipient}}</td>
                            <td>{{$row->country}}</td>
                            <td>{{$row->career}}</td>
                            <td>{{$row->tied}}</td>
                            <td>{{$row->title}}</td>
                        </tr>
                    @endforeach
                @else
                    <div class="alert alert-danger text-center">
                        <strong>No data found</strong>
                    </div>
                @endif
                </tbody>
            </table>
            {{ $posts->withQueryString()->links() }}
            {{-- Without withQueryString the next page of pagination will not work --}}
        </div>
    </div>
</div>
@endsection

