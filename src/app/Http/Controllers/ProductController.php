<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->query('keyword')) {
            $query->where('name','LIKE','%' . $request->query('keyword') . '%');
        }
        if ($request->query('select')) {
            $query->orderBy('price',$request->query('select'));
        }
        $products = $query->Paginate(6)->appends(request()->query());
        return view('products',compact('products'));
    }

    public function add()
    {
        $seasons = Season::all();
        return view('register',compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        $form = $request->all();
        if ($request->hasFile('image')) {
        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('product', $filename, 'public');
    }
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $filename
        ]);
        // $product->seasons()->attach($request->season);
        foreach ($request->season as $c) {
            DB::table('product_season')->insert([
            'product_id' => $product->id,
            'season_id' => $c,
            'created_at' => now(),
            'updated_at' => now()
            ]);

        };
        return redirect('/products');
    }

    public function edit($productId)
    {
        $product = Product::with('seasons')->find($productId);
        $seasons = Season::all();
        return view('edit',compact('product','seasons'));
    }

    public function update(UpdateRequest $request, $productId)
    {
        $product = Product::with('seasons')->find($productId);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
        if ($request->hasfile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('product',$filename,'public');
            $product->update(['image' => $filename]);
        }
        if ($request->has('seasons')) {
            $product->seasons()->sync($request->seasons);
        }
        return redirect('/products');
    }
    public function destroy(Request $request)
    {
        Product::with('seasons')->find($request->id)->delete();
        return redirect('/products');
    }
}