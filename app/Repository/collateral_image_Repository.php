<?php


namespace App\Repository;


use App\Http\Requests\imageRequest;
use App\Models\gallery;
use Illuminate\Support\Facades\Storage;

class collateral_image_Repository implements \App\Interfaces\collateral_image_interface
{

    public function getList($id)
    {
       return gallery::wherecollateral_id($id)->get();
    }

    public function upload(imageRequest $request,$collateral)
    {
        $path =$request->file('image')->store('gallery','myfiles');
        $gallery=gallery::create(['collateral_id'=>$collateral->id,'image'=>$path]);
        return $gallery;
    }

    public function delete($id)
    {
        $gallery = gallery::whereid($id)->first();
        $collateral_id = $gallery->collateral_id;
        Storage::disk('myfiles')->delete($gallery->path);
        $gallery->delete();
        return $collateral_id;
    }
}
