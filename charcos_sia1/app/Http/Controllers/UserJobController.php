<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\UserJob;
use App\Traits\ApiResponser;
use DB;

Class UserJobController extends Controller {
    use ApiResponser;

    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function index(){

        $usersjob = UserJob::all();

        return $this->successResponse($usersjob);
    }
    
    public function show($jobId){
        $usersjob = UserJob::where('jobId', $jobId)->first();
        if($usersjob){
            return $this->successResponse($usersjob);
        }

            return $this->errorResponse("UserJob id not found", Response::HTTP_NOT_FOUND);
        }

}