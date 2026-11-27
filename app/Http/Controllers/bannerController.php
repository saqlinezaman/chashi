<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    private const IMAGE_DIR = 'images/banners';

    public function index()
    {
        $banners = Banner::latest()->paginate(5);

        return view('dashboard.banner.index', compact('banners'));
    }

    public function store(BannerRequest $request)
    {
        $data = $request->safe()->only([
            'title',
            'subtitle',
            'button_text',
            'button_link',
        ]);

        $data['image']     = $this->uploadImage($request->file('image'));
        $data['is_active'] = $request->boolean('is_active');

        Banner::create($data);

        return redirect('banner')->with('success', 'Banner created successfully.');
    }

    public function update(BannerRequest $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $data = $request->safe()->only([
            'title',
            'subtitle',
            'button_text',
            'button_link',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $this->deleteImage($banner->image);
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $banner->update($data);

        return redirect('banner')->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        $this->deleteImage($banner->image);
        $banner->delete();

        return redirect()->back()->with('success', 'Banner deleted successfully.');
    }

//  Upload image to public/images/banners and return relative path.

    private function uploadImage(UploadedFile $file): string
    {
        $folderPath = public_path(self::IMAGE_DIR);
        File::ensureDirectoryExists($folderPath);

        $imageName = 'banner_' . time() . '_' . Str::uuid() . '.' . $file->extension();
        $file->move($folderPath, $imageName);

        return self::IMAGE_DIR . '/' . $imageName;
    }
    //  Delete image from public folder if it exists.
    private function deleteImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}