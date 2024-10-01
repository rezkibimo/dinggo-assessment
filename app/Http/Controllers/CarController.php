<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Car;
use App\Models\Quote;

class CarController extends Controller
{
    /**
     * Display the list of cars on the index page.
     */
    public function index()
    {
        $client = new Client();

        $url = 'https://app.dev.aws.dinggo.com.au/phptest/cars';
        $username = env('API_USERNAME'); // Ensure these are set in your .env file
        $key = env('API_KEY');

        try {
            // Make a POST request to the external API to fetch cars
            $response = $client->post($url, [
                'form_params' => [
                    'username' => $username,
                    'key'      => $key,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if ($data['success'] === 'ok') {
                $cars = $data['cars'];

                // Iterate through each car and store/update in the database
                foreach ($cars as $car) {
                    Car::updateOrCreate(
                        ['license_plate' => $car['licensePlate']], // Unique identifier
                        [
                            'license_state' => $car['licenseState'],
                            'vin'           => $car['vin'],
                            'year'          => $car['year'],
                            'colour'        => $car['colour'],
                            'make'          => $car['make'],
                            'model'         => $car['model'],
                        ]
                    );
                }

                // Retrieve all cars from the database to display
                $carList = Car::all();

                return view('index', compact('carList'));
            } else {
                return back()->withErrors(['API call failed.']);
            }
        } catch (\Exception $e) {
            // Handle exceptions such as network issues
            return back()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Handle the "Get Quote" action.
     */
    public function getQuotes(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'licensePlate' => 'required|string|max:255',
            'licenseState' => 'required|string|max:255',
        ]);

        $client = new Client();

        $url = 'https://app.dev.aws.dinggo.com.au/phptest/quotes';
        $username = env('API_USERNAME');
        $key = env('API_KEY');

        // Retrieve license details from the form submission
        $licensePlate = $validated['licensePlate'];
        $licenseState = $validated['licenseState'];

        try {
            // Make a POST request to the external API to fetch quotes
            $response = $client->post($url, [
                'form_params' => [
                    'username'      => $username,
                    'key'           => $key,
                    'licensePlate'  => $licensePlate,
                    'licenseState'  => $licenseState,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if ($data['success'] === 'ok') {
                $quotes = $data['quotes'];

                // Find the car in the database
                $car = Car::where('license_plate', $licensePlate)->first();

                if ($car) {
                    // Iterate through each quote and store it in the database
                    foreach ($quotes as $quote) {
                        Quote::create([
                            'car_id'           => $car->id,
                            'price'            => $quote['price'],
                            'repairer'         => $quote['repairer'],
                            'overview_of_work' => $quote['overviewOfWork'],
                        ]);
                    }
                } else {
                    return back()->withErrors(['Car not found in the database.']);
                }

                return view('quotes', compact('quotes'));
            } else {
                return back()->withErrors(['API call failed.']);
            }
        } catch (\Exception $e) {
            // Handle exceptions such as network issues
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
