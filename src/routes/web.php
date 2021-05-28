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

$router->get('/', function () use ($router) {
    return view('greetings', [
        'images' => \App\Models\Image::all()
    ]);
});

$router->post('/upload', function (\Illuminate\Http\Request $request) use ($router) {
    if($request->hasFile('file')) {
        $uploadedFile = $request->file('file');

        $manager = new ImageManager(['driver' => 'gd']);

        $img = $manager->make($uploadedFile);

        $width = $img->width() / 2;
        $height = $img->height() / 2;

        $img1 = clone $img;
        $img2 = clone $img;
        $img3 = clone $img;
        $img4 = clone $img;

        $img1->crop($width, $height, 0, 0);
        $img2->crop($width, $height, $width, 0);
        $img3->crop($width, $height, 0, $height);
        $img4->crop($width, $height, $width, $height);

        $images = [$img1, $img2, $img3, $img4];

        foreach ($images as $ind => $img) {
            $image = new \App\Models\Image();
            $image->name = $uploadedFile->getFilename() . $ind;
            $image->image = (string) $img->stream();

            $image->save();
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
