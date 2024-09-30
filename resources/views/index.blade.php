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
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $car['make'] }} {{ $car['model'] }}</h5>
                    <p class="card-text">{{ $car['year'] }} - {{ $car['colour'] }}</p>
                    <p class="card-text">{{ $car['licenseState'] }} - {{ $car['licensePlate'] }}</p>
                    <form action="{{ url('/quotes') }}" method="POST">
                        @csrf
                        <input type="hidden" name="licenseState" value="{{ $car['licenseState'] }}">
                        <input type="hidden" name="licensePlate" value="{{ $car['licensePlate'] }}">
                        <button type="submit" class="btn btn-primary">Get Quote</button>
                    </form>
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