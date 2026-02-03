<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Vacation;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private function validateOrder($type, $value): String
    {
        $array = [
            'col' => ['id', 'title', 'price'],
            'order' => ['desc', 'asc']
        ];
        if (in_array($value, $array[$type])) {
            return $value;
        }
        return $array[$type][0];
    }

    private function validateNumbers($num): mixed
    {
        if (!is_numeric($num) || $num < 0) return null;
        return $num;
    }

    public function index(Request $request)
    {
        $q = $request->q;
        $typeIds = $request->input('typeid');
        $col = $this->validateOrder('col', $request->col);
        $order = $this->validateOrder('order', $request->order);
        $from = $this->validateNumbers($request->from);
        $to = $this->validateNumbers($request->to);
        $query = Vacation::query();
        if (!empty($typeIds)) {
            $query->whereIn('type_id', (array) $typeIds);
        }
        if ($from) {
            $query->whereRaw("price >= $from");
        }
        if ($to) {
            $query->whereRaw("price <= $to");
        }
        if ($q) {
            $query->where(function ($sq) use ($q) {
                $sq->where('title', 'like', '%' . $q . '%')
                    ->orWhere('description', 'like', '%' . $q . '%')
                    ->orWhere('country', 'like', '%' . $q . '%');
            });
        }
        $query->orderBy($col, $order);
        $vacations = $query->paginate(12)->withQueryString();
        $types = Type::all();
        return view('main', [...compact('vacations', 'types', 'q', 'col', 'from', 'to', 'order', 'typeIds')]);
    }
}
