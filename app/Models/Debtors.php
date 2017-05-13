<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debtors extends Model
{
    protected $table='tbl_profiles';

    protected $fillable=['batch_numbers', 'clearing_mpesa_trans_id', 'date_cleared', 'fully_cleared', 'mobile_number', 'national_id'];

}
