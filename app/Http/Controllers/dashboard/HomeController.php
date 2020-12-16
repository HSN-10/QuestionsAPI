<?php

namespace App\Http\Controllers\dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Question;
use App\Score;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categoriesCount = Category::all()->count();
        $questionsCount = Question::all()->count();
        $scoresCount = Score::all()->count();
        $usersCount = User::all()->count();
        $data = [
            'date' => [],
            'number' => []
        ];
        $from_date = Carbon::now()->subDay(14);
        $to_date = Carbon::now();
        $period = CarbonPeriod::create($from_date, $to_date);
        foreach ($period as $date) {
            array_push($data['date'], $date->format('Y-m-d'));
            $numbers = Score::where('created_at', '>=', $from_date)
                ->groupBy('date')
                ->get(array(
                    DB::raw('Date(created_at) as date'),
                    DB::raw('COUNT(*) as "number"')
                ));
            $num = 0;
            foreach ($numbers as $number) {
                if ($date->format('Y-m-d') == $number['date']) {
                    $num = $number['number'];
                    break;
                } else
                    $num = 0;
            }
            array_push($data['number'], $num);
        }
        return view('dashboard.home', compact(['categoriesCount', 'questionsCount', 'scoresCount', 'usersCount', 'data']));
    }
}
