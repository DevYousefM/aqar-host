<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(["permission:articles_create,guard:admin"])->only(["create", "store"]);
        $this->middleware(["permission:articles_update,guard:admin"])->only(["edit", "update"]);
        $this->middleware(["permission:articles_read,guard:admin"])->only("index");
        $this->middleware(["permission:articles_delete,guard:admin"])->only("destroy");
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:150',
            'body' => 'required|string',
            'title_seo' => 'required|string|max:255',
            'image_alt' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'brief' => 'required|string|max:400',
        ]);
        if ($request->hasFile("image")) {
            $del_old = Storage::disk("public")->delete($article->image);
            if ($del_old) {
                $path = $request->file('image')->store('article_images', 'public');
            }
        }
        $updating = $article->update([
            "title" => $request->title,
            "title_seo" => $request->title_seo,
            "body" => $request->body,
            "image" => $path ?? $article->image,
            "image_alt" => $request->image_alt,
            "brief" => $request->brief
        ]);
        if (!$updating) {
            return redirect()->back()->with("message", "لم يتم تحديث المقال");
        }
        return redirect()->back()->with("success", "تم تعديل المقال");
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);
        Storage::disk("public")->delete($article->image);
        $article->delete();
        return redirect()->route("all.articles")->with("success", "تم حذف المقال");
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'title_seo' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'required|string|max:255',
            'brief' => 'required|string|max:400',
        ]);
        $path = $request->file('image')->store('article_images', 'public');
        $article = Article::create([
            "title" => $request->title,
            "title_seo" => $request->title_seo,
            "body" => $request->body,
            "image" => $path,
            "image_alt" => $request->image_alt,
            "brief" => $request->brief
        ]);
        if (!$article) {
            return redirect()->back()->with("message", "لم يتم اضافة المقال");

        }
        return redirect()->back()->with("success", "تم أضافة المقال وسوف يتم عرضه في صفحة اخبار العقارات");
    }

    public function create()
    {
        return view("dashboard.articles.create");
    }

    public function index()
    {
        $articles = Article::paginate(10);
        return view("dashboard.articles.show", ["articles" => $articles]);
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view("dashboard.articles.edit", compact("article"));
    }

    public function articles()
    {
        $articles = Article::paginate(10);
        $left_sliders = Slider::where("place", "left")->get();
        $right_sliders = Slider::where("place", "right")->get();
        return view("blog.articles", ["articles" => $articles, "left_sliders" => $left_sliders, "right_sliders" => $right_sliders]);
    }

    public function show_article($id)
    {
        $article = Article::findOrFail($id);
        $left_sliders = Slider::where("place", "left")->get();
        $right_sliders = Slider::where("place", "right")->get();
        return view("blog.show", compact("article", "left_sliders", "right_sliders"));
    }
}
