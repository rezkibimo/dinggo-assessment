<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Home</title>

</head>

<body>
    <div class="container">
        <h1> Car List </h1>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @if(!empty($cars))
            @foreach($cars as $car)
            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                    </svg>
                    <div class="card-body">
                        <h5 class="card-title">{{ $car['make'] }} {{ $car['model'] }} {{ $car['year'] }} - {{ $car['colour'] }}</h5>
                        <p class="card-text"><strong>Registration:</strong> {{ $car['licenseState'] }} - {{ $car['licensePlate'] }}</p>
                        <p class="card-text"><strong>VIN:</strong> {{ $car['vin'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <form action="{{ url('/quotes') }}" method="POST">
                            @csrf
                            <input type="hidden" name="licenseState" value="{{ $car['licenseState'] }}">
                            <input type="hidden" name="licensePlate" value="{{ $car['licensePlate'] }}">
                            <button type="submit" class="btn btn-primary">Get Quote</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <p>No cars found.</p>
        @endif
    </div>
</body>

</html>