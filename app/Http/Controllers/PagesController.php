<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\File;
use App\Tag;
use App\Admin;
use Auth;
class PagesController extends Controller
{
    public function getindex()
    {
        $query = Post::where('status','=',1);
        $vn_name = '';
        if(isset($_GET['vn_name']) && $_GET['vn_name'] != '') {
            $vn_name =  $_GET['vn_name'];
            $query->where('vn_name', 'like', '%'.$vn_name.'%');
        }
        $list_book = $query->get();

        return view('news.pages.home', ['list_book'=> $list_book]);
    }
    public function getContact()
    {
    	return view('news.pages.contact');
    }
}
