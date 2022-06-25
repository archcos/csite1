<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserJob;
use App\Traits\ApiResponser;
use DB;

Class UserController extends Controller {
    use ApiResponser;

    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }
    public function getUsers(){
    
    $users = DB::connection('mysql')
    ->select("Select * from tbluser");
    
    return $this->successResponse($users);  
   
    }

    public function index(){

        $users = User::all();

        return $this->successResponse($users);
    }

    public function add(Request $request){
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
            'jobId' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);

        $userjob = UserJob::findOrFail($request->jobId);
        $user = User::create($request->all());

    return $this->successResponse($user, Response::HTTP_CREATED);
    }

    public function show($id){
        $user = User::where('id', $id)->first();
        if($user){
            return $this->successResponse($user);
        }

            return $this->errorResponse("User id not found", Response::HTTP_NOT_FOUND);
        }

    public function update(Request $request, $id)  {
        $user = User::findOrFail($id);
        $user->update($request->all());
    
            return $this->successResponse($user, Response::HTTP_CREATED);
        }

    public function delete($id, Request $request)
        {
            $user = User::findOrFail($id);
            $user->delete($request->all());

            return $this->successResponse($user, Response::HTTP_OK);
        }

}