<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::latest()->paginate(5);
        return view('food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'foodname' => 'required|max:30',
            'foodprice' => 'required|integer',
            'foodcategory' => 'required',
            'foodimage' => 'required|mimes:png,jpg,jpeg'
        ]);

        $foodimage = $request->file('foodimage');
        $imagename = 'food-' . time() . '.' . $foodimage->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $foodimage->move($destinationPath, $imagename);

        Food::create([
            'name' => $request->get('foodname'),
            'description' => $request->get('fooddescription'),
            'price' => $request->get('foodprice'),
            'category_id' => $request->get('foodcategory'),
            'image' => $imagename,
        ]);

        return redirect()->route('food.index')->with('message', 'New food created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::find($id);
        return view('food.detail', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::find($id);
        return view('food.edit', compact('food'));
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
        $this->validate($request, [
            'foodname' => 'required|max:30',
            'foodprice' => 'required|integer',
            'foodcategory' => 'required',
            'foodimage' => 'mimes:png,jpg,jpeg'
        ]);

        $food = Food::find($id);
        $imagename = $food->image;

        if($request->hasFile('foodimage')) {
            $foodimage = $request->file('foodimage');
            $imagename = 'food-' . time() . '.' . $foodimage->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $foodimage->move($destinationPath, $imagename);
        }

        $food->name = $request->get('foodname');
        $food->description = $request->get('fooddescription');
        $food->price = $request->get('foodprice');
        $food->category_id = $request->get('foodcategory');
        $food->image = $imagename;
        $food->save();

        return redirect()->route('food.index')->with('message', $food->name . ' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect()->route('food.index')->with('message', $food->name . ' deleted successfully');
    }

    public function listFood() {
        $categories = Category::with('food')->get();
        return view('index', compact('categories'));
    }
}
