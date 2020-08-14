  @forelse ($MobilatDetails as $details)
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
            @empty
            <tr>
  
            <td colspan="3">
                لا يوجد اي سريالات اخري
	            <input type="hidden" id="no_products_found">
            </td>
            </tr>

@endforelse



