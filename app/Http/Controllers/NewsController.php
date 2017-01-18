<?php

    namespace App\Http\Controllers;

    use App\News;
    use Illuminate\Support\Facades\Config;
    use Illuminate\Http\Request;

    class NewsController extends Controller
    {
        public function index()
        {
            return view( 'admin.news.list' );
        }

        public function page( $id = 0 )
        {
            $pages    = Config::get( 'site.pages_show_news' );
            $all_news = News::count();
            $all_page = ceil( $all_news / $pages );
            $limit    = $id * $pages;
            $data     = News::select('id','header','create_date','created_at','publish_date','updated_at','status')->offset( $limit )->limit( $pages )->orderby( 'create_date', 'desc' )->get();

            return response()->json( [ 'data' => $data, 'pages' => $all_page ] );
        }

        public function edit( $id )
        {
            return view( 'admin.news.edit', [ 'id' => $id ] );
        }

        public function get( $id )
        {
            $data = News::where( 'id', $id )->first();
            $data->getAuthors();

            return response()->json( $data );
        }
    }
