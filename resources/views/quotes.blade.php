<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Car Quotes</title>

</head>

<body>
    <div class="container p-4">
        <h1 class="mb-3">Car Quotes</h1>

        <!-- Display Error Messages -->
        @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(isset($car))
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $car->make }} {{ $car->model }} {{ $car->year }}</li>
            </ol>
        </nav>
        @else
        <!-- Default Breadcrumb if Car Details are Missing -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quotes</li>
            </ol>
        </nav>
        @endif

        <!-- Display Quotes -->
        @if(!empty($quotes))
        @foreach($quotes as $quote)
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h4 class="my-0 fw-normal">{{ $quote['repairer'] }}</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">${{ $quote['price'] }}</h1>
                <p class="card-text">{{ $quote['overviewOfWork'] }}</p>
            </div>
        </div>
        <!-- Adjust based on the actual structure of your quotes data -->
        @endforeach
        @else
        <p>No quotes found.</p>
        @endif
    </div>
</body>

</html>