<?php

namespace App\Http\Controllers;

use App\Models\CompanyProject;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware("company");
    }

    public function index()
    {
        $projects = auth()->user()->company_projects;
        return view("pages.company_projects", ["projects" => $projects]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'عنوان المشروع مطلوب',
            'title.max' => 'عنوان المشروع يجب ألا يتجاوز 100 حرفًا',
            'images.required' => 'صور المشروع مطلوبة',
            'images.min' => 'يجب تحميل ملف صورة واحد على الأقل',
            'images.*.image' => 'الملف المرفق ليس صورة صالحة',
            'images.*.mimes' => 'الصور يجب أن تكون من نوع jpeg، png، jpg، أو gif',
            'images.*.max' => 'حجم كل صورة يجب أن لا يتجاوز 2 ميجابايت',
        ]);
        $project = CompanyProject::create([
            "title" => $request->title,
            "user_id" => auth()->user()->id
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('project_images', $image, $filename);

                $propertyImage = new ProjectImage([
                    'company_project_id' => $project->id,
                    'image' => $filename,
                ]);

                $propertyImage->save();
            }
        }
        return redirect()->back()->with("success", 'تم أاضافة المشروع بنجاح');
    }

    public function create()
    {
        return view("pages.add-project");
    }

    public function destroy($id)
    {
        $project = CompanyProject::findOrFail($id);
        foreach ($project->images as $img) {
            Storage::disk("public")->delete("project_images/" . $img->image);
        }
        $project->delete();
        return redirect()->back()->with("success", "تم حذف المشروع");
    }
}
