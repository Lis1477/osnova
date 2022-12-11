<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       // берем категории
        $categories = Category::all();

        if (isset($request->includeProducts) && $request->includeProducts == 1) {

            // берем все товары
            $products = Product::all();

            // собираем коллекцию категорий с товарами
            $collect = new Collection;

            // берем все товары
            foreach ($categories->where('parent_id', 0) as $category) {

                // берем товары категории
                $cat_prods = $products->where('category_id', $category->id);

                // добавляем в коллекцию категорию и ее товары

                $collect->push([
                    'name' => $category->name,
                    'products' => $cat_prods,
                ]);

                // 2 уровень
                foreach ($categories->where('parent_id', $category->id) as $sub_cat) {

                    // берем товары категории
                    $sub_cat_prods = $products->where('category_id', $sub_cat->id);

                    // добавляем в коллекцию категорию и ее товары

                    $collect->push([
                        'name' => $sub_cat->name,
                        'products' => $sub_cat_prods,
                    ]);

                    // 3 уровень
                    foreach ($categories->where('parent_id', $sub_cat->id) as $sub_sub_cat) {

                        // берем товары категории
                        $sub_sub_cat_prods = $products->where('category_id', $sub_sub_cat->id);

                        // добавляем в коллекцию категорию и ее товары

                        $collect->push([
                            'name' => $sub_sub_cat->name,
                            'products' => $sub_sub_cat_prods,
                        ]);
                    }
                }
            }

            $categories = $collect;

            $view = 'categories.all_cat_prods';

        } else {
            $view = 'categories.index';
        }

        return view($view, compact('categories'));
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

        return view('categories.create', compact('categories'));
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
            'parent_id' => 'numeric | integer | required',
        ]);

        // записываем
        Category::create($request->all());

        return redirect('categories')->with('success', 'Категория создана успешно!');
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
        // берем категорию
        $data['category'] = Category::find($id);

        // берем категории
        $data['categories'] = Category::all();

        return view('categories.edit')->with($data);
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
            'parent_id' => 'numeric | required',
        ]);

        // обновляем
        Category::where('id', $id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect('categories')->with('success', 'Категория "'.$request->name.'"" обновлена успешно!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function categoryProducts(Request $request, $id)
    {
        if (isset($request->includeProducts) && $request->includeProducts == 1) {
            // берем категорию
            $category = Category::find($id);
            $data['category'] = $category->name;

            // берем товары категории
            $products = Product::where('category_id', $category->id)->get(['name']);
            $data['products'] = $products;

            return view('categories.cat_prods')->with($data);
        } else {
            return "Неверный параметр";
        }
    }

    public function products(Request $request, $id)
    {

        if (isset($request->includeChildren) && $request->includeChildren == 1) {

            // собираем коллекцию категорий с товарами
            $collect = new Collection;

            // берем категорию
            $category = Category::where('id', $id)->first(['id', 'name']);

            // если есть
            if ($category) {

                // берем товары категории
                $cat_prods = Product::where('category_id', $category->id)->get();

                // добавляем в коллекцию категорию и ее товары
                $collect->push([
                    'name' => $category->name,
                    'products' => $cat_prods,
                ]);

                // берем дочернюю категорию
                $sub_cats = Category::where('parent_id', $category->id)->get(['id', 'name']);

                // если есть
                if ($sub_cats->count()) {

                    foreach ($sub_cats as $sub_cat) {

                        // берем товары категории
                        $sub_cat_prods = Product::where('category_id', $sub_cat->id)->get();

                        // добавляем в коллекцию категорию и ее товары

                        $collect->push([
                            'name' => $sub_cat->name,
                            'products' => $sub_cat_prods,
                        ]);

                        // берем дочернюю категорию
                        $sub_sub_cats = Category::where('parent_id', $sub_cat->id)->get();

                        // если есть
                        if ($sub_sub_cats->count()) {
                            foreach ($sub_sub_cats as $sub_sub_cat) {

                                // берем товары категории
                                $sub_sub_cat_prods = Product::where('category_id', $sub_sub_cat->id)->get(['name', 'price']);

                                // добавляем в коллекцию категорию и ее товары

                                $collect->push([
                                    'name' => $sub_sub_cat->name,
                                    'products' => $sub_sub_cat_prods,
                                ]);
                            }
                        }
                    }
                }
            }

            $categories = $collect;

            return view('categories.child_prods', compact('categories'));

        } else {

            // берем товары категории
            $products = Product::where('category_id', $id)->get(['name']);
     
            return view('categories.prods', compact('products'));
        }
    }
}
