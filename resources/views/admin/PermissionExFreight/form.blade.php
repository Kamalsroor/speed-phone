{!! Html::style('public/css/select2.min.css') !!}
{!! Html::script('public/js/select2.full.min.js') !!}
  <table class="table table-bordered " id="table-add-transition" data-url-permission-types=""
data-row-standard='
<tr>
        <td class="TypeOfProduct"> 
             {!! Form::select('TypeOfProduct[]', $TypeOfProduct, null, ['class' => 'select2 form-control']) !!}

              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td class="ProductName">
              {!! Form::text('ProductName[]', null, ['class' => ' form-control', 'placeholder' => 'Transition ProductName']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td>
          <td Class="Quantity">
              {!! Form::text('Quantity[]', null, ['class' => 'amount form-control', 'placeholder' => 'Transition Quantity']) !!}
              <div class="show-error-amount invalid-feedback"></div>
          </td >
          <td class="text-center Quantity">
              <button type="button" class="btn btn-danger remove-row"><i class="fa fa-close"></i></button>
          </td>
        </tr>'>

    <!-- Description -->
    <div class="form-group">
        {!! Form::label('اسم العميل', 'اسم العميل') !!}
        {!! Form::select('customernames', $Customers, null, ['class' => 'customernames select2  form-control', 'id' => 'customernames']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('اسم العميل', 'اسم العميل') !!}
        {!! Form::select('id_state',[''=>'--- Select State ---'],null,['class'=>'id_state form-control']) !!}


    </div>
    <div class="form-group">
        {!! Form::label('تاريخ الاذن ', ' تاريخ الاذن') !!}
        {!! Form::date('PermissionDate', null, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل']) !!}
    </div>
    <!--./ Description -->
    <thead>
        <tr>
            <th >#</th>
            <th >رقم اذن  الاضافه</th>
            <th class="">نوع الصنف</th>
            <th class="">اسم الصنف</th>
            <th Class="">الكميه المستلمه</th>
            <th Class="">الكميه</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr>
        <th>اسم الصنف</th>
            <th>الكميه</th>
            <th>حذف</th>
        </tr>
    </tfoot>
</table>

<br>
<br>

<script type="text/javascript">
$(document).ready(function(){

fetch_customer_data();

function fetch_customer_data(query = '')
{
 $.ajax({
  url:"{{ route('Search.action2') }}",
  method:'GET',
  data:{query:query},
  dataType:'json',
  success:function(data)
  {
   $('tbody').html(data.table_data);
  }
 })
}


$(document).on('change', '#customernames', function(){
 var query = $(this).val();
 fetch_customer_data(query);
});
});


</script>