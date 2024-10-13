<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontsite\BudgetUsage\BudgetUsageFilterRequest;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\Transaction;
use Carbon\Carbon;

class BudgetUsageController extends Controller
{
    public function index(BudgetUsageFilterRequest $request)
    {
        $filter = $request->validated();
        $budgets = Budget::where('user_id', 1)->get();
        $end_date_filter = Carbon::createFromFormat('Y-m-d', $filter['end_date']);

        $query_filter = [];
        foreach ($budgets as $budget){
            if($budget->day_of_month == 1){
                $start_date = $end_date_filter->startOfMonth();
                $query_filter['start_date'] = $start_date->format('Y-m-d');
                $end_date = $start_date->endOfMonth();
                $query_filter['end_date'] = $end_date->format('Y-m-d');
            }else{
                $end_date = $end_date->subDays(1);
                $query_filter['end_date'] = $end_date->format('Y-m-d');
                $start_date = $end_date->subMonth(1);
                $query_filter['start_date'] = $start_date->format('Y-m-d');
            }

            $budget_category = BudgetCategory::where('budget_id', $budget->budget_id)->pluck('category_id')->toArray();

            $spending = Transaction::where('user_id', 1)
                ->whereBetween('transaction_date', array_values($query_filter))
                ->whereIn('category_id', $budget_category)
                ->sum('amount');;

            $budget->spending = $spending;
        }

        return $budget;
    }
}
