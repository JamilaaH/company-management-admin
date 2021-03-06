<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messagerie extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'entreprise_id',
        'message',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id','tva');
    }
}
