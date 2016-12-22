<?php namespace App\Http\Controllers;
use App\Group;
use App\User;
use App\RunningData;
use App\UserRunningPlan;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Input;

class DiaryController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('diary');

	}

	/**
	 * Upload data to DB and redirect to running_plan
	 *
	 * @return running_plan
	 */
	public function create(){
		$userID = Auth::user()->id;
		(float)$distance = Input::get('distance');
		$date = Input::get('date');
		(int)$mood = Input::get('mood');
		$userRunningPlanID = 2;

		if (!($distance > 0)){
			return view('diary')->withErrors('Zle zadaná vzdialenost');
		}
		$mytime = \Carbon\Carbon::now();
		if ($date > $mytime){
			return view('diary')->withErrors('Nesprávne zadaný dátum');
		}

		$userRunPlans =  DB::table('user_running_plans')
								->join('running_plans', 'user_running_plans.running_plan_id', '=', 'running_plans.id')	
								->select('running_plans.id')	
								->where('running_plans.end', '>', $mytime)
								->where('user_id', $userID)
								->lists('running_plans.id');

		var_dump($userRunPlans);
		if (empty($userRunPlans)){
			return view('diary')->withErrors('Nemáš žiadne aktívne bežecké plány');
		}
		DB::table('user_running_plans')->where('user_id', $userID)->increment('total_distance', $distance);
		foreach ($userRunPlans as $urp) {
			RunningData::create([
			'user_id' => $userID,
			'user_running_plan_id' => $urp,
			'date' => $date,
			'mood' => $mood,
			'distance' => $distance,
			]);
		}

		return redirect('running_plan')->with('status', 'Záznam z behu pridaný!');
	}

}

