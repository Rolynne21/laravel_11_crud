<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
class ProductController extends Controller
{
 /**
 * Display a listing of the resource.
 */
 public function index() : View
 {
 $products = Product::latest()->paginate(10);
 return view('products.index', compact('products'));
 }


    /**
 * Show the form for creating a new resource.
 */
 public function create() : View
 {
 return view('products.create');
 }
 /**
 * Store a newly created resource in storage.
 */
 public function store(Request $request) : RedirectResponse
 {
 $request->validate([
 'code' => 'required',
 'name' => 'required',
 'quantity' => 'required|integer',
 'price' => 'required|numeric',
 'description' => 'nullable',
 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
 ]);

 $data = $request->only(['code', 'name', 'quantity', 'price', 'description']);

 if ($request->hasFile('image')) {
 $path = $request->file('image')->store('products', 'public');
 $data['image'] = $path;
 \Log::info('Image path:', [$path]);
 } else {
 $data['image'] = null;
 }

 \Log::info('Product data:', $data);

 Product::create($data);
 return redirect()->route('products.index')
 ->with('success', 'Product created successfully.');
 }
 /**
 * Display the specified resource.
 */
 public function show(Product $product) : View
 {
 return view('products.show', compact('product'));
 }
 /**
 * Show the form for editing the specified resource.
 */
 public function edit(Product $product) : View
 {
 return view('products.edit', compact('product'));
 }
 /**
 * Update the specified resource in storage.
 */
 public function update(Request $request, Product $product) : RedirectResponse
 {
 $request->validate([
 'code' => 'required',
 'name' => 'required',
 'quantity' => 'required|integer',
 'price' => 'required|numeric',
 'description' => 'nullable',
 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
 ]);

 $data = $request->only(['code', 'name', 'quantity', 'price', 'description']);

 if ($request->hasFile('image')) {
 $data['image'] = $request->file('image')->store('products', 'public');
 }

 $product->update($data);
 return redirect()->route('products.index')
 ->with('success', 'Product updated successfully');
 }
/**
* Remove the specified resource from storage.
*/
public function destroy(Product $product) : RedirectResponse
{
$product->delete();
return redirect()->route('products.index')
->with('success', 'Product deleted successfully');
}
}

