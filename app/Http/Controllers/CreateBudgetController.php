<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\TransportUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isNull;

class CreateBudgetController extends Controller
{
    private const MINIMUM_SALARY = 123.22;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'travel_type' => [
                'required',
                Rule::in(['One Way', 'Round Trip']),
            ],
            'transport_unit' => [
                'required',
                Rule::in(['Car', 'Van', 'Bus']),
            ],
            'departure_time' => 'required|date|date_format:d-m-Y',
            'return_time' => [
                'filled',
                'date',
                'date_format:d-m-Y',
                Rule::requiredIf(function () use ($request) {
                    return $request->travel_type === 'Round Trip';
                }),
                'after:departure_time'
            ],
            'one_way_route' => [
                'required',
                'string',
                'regex:/^([a-zA-Z]+-[a-zA-Z]+)(-[a-zA-Z]+)*$/u',
                'exists:routes,name'
            ],
            'return_route' => [
                'filled',
                'string',
                'regex:/^([a-zA-Z]+-[a-zA-Z]+)(-[a-zA-Z]+)*$/u',
                'exists:routes,name',
                Rule::requiredIf(function () use ($request) {
                    return $request->travel_type === 'Round Trip';
                }),
            ],
            'total_people' => 'required|integer'
        ]);


        $totalDays = Carbon::parse($request->return_time)->diffInDays(Carbon::parse($request->departure_time));
        $viatics = self::MINIMUM_SALARY * 6 * $totalDays;

        $oneWayRoute = Route::where('name', $request->one_way_route)->first();

        $totalTollBooths = count(explode('-', $oneWayRoute->name)) - 1;

        $transportUnit = TransportUnit::where('name', $request->transport_unit)->first();
        $totalTollBooths += $totalTollBooths * $transportUnit->tollbooth_price;
        $fuelPrice = $oneWayRoute->distance / 3 * $transportUnit->fuel_unit_price;

        if ($request->has('return_route')) {
            $returnRoute = Route::where('name', $request->return_route)->first();
            $totalTollBooths += count(explode('-', $returnRoute->name)) - 1;
            $fuelPrice += $returnRoute->distance / 3 * $transportUnit->fuel_unit_price;
        }

        switch ($request->transport_unit) {
            case 'Car':
                $totalTransportUnits = $request->total_people < 4 ? 1 : ceil($request->total_people / 4);
                break;
            case 'Van':
                $totalTransportUnits = $request->total_people < 8 ? 1 : ceil($request->total_people / 8);
                break;
            case 'Bus':
                $totalTransportUnits = $request->total_people < 50 ? 1 : ceil($request->total_people / 50);
                break;
        }

        $viatics *= $totalTransportUnits;
        $totalTollBooths *= $totalTransportUnits;
        $fuelPrice *= $totalTransportUnits;


        return response()->json([
            'itinerary' => [
                'one_way_route' => $request->one_way_route,
                'return_route' => $request->return_route,
            ],
            'viatics' =>   $viatics,
            'tollbooths' => $totalTollBooths,
            'fuel_price' => $fuelPrice,
            'budget_total' => $viatics + $totalTollBooths + $fuelPrice,
        ], 200);
    }
}
