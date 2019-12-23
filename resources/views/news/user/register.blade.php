!<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    </head>
    <body>
            <div class="cont">
              <div class="form sign-in">
                <h2>Chào mừng đã trở lại</h2>
                <div style="margin-left: 180px; font-size: 12px; color: red;">
                @if(count($errors)>0)
                    @foreach($errors->all() as $err)
                    {{ $err }}<br>
                    @endforeach
                @endif
                @if(session('register_success'))
                <div class="alert alert-success">
                    {{ session('register_success') }}
                </div>
                @endif
                </div>
                <form id="login" action="{!! URL::route('user.login') !!}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <label>
                  <span>Tài Khoản</span>
                  <input name="username" type="text" />
                </label>
                <label>
                  <span>Mật khẩu</span>
                  <input name="password" type="password" />
                </label>
                <p class="forgot-pass">Quên mật khẩu?</p>
                <a href="container.html"><button type="submit" class="submit">Đăng nhập</button></a>
                
                <button type="button" class="fb-btn">Đăng nhập bằng <span>facebook</span></button>
                </form>
              </div>
              <div class="sub-cont">
                <div class="img">
                  <div class="img__text m--up">
                    <h2>Bạn là người mới?</h2>
                    <p>Tạo tài khoản để tham gia thư viện cùng chúng mình nào!</p>
                  </div>
                  <div class="img__text m--in">
                    <h2>Bạn muốn tìm sách gì?</h2>
                    <p>Hãy đăng nhập ngay để tìm những cuốn sách mình thích nhé!</p>
                  </div>
                  <div class="img__btn">
                    <span class="m--up">Đăng ký</span>
                    <span class="m--in">Đăng nhập</span>
                  </div>
                </div>
                <div class="form sign-up">
					<form id="register">
						<h2>Có rất nhiều cuốn sách hấp dẫn chờ bạn ở đây đó ^^</h2>
						<label>
							<span>Tên</span>
							<input name="name" type="text" />
						</label>
						<label>
							<span>Tài khoản</span>
							<input name="username" type="text" />
						</label>
						<label>
							<span>Mật khẩu</span>
							<input name="password" type="password" />
						</label>
            <label>
							<span><p class="error" style="font-size: 12px; color: red;"></p></span>
						</label>						
						<button type="button" class="submit register">Đăng ký</button>
						<button type="button" class="fb-btn">Đăng ký bằng <span>facebook</span></button>
					</form>
                </div>
              </div>
			</div>
			<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('js/registration.js') }}"></script> 
			<script type="text/javascript">
				$(document).ready(function() {
					$('.register').click(() => {
						var name = $("#register input[name='name']").val();
						var username = $("#register input[name='username']").val();
						var password = $("#register input[name='password']").val();
						if(name !== '' && username !== '' && password !== '') {
              $.ajax({
                  url: '{!! URL::route('user.add') !!}',
                  type: 'PUT',
                  data: {"name": name, "username":username, "password": password, "_token": "{{ csrf_token() }}"},
                })
                .done(function(data) {
                  if(data == 'ok') {
                    window.location.href = '{!! URL::route('register') !!}';
                  }else {
                    $('.error').text(data);
                  }
                })
                .fail(function() {
                    console.log("error");
                })
            }else {
              $('.error').text('Vui lòng nhập đầy đủ thông tin');
            }
          });
				});
			</script> 
    </body>
</html>