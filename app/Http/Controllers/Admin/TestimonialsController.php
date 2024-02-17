<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.testimonials_list', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        return view('admin.testimonials.add_testimonials');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'position' => 'required|max:255',
        'content' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $testimonial = new Testimonial();
    $testimonial->name = $request->name;
    $testimonial->position = $request->position;
    $testimonial->content = $request->content;
    $testimonial->published = $request->has('published');

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);
        $testimonial->image = $name;
    } else {
        // set a default image or display an error message
        $testimonial->image = 'default.jpg';
    }

    $testimonial->save();

    return redirect()->route('testimonials')->with('success', 'Testimonial added successfully.');
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
    public function edit(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit_testimonials', compact('testimonial'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'position' => 'required',
        'content' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $testimonial = Testimonial::findOrFail($id);
    $testimonial->name = $request->name;
    $testimonial->position = $request->position; // change designation to position
    $testimonial->content = $request->content;
    $testimonial->published = $request->published == 'on' ? 1 : 0;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('images');
        $image->move($destinationPath, $name);
        $testimonial->image = $name;
    }

    $testimonial->save();

    return redirect()->route('testimonials')->with('success', 'Testimonial updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
{
    $testimonial = Testimonial::findOrFail($id);
    $testimonial->delete();

    return redirect()->route('testimonials')->with('success', 'Testimonial deleted successfully.');
}

    public function restore($id)
{
    $testimonial = Testimonial::onlyTrashed()->findOrFail($id);
    $testimonial->restore();

    return redirect()->back()->with('success', 'Testimonial restored successfully.');
}

public function trashed()
{
    $testimonials = Testimonial::onlyTrashed()->get();

    return view('admin.testimonials.trashed', compact('testimonials'));
}

public function forceDelete($id)
{
    $testimonial = Testimonial::onlyTrashed()->findOrFail($id);
    $testimonial->forceDelete();

    return redirect()->back()->with('success', 'Testimonial permanently deleted.');
}

    
}
