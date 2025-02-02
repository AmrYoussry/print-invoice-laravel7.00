@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    اضافة فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

   <div class="card-body">
        <form action="{{route('invoices.store')}}" method="post" class = "form">
            @csrf
          <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="invoice_number">رقم الفاتورة</label>
                        <input type="text" name = "invoice_number" class = "form-control">
                        @error('invoice_number')<span class="help-block text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="invoice_date">تاريخ الفاتورة</label>
                        <input type="text" name = "invoice_date" class = "form-control fc-datepicker" value="{{ date('Y-m-d') }}">
                        @error('invoice_date')<span class="help-block text-danger">{{$message}}</span>@enderror
                    </div>
                </div>


                <div class="col">
                    <div class="form-group">
                        <label for="customer_name">العميل</label>
                        <input type="text" name = "Customer_name" class = "form-control">
                        @error('customer_name')<span class="help-block text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

            </div>
            <div class="table-responsie">
                <table class = "table" id = "invoice-details">
                    <thead>
                        <tr>
                            <th>إلغاء</th>
                            <th>المخزن</th>
                            <th>اسم المنتج</th>
                            <th>الوحدة</th>
                            <th>الكمية</th>
                            <th>سعر الوحدة</th>
                            <th>الإجمالى</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="clone" id="0">
                            <td>#</td>
                            <td>
                               <select name="section_name[]" id="section_name">
                                <option value="A">A</option>
                               </select>
                               @error('section_name')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </td>
                            <td>
                                <input type="text" name = "product_name[]" id = "product_name" class = "product_name form-control">
                                @error('product_name')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </td>
                            <td>
                                <select name="unit[]" id="unit" class="unit form-control">
                                    <option value="piece">قطعه</option>
                                    <option value="gram">جرام</option>
                                    <option value="kilo">كيلو جرام</option>
                                </select>
                                @error('unit')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </td>
                            <td>
                                <input type="number" step="0.01" name = "quantity[]" id="quantity" class = "quantity form-control">
                                @error('quantity')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </td>
                            <td>
                                <input type="number" step="0.01" name = "unit_price[]" id="unit_price" class = "unit_price form-control">
                                @error('unit_price')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </td>
                            <td>
                                <input type="number" step="0.01" name = "row_sub_total[]" id="row_sub_total" class="row_sub_total form-control" value = "0.00" readonly="readonly">
                                @error('row_sub_total')<span class="help-block text-danger">{{$message}}</span>@enderror
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <button type="button" class = "btn-add btn btn-primary">إضافة صنف</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">إجمالى القيمة</td>
                            <td><input type="number" step="0.01" name="sub_total" id="sub_total" class="sub_total form-control" readonly="readonly"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">الخصم</td>
                            <td>
                                <div class="input-group md3">
                                    <select name="discount_type" id="discount_type" class="discount_type custom-select">
                                        <option value="fixed">EGP</option>
                                        <option value="percentage">%</option>
                                    </select>
                                    <div class="input-group-append">
                                        <input type="number" step="0.01" name="discount_value" id="discount_value" class="discount_value form-control" value="0.00">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">ضريبة قيمة مافة 14%</td>
                            <td><input type="number" step="0.01" name="vat_value" id="vat_value" class="vat_value form-control"readonly="readonly"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">رسوم السحن</td>
                            <td><input type="number" step="0.01" name="shipping" id="shipping" class="shipping form-control"></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">صافى الفاتورة</td>
                            <td><input type="number" step="0.01" name="total_due" id="total_due" class="total_due form-control" value = "0.00" readonly="readonly"></td>
                        </tr>
                    </tfoot>


                </table>
            </div>
            <div class="text-right pt-3">
                <button type="submit" name="save" class="btn btn-primary">حفظ الفاتورة</button>
            </div>
        </form>

    </div>
   </div>
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        $(document).ready(function(){
            $('#invoice-details').on('keyup blur','.quantity',function(){
                let $row = $(this).closest('tr');
                let quantity = $row.find('.quantity').val() || 0;
                let unit_price = $row.find('.unit_price').val() || 0;

                $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2));

                $('#sub_total').val(sum_totl('.row_sub_total'));
                $('#vat_value').val(calculate_vat());
                $('#total_due').val(sum_due_total());

        });
        $('#invoice-details').on('keyUp blur' , '.unit_price' , function(){
                let $row = $(this).closet('tr');
                let quantity = $row.find('.quantity').val()|| 0;
                let unit_price = $row.find('.unit_price').val()|| 0;

                $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2));

                $('#sub_total').val(sum_totl('.row_sub_total'));
                $('#vat_val').val(calculate_vat());
                $('#total_due').val(sum_due_total());

        })

        $('#invoice-details').on('keyUp blur' , '.discount_type' , function(){


                $('#sub_total').val(sum_totl('.row_sub_total'));
                $('#vat_val').val(calculate_vat());
                $('#total_due').val(sum_due_total());

        })

        $('#invoice-details').on('keyUp blur' , '.discount_value' , function(){

                $('#sub_total').val(sum_totl('.row_sub_total'));
                $('#vat_val').val(calculate_vat());
                $('#total_due').val(sum_due_total());

        })

        $('#invoice-details').on('keyUp blur' , '.shipping' , function(){


                $('#sub_total').val(sum_totl('.row_sub_total'));
                $('#vat_val').val(calculate_vat());
                $('#total_due').val(sum_due_total());

        })

    })

    let sum_totl = function(selector)
    {
        let sum = 0;
        $(selector).each(function(){
            let selectorVal = $(this).val() != '' ? $(this).val() : 0;
            sum += parseFloat(selectorVal);
        });
        return sum.toFixed(2);
    }

    let calculate_vat = function() {
        let sub_totalVal = $('.sub_total').val() || 0;
        let discount_type = $('.discount_type').val();
        let discount_value = parseFloat($('.discount_value').val()) || 0;
        let discountVal = discount_value != 0 ? discount_type == 'percentage' ? sub_totalVal * (discount_value/100) : discount_value : 0;

        let vatval = (sub_totalVal - discount_value) * 0.14;
        return vatval.toFixed(2);
  }

    let sum_due_total = function () {
        let sum = 0;
        let sub_totalVal = $('.sub_total').val() || 0;
        let discount_type = $('.discount_type').val();
        let discount_value = parseFloat($('.discount_value').val()) || 0;
        let discountVal = discount_value != 0 ? discount_type == 'percentage' ? sub_totalVal * (discount_value/100) : discount_value : 0;

        let vatval = parseFloat($('.vat_value').val()) || 0;
        let shippingval = parseFloat($('.shipping').val()) || 0;

        sum += sub_totalVal;
        sum -= discount_value;
        sum += vatval;
        sum += shippingval;

        return sum.toFixed(2);
    }

    $('document').ready(function(){
        $('.btn_add')
    })

    </script>


@endsection
