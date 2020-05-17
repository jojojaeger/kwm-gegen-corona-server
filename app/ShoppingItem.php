<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingItem extends Model
{
    protected  $fillable=['description', 'amount', 'max_price', 'shopping_list_id'];

    //item is assigned to one list (n:1);
    public function shoppingList():BelongsTo {
        return $this->belongsTo(ShoppingList::class);
    }
}
