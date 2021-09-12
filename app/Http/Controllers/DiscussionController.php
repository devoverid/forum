<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\Reaction;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
    {
        // params
        $query = $request->get('q', null);
        $tag = $request->get('tag', null);
        $perpage = $request->get('perpage', 10);
        $filter = $request->get('filter', null);

        // orm
        $discussions = Discussion::with([
            'user',
            'tags',
            'reactions',
        ])->withCount('comments');

        // hadlefilter
        $discussions = $this->handleFilter($filter, $discussions);

        // search
        if ($query != null) $discussions->where('title', 'LIKE', "%$query%");

        // filter tag
        if ($tag != null) $discussions->whereHas('tags', function ($q) use ($tag) {
            return $q->whereName($tag);
        });

        // pagination
        // dd($discussions->get()->toArray());
        $discussions = $discussions->simplePaginate($perpage);

        // final
        $discussions_reactions = $this->getReactions($discussions)[0];
        $user_reactions = $this->getReactions($discussions)[1];


        // show all tags
        $tags = Cache::remember('all_tag_in_discussion_tag', now()->addMinute(5), function () {
            $tags_id = DB::table('discussion_tags')->get()->pluck('tag_id')->flatten()->unique();
            return Tag::whereIn('id', $tags_id)->get();
        });

        // return
        return view('pages.discussion.index', compact('discussions', 'tags', 'discussions_reactions', 'user_reactions'));
    }

    /**
     * handleFilter
     *
     * @param  mixed $filter
     * @param  mixed $discussions
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function handleFilter($filter, $discussions)
    {

        // filter by this week
        if ($filter == 'popular_this_week')
        {
            $discussions->where('created_at', '>', Carbon::now()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->orderBy('view', 'desc');
        }

        // filter popular all time
        if ($filter == 'popular')
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

        // for
        if (in_array($filter, ['solved', 'unsolved', 'me']) || $filter == null)
        {
            $discussions->orderBy('created_at', 'desc');
        }


        // return obj
        return $discussions;
    }

    /**
     * Get reactions for discussion
     *
     * @param  mixed $discussions
     * @return void
     */
    private function getReactions($discussions)
    {
        $discussions = new Collection($discussions->toArray()['data']);

        //
        $discussionReactions = [];
        $userReaction = [];

        //
        foreach ($discussions as $discussion)
        {
            $user = Auth::user();
            $reactions = new Collection($discussion['reactions']);

            // // get all reaction for each discussion
            $upvote = $reactions->filter(function ($value, $key) use ($discussion) {
                return @$value['type'] == 'upvote';
            });
            $downvote = $reactions->filter(function ($value, $key) use ($discussion) {
                return @$value['type'] == 'downvote';
            });
            $votecount = count($upvote) - count($downvote);
            array_push($discussionReactions, (object) [
                'id' => $discussion,
                'vote' => $votecount
            ]);

            // get user reaction in discussion
            if ($user && $user != null) {
                $user_reaction = $reactions->filter(function ($value, $key) use ($user) {
                    return @$value['user_id'] == $user->id;
                });
                if (count($user_reaction) > 0) {
                    $react = $user_reaction->first();
                    array_push($userReaction, $react);
                } else {
                    array_push($userReaction, false);
                }
            }
        }

        //
        return [$discussionReactions, $userReaction];
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

    public function actions(Request $request)
    {
        $request->validate(['action' => 'required|in:upvote,downvote,unvote']);
        if (
            ($request->action == 'upvote') ||
            ($request->action == 'downvote') ||
            ($request->action == 'unvote')
        ) {
            $request->validate(['discussion_id' => 'required']);
            $discussion = Discussion::findOrFail($request->discussion_id);
            $hasReactionBefore = Reaction::where('user_id', auth()->user()->id)
                ->where('reactionable_id', $request->discussion_id)
                ->where('reactionable_type', 'App\Models\Discussion')
                ->first();

            if ($hasReactionBefore || $request->action == 'unvote') {
                $hasReactionBefore->delete();
                if ($request->action == 'unvote') {
                    return response()->json(['status' => 'success', 'message' => 'Unvote success']);
                }
            }

            if ($request->action == 'upvote' || $request->action == 'downvote') {
                $react = new Reaction([
                    'user_id' => auth()->user()->id,
                    'type' => $request->action
                ]);
                $discussion->reactions()->save($react);
            }
        }
    }

    /**
     * Set Best Answer Discussion
     */
    public function best_answer_set($discussion, Comment $comment)
    {
        $discussion = Discussion::whereSlug($discussion)->first();

        //
        if (!$discussion) return abort(404);

        //
        $update = $discussion->update(['best_answer' => $comment->id]);
        return redirect()->route('discussion.show', [$discussion->slug]);
    }

    /**
     * Delete Best Answer Discussion
     */
    public function best_answer_delete($discussion)
    {
        $discussion = Discussion::whereSlug($discussion)->first();

        //
        if (!$discussion) return abort(404);

        //
        $update = $discussion->update(['best_answer' => null]);
        return redirect()->route('discussion.show', [$discussion->slug]);
    }
}
