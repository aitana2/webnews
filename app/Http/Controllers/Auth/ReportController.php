<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;
use App\Category;
use DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $news = DB::table('news')
        ->join('categories', 'news.categories_id', '=', 'categories.id')
        ->join('users', 'news.users_id', '=', 'users.id')
        ->where('news.users_id', $user->id)
        ->select('news.*', 'categories.description as categorydescription', 'users.name as user')
        ->get();
        
        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)
        ->orderBy('description', desc)
        ->get();

        return view('news.create', ['categories' =>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $report = new News;
        $report->title = $request->title;
        $report->description = $request->description;
        $report->image = "";
        $report->users_id = $user->id;
        $report->categories_id = $request->category;
        $report->status = $request->status;

        if($request->file('image')){
            $image = $request->file('image');
            $route = '/images/';
            $name = shal(Carbon::now()).'.'.$image->guessExtension();
            $image->move(getcwd().$route, $name);
            $news->image = $name;
        }
        $report->save();
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $news = DB::table('news')
        ->join('categories', 'news.categories_id', '=', 'categories.id')
        ->join('users', 'news.users_id', '=', 'users.id')
        ->where('news.users_id', $user->id)
        ->where('news.id', $id)
        ->select('news.*', 'categories.description as categorydescription', 'users.name as user')
        ->first();
        return view('news.show', ['report' => $report]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $report = DB::table('news')
        ->join('categories', 'news.categories_id', '=', 'categories.id')
        ->join('users', 'news.users_id', '=', 'users.id')
        ->where('news.users_id', $user->id)
        ->where('news.id', $id)
        ->select('news.*', 'categories.description as categoriesdescription', 'users.name as user')
        ->first();

        $categories = Category::where('status', 1)
        ->orderBy('description', 'desc')
        ->get();

        return view('news.edit', ['report' => $report, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $report = News::find($id);
        $report->title = $request->title;
        $report->description = $request->description;
        $report->users_id = $user->id;
        $report -> categories_id = $request->category;
        $report->status = $request->status;

        if($request->file('image')){
            $image = $request->file('image');
            $route='/images/';
            $name = shal(Carbon::now()).'.'.$image->guessExtension();
            $image->move(getcwd().$route, $name);
            $report->image = $name;
        }
        $news->save();
        return redirect()->route('news.show', ['id'=> $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);
        $report->delete();
        return redirect()->route('news.index');
    }
}
