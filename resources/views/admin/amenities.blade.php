@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                    Available amenities
                </div>

                <div class="card-body">

                    @include('layouts.success')

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Amenity Name</th>
                          <th scope="col">Amenity icon</th>
                         </tr>
                      </thead>
                      <tbody>
                        @foreach ($amenities as $amenity)
                       <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{ $amenity->name }}</td>
                          <td>{{ $amenity->ico_name }}</td>
                        </tr>
                        @endforeach



                        </tbody>
                    </table>
                    <div class="card">
                    <div class="card-body">
                            <form action="{{ route('admin.amenities') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                <div class="form-group col-7">
                                    <label for="name">Amenity name</label>
                                    <input type="text" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Amenity name"> 
                                </div>

                                <div class="form-group col-5">
                                    <label for="ico_name">Icon attribute</label>
                                    <input type="text" class="form-control" name="ico_name" id="ico_name" aria-describedby="ico_name" placeholder="Icon attrib"> 
                                </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary myClass">Add</button>
                            </form>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
