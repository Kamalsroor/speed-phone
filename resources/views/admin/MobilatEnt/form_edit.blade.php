<table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}"
data-row-standard='
    <tr>
        <td>
            {!! Form::hidden('id[]', 0) !!}
            {!! Form::select('Prodact_name[]', $mobilats, null, ['class' => ' form-control  '   ]) !!}


        </td>
        <td>
            {!! Form::text('sirarnamber[]', null, ['class' => ' form-control', 'placeholder' => 'السريال']) !!}
            <div class="show-error-amount invalid-feedback"></div>
        </td>


        <td class="text-center">
            <button type="button" class="btn btn-danger remove-row" data-id="0"><i class="fa fa-close"></i></button>
        </td>
    </tr>'>
            <!-- Description -->
            <div class="form-group">
                {!! Form::label('اسم العميل', 'اسم العميل') !!}
                {!! Form::select('CustomerNames', $Customers, $MobilatDetails[0]->MobilatEnt->CustomerNames, ['class' => 'sub_account custom_select select2 form-control' ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label(' رقم الاذن','رقم الاذن') !!}
                {!! Form::text('premission_id',  $MobilatDetails[0]->MobilatEnt->premission_id, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => ' رقم الاذن']) !!}
            </div>
            <div class="form-group">
				{!! Form::label('رقم الفاتوره','رقم الفاتوره') !!}
               
                {!! Form::text('order_id',  $MobilatDetails[0]->MobilatEnt->order_id, ['class' => 'form-control', 'id' => 'CustomerNames', 'placeholder' => 'رقم الفاتوره ']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('تاريخ الاذن ', ' تاريخ الاذن') !!}
                {!! Form::date('date',  $MobilatDetails[0]->MobilatEnt->date, ['class' => 'form-control', 'id' => 'PermissionDate', 'placeholder' => 'اسم العميل']) !!}
            </div>
    	    <input type="hidden" id="suggestion_page" value="1">
            
    <!--./ Description -->
    <thead>
        <tr>
          <th>اسم الصنف</th>
          <th>السريال</th>
          <th>حذف</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($MobilatDetails as $details)
            <tr>
                <td>
                    {!! Form::hidden('id[]', $details->id) !!}

                    {!! Form::select('Prodact_name[]', $mobilats, $details->Prodact_name, ['class' => '  custom_select select2 form-control'   ]) !!}

                </td>
                
                <td>
                  {!! Form::text('sirarnamber[]', $details->sirarnamber, ['class' => ' form-control', 'placeholder' => 'السريال']) !!}
                </td>

                <td class="text-center">
                    @if(ChackSiralExit($details->sirarnamber))
                    
                    <button type="button" class="btn btn-danger remove-row" data-id="{{ $details->id }}"><i class="fa fa-close"></i></button>
                    @endif
                </td>
                
            </tr>
        @endforeach
        <tr>
        
           <td colspan="2">
                 <div class="col-md-12 text-center" id="suggestion_page_loader" style="display: none;">
                    <i class="fa fa-spinner fa-spin fa-2x"></i>
                  </div>
            </td>
            <td colspan="1">
                <button type="button" class="btn btn-info btn-lg add-row"><i class="fa fa-plus"></i></button>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
          <th>اسم الصنف</th>
          <th>السريال</th>
          <th>حذف</th>
        </tr>
    </tfoot>
</table>

<br>
<br>
