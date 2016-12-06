<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class NewPackageController extends Controller
{
    public function index()
    {
        return view('test.index');
    }

    public function testGeoCoder()
    {
        $geocoder = App('geocoder');

        $resp = $geocoder->setDirection(\AMgradeTZ\GeoCoding\GeoCodingClient::STRAIGHT)
            ->setCoordinates(40.714224,-73.961452)
            ->setAddress('Бобруйск')
            ->makeRequest();

        $coords = $resp->results[0]->geometry->location;
        return view('test.testdata')->with('coords', $coords);
    }

    public function geocode(Request $request)
    {
        $address = $request->get('address');
        $language = $request->get('language');

        $geocoder = App('geocoder');

        $resp = $geocoder->setDirection(\AMgradeTZ\GeoCoding\GeoCodingClient::STRAIGHT)
            ->setAddress($address)
            ->setLanguage($language)
            ->makeRequest();

        return view('test.index')->with('resp', $resp);
    }

    public function geocode_reverse(Request $request)
    {
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $language = $request->get('language');

        $geocoder = App('geocoder');

        $resp = $geocoder->setDirection(\AMgradeTZ\GeoCoding\GeoCodingClient::REVERSE)
            ->setCoordinates($lat, $lng)
            ->setLanguage($language)
            ->makeRequest();

        return view('test.testdata')->with('resp', $resp);
    }
}