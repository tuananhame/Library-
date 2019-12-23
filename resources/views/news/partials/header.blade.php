<div id nav-bar>
			<a href="" id="logo"></a>
			<nav>
				<a href="#" id="menu-icon"></a>
				<ul>
					<li><a href="https://trithucvn.net/doi-song/10-ly-do-chung-ta-nen-doc-sach-moi-ngay.html">Về chúng tôi</a></li>
					<li><a href="https://www.facebook.com/anhhtuanvu">Liên hệ Admin</a></li>
					<li><a href="#Product">Thư viện sách</a></li>
					<?php 	
						$html = '';					
						if(Auth::check()) {
							$user = Auth::user();
							if($user->tid == 4) {
								$html = '<li><a href="admin">Admin</a></li>';
							}else{
								$html = '<li><a href="user/profile">'.$user->name.'</a><a href="'. URL::route("user.list_borow") .'">       Sách mượn</a>
								<a href="dangxuat">      Đăng xuất</a></li>';
							}
						}else {
							$html = '<li><a href="register">Đăng nhập</a></li>';
						}
						echo $html;
					?>
				</ul>
			</nav>
		</div>