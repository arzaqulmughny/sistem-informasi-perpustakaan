<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDays = Carbon::now()->daysInMonth;
        $currentMonth = date('m');
        $currentYear = date('Y');

        $days = range(1, $totalDays);

        $loans = DB::table('loans')
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('COUNT(*) as total'))
            ->whereMonth('created_at', '=', $currentMonth) // This month
            ->whereYear('created_at', '=', $currentYear) // This year
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'), 'asc')
            ->get()
            ->keyBy('day');

        $loansResult = [];

        foreach ($days as $date) {
            $loansResult[] = [
                'day' => $date,
                'total' => isset($loans[$date]) ? $loans[$date]->total : 0,  // Jika tidak ada data, set total menjadi 0
            ];
        }

        $data = new Fluent([
            'members_count' => Member::count(),
            'books_count' => Book::count(),
            'copies_count' => BookCopy::count(),
            'staffs_count' => User::where(['role_id' => UserRole::STAFF])->get()->count(),
            'loan_data' => collect($loansResult)->pluck('total')->toArray(),
            'loan_labels' => $days,
        ]);

        return view('index', compact('data'));
    }
}
