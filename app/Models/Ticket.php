<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

protected $fillable = ['title','description','attachment','user_id', 'status','status_changed_by_id','user_message', 'admin_message'];

public function user(): BelongsTo
{
    return $this->BelongsTo(User::class);
}

public function messages(): HasMany
{
    return $this->hasMany(Message::class);
}
public function statusChangedUser(): HasOne
{
    return $this->HasOne(User::class, 'id','status_changed_by_id');
}

}