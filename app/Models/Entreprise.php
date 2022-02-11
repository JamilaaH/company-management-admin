<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $primaryKey = 'tva';
    public $incrementing = false;
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Messagerie::class, 'entreprise_id', 'tva');
    }

    public function taches()
    {
        return $this->hasMany(Tache::class,'entreprise_id', 'tva');
    }
}
