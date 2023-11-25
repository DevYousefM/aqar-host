<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:sliders_create,guard:admin"])->only(["create", "store"]);
        $this->middleware(["permission:sliders_update,guard:admin"])->only(["edit", "update"]);
        $this->middleware(["permission:sliders_read,guard:admin"])->only("show");
        $this->middleware(["permission:sliders_delete,guard:admin"])->only("destroy");
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view("dashboard.sliders.edit", ["slider" => $slider]);
    }

    public function update(Request $request, $id)
    {

        $slider = Slider::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'place' => 'required|string|in:right,left',
        ]);
        if ($request->hasFile('image')) {
            $old = Storage::disk("public")->delete($slider->path);
            if ($old) {
                $path = $request->file('image')->store('sliders', 'public');
            }
        }
        $slider->update([
            "name" => $request->name,
            "path" => $path ?? $slider->path,
            "place" => $request->place
        ]);
        return redirect()->route("show.slider")->with("success", "تم تعديل السلايدر");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'place' => 'required|string|in:right,left',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sliders', 'public');
        }
        $slider = Slider::create([
            "name" => $request->name,
            "path" => $path,
            "place" => $request->place
        ]);
        return redirect()->back()->with("success", "تم أضافة الأعلان الي السلايدر");
    }

    public function create()
    {
        return view("dashboard.sliders.create");
    }

    public function show()
    {
        $sliders = Slider::paginate(10);
        return view("dashboard.sliders.show", ["sliders" => $sliders]);
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        Storage::disk("public")->delete($slider->path);
        $slider->delete();
        return redirect()->route("show.slider")->with("success", "تم حذف الأعلان");
    }
}
