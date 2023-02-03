<?php

namespace App\Modules\Order\Http\Controllers;

use App\Constants\OrderQuantity;
use App\Constants\OrderStatusConstant;
use App\Http\Controllers\Controller;
use App\Modules\Authentication\Repositories\UserLogonRepository;
use App\Modules\Authentication\Repositories\UserRepository;
use App\Modules\Order\Models\Foods;
use App\Modules\Order\Models\Orders;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class OrderController  extends Controller
{
    private $token;

    public function __construct(
        UserRepository $userRepository,
        Request $request
    ) {
        $this->token = $userRepository->decodeToken(
            $request->header('authorization')
        );
    }

    public function getAll()
    {
        return Orders::query()->get();
    }

    public function getAllByUserId(int $userId)
    {
        return Orders::query()->where('user_id', $userId)->get();
    }

    public function createOne(Request $request)
    {
        $food = Foods::query()
            ->where('id', $request->input('food_id'))
            ->firstOrFail();

        $order = new Orders();
        $order->quantity = OrderQuantity::DEFAULT;
        $order->status = OrderStatusConstant::DRAFT;
        $order->total_price = $food->price;
        $order->user_id = $this->token->user->id;
        $order->food_id = $food->id;
        $order->save();

        return response()->json(['msg' => 'Successfully created', 'id' => $order->id]);
    }

    public function updateOne(
        Request $request,
        int $id
    ) {
        $validator = Validator::make($request->all(), [
            'status' => ['required', Rule::in(OrderStatusConstant::ALL)],
        ]);
        if ($validator->fails()) return response()->json(['msg' => 'Status invalid'], 422);

        $order = Orders::query()
            ->where('id', $id)
            ->firstOrFail();
        $order->status = $request->input('status');
        $order->save();

        return response()->json(['msg' => 'Successfully updated', 'id' => $order->id]);
    }

    public function deleteOne(
        int $id
    ) {
        $order = Orders::query()
            ->where('id', $id)
            ->firstOrFail();

        $order->delete();
        return response()->json(['msg' => 'Successfully deleted', 'id' => $order->id]);
    }
}
