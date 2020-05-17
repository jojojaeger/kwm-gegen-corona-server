<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingList extends Model
{
    protected  $fillable=['due_date', 'name', 'done', 'total_price', 'open', 'volunteer_id', 'helpseeker_id'];

    //list has many items
    public function shoppingItems():HasMany {
        return $this->hasMany(ShoppingItem::class);
    }

    //list is assigned to one helpseeker (n:1);
    public function helpseeker():BelongsTo {
        return $this->belongsTo(User::class);
    }

    //list is assigned to one volunteer (n:1);
    public function volunteer():BelongsTo {
        return $this->belongsTo(User::class);
    }

    //list has many items
    public function feedback():HasMany {
        return $this->hasMany(Feedback::class)->with('user');
    }
}
