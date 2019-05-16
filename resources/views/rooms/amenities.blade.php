
<h2>Amenities</h2>
    @if($amenities->count())
      <ul class="amenities">
            @foreach ($amenities as $amenity)
              <li><i style="font-size: 10px">{{ $amenity->ico_name }}</i>  {{ $amenity->name }}</li>
            @endforeach 
        </ul>
    @else
    <p><i>No amenities were found</i></p>
    @endif