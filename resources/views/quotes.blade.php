<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Car Quotes</title>

</head>

<body class="container">
    <h1>Car Quotes</h1>

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

    <a href="{{ url('/') }}">Back to My Car List</a>
</body>

</html>