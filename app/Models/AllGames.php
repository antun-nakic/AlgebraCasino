<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AllGames extends Model
{
    use HasFactory;

    public function pripada_korisniku()
    {
        return $this->BelongsTo(User::class, 'idKorisnika');
    }
}
