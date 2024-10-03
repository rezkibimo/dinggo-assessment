<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Car;
use App\Models\Quote;

class CarQuoteController extends Controller
{
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

        $url = env('API_URL') . '/phptest/quotes';
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
                $quotesData = $data['quotes'];

                // Find the car in the database
                $car = Car::where('license_plate', $licensePlate)->first();

                if ($car) {
                    // Iterate through each quote and store/update in the database
                    foreach ($quotesData as $quoteData) {
                        Quote::updateOrCreate(
                            [
                                'car_id'           => $car->id,
                                'repairer'         => $quoteData['repairer'],
                                'overview_of_work' => $quoteData['overviewOfWork'],
                            ],
                            [
                                'price' => $quoteData['price'],
                            ]
                        );
                    }
                } else {
                    return back()->withErrors(['Car not found in the database.']);
                }

                // Pass both quotes and car details to the view
                return view('quotes', [
                    'quotes' => $quotesData,
                    'car'    => $car,
                ]);
            } else {
                return back()->withErrors(['API call failed.']);
            }
        } catch (\Exception $e) {
            // Handle exceptions such as network issues
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
