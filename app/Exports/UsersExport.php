<?php

namespace App\Exports;

use App\User;
use App\permission_ent_details_freight;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection  ,WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;
    public function __construct( $id)
    {
        $this->id = $id; 
    }
    public function headings(): array
    {
        return [
            '#',
            'رقم اذن الاضافه',
            'اسم العميل',
            'نوع الصنف',
            'اسم الصنف',
            'الكميه المشحونه',
            'الكميه المستلمه',
            'النواقص',
            'الوزن',
            'سعر القطعه',
            'اجمالي القيمه',
            'سعر التخليص',
            'تكلفه الطيران',
            'تكاليف اخري',
            ' نسبه الوزن',
            'الوزن المحمل',
            'العموله',
            'اجمالي التكلفه',
            'صافي الربح',
        ];

       

    }

    public function collection()
    {
        return permission_ent_details_freight::where('permission_ent_id',  $this->id)->get();
    }
    public function map($farm): array
   {
        return [
            $farm->id,
            $farm->permission_ent_id,
            $farm->Customersed->name,
            $farm->TypeOfProduct->name,
            $farm->ProductName,
            $farm->QuantityCharged,
            $farm->Quantityrecipient,
            $farm->Forlack,
            $farm->wight,
            $farm->Tcotpiece,
            $farm->cost,
            $farm->Clearanceprice,
            $farm->Flightcost,
            $farm->othercost,
            $farm->Weightratio,
            $farm->Weightbearing,
            $farm->commission,
            $farm->totalcost,
            $farm->nitprofit,
        ];
    }

}
