<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyBannerController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:banners_read,guard:admin"])->only("show");
        $this->middleware(["permission:banners_update,guard:admin"])->only(["edit", "update"]);
        $this->middleware(["permission:banners_create,guard:admin"])->only(["create", "store"]);
        $this->middleware(["permission:banners_delete,guard:admin"])->only("destroy");
    }


    public function show()
    {
        $banners = CompanyBanner::paginate(10);
        return view("dashboard.banners.show", ["banners" => $banners]);
    }

    public function edit($id)
    {
        $banner = CompanyBanner::findOrFail($id);
        return view("dashboard.banners.edit", ["banner" => $banner]);
    }

    public function update(Request $request, $id)
    {

        $banner = CompanyBanner::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $old = Storage::disk("public")->delete($banner->path);
            if ($old) {
                $path = $request->file('image')->store('banners', 'public');
            }
        }
        $banner->update([
            "name" => $request->name,
            "path" => $path ?? $banner->path,
        ]);
        return redirect()->route("show.banner")->with("success", "تم تعديل الأعلان");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
        }
        CompanyBanner::create([
            "name" => $request->name,
            "path" => $path,
        ]);
        return redirect()->back()->with("success", "تم اضافة البانر");
    }

    public function create()
    {
        return view("dashboard.banners.create");
    }

    public function destroy($id)
    {
        $banner = CompanyBanner::findOrFail($id);
        Storage::disk("public")->delete($banner->path);
        $banner->delete();
        return redirect()->route("show.banner")->with("success", "تم حذف اعلان البانر");
    }
}
