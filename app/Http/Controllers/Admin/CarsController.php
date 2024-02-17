<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car ;
use Illuminate\Validation\Validator;
use Illuminate\Contracts\Validation\Factory as ValidatorFactory;
use App\Models\Category ;




class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::get();
        return view('admin.cars.cars_list',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.cars.add_cars',compact('categories'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ValidatorFactory $validator)
    {
        $messages = $this->messages();

        $validator = $validator->make($request->all(), [
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'image'=> 'required|mimes:png,jpg,jpeg|max:2048',
            'price' => 'required|numeric',
            'Luggage' => 'required|numeric',
            'Doors' => 'required|numeric',
            'Passenger' => 'required|numeric',
            'category_id' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect('cars')
                ->withErrors($validator)
                ->withInput();
        }

        $fileName = $this->uploadFile($request->image, 'assets/images');

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $fileName,
            'price' => $request->input('price'),
            'Luggage' => $request->input('Luggage'),
            'doors' => $request->input('doors'),
            'passenger' => $request->input('passenger'),
            'published' => $request->has('published'),
        ];

        Car::create($data);

        return redirect('cars');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function messages()
    {
      return [
        'title.required' => ' title is required',
        'title.string' => 'title should be string',
        'description.required' => 'description is required',
        'image.required' => 'please sure to upload an mage',
        'image.mimes' => 'incorrect image type',
        'image.max' => 'Max file size exceeded',
        'price.required' => 'price is required',
        'price.numeric' => ' price should be a number',
        'Luggage.required' => 'luggage is required',
        'Luggage.numeric' => 'luuugage should be a number',
        'doors.required' => ' doors is required',
        'doors.numeric' => ' doors should be a number',
        'passenger.required' => ' passenger is required',
        'passenger.numeric' => 'passenger should be a number',

      ];
    }
}
