<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display the list of cars on the index page.
     */
    public function index()
    {
        $client = new Client();

        $url = env('API_URL') . '/phptest/cars';
        $username = env('API_USERNAME');
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
                foreach ($cars as $carData) {
                    Car::updateOrCreate(
                        ['license_plate' => $carData['licensePlate']], // Unique identifier
                        [
                            'license_state' => $carData['licenseState'],
                            'vin'           => $carData['vin'],
                            'year'          => $carData['year'],
                            'colour'        => $carData['colour'],
                            'make'          => $carData['make'],
                            'model'         => $carData['model'],
                        ]
                    );
                }

                // Retrieve all cars from the database to display (pagination can be done in the future if needed)
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

}
