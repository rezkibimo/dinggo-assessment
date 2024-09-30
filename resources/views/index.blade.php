<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

    </head>
    <body>
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

    @if(!empty($cars))
        @foreach($cars as $car)
            <div>
                <p><strong>{{ $car['make'] }} - {{ $car['model'] }} - {{ $car['licensePlate'] }} - {{ $car['licenseState'] }} - {{ $car['year'] }} - {{ $car['colour'] }}</strong></p>
            </div>
        @endforeach
    @else
        <p>No cars found.</p>
    @endif
    </body>
</html>
