<?php

namespace App\Http\Controllers;

use App\Record;
use App\User;
use Illuminate\Http\Request;
use PhpFanatic\clarifAI\ImageClient;
use Clarifai\API\ClarifaiClient;
use Clarifai\DTOs\Inputs\ClarifaiURLImage;
use Clarifai\DTOs\Predictions\Concept;
use Clarifai\DTOs\Workflows\WorkflowPredictResult;
use Clarifai\DTOs\Inputs\ClarifaiFileImage;
use Illuminate\Support\Facades\Storage;

class ClarifaiController extends Controller
{
    public function index(Request $request)
    {

        $user = \Auth::user();

        if ($request->hasFile('thumbnail')) {
            if ($user->thumbnail !== null) {
                Storage::disk('local')->delete($user->thumbnail);
            }
//            Storage::putFileAs('public/photos', $request->thumbnail, 'photo.jpg');
            $user->thumbnail = $request->file('thumbnail')->storePublicly('photos', 'local');
            $user->save();
        }

        $client = new ClarifaiClient('5eaae2c6f2554ec3ade9885d5e077936');

        $response = $client->workflowPredict('20001023',
            new ClarifaiFileImage(file_get_contents('storage/' . $user->thumbnail)))
            ->executeSync();

        $arr = array();
        if ($response->isSuccessful()) {
//            echo "Response is successful.\n";

            /** @var WorkflowPredictResult $workflowResult */
            $workflowResult = $response->get();

//            echo "Predicted concepts:\n";
            /** @var Concept $concept */
            foreach ($workflowResult->workflowResult()->predictions() as $output) {
//                echo 'Predictions for output ' . $output->id() . "\n";
                /** @var Concept $concept */
                foreach ($output->data() as $concept) {
                    if($concept->value() >= 0.90) {
                        array_push($arr, $concept);
                    }
//                    echo "\t" . $concept->name() . ': ' . $concept->value() . "\n";
                }
//
//                while (count($arr) >= 5) {
//                    $smallest = 0;
//                    for ($i = 1; $i < count($arr); $i++) {
//                        if($arr[$i] < $arr[$smallest]) {
//                            $smallest = $i;
//                        }
//                    }
//
//                }
//                if(count($arr) == 0) {
//                    foreach ($output->data() as $concept) {
//                        if($concept->value() >= 0.80 && count($arr) < 5) {
//                            array_push($arr, $concept);
//                        }
//                    }
//                }
            }
        }

        else {
            echo "Response is not successful. Reason: \n";
            echo $response->status()->description() . "\n";
            echo $response->status()->errorDetails() . "\n";
            echo "Status code: " . $response->status()->statusCode();
        }
        function find($food_name)
        {
            $curl = curl_init("https://trackapi.nutritionix.com/v2/search/instant?query=" . $food_name);
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
            ));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'x-app-id: d4503a2c',
                'x-app-key: c90bb22808e84463b22173d4ce3a45e8'
            ));
            $resp = curl_exec($curl);
            if ($resp != null) {
//                print_r($resp);
                $J = json_decode($resp);
//                print_r($J);
                foreach ($J->branded as $name) {
                    if (strcasecmp($name->food_name, $food_name) == 0) {
                        if($name->nf_calories != null) {
                            return ['name' => $name->food_name, 'calorie' => round($name->nf_calories / $name->serving_qty), 'serving' => $name->serving_unit];
                        }
                        else {
                            continue;
                        }
                    }
                    else if (stripos($name->food_name, $food_name) !== false) {
                        if($name->nf_calories != null) {
                            return ['name' => $name->food_name, 'calorie' => round($name->nf_calories / $name->serving_qty), 'serving' => $name->serving_unit];
                        }
                        else {
                            continue;
                        }
                    }
                    else {
                        continue;
                    }
                }
            }
            else {

            }
        }

        $foods = array();

        foreach ($arr as $item) {
            array_push($foods, find($item->name()));
        }

        return view('upload', ['foods' => $foods, 'user' => \Auth::user()]);

    }
}
