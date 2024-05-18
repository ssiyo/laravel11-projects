<?php

namespace App\Http\Controllers;

use League\CommonMark\CommonMarkConverter;

use App\Models\Article;
use App\Models\Interests;
use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd("index");
        $query = Article::query();
        if (!auth()->check() || !auth()->user()->is_admin) {
            $query->where("is_public", 1);
        }
        // Search articles with followed topics
        $interests = null;
        if (auth()->check()) {
            $interests = implode(',', Interests::where('user_id', auth()->user()->id)->pluck('topic')->toArray());
        }

        // Search by title
        if ($request->has('title')) {
            $query->where('title', 'like', "%{$request->get('title')}%");
        }

        // Search by topic
        $topic = null;
        $interested = null;

        if ($request->has('topics')) {
            $topics = explode(',', $request->get('topics'));
            if (count($topics) == 1){
                $topic = $topics[0];
                $interested = Interests::where("user_id", auth()->user()->id)->
                where("topic", $topic)->count() == 1;
            }

            $query->where(function ($query) use ($topics) {
                foreach ($topics as $t) {
                    $query->orWhere('topics', 'like', "%$t%");
                }
            });
        }

        // Search liked articles
        if ($request->has('liked')) {
            $query->whereHas('likes', function ($q) {
                $q->where('user_id', auth()->user()->id);
            });
        }

        // Pagination
        $articles = $query->orderBy('created_at', 'desc')->paginate(8)->appends($request->query());
        foreach($articles as $a){
            $a->description = Str::words($a->description, 30);
        }

        return view('index', compact('articles', 'topic', 'interested', 'interests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect(route("index"));
        }

        return view("article.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "topics" => ["required"],
            "thumbnail" => ["required", "image"],
        ]);

        $data["thumbnail"] = $request->file('thumbnail')->store('thumbnails', 'public');

        Article::create($data);

        return redirect(route('index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        if ($article->is_public == 0) {
            if (!auth()->check() || !auth()->user()->is_admin) {
                return view("index");
            }
        }

        $converter = new CommonMarkConverter();
        $article->content = $converter->convert($article->content ?? '');

        return view("article.show", compact('article'));
    }
    public function like(Int $article_id)
    {
        $liked = Likes::where('article_id', $article_id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($liked) {
            $liked->delete(); // If the like exists, delete it
        } else {
            Likes::create([
                "article_id" => $article_id,
                "user_id" => auth()->user()->id,
            ]);
        }

        return redirect(route("article.show", $article_id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view("article.edit", compact("article"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            "title" => ["required"],
            "description" => ["required"],
            "topics" => ["required"],
            "visible"=>'',
            "content" => '',
        ]);
        if (isset($data["visible"])) {
            $data["is_public"] = 1;
        } else {
            $data["is_public"] = 0;
        }
        
        $article->update($data);

        if (!empty($request->thumbnail)) {
            $tn = $request->validate(["thumbnail" => ["image"]]);
            $tn["thumbnail"] = $request->file('thumbnail')->store('thumbnails', 'public');
            $article->thumbnail = $tn["thumbnail"];
            $article->save();
        }

        if ($article->is_public) {
            return redirect(route("article.show", $article));
        } else {
            return redirect(route("index"));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect(route("index"));
    }
}
