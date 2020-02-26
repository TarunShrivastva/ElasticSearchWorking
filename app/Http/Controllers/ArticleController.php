<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('id', '<', 200)->get();

//        $status = Article::createIndex($shards = 1, $replicas = 1);

//        $status = Article::putMapping($ignoreConflicts = true);

        $status = $articles->addToIndex();

        return $status;
    }

    public function search(Request $request)
    {
        $parameters = $request->route()->parameters();

        $articles = Article::searchByQuery(['match' => [$parameters['key'] => $parameters['value']]]);

        return $articles;
    }

}
