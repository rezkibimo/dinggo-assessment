<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Car Quotes</title>

</head>

<body>
    <h1>Car Quotes</h1>

    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(!empty($quotes))
    <ul>
        @foreach($quotes as $quote)
        <li>{{ $quote['repairer'] }} - ${{ $quote['price'] }}</li>
        <!-- Adjust based on the actual structure of your quotes data -->
        @endforeach
    </ul>
    @else
    <p>No quotes found.</p>
    @endif

    <a href="{{ url('/') }}">Back to Car List</a>
</body>

</html>