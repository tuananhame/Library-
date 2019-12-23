<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Cart;
use Datatables;
use Validator;
use Session;
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\MessageBag;

class ManageController extends Controller
{
    public function register()
    {
        if( Auth::check()){           
            return redirect()->route('home'); 
        }
    	return view('news.user.register');
    }
    public function list_borow()
    {
        $list_borow = DB::table('cart')->where('users_id', '=', Auth::user()->id)->get();
    	return view('news.user.list_borow', ['list_borow' => $list_borow]);
    }
	//
    public function postAdd(Request $request)
    {
    	if($request->ajax()){
			$user = Admin::where('username' , '=', $request->input('username'))->get();
			if(count($user) > 0) {
				return 'Tài khoản đã tồn tại';
			}else {
				$author = new Admin();
				$author->name = $request->input('name');
                $author->username = $request->input('username');
                $author->password =bcrypt($request->input('password'));
                $author->tid = 1;
                $author->status = 1;
				$author->created = time();			
				$author->save();
				Session::flash('register_success','Tài khoản đã được tạo thành công vui lòng đăng nhập để sử dụng');
				return 'ok';
			}
	    }
    }

    public function postLogin(Request $request)
    {
    	$rules = [
    		'username' => 'required',
    		'password' => 'required'
    	];

    	$msg = [
		    'username.required' => 'Tên đăng nhập không được bỏ trống.',
		    'password.required' => 'Mật khẩu không được bỏ trống.',
		];
	
    	$validator = Validator::make($request->all(), $rules , $msg);

    	if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } else {
        	$username = $request->input('username');
        	$password = $request->input('password');
        	
        	if( Auth::attempt(['username' => $username, 'password' => $password]) ){
        		return redirect()->route('home');
        	} else {
        		$msg = new MessageBag(['errlogin'=> 'Tên đăng nhập hoặc mật khẩu sai.']);
        		return redirect()->back()->withErrors($msg);
        	}
        }
    }
    
    public function getLogout()
    {
        if( Auth::check() ) Auth::logout();
        return redirect()->route('home');
	}
	
	public function getProfile()
    {
    	$user = Admin::find(Auth::user()->id);
    	return view('news.user.profile', ['user' => $user]);
	}
	public function profileUpdate(Request $request)
    {
        $rules= [
            'name'=>'required',
            ];

    	
    	$msg = [
    			'required'=>'Không được bỏ trống :attribute.',
    			];
		$validator = Validator::make($request->all(), $rules , $msg);

		if ($validator->fails()) {
		    return redirect()->back()
		                ->withErrors($validator)
		                ->withInput();
		} else {
			$profile = Admin::find(Auth::user()->id);
			$profile->name = $request->input('name');
            $profile->age = $request->input('age');
            $profile->email = $request->input('email');
            $profile->address = $request->input('address');
            $profile->phone = $request->input('phone');
	    	//Upload Image
	    	if($request->hasFile('img_post')){
	    		$file = $request->file('img_post');
	    		$file_extension = $file->getClientOriginalExtension(); // Lấy đuôi của file
	    		if($file_extension != 'png' && $file_extension != 'jpg' && $file_extension && 'jpeg'){
                    return redirect()->back()->with('errfile','Chưa hỗ trợ định dạng file vừa upload.')->withInput();
	    		}
	    		$file_name = $file->getClientOriginalName();
	    		$random_file_name = str_random(4).'_'.$file_name;
                $file->move('upload/profile',$random_file_name);
                $profile->image = $random_file_name;
	    	}
            
            $profile->save();
	    	Session::flash('flash_success','Thay đổi thành công.');
    		return redirect()->back();
		}
    }
    //borow book
    public function borow_book($id)
    {
    	$item = DB::table('products')->find($id);
    	return view('news.user.borow', ['item' => $item]);
    }

    public function add_cart(Request $request)
    {
        if($request->input('id') > 0) {
            $cart = new Cart();
            $cart->users_id = Auth::user()->id;
            $cart->products_id = $request->input('id');
            $cart->status = 0;
            $cart->date = $request->input('date');
            $cart->qty = $request->input('qty');
            $cart->created = time();
            $cart->save();
        }           
    	Session::flash('flash_success','Mượn sách thành công.');
    	return redirect()->route('user.list_borow');
    }
}
