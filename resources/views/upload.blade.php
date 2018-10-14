@extends('layouts.app')

@section('content')
    <div class="container bg-white box-shadow">
        <div class="justify-content-center">
            <img class="img-thumbnail img-fluid img-responsive" src="{{ asset('storage/' . $user->thumbnail) }}" alt="">
        </div>
        <div class="row justify-content-center">
            <form action="{{ route('submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                @foreach($foods as $food)
                    @if($food['name'] != null)
                    <div class="form-row">
                        <div class="form-group col-6 mt-2">
                            <label for="quantity">{{ $food['name'] }}</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="quantity">
                        </div>
                        <div class="form-group col-3 mt-5">
                            <h5>{{ $food['serving'] }}</h5>
                        </div>
                        <div class="form-group col-3 mt-5">
                            <h5>{{ $food['calorie'] }} calories</h5>
                            <input type="text" class="form-control" hidden id="quantity" name="calorie" placeholder="quantity" value="{{ $food['calorie'] }}">
                        </div>
                    </div>
                    @endif
                @endforeach
                <input type="number" hidden name="user_id" value="{{ $user->id }}">
                <button class="btn btn-md btn-primary m-5">submit</button>
            </form>
        </div>
    </div>
@endsection
