<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class bannerController extends Controller
{
    public function index(){
        $banners = Banner::all();
        return view('dashboard.banner.index' , compact('banners'));
    }
    public function store(Request $request){
    
    // $validated= $request->validate([
    //         'title' => 'nullable|string|max:255',
    //         'subtitle' => 'nullable|string|max:255',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:40960',
    //         'button_text' => 'nullable|string|max:255',
    //         'button_link' => 'nullable|url|max:255',
    //     ]);

        $banner = new Banner;
        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->button_text = $request->button_text;
        $banner->button_link = $request->button_link;
        $folderPath = public_path('images/banners');
        File::ensureDirectoryExists($folderPath);
        $imageName = 'banner_' . time() . Str::uuid() . '.' . $request->image->extension();
        $request->image->move($folderPath, $imageName);
        $banner->image = 'images/banners/' . $imageName;
        $banner->is_active = $request->has('is_active') ? 1 : 0;
        $banner->save();

        return redirect('banner')->with('success', 'Banner created successfully.');
    }
}
