@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
 شاشة المنتجات
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الإعــدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المنتجات</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection


@section('content')

			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif


		@if (session()->has('Add'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>{{ session()->get('Add') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif


		@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('edit') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('Error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



			<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<!-- <h4 class="card-title mg-b-0">إنشاء منتج جديد</h4> -->
									<div class="col-sm-6 col-md-4 col-xl-3">
									<h4 class="card-title mg-b-0">جدول المنتجات</h4>
									<br>




									<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إنشاء منتج جديد</a>
									</div>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>

							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم المنتج</th>
												<th class="border-bottom-0">اسم القسم</th>
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0">العمليات</th>

											</tr>
										</thead>
										<tbody>
										<?php $i = 0 ?>
										@foreach ($pro as $product)
										   <?php $i+=1 ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$product->product_name}}</td>
												<td>{{$product->sect->section_name}}</td>
												<td>{{$product->description}}</td>
												<td>
													<button class="btn btn-outline-success btn-sm"
                                                    data-name="{{ $product->product_name }}" data-pro_id="{{ $product->id }}"
                                                    data-section_name="{{ $product->sect->section_name }}"
                                                    data-description="{{ $product->description }}" data-toggle="modal"
                                                    data-target="#edit_Product">تعديل</button>

													<button class="btn btn-outline-danger btn-sm " data-pro_id="{{ $product->id }}"
													data-product_name="{{ $product->product_name }}" data-toggle="modal"
													data-target="#modaldemo9">حذف</button>
												</td>
											</tr>
										@endforeach

										</tbody>
									</table>
								</div>
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->

					<!--div-->
					<!-- Basic modal -->
				<!-- Create -->
	<div class="modal" id="modaldemo8">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">إضافة منتج جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
				<div class="modal-body">
					<form action ="{{route('products.store')}}" method="post" autocomplete="off">
						{{csrf_field()}}
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">إسم المنتج</label>
							<input type="text" class="form-control" id="product_name" name="product_name"placeholder="المنتج" required>
						</div>
						 <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            <select name="section_id" id="section_id" class="form-control" required>
                                <option value="" selected disabled> --حدد القسم--</option>
								@foreach ($sec as $section )
								<option value={{$section->id}}>{{$section->section_name}}</option>
								@endforeach

                            </select>
						<div class="mb-3">
							<label for="exampleFormControlTextarea1" class="form-label">الوصف</label>
							<textarea class="form-control" id="description" name="description" rows="3"></textarea>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">تأكيد</button>
							<button type="button" class="btn ripple btn-secondary" data-dismiss="modal">إلغاء</button>
						</div>
					</form>
			</div>
		</div>
	 </div>
	</div>

	<!-- edit -->
		<div class="modal" id="edit_Product">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">تعديل منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
				<div class="modal-body">
					<form action ="products/update" method="post" autocomplete="off">
						{{method_field('patch')}}
						{{csrf_field()}}
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">إسم المنتج</label>

							<input type="hidden"  id="pro_id" name="pro_id">

							<input type="text" class="form-control" name="Product_name" id="Product_name">



						</div>
						 <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            <select name="section_name" id="section_name" class="form-control" required>
								@foreach ($sec as $section )
								<option>{{$section->section_name}}</option>
								@endforeach

                            </select>
						<div class="mb-3">
							<label for="exampleFormControlTextarea1" class="form-label">الوصف</label>
							<textarea class="form-control" id="description" name="description" rows="3"></textarea>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">تأكيد</button>
							<button type="button" class="btn ripple btn-secondary" data-dismiss="modal">إلغاء</button>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>
		<!-- End Basic modal -->

    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="products/destroy" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="pro_id" id="pro_id" value="">
                        <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>

            </form>
        </div>
    </div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>


    <script>
        $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var Product_name = button.data('name')
            var section_name = button.data('section_name')
            var pro_id = button.data('pro_id')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #Product_name').val(Product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #pro_id').val(pro_id);
        })


        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var product_name = button.data('product_name')
            var modal = $(this)

            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #product_name').val(product_name);
        })

    </script>



@endsection
