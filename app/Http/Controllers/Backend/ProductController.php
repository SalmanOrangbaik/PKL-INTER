<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::latest()->get();

        $title = 'Hapus Data!';
        $text  = "Apakah Anda Yakin?";
        confirmDelete($title, $text);

        return view('backend.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product  = Product::all();
        $category = Category::all();
        return view('backend.product.create', compact('product', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'name'        => 'required|unique:categories',
            'category_id' => 'required',
            'price'       => 'required|numeric',
            'description' => 'required',
            'stock'       => 'required|numeric',
            'image'       => 'required|image|mimes:jpg,png',
        ]);

        $product              = new Product();
        $product->name        = $request->name;
        $product->slug        = Str::slug($request->name, '-');
        $product->category_id = $request->category_id;
        $product->price       = $request->price;
        $product->stock       = $request->stock;
        $product->description = $request->description;
        //upload gambar
        if ($request->hasFile('image')) {
            $file       = $request->file('image');
            $randomName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path       = $file->storeAs('products', $randomName, 'public');
            //memasukan nama imagenya ke database\
            $product->image = $path;
        }

        $product->save();
        toast('Data berhasil di simpan', 'success');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product  = Product::findOrFail($id);
        $category = Category::all();
        return view('backend.product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validasi
        $validated = $request->validate([
            'name'        => 'required|unique:categories',
            'category_id' => 'required',
            'price'       => 'required|numeric',
            'description' => 'required',
            'stock'       => 'required|numeric',
            // 'image'       => 'required|image|mimes:jpg,png',
        ]);

        $product              = Product::findOrFail($id);
        $product->name        = $request->name;
        $product->slug        = Str::slug($request->name, '-');
        $product->category_id = $request->category_id;
        $product->price       = $request->price;
        $product->stock       = $request->stock;
        $product->description = $request->description;
        //upload gambar
        if ($request->hasFile('image')) {
            //menghapus foto lama

            Storage::disk('public')->delete($product->image);

            //upload foto baru
            $file       = $request->file('image');
            $randomName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path       = $file->storeAs('products', $randomName, 'public');
            //memasukan nama imagenya ke database\
            $product->image = $path;
        }

        $product->save();
        toast('Data berhasil di simpan', 'success');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete($product->image);
        $product->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('product.index');
    }
}
