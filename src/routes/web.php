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

    return redirect('/');
});

$router->get('/test/{id}', function (\Illuminate\Http\Request $request, $id) use ($router) {
    $image = \App\Models\Image::query()->where('id', $id)->get()->first();

    if(!$image){
        abort(404);
    }

    $manager = new ImageManager(['driver' => 'gd']);
    $img = $manager->make($image->image);

    return $img->response();
});
