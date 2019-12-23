

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sách mượn</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{ asset('css/container.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	
</head>

<body>
<section id="cart-view">
			<div class="container">
				<div class="row">
				<div class="col-md-12">
					<div class="cart-view-area">
					<div class="cart-view-table">
						<div class="table-responsive">
						<h1>Danh sách sách mượn</h1>
							<table class="table">
								<thead>
								<tr>
									<th>Ảnh</th>
									<th>Tên sách</th>									
									<th>Số lượng</th>
									<th>Thời gian</th>
								</tr>
								</thead>								
								<tbody>
								<?php if(count($list_borow) > 0) { ?>
									@foreach($list_borow as $item)
									<tr>
										<td><a href=""><img src="{{ asset('upload/posts/' . DB::table('products')->find($item->products_id)->image_link) }}"  style="width: 45px; height: 50px;"></a></td>
										<td><a class="aa-cart-title text-left" href="">{{ DB::table('products')->find($item->products_id)->vn_name }}</a></td>
										<td><input disable name="qty" class="qty aa-cart-quantity" type="number" value="{{ $item->qty}}"></td>
										<td>{{ $item->date}} ngày</td>							
									</tr>
									@endforeach
								<?php }else {echo 'Không có sách mượn';} ?>
								</tbody>
								
							</table>
							</div>
													<!-- Cart Total view -->
							<div class="cart-view-total">
								<a href="{!! URL::route('home') !!}" class="btn">Tiếp tục xem</a>			
							</div>

					</div>
					</div>
				</div>
				</div>
			</div>
		</section>		
</body>

