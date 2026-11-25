<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class bannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->paginate(5);
        return view('dashboard.banner.index', compact('banners'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

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
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if (File::exists(public_path($banner->image))) {
                File::delete(public_path($banner->image));
            }

            $folderPath = public_path('images/banners');
            File::ensureDirectoryExists($folderPath);
            $imageName = 'banner_' . time() . Str::uuid() . '.' . $request->image->extension();
            $request->image->move($folderPath, $imageName);
            $banner->image = 'images/banners/' . $imageName;
        }

        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->button_text = $request->button_text;
        $banner->button_link = $request->button_link;
      $banner->is_active = (int) $request->input('is_active', 0);
        $banner->save();

        return redirect('banner')->with('success', 'Banner updated successfully.');
    }
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
         $imagePath = public_path($banner->image);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $banner->delete();
        return redirect()->back()->with('success', 'Banner deleted successfully.');
    }
}
