<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Service\FileUpload;
use App\Service\QueryManager;
use Illuminate\Http\Request;

class ProductController extends Controller
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
    public function index(QueryManager $queryManager)
    {
        $currentCategory = $queryManager->get("category");
        $category = $currentCategory ? Category::findOrFail($currentCategory) : null;
        $products = $currentCategory ? Product::where("category_id", $currentCategory)->paginate(15) :  Product::paginate(15);
        $categories = Category::all();

        return view('pages/admin/product/index', compact("products", "categories", "category", "currentCategory"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages/admin/product/create', compact("categories"));
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
            "miniature" => ["image", "required"],
            "name" => ["required", "string" ,"min:2"],
            "price" => ["required", "numeric", "min:0"],
            "stock" => ["required", "int", "min:0"],
            "description" => ["required", "string", "min:5"],
            "category_id" => ["required"]
        ]);

        Category::findOrFail($request->input("category_id"));
        $filename= $this->fileUpload->upload("miniature", $request->input("name"));

        if(!$filename) {
            return back()->withErrors(["customError" => "Error for uploading"]);
        }

        Product::create(array_merge($request->all(), ["img_path" => $filename]));

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view("pages/admin/product/show", compact("product", "categories"));
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
            "miniature" => ["image"],
            "name" => ["required", "string" ,"min:2"],
            "price" => ["required", "numeric", "min:0"],
            "stock" => ["required", "int", "min:0"],
            "description" => ["required", "string", "min:5"],
            "category_id" => ["required"]
        ]);

        Category::findOrFail($request->input("category_id"));

        $product = Product::findOrFail($id);
        $product->fill($request->all());

        if($request->hasFile("miniature")) {
            $this->fileUpload->remove($product->img_path);
            $filename = $this->fileUpload->upload("miniature", $request->input("name"));

            if(!$filename) {
                return back()->withErrors(["customError" => "Error for uploading"]);
            }

            $product->img_path = $filename;
        }

        $product->save();

        return redirect()->route('products.show', ['product' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}
