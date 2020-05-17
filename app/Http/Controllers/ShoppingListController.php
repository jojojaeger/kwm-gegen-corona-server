<?php

namespace App\Http\Controllers;

use App\ShoppingItem;
use App\User;
use App\Feedback;
use App\ShoppingList;
use Illuminate\Http\Request;
use Illuminate\Http\JSONResponse;
use Illuminate\Support\Facades\DB;


class ShoppingListController extends Controller
{

    //alle
    //-login
    //-register
    //-logout
    //post feedback

    //- get my closed lists (done = true & volunteer_id bzw helpseeker_id = this person)
    //- get my open lists  (done = false & volunteer_id bzw helpseeker_id = this person)

    //HELPSEEKER
    //post list

    //VOLUNTEER
    //- get all done=false lists where volunteer_id is not mine
    //put, update lists


    public function index()
    {
        $shoppingLists = ShoppingList::with(['shoppingItems', 'helpseeker', 'volunteer', 'feedback'])
            ->where('volunteer_id', null)->get();
        return $shoppingLists;
    }

    public function getSingleList($listId)
    {
        $shoppingList =
            ShoppingList::with(['shoppingItems', 'helpseeker', 'volunteer', 'feedback'])
            ->where('id', $listId)
            ->get();
        return $shoppingList;
    }


    public function getOpenLists($userid)
    {
        $userType = $this->getUserType($userid);
        if ($userType !== null) {

            $shoppingLists = ShoppingList::with(['shoppingItems', 'helpseeker', 'volunteer', 'feedback'])
                ->where('done', 'LIKE', '0')
                ->where($userType . '_id', 'like', '%' . $userid . '%')
                ->get();
            return $shoppingLists;
        }
        return [];
    }

    public function getDoneLists($userid)
    {
        $userType = $this->getUserType($userid);
        if ($userType !== null) {

            $shoppingLists = ShoppingList::with(['shoppingItems', 'helpseeker', 'volunteer', 'feedback'])
                ->where('done', 'LIKE', '1')
                ->where($userType . '_id', 'like', '%' . $userid . '%')
                ->get();
            return $shoppingLists;
        }
        return [];
    }

    public function saveFeedback(Request $request){
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $feedback = Feedback::create($request->all());
            DB::commit();
            return response()->json($feedback, 201);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json("saving feedback failed: ". $e->getMessage(), 420);
        }
    }

    public function update(Request $request, $id) : JsonResponse
    {

        DB::beginTransaction();
        try {
            $list = ShoppingList::with(['shoppingItems', 'helpseeker', 'volunteer', 'feedback'])
                ->where('id', $id)->first();
            if ($list != null) {
                $request = $this->parseRequest($request);
                $list->update($request->all());
            }
            DB::commit();
            $listUpdated = ShoppingList::with(['shoppingItems', 'helpseeker', 'volunteer', 'feedback'])
                ->where('id', $id)->first();
            return response()->json($listUpdated, 201);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("updating list failed: " . $e->getMessage(), 420);
        }
    }

    public function save(Request $request) : JsonResponse
    {

        $request = $this->parseRequest($request);
        DB::beginTransaction();
        try {
            $list = ShoppingList::create($request->all());
            //save items
            if(isset($request['shopping_items']) && is_array($request['shopping_items'])){
                foreach($request['shopping_items'] as $itm){
                    $item = ShoppingItem::firstOrNew(['description' => $itm['description'], 'amount' => $itm['amount'],
                        'max_price' => $itm['max_price']]);
                    $list->shoppingItems()->save($item);
                }
            }
            DB::commit();
            return response()->json($list, 201);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving list failed: " . $e->getMessage(), 420);
        }
    }


    public function getUserType($userid)
    {
        $user = User::find($userid);
        return $user !== null ? $user->type : null;
    }

    private function parseRequest(Request $request):Request{
        $date = new \DateTime($request->published);
        $request['published']=$date;
        return $request;
    }
}
