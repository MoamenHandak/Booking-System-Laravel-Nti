<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Hotel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['city_id', 'name', 'description', 'address', 'rating'];
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}