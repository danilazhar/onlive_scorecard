<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

        $evaluation_id = Evaluation::insertEvaluation($data);
        if (!$evaluation_id) {
            throw new Exception("Failed to create evaluation");
        }

        Evaluation::insertScorecardPoints($evaluation_id, $data);

        DB::commit();
    }

    /**
     * @param $data
     * @return mixed
     */
    private static function insertEvaluation($data)
    {
        Evaluation::insertGetId([
                'department_id' =>  $data['id']['department_id'],
                'user_id' =>  $data['id']['user_id'],
                'supervisor_id' =>  $data['id']['evaluator'],
                'date_of_audit' =>  $data['id']['evaluation_date'],
                'total_score' =>  $data['id']['total_score'],
                'remarks' =>  $data['id']['total_sremarkscore'],
                'created_by' => request()->session()->get('user_id'),
                'created_at' => Carbon::now()
            ]);
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

                EvaluationPoints::create([
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
}