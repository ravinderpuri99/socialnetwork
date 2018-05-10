<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Auth;
use DB;  //for query builder

class ArticlesController extends Controller
{
    
    public function index()
    {

        //$articles = Article::withTrashed()->paginate(10); //will show all the records including soft deleted ones.

        //$articles = Article::onlyTrashed()->paginate(10);
        
        //$articles = Article::all();  //Eloquent
        //$articles = Article::whereLive(1)->get();  //Eloquent

        $articles = Article::whereLive(1)->paginate(10);

        //$articles = DB::table('articles')->get();  //Query Builder
        //$articles = DB::table('articles')->whereLive(1)->first();  //get first matching record 
        
        //$articles = DB::table('articles')->whereLive(1)->paginate(10);

        //dd($articles);  uses to return single record

        //return $articles;

        return view('articles.index', compact('articles'));
    }

    
    public function create()
    {
        return view('articles.create');
    }


    public function store(Request $request)
    {
        /*
        $article = new Article();

        $article->user_id = Auth::user()->id;
        $article->content = $request->content;
        $article->live = (boolean)$request->live;
        $article->post_on = $request->post_on;

        $article->save();
        */

        Article::create($request->all());  //if table columns and input field's names are same


        //DB::table('articles')->insert($request->except('_token'));  //Query Builder to insert data into table

        // Query Builder is fatser than as compare to Eloquent

        //if you have different names of columns in your db tables
       /* Article::create([
                'user_id' => Auth::user()->id,
                'content' => $request->content,
                'live' => $request->live,
                'post_on' => $request->post_on
            ]);
        */

        return redirect('/articles');
    }

    
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        if(!isset($request->live))
            $article->update(array_merge($request->all(), ['live' => false]));
        else
            $article->update($request->all());

        return redirect('/articles');
    }

    
    public function destroy($id)
    {
        //$article = Article::findOrFail($id);
        //$article->delete();
        //$article->forceDelete();

        Article::destroy($id);

        return redirect('/articles');
    }

    public function restore($id)
    {
        $article = Article::findOrFail($id);
        $article->restore();
    }
}
