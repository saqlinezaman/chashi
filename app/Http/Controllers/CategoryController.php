<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private const IMAGE_DIR = 'images/categories';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);

        return view('dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
   
        $data = $request->safe()->only([
            'title',
            'slug',
            
        ]);

        $data['image']     = $this->uploadImage($request->file('image'));
        $data['is_active'] = $request->boolean('is_active');

        Category::create($data);

        return redirect('categories')->with('success', 'Category created successfully.');
    

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
    private function uploadImage(UploadedFile $file): string
    {
        $folderPath = public_path(self::IMAGE_DIR);
        File::ensureDirectoryExists($folderPath);

        $imageName = 'category_' . time() . '_' . Str::uuid() . '.' . $file->extension();
        $file->move($folderPath, $imageName);

        return self::IMAGE_DIR . '/' . $imageName;
    }
}
