<?php

namespace App\Models;
use Request;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WaterSupplyEquipmentModel extends Model
{
    use HasFactory;
    protected $table = 'water_supply_equipment';
    protected $primaryKey = 'water_supply_equipment_id';
    public $incrementing = true;
    public $timestamps = false;

    // To get single record of query
    static function ToSingleWaterSupplyEquipment($water_supply_equipment_id)
    {
        return WaterSupplyEquipmentModel::find($water_supply_equipment_id);
    }

    static function ToGetAllActiveWaterSupplyEquipment($company_ID)
    {
        $records = WaterSupplyEquipmentModel::select('*',)
                ->where('water_supply_equipment_status', 1)
                ->where('company_id', $company_ID)
                ->paginate(15);
        return $records;
    }

    static function ToGetAllDeleteWaterSupplyEquipment($company_ID)
    {
        $records = WaterSupplyEquipmentModel::select('*',)
                ->where('water_supply_equipment_status', 2)
                ->where('company_id', $company_ID)
                ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no deleted Water Supply Equipment !';
        }

        return $records;
    }

    static function ToGetAllSuspendWaterSupplyEquipment($company_ID)
    {
        $records = WaterSupplyEquipmentModel::select('*',)
                ->where('water_supply_equipment_status', 3)
                ->where('company_id', $company_ID)
                ->paginate(15);
        if ($records->isEmpty()) {
            return 'There is no suspend Water Supply Equipment !';
        }

        return $records;
    }
}
