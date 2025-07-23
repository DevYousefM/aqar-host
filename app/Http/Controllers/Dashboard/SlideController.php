<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:slides_create,guard:admin"])->only(["create", "store"]);
        $this->middleware(["permission:slides_update,guard:admin"])->only(["edit", "update"]);
        $this->middleware(["permission:slides_read,guard:admin"])->only("show");
        $this->middleware(["permission:slides_delete,guard:admin"])->only("destroy");
    }

    public function edit($id)
    {
        $slide = Slide::findOrFail($id);
        return view("dashboard.slides.edit", ["slide" => $slide]);
    }

    public function update(Request $request, $id)
    {

        $slide = Slide::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->delete_date) {
            $request->validate([
                "delete_date" => ["date", "after:" . Carbon::today()->toDateString()]
            ]);
        }
        if ($request->hasFile('image')) {
            $old = Storage::disk("public")->delete($slide->path);
            if ($old) {
                $path = $request->file('image')->store('slides', 'public');
            }
        }
        $slide->update([
            "name" => $request->name,
            "path" => $path ?? $slide->path,
            "delete_date" => $request->delete_date ?? null
        ]);
        return redirect()->route("show.slide")->with("success", "تم تعديل الأعلان");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->delete_date) {
            $request->validate([
                "delete_date" => ["date", "after:" . Carbon::today()->toDateString()]
            ]);
        }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('slides', 'public');
        }
        $slide = Slide::create([
            "name" => $request->name,
            "path" => $path,
            "delete_date" => $request->delete_date ?? null
        ]);
        return redirect()->back()->with("success", "تم أضافة الأعلان");
    }

    public function create()
    {
        return view("dashboard.slides.create");
    }

    public function show()
    {
        $slides = Slide::paginate(10);
        return view("dashboard.slides.show", ["slides" => $slides]);
    }

    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);
        Storage::disk("public")->delete($slide->path);
        $slide->delete();
        return redirect()->route("show.slide")->with("success", "تم حذف الأعلان");
    }
}
