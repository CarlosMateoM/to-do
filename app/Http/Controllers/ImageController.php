<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Services\ImageService;

class ImageController extends Controller
{

    public function __construct(
        private ImageService $imageService
    ) { }

    /**
     * Store a newly created resource in storage.
     */
    public function __invoke(StoreImageRequest $request)
    {
        $image = $request->file('image');

        $url = $this->imageService->createImage($image);

        return response()->json([ 'url' => $url ]);
    }
}
