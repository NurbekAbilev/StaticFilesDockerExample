<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Intervention\Image\ImageManager;
use Intervention\Image\Response;

$router->get('/', function () use ($router) {
    return view('greetings');
});

$router->post('/upload', function (\Illuminate\Http\Request $request) use ($router) {
    if($request->hasFile('file')) {
        $uploadedFile = $request->file('file');

        $image = new \App\Models\Image();
        $image->name = $uploadedFile->getFilename();
        $image->image = $uploadedFile->get();

        $manager = new ImageManager(array('driver' => 'imagick'));
//        $img = Image::make(Input::file('photo'));




        try{
            $image->save();

        }catch (Exception $e) {
            dd($e);
        }
    }

    dd($uploadedFile->get());
});

$router->get('/test', function (\Illuminate\Http\Request $request) use ($router) {
    $collection = \App\Models\Image::query()->get();

    $image = $collection[0];
//    return response()->getLastModified()
//    echo $image->image;
    $headers = ['Content-Type' => 'image/png'];
//    $response = new BinaryFileResponse($image->image, 200, $headers);
//    return $response;

    try{

        $manager = new ImageManager(['driver' => 'gd']);
        $img = $manager->make($image->image);

        $response = new Response($img);

//        $response->header('Content-Type', 'image/png');

        return $response;

    }catch (\Throwable $e) {
        dd($e);
    }

//    echo print_r($collection,true);
});
