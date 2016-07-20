<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model {

    // Table name
    protected $table = 'openpaymentsdata_recipient';
    // Table Primary Key
    protected $primaryKey = 'recipient_id';
    // Indicates if the model should be timestamped by laravel
    public $timestamps = true;
    
    

    public static function deleteDoctors() {
        parent::where("type", 'HOSPITAL')->delete();
    }
    
    public static function deleteProviders() {
        parent::where("type", 'PROVIDER')->delete();
    }

}
