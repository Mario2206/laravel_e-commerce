<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Service\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{

    private FileUpload $fileUpload;

    public function __construct(FileUpload $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('pages/admin/category/index', compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages/admin/category/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            "name" => ["required", "min:2"],
            "miniature" => ["required", "image"]
        ]);

        $imgPath = $this->fileUpload->upload("miniature",$request->input("name"));

        if(!$imgPath) {
            return back()->withErrors($request->file('miniature')->getError(), $request->file('miniature')->getErrorMessage() );
        }

        Category::create(["name" => $request->input("name"), "img_path" => $imgPath]);

        return redirect()->route("categories.index");


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages/admin/category/edit', compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => ["required", "min:2"],
            "miniature" => ["image"]
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->input("name");

        if($request->hasFile('miniature')) {

            $this->fileUpload->remove($category->img_path);
            $imgPath = $this->fileUpload->upload('miniature', $request->input("name"));

            if($imgPath) {
                $category->img_path = $imgPath;
            }
        }

        $category->save();

        return redirect()->route("categories.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $this->fileUpload->remove($category->img_path, "images");
        $category->delete();

        return redirect()->route('categories.index');
    }
}
