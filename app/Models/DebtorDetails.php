<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DebtorDetails extends Model
{
    protected $table='tbl_due_listing';

    protected $fillable=['cust_acno', 'cust_id', 'cust_mobile_number', 'cust_name', 'loan_amount', 'loan_balance', 'loan_due_date', 'loan_issue_date'];

}
