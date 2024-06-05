<?php

namespace App\Http\Controllers;

use App\Models\AppBgImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AppBgImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bgimage = AppBgImages::get();
        return Response::json(['appImage' => $bgimage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AppBgImages $appbgimages)
    {
        $data = $request->all();
		
        $storePath = public_path('images');
        if (!file_exists($storePath)) {
            mkdir($storePath, 0777, true);
        };
        if ($request->hasfile('bgimage')) {
            $fileName = time() . '.' . $request->bgimage->extension();
            $request->bgimage->move($storePath, $fileName);
        }
        $data['bgimage'] = $fileName;

        if (AppBgImages::where('app', $request->app )->exists()) {
            AppBgImages::where('app', $request->app)->update(['bgimage' => $fileName]);
			return "Imagen atualizada com sucesso!";
        } else {
            AppBgImages::create($data);
			return "Imagen inserida com sucesso!";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppBgImages  $appbgimages
     * @return \Illuminate\Http\Response
     */
    public function show(AppBgImages $appbgimages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppBgImages  $appbgimages
     * @return \Illuminate\Http\Response
     */
    public function edit(AppBgImages $appbgimages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppBgImages  $appbgimages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppBgImages $appbgimages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppBgImages  $appbgimages
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppBgImages $appbgimages)
    {
        //
    }
}
