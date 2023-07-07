<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Evaluation;


class DashboardController extends Controller
{
    public function index()
    {

        if(Auth::check()){

            $userCount = User::where('status', '!=', '2')->count();
            $passCount = Evaluation::where('status', '2')->where('result', '1')->count();
            $evaluatedCount = Evaluation::where('status', '2')->count();
            $recentEvaluations = Evaluation::where('status', '2')->limit(5)->orderBy('updated_at', 'desc')->get();

            $passPercentage = 0;

            if($passCount > 0) {
                $passPercentage = ($passCount / $userCount) * 100;
            }

            return view('dashboard')
                ->with('userCount', $userCount)
                ->with('passPercentage', $passPercentage)
                ->with('evaluatedCount', $evaluatedCount)
                ->with('recentEvaluations', $recentEvaluations);
        }

        return redirect("/login");

    }
}