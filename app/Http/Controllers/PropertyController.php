<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:properties_update,guard:admin"])->only(["update_seen", "update", "edit", "toggle_special"]);
        $this->middleware(["permission:properties_read,guard:admin"])->only("properties");
        $this->middleware(["permission:properties_delete,guard:admin"])->only("delete");
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $user_subs = null;
        if (!empty(auth()->user()->company_plans_sub)) {
            $user_subs = $user->company_plans_sub->where("status", "active")->first();
        }
        if (!empty($user_subs) && $user_subs->remaining_properties > 0) {
            $this->store_property($request, $user);
            $user_subs->update([
                "remaining_properties" => $user_subs->remaining_properties - 1
            ]);
            return redirect()->route("property.create")->with("success", "تم اضافة العقار وسيتم عرضه في صفحة الأعلانات");
        }
        if ($user->property_charge > 0) {
            $this->store_property($request, $user);
            $user->update([
                "property_charge" => $user->property_charge - 1,
            ]);
            return redirect()->route("property.create")->with("success", "تم اضافة العقار وسيتم عرضه في صفحة الأعلانات");
        }
        return redirect()->back()->with("error", "لا يمكنك اضافة اعلانات اكثر");
    }

    protected function store_property(Request $request, $user)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'brief' => 'required|string',
            'type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255|in:بيع,شراء,ايجار',
            'gov' => 'required|numeric|exists:governments,id',
            'area' => 'required|string|max:255',
            'level' => 'nullable',
            'rooms' => 'nullable|integer|min:1',
            'meters' => 'required|numeric|min:1',
            'payment' => 'nullable|in:كاش,قسط',
            'price' => 'required_if:payment,كاش',
            'presenter' => 'required_if:payment,قسط',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=1300,max_width=1700,min_height=400,max_height=600,ratio=16/5',
        ]);
        if (!empty($request->price)) {
            $request->validate([
                'price' => 'required_if:payment,كاش|integer|max_digits:20',
            ]);
        }
        if (!empty($request->presenter)) {
            $request->validate([
                'presenter' => 'required_if:payment,قسط|integer|max_digits:11',
            ]);
        }
        // Create a new property instance
        $property = Property::create([
            "user_id" => $user->id,
            'title' => $request->title,
            'brief' => $request->brief,
            'type' => $request->type,
            'purpose' => $request->purpose,
            'gov' => $request->gov,
            'area' => $request->area,
            'level' => $request->level,
            'rooms' => $request->rooms,
            'meters' => $request->meters,
            'payment' => $request->payment,
            'presenter' => $request->presenter,
            'price' => $request->price,
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('property_images', $image, $filename);

                $propertyImage = new PropertyImage([
                    'property_id' => $property->id,
                    'path' => $filename,
                ]);

                $propertyImage->save();
            }
        }
        if ($request->has("is_special")) {
            $user_subs = $user->company_plans_sub->where("status", "active")->first();
            if ($user_subs->remaining_special > 0) {
                $user_subs->update([
                    "remaining_special" => $user_subs->remaining_special - 1
                ]);
            }
            $property->update([
                "is_special" => true
            ]);
        }
    }

    public function create()
    {

        return view("property.add");
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'brief' => 'required|string',
        ]);
        $property->update([
            'title' => $request->title ?? $property->title,
            'brief' => $request->brief ?? $property->brief,
        ]);
        return redirect()->route("admin.properties")->with("success", "تم تعديل العقار وسيتم عرضه في صفحة الأعلانات");
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        $slides = Property::latest()->take(6)->get();
        $property->update(["seen" => $property->seen + 1]);
        return view("property.show", compact("property", "slides"));
    }

    public function properties(Request $request)
    {
        $timeRange = $request->timeRange;
        $ranges = [
            "7days",
            "15days",
            "1month",
            "3months",
            "1year"
        ];
        if ($timeRange && in_array($timeRange, $ranges)) {
            $properties = $this->filterPropertiesByTimeRange($timeRange);
        } else {
            $properties = Property::all();
        }
        return view("dashboard.properties.show", ["properties" => $properties]);
    }
    protected function filterPropertiesByTimeRange($timeRange)
    {
        $startDate = Carbon::now();

        switch ($timeRange) {
            case '7days':
                $startDate->subDays(7);
                break;
            case '15days':
                $startDate->subDays(15);
                break;
            case '1month':
                $startDate->subMonth();
                break;
            case '3months':
                $startDate->subMonths(3);
                break;
            case '1year':
                $startDate->subYear();
                break;
        }
        return Property::where('created_at', '>=', $startDate)->get();
    }
    public function delete($id)
    {
        $property = Property::findOrFail($id);
        foreach ($property->images as $img) {
            Storage::disk("public")->delete("property_images/" . $img->path);
        }
        $property->delete();
        return redirect()->back()->with("success", "تم حذف العقار");
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view("dashboard.properties.edit", compact("property"));
    }

    public function toggle_special($id)
    {
        $property = Property::findOrFail($id);
        $property->update([
            "is_special" => !($property->is_special),
        ]);
        return redirect()->back()->with("success", "تم تحديث حالة الاعلان");
    }

    public function reset($id)
    {
        $property = Property::findOrFail($id);
        if (auth()->user()->id !== $property->user->id) {
            abort(404);
        }
        $property->update(["created_at" => Carbon::now()]);
        return redirect()->back();
    }
    public function update_seen(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        if (is_numeric($request->seen)) {
            $property->update([
                "seen" => $request->seen
            ]);
        }
        return redirect()->back();
    }
}
