@extends('news.layout.layout')

@section('content')
	@include('news.partials.about')
<section><a name="Product"></a>
				<h1 align="center">Ở đây chúng mình có gì?</h1>
				<p>Sách là nguồn tri thức vô tận. Hãy chia sẻ những cuốn sách hay của bạn cho mọi người và cùng nhau kết
					bạn tại đây nhé ^^</p>
					<form action="" method="GET">
					<input type="text" id="search-bar" name="vn_name" value="Bạn muốn tìm sách gì?"
						onfocus="if (this.value=='Bạn muốn tìm sách gì?') this.value='';" />
						<button type="submit">Tìm kiếm</button>
					</form>
				<div class="merch-sell">
					<?php if(isset($list_book)) { ?>
						@foreach($list_book as $item)
						<div class="greenl"><img
								src="{{ asset('upload/posts/' . $item->image_link) }}" width="200"
								height="250">
							<p>{{ $item->vn_name }}</p>
							<a id="connect" href="{!! URL::route('user.borow_book',$item->id) !!}">Liên hệ mượn</a>
						</div>
						@endforeach	
					<?php }else {echo 'Dữu liệu đang cập nhật';} ?>				
				</div>
			</section>
@endsection

