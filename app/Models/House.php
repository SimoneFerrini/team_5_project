<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title', 'description', 'rooms', 'beds', 'bathrooms', 'square_mt', 
                            'street', 'city', 'house_number', 'latitude', 'longitude', 'thumbnail', 'visibility'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function views(){
        return $this->hasMany(View::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function services() {
        return $this->belongsToMany(Service::class);
    }

    
}
