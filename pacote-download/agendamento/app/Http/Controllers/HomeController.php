<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
use App\Models\User;      
use App\Models\Appointment;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function redirect(){
        
        if(Auth::id()){

            if(Auth::user()->usertype=='0')
            {
                
                $doctor = doctor::all();
                return view('user.home', compact('doctor'));
            }
            else
            {
                $exappointmentCount = Appointment::where('status', 'Negada')->count();
                $userCount = User::count();
                $appointmentCount = Appointment::count();
                $doctorCount = Doctor::count();
                return view('admin.home', compact('doctorCount','appointmentCount', 'exappointmentCount','userCount'));
            }

        }else{
            return redirect()->back();
        }
}
public function index() {
    $doctor = doctor::all();

    if (auth()->check()) {
        // Usuário está logado
        return view('user.home', compact('doctor'));
    } else {
        // Usuário não está logado
        return view('user.home1', compact('doctor'));
    }
}

        public function appointment(Request $request){
            $data = new appointment;
            $data->name=$request->name;
            $data->email=$request->email;
            $data->phone=$request->phone;
            $data->date=$request->date;
            $data->message=$request->message;
            $data->doctor=$request->doctor;
            $data->status="Pendente";
            if(Auth::id()){
            $data->user_id=Auth::user()->id;
            }
            $data->save();
            return redirect()->back()->with('message', 'Pedido de Consulta enviado com sucesso!');

        }

        public function myappointment(){
            if(Auth::id())
            {
                if(Auth::user()->usertype==0)
                {
                $appointmentCount = Appointment::where('user_id', Auth::id())->count();
                $userid=Auth::user()->id;
                //$data = Doctor::orderBy('created_at', 'desc')->get();
                $appoint=Appointment::where('user_id',$userid)->orderBy('date', 'asc')->get();
                return view('user.my_appoitment', compact('appoint','appointmentCount'));
            }
            else
            {
                return redirect()->back();
            }
            }
            else
            {
                return redirect()->back();
            }
            

        }
        
        public function cancel_appoint($id)
        {
            $data=appointment::find($id);
            $data->delete();
            return redirect()->back()->with('message', 'Consulta Apagada');;
        }
        private function updateAppointmentStatuses()
        {
            $today = Carbon::today();
            Appointment::where('date', '<', $today)
                ->where('status', '==', 'Pendente')
                ->update(['status' => 'Negada']);
        }
        
}
