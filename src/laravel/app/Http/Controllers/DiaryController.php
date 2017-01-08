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
		$distance = Input::get('distance');
		$date = date("Y-m-d H:i:s", strtotime( Input::get('date') ));
		$mood = Input::get('mood');
		if (!($distance > 0)){
			return view('diary')->withErrors('Zle zadaná vzdialenosť');
		}
		$mytime = date("Y-m-d H:i:s", strtotime( \Carbon\Carbon::now() ));
		if ($date > $mytime){
			return view('diary')->withErrors('Nesprávne zadaný dátum');
		}
		$userRunPlans = DB::table('user_running_plans')
								->join('running_plans', 'user_running_plans.running_plan_id', '=', 'running_plans.id')	
								->where('running_plans.end', '>', $mytime)
								->where('user_id', $userID)
								->get([
								    'user_running_plans.*',
                                    'running_plans.id AS running_plans___id',
                                ]);
		if (empty($userRunPlans)){
			return view('diary')->withErrors('Nemáš žiadne aktívne bežecké plány');
		}

		$check = false;

		foreach ($userRunPlans as $urp) {
			$tot_dis = DB::table('user_running_plans')->where('user_id', $userID)->where('running_plan_id', $urp->running_plans___id)->lists('total_distance');
			$dis_val = DB::table('running_plans')->where('id', $urp->running_plans___id)->lists('distance_value');
			if ($tot_dis < $dis_val){
			    $check = true;

				DB::table('user_running_plans')->where('user_id', $userID)->where('running_plan_id', $urp->running_plans___id)->increment('total_distance', $distance);

				$tot_dis = DB::table('user_running_plans')->where('user_id', $userID)->where('running_plan_id', $urp->running_plans___id)->lists('total_distance');
				$dis_val = DB::table('running_plans')->where('id', $urp->running_plans___id)->lists('distance_value');
				if ($tot_dis > $dis_val){
					DB::table('user_running_plans')
							->where('user_id', $userID)
							->where('running_plan_id', $urp->running_plans___id)
	           				->update(['finish' => $mytime]);
				}

				RunningData::create([
				'user_id' => $userID,
				'user_running_plan_id' => $urp->id,
				'date' => $date,
				'mood' => $mood,
				'distance' => $distance,
				]);
            }
			
		}

        return redirect('running_plan')->with('status', $check ? 'Záznam z behu pridaný!' : 'Už ste asi všetky plány naplnili, prihláste sa na nejaký ďalší.');
	}
}
