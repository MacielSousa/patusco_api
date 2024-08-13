<?php

namespace App\Http\Controllers\Consult\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultEditRequest;
use App\Http\Requests\ConsultRequest;
use App\Models\Consult;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    public function register(ConsultRequest $request, Consult $consul)
    {
        $consultData = $request->validated();

        $consultData['user_id'] = $consultData['user_id'] ??  auth()->user()->id;

        if(!$consul = $consul->create($consultData))
        {
            abort(400, 'Error to create a new consult...!!'); 
        }

        return response()->json([
            'data' => [
                'user' => $consul
            ]
        ]);
    }

    public function list(Request $request)
    {
        $user_id = auth()->user()->id;
        $consults = Consult::where('user_id', $user_id)->get();

        return response()->json([
            'data' => [
                'consults' => $consults
            ]
        ]);
    }

    public function delete($id)
    {
        $consult = Consult::find($id);
        if (!$consult) {
            return response()->json(['error' => 'Consultation not found'], 404);
        }

        $consult->delete();

        return response()->json(['message' => 'Consultation deleted successfully']);
    }

    public function update(ConsultEditRequest $request, $id)
    {
        $consult = Consult::findOrFail($id);
        $consultData = $request->validated();
        $consult->update($consultData);
        return response()->json($consult, 200);
    }

    public function filter(Request $request)
    {
        $query = Consult::query()
            ->leftJoin('users', 'consults.user_id', '=', 'users.id')
            ->select('consults.*', 'users.name as user_name', 'users.email as user_email');
        if(Auth::user()->type_user === User::TYPE_USER_DOCTOR)
        {
          $query = $query->where('doctor_id', Auth::user()->id);
        }

        if($request->animal_type)
        {
            $query = $query->where('animal_type', $request->animal_type);
        }

        if ($request->date) {
            $query->whereDate('date', $request->date);
        }

        $consults = $query->get();

        $consultsData = $consults->map(function ($consult) {
            $doctor = User::where('id',  $consult->doctor_id)->first();
            return [
                'id' => $consult->id,
                'animal_name' => $consult->animal_name,
                'animal_type' => $consult->animal_type,
                'age' => $consult->age,
                'symptoms' => $consult->symptoms,
                'date' => $consult->date,
                'time_of_day' => $consult->time_of_day,
                'user_id' => $consult->user_id,
                'doctor_id' => $consult->doctor_id,
                'receptionist_id' => $consult->receptionist_id,
                'doctor_name' => $consult->doctor_id ? $doctor->name : '',
                'doctor_email' => $consult->doctor_id ? $doctor->email : '',
                'user_name' => $consult->user_name,
                'user_email' => $consult->user_email,
            ];
        });
        return response()->json([
            'data' => [
                'consults' => $consultsData
            ]
        ]);
    }

    public function getDoctors()
    {
        $doctors = User::where('type_user', User::TYPE_USER_DOCTOR)->get()->map(function ($doctor) {
            return ['value' => $doctor->id, 'label' => $doctor->name];
        });
    
        return response()->json([
            'data' => ['doctors' => $doctors]
        ]);
    }

    public function assignDoctor($consult_id, $doctor_id)
    {
        $consult = Consult::find($consult_id);
        $consult->doctor_id = $doctor_id;
        $consult->save();

        return response()->json([
            'data' => ['doctors' => $consult]
        ]);
    }
}
