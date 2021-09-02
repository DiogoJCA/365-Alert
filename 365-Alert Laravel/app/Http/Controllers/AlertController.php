<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Alert;
use Carbon\Carbon;

class AlertController extends Controller
{
    public function getApi()
    {
        // Create a new client
        $alerts = new Client();

        // Set the URL of the API to get the stations JSON
        $url = 'https://heichwaasser.lu/api/v1/stations';

        // Save the API request answer to a variable
        $response = $alerts->request('GET', $url);

        // Decode the JSON file into an Object
        $responseBodys = json_decode($response->getBody());

        // Looping through the Object 
        foreach ($responseBodys as $response) {
            // Nested Loop to Iterate through the alert_levels array
            foreach ($response->alert_levels as $key => $level) {
                
                // Conditionals to save the water levels into variables and rehuse them to check
                // if the current water levels are at certain levels or normal
                if ($level->name === 'Cote d’alerte') {
                    $redAlertLevel = $level->value;

                    // Checking if current water level is higher then the alert level
                    if ($response->current->value >= $redAlertLevel) {

                        // Find the alert
                        $alert = Alert::find($response->id);

                        // Set the Attributes
                        $alert->type = 'Red';
                        $alert->water_level = $response->current->value;
                        $alert->updated_at = Carbon::now()->format('Y-m-d H:i:s');

                        // Save on the model instance
                        $alert->save();
                    } 
                    
                } else if ($level->name === 'Cote de préalerte') {

                    $orangeAlertLevel = $level->value;

                    // Checking if current water level is higher then the alert level
                    if ($response->current->value >= $orangeAlertLevel) {
                        
                        // Find the alert
                        $alert = Alert::find($response->id);

                        // Set the Attributes
                        $alert->type = 'Orange';
                        $alert->water_level = $response->current->value;
                        $alert->updated_at = Carbon::now()->format('Y-m-d H:i:s');

                        // Save on the model instance
                        $alert->save();
                    } 
                    
                } else if ($level->name === 'Cote de vigilance') {

                    $yellowAlertLevel = $level->value;

                    // Checking if current water level is higher then the alert level
                    if ($response->current->value >= $yellowAlertLevel) {

                        // Find the alert
                        $alert = Alert::find($response->id);

                        // Set the Attributes
                        $alert->type = 'Yellow';
                        $alert->water_level = $response->current->value;
                        $alert->updated_at = Carbon::now()->format('Y-m-d H:i:s');

                        // Save on the model instance
                        $alert->save();

                    // If the water level is not higher then any of the alerts it's in green/good status then run this code
                    } else {
                        
                        // Find the alert
                        $alert = Alert::find($response->id);

                        // Set the Attributes
                        $alert->type = 'Green';
                        $alert->water_level = $response->current->value;
                        $alert->updated_at = Carbon::now()->format('Y-m-d H:i:s');

                        // Save on the model instance
                        $alert->save();
                    }
                }

                // If the water level is lower then the minimum water levels
                if ($response->current->value <= $response->minimum->value) {
                    
                    // Find the alert
                    $alert = Alert::find($response->id);

                    // Set the Attributes
                    $alert->type = 'Dry';
                    $alert->water_level = $response->current->value;
                    $alert->updated_at = Carbon::now()->format('Y-m-d H:i:s');

                    // Save on the model instance
                    $alert->save();;
                }
            }
        }
        
        return view('alerts');
    }
}
