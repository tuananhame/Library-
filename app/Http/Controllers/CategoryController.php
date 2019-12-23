<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Cart;
use App\Post;
use App\User;
use Session;
use Datatables;
use URL;

class CategoryController extends Controller
{
    public function getList()
    {
    	$cates = Category::all();
    	return view('admin.category.list',["cates"=>$cates]);
    }
    public function dataTable()
    { 
    	
    	$model = Cart::query();

    	return DataTables::eloquent($model)
                ->addColumn('book', function($model) {
					$book = Post::find($model->products_id);
                    return $book->vn_name;
				})
				->addColumn('user', function($model) {
					$user = User::find($model->users_id);
                    return $user->name;
				})
				->addColumn('created', function($model) {					
                    return date('d/m/Y', $model->created);
				})
				->addColumn('date', function($model) {					
                    return $model->date . ' ngày';
				})
				->addColumn('status', function($model) {					
                    return $model->status == 0 ? 'Đang mượn' : 'Đã trả sách';
                })
                ->addColumn('action', function($model) {					
                    return '<a href="'. URL::route("update_status", $model->id) .'" type="button" class="btn btn-info btn-sm delete" >
					<i class="fa fa-pencil-square-o delete" aria-hidden="true" id="delete"></i>  Cập nhật trạng thái
					</a>';
                })
                ->make(true);
    }

    public function update_status($id)
    {
		if($id > 0) {
            $cart = Cart::find($id);
            $cart->status =  !$cart->status;
            $cart->save();
		}
		return redirect()->route('category.list');
    }
}
