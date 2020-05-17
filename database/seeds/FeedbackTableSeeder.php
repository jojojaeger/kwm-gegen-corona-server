<?php

use Illuminate\Database\Seeder;

class FeedbackTableSeeder extends Seeder
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

        $feedback = new \App\Feedback();
        $feedback->comment = 'Vollmilch oder Haltbarmilch?';
        $feedback->user()->associate(2);
        $feedback->shoppingList()->associate($list);
        $feedback->save();

        $feedback2 = new \App\Feedback();
        $feedback2->comment = 'Bitte Vollmilch...';
        $feedback2->user()->associate(1);
        $feedback2->shoppingList()->associate($list);
        $feedback2->save();

    }
}
