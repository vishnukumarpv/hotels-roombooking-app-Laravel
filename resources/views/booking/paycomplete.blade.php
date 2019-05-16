@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-header">Your booking information</div>

                <div class="card-body">
                    @include('booking._booking')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
