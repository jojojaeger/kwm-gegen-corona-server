<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $fillable=['comment', 'shopping_list_id', 'user_id'];

    //feedback is assigned to one user (n:1);
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //feedback is assigned to one list (n:1);
    public function shoppingList():BelongsTo
    {
        return $this->belongsTo(ShoppingList::class);
    }
}
