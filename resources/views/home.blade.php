@extends('layouts.app')

@section('content')
    <div class="container bg-white box-shadow">
        <div class="row py-5">
            <div class="col-5 mt-5 text-center">
                <div class="col-5 offset-4">
                    <img class="rounded img-thumbnail" src="https://is4-ssl.mzstatic.com/image/thumb/Purple115/v4/f6/de/7b/f6de7b8c-1299-6e59-817c-5d3a9fd43c38/AppIcon-1x_U007emarketing-85-220-0-6.png/246x0w.jpg" alt="">
                </div>
                <h1 class="mt-5 p-2 offset-1">{{ $user->name }}</h1>
            </div>
            <div class="col-6 ml-5">
                <prog></prog>
            </div>
        </div>
        <div class="justify-content-center mb-5">
            <div class="col-10 offset-1 text-center">
                <div class="card p-5">
                    <form action="{{ route('clarifai') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group p-2 mb-3">
                            <label class="mb-2">Upload your photo</label>
                            <input type="file" class="form-control-file mt-2" name="thumbnail">
                        </div>
                        <div class="form-group p-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-block">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-10 offset-3 container m-5">
            <chart></chart>
        </div>

        <div class="container mt-3">
            @foreach($user->records as $record)
                <div class="card mt-3">
                    <h5 class="card-header">{{ $record->date }}</h5>
                    <div class="card-body row">
                        <div class="col-6">
                            <h5 class="card-title">Calorie Record</h5>
                            <p class="card-text">{{ $record->calorie }}</p>
                        </div>
                        <div class="col-6">
                            <img class="img-responsive img-thumbnail" src="{{ asset('storage/' . $record->thumbnail) }}" alt="">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
