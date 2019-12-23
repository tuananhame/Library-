

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Trang chủ</title>
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
								<form action="{!! URL::route('user.add_cart') !!}" method="POST" accept-charset="utf-8">
									<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
									<input type="hidden" name="id" value="{{$item->id}}" />
									<tr>
										<td><a href=""><img src="{{ asset('upload/posts/' . $item->image_link) }}"  style="width: 45px; height: 50px;"></a></td>
										<td><a class="aa-cart-title" href="">{{$item->vn_name}}</a></td>
										<td><input disable name="qty" class="qty aa-cart-quantity" type="number" value="1"></td>
										<td>
											<select class="form-control"  name="date" id="">
												<option value="10">10 ngày</option>
												<option value="20">20 ngày</option>
												<option value="30">30 ngày</option>
											</select>
										</td>							
									</tr>
								</tbody>
								
							</table>
							</div>
													<!-- Cart Total view -->
							<div class="cart-view-total">
								<a href="{!! URL::route('home') !!}" class="btn">Tiếp tục xem</a>
								<button type="submit" class="btn">Hoàn tất</button>					
							</div>
						</form>

					</div>
					</div>
				</div>
				</div>
			</div>
		</section>		
</body>

