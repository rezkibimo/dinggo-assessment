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
        <h1>Car List</h1>

        <!-- Display Error Messages -->
        @if ($errors->any())
            <div class="error-messages alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Check if there are cars to display -->
        @if($carList->isNotEmpty())
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($carList as $car)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <!-- Placeholder Image -->
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect>
                            </svg>
                            <div class="card-body d-flex flex-column">
                                <!-- Car Title -->
                                <h5 class="card-title">{{ $car->make }} {{ $car->model }} {{ $car->year }} - {{ $car->colour }}</h5>
                                
                                <!-- Car Registration -->
                                <p class="card-text"><strong>Registration:</strong> {{ $car->license_state }} - {{ $car->license_plate }}</p>
                                
                                <!-- Car VIN -->
                                <p class="card-text"><strong>VIN:</strong> {{ $car->vin }}</p>
                                
                                <!-- Spacer to push buttons to the bottom -->
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <!-- Edit Button (Functionality to be implemented) -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </div>
                                    
                                    <!-- Get Quote Form -->
                                    <form action="{{ url('/quotes') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="licenseState" value="{{ $car->license_state }}">
                                        <input type="hidden" name="licensePlate" value="{{ $car->license_plate }}">
                                        <button type="submit" class="btn btn-primary btn-sm">Get Quote</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links (if applicable) -->
            @if($carList instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="d-flex justify-content-center mt-4">
                    {{ $carList->links() }}
                </div>
            @endif
        @else
            <p>No cars found.</p>
        @endif
    </div>
</body>

</html>