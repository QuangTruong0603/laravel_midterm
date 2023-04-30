<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SleepTracker extends Model
{
    protected $table = 'sleeprecord';
    protected $fillable = ['sleep_date', 'sleep_time', 'wake_time'];

    public static function getData($id)
    {
        return self::where('user_id', $id)->get();
    }
    public static function addData($user_id, $sleep_date, $sleep_time, $wake_time)
    {
        return self::insert([
            'user_id' => $user_id,
            'sleep_date' => $sleep_date,
            'sleep_time' => $sleep_time,
            'wake_time' => $wake_time,
        ]);
    }

    public static function updateData($id, $sleep_date, $sleep_time, $wake_time)
    {
        return self::where('id', $id)->update([
            'sleep_date' => $sleep_date,
            'sleep_time' => $sleep_time,
            'wake_time' => $wake_time,
        ]);
    }

    public static function deleteData($id)
    {
        $sleepRecord = self::findOrFail($id);
        return $sleepRecord->delete();
    }
}
?>