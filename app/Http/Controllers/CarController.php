<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CarController extends Controller
{
    // Display the car list on the index page
    public function index()
    {
        $client = new Client();

        $url = env('API_URL') . '/phptest/cars';
        $username = env('API_USERNAME');
        $key = env('API_KEY');

        try {
            // Make a POST request to the external API to get the car list
            $response = $client->post($url, [
                'form_params' => [
                    'username' => $username,
                    'key'      => $key,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if ($data['success'] === 'ok') {
                $cars = $data['cars'];
                return view('index', compact('cars'));
            } else {
                return back()->withErrors(['API call failed.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }

    // Handle the quote request
    public function getQuotes(Request $request)
    {
        $client = new Client();

        $url = env('API_URL') . '/phptest/quotes';
        $username = env('API_USERNAME');
        $key = env('API_KEY');

        $licensePlate = $request->input('licensePlate');
        $licenseState = $request->input('licenseState');

        try {
            // Make a POST request to the external API to get the quotes
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
                return view('quotes', compact('quotes'));
            } else {
                return back()->withErrors(['API call failed.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
