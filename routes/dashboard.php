<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\CompanyBannerController;
use App\Http\Controllers\Dashboard\CompanyPlansController;
use App\Http\Controllers\Dashboard\SingleServiceRequestController;
use App\Http\Controllers\Dashboard\SlideController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\SubscribeCompanyPlanController;
use App\Http\Controllers\Dashboard\UserPlansController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SearchRequestsController;
use App\Http\Controllers\UserPlansRequestsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::middleware('admin')->group(function () {
    Route::get("/", function () {
        $users = User::where("account_type", "personal")->get();
        return view("dashboard.users.show", ["users" => $users]);
    })->name("dashboard.admin");

    Route::get("/companies", [AdminController::class, "companies"])->name("admin.companies");
    Route::get('/export-companies', [
        AdminController::class,
        'exportCompanies'
    ])->name('export.companies');

    Route::get("/make-im/{id}", [AdminController::class, "make_important"])->name("make.important");
    Route::get("/make-un_im/{id}", [AdminController::class, "make_unimportant"])->name("make.un_important");

    Route::get("/slides", [SlideController::class, "show"])->name("show.slide");
    Route::get("/add-slide", [SlideController::class, "create"])->name("create.slide");
    Route::post("/store-slide", [SlideController::class, "store"])->name("store.slide");
    Route::get("/delete-slide/{id}", [SlideController::class, "destroy"])->name("delete.slide");
    Route::get("/edit-slide/{id}", [SlideController::class, "edit"])->name("edit.slide");
    Route::post("/update-slide/{id}", [SlideController::class, "update"])->name("update.slide");

    Route::get("/banners", [CompanyBannerController::class, "show"])->name("show.banner");
    Route::get("/add-banner", [CompanyBannerController::class, "create"])->name("create.banner");
    Route::post("/store-banner", [CompanyBannerController::class, "store"])->name("store.banner");
    Route::get("/delete-banner/{id}", [CompanyBannerController::class, "destroy"])->name("delete.banner");
    Route::get("/edit-banner/{id}", [CompanyBannerController::class, "edit"])->name("edit.banner");
    Route::post("/update-banner/{id}", [CompanyBannerController::class, "update"])->name("update.banner");

    Route::get("/sliders", [SliderController::class, "show"])->name("show.slider");
    Route::get("/add-slider", [SliderController::class, "create"])->name("create.slider");
    Route::post("/store-slider", [SliderController::class, "store"])->name("store.slider");
    Route::get("/delete-slider/{id}", [SliderController::class, "destroy"])->name("delete.slider");
    Route::get("/edit-slider/{id}", [SliderController::class, "edit"])->name("edit.slider");
    Route::post("/update-slider/{id}", [SliderController::class, "update"])->name("update.slider");

    Route::get("/properties", [PropertyController::class, "properties"])->name("admin.properties");
    Route::get("/delete-property/{id}", [PropertyController::class, "delete"])->name("delete.property");
    Route::get("/edit-property/{id}", [PropertyController::class, "edit"])->name("edit.property");
    Route::post("/update-property/{id}", [PropertyController::class, "update"])->name("update.property");
    Route::get("/toggle-special/{id}", [PropertyController::class, "toggle_special"])->name("toggle.property.special");
    Route::post("/update-seen/{id}", [PropertyController::class, "update_seen"])->name("update.seen");

    Route::get("/add-prop", [AdminController::class, "add_properties"])->name("add.properties.admin");
    Route::post("/store-prop", [AdminController::class, "store_property"])->name("store.properties.admin");

    Route::get("/users", [AdminController::class, "users"])->name("show.users");
    Route::get('/export-users', [
        AdminController::class,
        'exportUsers'
    ])->name('export.users');

    Route::get("/articles", [ArticleController::class, "index"])->name("all.articles");
    Route::get("/create-article", [ArticleController::class, "create"])->name("create.article");
    Route::post("/store-article", [ArticleController::class, "store"])->name("store.article");
    Route::get("/edit-article/{id}", [ArticleController::class, "edit"])->name("edit.article");
    Route::post("/update-article/{id}", [ArticleController::class, "update"])->name("update.article");
    Route::get("/delete-article/{id}", [ArticleController::class, "delete"])->name("delete.article");

    Route::get("/messages", [AdminController::class, "messages"])->name("all.messages");

    Route::get("/user-plans-requests", [UserPlansRequestsController::class, "index"])->name("all.user.plans.requests");
    Route::post("/accept-plans-requests/{id}", [UserPlansRequestsController::class, "accept_request"])->name("accept.user.plans.requests");
    Route::get("/current-subscriptions", [UserPlansRequestsController::class, "current_subscriptions"])->name("current.user.plans.requests");
    Route::post("/end-sub/{id}", [UserPlansRequestsController::class, "end_sub"])->name("end.user.plans.sub");
    Route::get("/expired-subscriptions", [UserPlansRequestsController::class, "expired_subscriptions"])->name("expired.subscriptions.user.plans");
    Route::post("/delete-req/{id}", [UserPlansRequestsController::class, "delete_req"])->name("delete.user.plans.sub");

    Route::get("/user-plans", [UserPlansController::class, "index"])->name("show.user.plans");
    Route::get("/edit-user-plan/{id}", [UserPlansController::class, "edit"])->name("edit.user.plans");
    Route::post("/update-user-plan/{id}", [UserPlansController::class, "update"])->name("update.user.plans");

    Route::get("/company-plan", [CompanyPlansController::class, "index"])->name("show.company.plans");
    Route::get("/add-company-plan", [CompanyPlansController::class, "create"])->name("create.company.plans");
    Route::post("/store-company-plan", [CompanyPlansController::class, "store"])->name("store.company.plans");
    Route::get("/edit-company-plan/{id}", [CompanyPlansController::class, "edit"])->name("edit.company.plans");
    Route::post("/update-company-plan/{id}", [CompanyPlansController::class, "update"])->name("update.company.plans");

    Route::get("/company-plans-requests", [SubscribeCompanyPlanController::class, "index"])->name("all.company.plans.requests");
    Route::post("/reject-request/{id}", [SubscribeCompanyPlanController::class, "reject_request"])->name("reject.company.request");
    Route::post("/activate-plan/{id}", [SubscribeCompanyPlanController::class, "activate_plan"])->name("activate.company.plan");
    Route::get("/active-plans", [SubscribeCompanyPlanController::class, "active_plans"])->name("active.company.plans");
    Route::post("/update-resources/{id}/{key}", [SubscribeCompanyPlanController::class, "update_resources"])->name("update.resources");
    Route::get("/stop-plans", [SubscribeCompanyPlanController::class, "must_stop"])->name("must.stop.company.plans");
    Route::post("/stop-plan/{id}", [SubscribeCompanyPlanController::class, "stop_plan"])->name("stop.company.plan");
    Route::get("/expired-plans", [SubscribeCompanyPlanController::class, "expired_plans"])->name("expired.stop.company.plans");

    Route::get("/single-service-requests", [SingleServiceRequestController::class, "index"])->name("all.single.service.requests");
    Route::post("/accept-single-service/{id}", [SingleServiceRequestController::class, "accept_request"])->name("accept.single.service.requests");
    Route::post("/reject-single-service/{id}", [SingleServiceRequestController::class, "reject_request"])->name("reject.single.service.requests");
    Route::get("/completed-single-service", [SingleServiceRequestController::class, "completed"])->name("completed.single.service.requests");

    Route::get("/search-request", [SearchRequestsController::class, "index"])->name("all.search_request");
});
Route::get("/login", [AdminController::class, "login"])->name("admin.login");


require __DIR__ . '/auth_admin.php';
