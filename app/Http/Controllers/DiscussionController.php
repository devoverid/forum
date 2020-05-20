<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // params
        $query = request()->get('q', null);
        $tag = request()->get('tag', null);
        $perpage = request()->get('perpage', 10);
        $filter = request()->get('filter', null);

        // orm
        $discussions = Discussion::with('user', 'tags')
            ->orderBy('created_at', 'desc');

        // hadlefilter
        $discussions = $this->handleFilter($filter, $discussions);

        // search
        if ($query != null) $discussions->where('title', 'LIKE', "%$query%");


        // filter tag
        if ($tag != null) $discussions->whereHas('tags', function ($q) use ($tag) {
            return $q->whereName($tag);
        });

        // pagination
        $discussions = $discussions->simplePaginate($perpage);

        // show all tags
        $tags = Cache::remember('all_tag_in_discussion_tag', now()->addMinute(5), function () {
            $tags_id = DB::table('discussion_tag')->get()->pluck('tag_id')->flatten()->unique();
            return Tag::whereIn('id', $tags_id)->get();
        });

        // return
        return view('pages.discussion.index', compact('discussions', 'tags'));
    }

    public function handleFilter($filter, $discussions) 
    {

        // filter by this week
        if ($filter == 'popular_this_week')
        {
            $discussions->where('created_at', '>', Carbon::now()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->orderBy('view', 'desc');
        }

        // filter popular all time
        if ($filter == 'popular_this_week')
        {
            $discussions->orderBy('view', 'desc');
        }

        // filter solved
        if ($filter == 'solved')
        {
            $discussions->whereNotNull('solved_at');
        }

        // filter unsolved
        if ($filter == 'unsolved')
        {
            $discussions->whereNull('solved_at');
        }

        // filter me
        if ($filter == 'me' && auth()->check())
        {
            $discussions->whereUserId(auth()->user()->id);
        }


        // return obj
        return $discussions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('pages.discussion.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'tags' => 'required|array',
            'content' => 'required|min:10',
        ]);

        // 
        $slug = Str::slug($request->title . '-' . rand(1000,9999));

        // create
        $store = Discussion::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
        ]);

        // add tag - manytomany
        $store->tags()->attach($request->tags);

        // redirect
        return redirect()->route('discussion.show', [$slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $discussion = Discussion::whereSlug($slug)->first();

        // if not found, return 404
        if (!$discussion) abort(404);

        // save view to help statistic guest
        $discussion->increment('view');

        // return
        return view('pages.discussion.show', compact('discussion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // get
        $discussion = Discussion::whereSlug($slug)->first();

        // if set solved
        if (isset($_GET['set_solved'])) {
            if ($discussion->solved_at == null) $discussion->update(['solved_at' => Carbon::now()]);
            return redirect()->back();
        }

        // get
        $tags = Tag::all();

        // if not found, return 404
        if (!$discussion) abort(404);

        // 
        return view('pages.discussion.edit', compact('tags', 'discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // validate
        $request->validate([
            'title' => 'required|min:5|max:255',
            'tags' => 'required|array',
            'content' => 'required|min:10',
        ]);

        // get
        $discussion = Discussion::whereSlug($slug)->first();

        // if not found, return 404
        if (!$discussion) abort(404);

        // update
        $update = $discussion->update(
            $request->only('title', 'tags')
        );

        // add tag - manytomany
        $discussion->tags()->sync($request->tags);

        // redirect
        return redirect()->route('discussion.show', [$discussion->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $discussion = Discussion::whereSlug($slug)->first();

        // if not found, return 404
        if (!$discussion) return abort(404);

        // user must a writer to delete
        if ($discussion->user_id != auth()->user()->id) return abort(403);

        // delete
        $destroy = $discussion->delete();

        // return
        return redirect()->route('discussion.index');
    }
}
