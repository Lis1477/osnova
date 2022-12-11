<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // берем товары
        $products = Product::orderBy('name')->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // берем категории
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // валидация
        $this->validate($request, [
            'name' => 'string | required',
            'category_id' => 'numeric | integer | required',
            'price' => 'numeric | required',
        ]);

        // записываем
        Product::create($request->all());

        return redirect('products')->with('success', 'Товар создан успешно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // берем товар
        $data['product'] = Product::find($id);

        // берем категории
        $data['categories'] = Category::all();

        return view('products.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // валидация
        $this->validate($request, [
            'name' => 'string | required',
            'category_id' => 'numeric | integer | required',
            'price' => 'numeric | required',
        ]);

        // обновляем
        Product::where('id', $id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
        ]);

        return redirect('products')->with('success', 'Товар "'.$request->name.'" обновлен успешно!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // удаляем
        Product::where('id', $id)->delete();

        return redirect('products')->with('success', 'Товар удален!');
    }
}
