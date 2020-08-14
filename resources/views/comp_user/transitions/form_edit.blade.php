<table class="table table-bordered" id="table-add-transition" data-url-account-types="{{ route('get_account_types') }}" 
data-row-standard='
    <tr>
        <td>
            {!! Form::hidden('id[]', 0) !!}
            {!! Form::hidden('comp_user_id[]', auth()->guard('comp_user')->id()) !!}
            {!! Form::select('account_type_id[]', $account_types, null, ['class' => 'account_type custom_select form-control']) !!}
        </td>
        <td>
            {!! Form::select('account_name_id[]', $sub_accounts, null, ['class' => 'sub_account custom_select form-control']) !!}
        </td>
        <td>
            {!! Form::select('action[]', ['from' => 'from', 'to' => 'to'], null, ['class' => 'action custom_select form-control']) !!}
        </td>
        <td>
            {!! Form::text('amount[]', null, ['class' => 'amount form-control', 'placeholder' => 'Transition Amount']) !!}
            <div class="show-error-amount invalid-feedback"></div>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger remove-row" data-id="0"><i class="fa fa-close"></i></button>
        </td>
    </tr>'>
    <thead>
        <tr>
            <th>Account Type</th>
            <th>Sub Account</th>
            <th>Action</th>
            <th>Amount</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transitions_details as $details)
            <tr>
                <td>
                    {!! Form::hidden('id[]', $details->id) !!}
                    {!! Form::hidden('comp_user_id[]', $details->comp_user_id) !!}
                    {!! Form::select('account_type_id[]', $account_types, $details->account_type->id, ['class' => 'account_type custom_select form-control']) !!}
                </td>
                <td>
                    {!! Form::select('account_name_id[]', $sub_accounts, $details->account_name->id, ['class' => 'sub_account custom_select form-control']) !!}
                </td>
                <td>
                    {!! Form::select('action[]', ['from' => 'from', 'to' => 'to'], $details->action, ['class' => 'action custom_select form-control']) !!}
                </td>
                <td>
                    {!! Form::text('amount[]', $details->amount, ['class' => 'amount form-control', 'placeholder' => 'Transition Amount']) !!}
                    <div class="show-error-amount invalid-feedback"></div>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger remove-row" data-id="{{ $details->id }}"><i class="fa fa-close"></i></button>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5">
                <button type="button" class="btn btn-info btn-lg add-row"><i class="fa fa-plus"></i></button>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Account Type</th>
            <th>Sub Account</th>
            <th>Action</th>
            <th>Amount</th>
            <th>Remove</th>
        </tr>
    </tfoot>
</table>

<br>
<br>

<!-- Description -->
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', $transitions_details[0]->transition->description, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Transition description']) !!}
</div>
<!--./ Description -->