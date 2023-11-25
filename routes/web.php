<?php

use App\Http\Controllers\CompanyProjectController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\SingleServiceRequestController;
use App\Http\Controllers\Dashboard\SubscribeCompanyPlanController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserPlansRequestsController;
use App\Http\Controllers\SearchRequestsController;
use App\Models\Property;
use App\Models\Slide;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function (Request $request) {
    $query = Property::query();

    if ($request->has('purpose') && !empty($request->purpose)) {
        $query->where('purpose', $request->input('purpose'));
    }

    if ($request->has('type') && !empty($request->type)) {
        $query->where('type', $request->input('type'));
    }

    if ($request->has('gov') && !empty($request->gov)) {
        $query->where('gov', $request->input('gov'));
    }

    if ($request->has('area') && !empty($request->area)) {
        $query->where('area', $request->input('area'));
    }

    if ($request->has('search') && !empty($request->search)) {
        $searchTerm = $request->input('search');
        $query->where(function ($innerQuery) use ($searchTerm) {
            $innerQuery->where('title', 'LIKE', "%$searchTerm%")
                ->orWhere('brief', 'LIKE', "%$searchTerm%");
        });
    }

    $ads = $query->orderBy('is_special', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(6);
    $slides = Slide::all();
    $left_sliders = Slider::where("place", "left")->get();
    $right_sliders = Slider::where("place", "right")->get();
    return view('welcome', ["ads" => $ads, "slides" => $slides, "left_sliders" => $left_sliders, "right_sliders" => $right_sliders]);
})->name("home");

Route::get('/companies', [FrontController::class, 'show_companies'])->name('companies.show');
Route::get('/im-property', [FrontController::class, 'im_property'])->name('im.property');
Route::get('/find-your-property', [SearchRequestsController::class, 'search_request_form'])->name('search_request_form.show');
Route::post('/store-request', [SearchRequestsController::class, 'store'])->name('store.request');
Route::get('/call-us', [FrontController::class, 'call_us'])->name('call.us');
Route::get('/company-profile/{name}', [FrontController::class, 'company_profile'])->name('company.profile');
Route::post('/send-message', [FrontController::class, 'send_message'])->name('send.message');
Route::get('/news', [ArticleController::class, 'articles'])->name('show.articles');
Route::get('/news/{id}', [ArticleController::class, 'show_article'])->name('show.single.article');
Route::get('/plans', [FrontController::class, 'plans'])->name('front.plans');
Route::get('/company-plans', [FrontController::class, 'company_plans'])->name('company.plans');
Route::get('/services', [FrontController::class, 'single_services'])->name('single.services');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/update-brief', [ProfileController::class, 'update_brief'])->name('update.brief');
    Route::post('/update-image', [ProfileController::class, 'update_image'])->name('image.update');

    Route::get('/user-profile', function () {
        return view('dashboard', ["properties" => auth()->user()->properties, "user_plans" => \App\Models\UserPlans::all()]);
    })->name("dashboard");
    Route::get('/add-property', [PropertyController::class, 'create'])->name('property.create');
    Route::post('/store-property', [PropertyController::class, 'store'])->name('property.store');

    Route::post("make-request", [UserPlansRequestsController::class, "store"])->name("make.property.request");
    Route::get("show-requests", [UserPlansRequestsController::class, "show_requests"])->name("show.property.request");
    Route::get("show-plans", [SubscribeCompanyPlanController::class, "show_plans"])->name("show.plans");

    Route::get("/projects", [CompanyProjectController::class, "index"])->name("show.projects");
    Route::get("/add-project", [CompanyProjectController::class, "create"])->name("add.project");
    Route::post("/store-project", [CompanyProjectController::class, "store"])->name("store.project");
    Route::get("/delete-project/{id}", [CompanyProjectController::class, "destroy"])->name("delete.project");

    Route::post("subscribe-plan", [SubscribeCompanyPlanController::class, "store"])->name("sub.company.plan");
    Route::post("subscribe-single-service/{id}", [SingleServiceRequestController::class, "subscribe_single_service"])->name("subscribe.single.service");

    Route::get('/property-reset/{id}', [PropertyController::class, 'reset'])->name('property.reset');
});
Route::get('/property/{id}/{name?}', [PropertyController::class, 'show'])->name('property.show');


require __DIR__ . '/auth.php';
