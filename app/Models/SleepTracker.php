<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SleepTracker extends Model{
    protected $table = 'sleeprecord';
    protected $fillable = ['sleep_date', 'sleep_time', 'wake_time'];
    
    public static function getData()
    {
        return self::all();
    }
}
?>