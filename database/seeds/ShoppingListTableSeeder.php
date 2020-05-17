<?php

use Illuminate\Database\Seeder;

class ShoppingListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list= new \App\ShoppingList;
        $list->due_date = new DateTime('2020-06-19');
        $list->save();

        //add items
        $items = App\ShoppingItem::all();
        $list->shoppingItems()->saveMany($items);
        $list->save();

        //add volunteer
        $list->volunteer()->associate(2);
        $list->save();

        //add helpseeker
        $list->helpseeker_id = 1;
        $list->save();

        //add feedback
        $feedback = App\Feedback::all();
        $list->feedback()->saveMany($feedback);
        $list->save();

        $list2= new \App\ShoppingList;
        $list2->name = "Baumarkt";
        $list2->helpseeker_id = 1;
        $list2->due_date = new DateTime('2020-05-23');
        $list2->save();

        //add volunteer and helpseeker

        $list2->save();
    }
}
