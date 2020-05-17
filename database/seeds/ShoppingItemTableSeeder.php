<?php

use Illuminate\Database\Seeder;

class ShoppingItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //shopppingList
        $list = App\ShoppingList::all()->first();
        $list2 = App\ShoppingList::where('name', 'Baumarkt')->first();

        $item1 = new \App\ShoppingItem();
        $item1->description = 'Milch';
        $item1->amount = 2;
        $item1->max_price = 1.50;
        $item1->shoppingList()->associate($list);
        $item1->save();

        $item2 = new \App\ShoppingItem();
        $item2->description = 'Erdbeeren';
        $item2->max_price = 3.00;
        $item2->shoppingList()->associate($list);
        $item2->save();

        $item3 = new \App\ShoppingItem();
        $item3->description = 'Gartenschere';
        $item3->max_price = 7.00;
        $item3->shoppingList()->associate($list2);
        $item3->save();

        $item4 = new \App\ShoppingItem();
        $item4->description = 'Steckdosenleiste';
        $item4->amount = 2;
        $item4->max_price = 5.00;
        $item4->shoppingList()->associate($list2);
        $item4->save();

        $item4 = new \App\ShoppingItem();
        $item4->description = 'Spezialkleber';
        $item4->max_price = 4.00;
        $item4->shoppingList()->associate($list2);
        $item4->save();
    }
}
