<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\User;
use App\Hobby;
use Mail;
use App\Mail\CreateHobby;
use App\Mail\UpdateHobby;
use App\Mail\DeleteHobby;
use Validator;
class UserController extends Controller
{
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }


    public function sendError($error, $errorMessages = [], $code =200)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function create(Request $request){
        //return $request;
        $input = $request->all();
       // return $input;
        $validator = Validator::make($input, [
            'hobby' => 'required',
            'user_id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $hobby = Hobby::create($input);
        Mail::to($hobby->user->email)->send(new CreateHobby($hobby));
        return $this->sendResponse($hobby->toArray(), 'Hobby added successfully.');
       // Mail::to($hobby->user->email)->send(new CreateHobby($hobby,$user));
    }
  
    public function allhobby($id){
        $hobbies = Hobby::where('user_id',$id)->get();
        if(!$hobbies){
            return $this->sendError('Unknown user id'); 
        }else{
            return $this->sendResponse($hobbies->toArray(),'done');
        }
    }
    public function update(Request $request)
    {
         $hobby = Hobby::where('user_id',$request->user_id)
                       ->first();
         if(!$hobby){
             return $this->sendError('Unknown user id'); 
           }else{
               //return $hobby;
                $hobby->hobby = $request->hobby;
                $hobby->save();
                Mail::to($hobby->user->email)->send(new UpdateHobby($hobby));
                return $this->sendResponse($hobby->toArray(), 'Hobby updated successfully.');
           }
    }

    public function delete($id){

      $hobby = Hobby::find($id);
       if(!$hobby){
          return $this->sendError('Unknown user id'); 
       }else{   
            
             $hobby->delete();
             Mail::to($hobby->user->email)->send(new DeleteHobby($hobby));
            return $this->sendResponse($hobby->toArray(), 'Hobby deleted successfully.');
       }
    }
}

