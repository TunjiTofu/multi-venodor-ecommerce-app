<ul>
    @foreach ($multiImages as $image)
        <li><img src="{{ asset($image->multi_image) }}" alt=""></li>
    @endforeach
</ul>