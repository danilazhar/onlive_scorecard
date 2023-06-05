<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Evaluation extends Model
{
    protected $table = 'evaluations';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'department_id',
        'user_id',
        'supervisor_id',
        'date_of_audit',
        'total_score',
        'result',
        'remarks',
        'status',
        'created_by',
        'created_at',
        'updated_at'
    ];

    /**
     * @param $data
     * @throws Exception
     */
    public static function create_evaluation($data)
    {
        DB::beginTransaction();

        $evaluation_id = Evaluation::insertGetId([
            'department_id' =>  $data['id']['department_id'],
            'user_id' =>  $data['id']['user_id'],
            'supervisor_id' =>  request()->session()->get('user_id'),
            'date_of_audit' =>  Carbon::now(),
            'total_score' =>  $data['score']['total_score'],
            'result' =>  $data['result']['result'],
            'remarks' =>  $data['remarks']['remarks'],
            'created_by' => request()->session()->get('user_id'),
            'created_at' => Carbon::now()
        ]);


        if (!$evaluation_id) {
            throw new Exception("Failed to create evaluation");
        }

        Evaluation::insertEvaluationPoints($evaluation_id, $data);

        DB::commit();
    }

    /**
     * @param $scorecardagent_id
     * @param $data
     */
    private static function insertEvaluationPoints($evaluation_id, $data)
    {
        foreach ($data as $id => $data_list) {
            if (isset($data_list['category_' . $id])) {
                $criteria_id = $id;
                $point_achieved = 0;
                if ($data_list['points_achieved_criterias_' . $id] != '') {
                    $point_achieved = $data_list['points_achieved_criterias_' . $id];
                }

                EvaluationPoint::create([
                    'evaluation_id' => $evaluation_id,
                    'department_criteria_id' => $criteria_id,
                    'points' => $point_achieved,
                    'perform' => $data_list['perform_' . $id],
                    'critical' => $data_list['is_critical_' . $id],
                    'comments' => $data_list['comments_criterias_' . $id],
                    'created_by' => request()->session()->get('user_id'),
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evaluation_points()
    {
        return $this->hasMany(EvaluationPoint::class);
    }
}