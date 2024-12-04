<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\View;


class AdminController extends Controller
{
   
    public function addview()
    {
        if(Auth::id()){
            if(Auth::user()->usertype==1){
                return view('admin.add_doctor');        
            }else{
            return redirect()->back();}
        }else{
            return redirect('login');
        }
        
    }
  
    public function upload(Request $request)
{
    // Criação de uma nova instância do modelo Doctor
    $doctor = new Doctor;
    
    // Obtém o arquivo de imagem do request
    $image = $request->file('file');
    
    // Verifica se a imagem foi carregada corretamente
    if ($image && $image->isValid()) {
        // Gera um nome único para a imagem com base no timestamp atual e na extensão original do arquivo
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        
        // Move a imagem para a pasta 'doctorimage' com o novo nome gerado
        $image->move('doctorimage', $imagename);
        
        // Define o nome da imagem no modelo Doctor
        $doctor->image = $imagename;
    } else {
        // Caso o upload da imagem falhe, pode-se adicionar um tratamento de erro aqui
        return redirect()->back()->with('message', 'Erro ao carregar a imagem.');
    }

    // Define outros campos no modelo Doctor com base no request
    $doctor->name = $request->name;
    $doctor->phone = $request->phone;
    $doctor->room = $request->room;
    $doctor->speciality = $request->speciality;
    
    // Salva o modelo Doctor no banco de dados
    $doctor->save();
    
    // Redireciona de volta com uma mensagem de sucesso
    return redirect('showdoctor')->with('message', 'Medico adicionado com sucesso.');

}

public function showappointment()
    {
        //$data=Appointment::all();
        $data = Appointment::orderBy('date', 'asc')->get();
        if(Auth::id()){
            if(Auth::user()->usertype==1){
                View::share('sharedData', $data);
                return view('admin.showappointment', compact('data'));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect('login');
        }
        
    }
    public function approved($id)
    {
        $data=appointment::find($id);
        $data->status='Aprovada';
        $data->save();
        return redirect()->back()->with('message', 'Consulta aprovada');;
    }
    public function canceled($id)
    {
        $data=appointment::find($id);
        $data->status='Negada';
        $data->save();
        return redirect()->back()->with('message', 'Consulta negada');
    }
    public function showdoctor()
    {
        $data = Doctor::orderBy('created_at', 'desc')->get();
        return view('admin.showdoctor', compact('data'));
    }
    
    public function deletedoctor($id)
    {
        $data=doctor::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Eliminado com sucesso');
    }
    public function updatedoctor($id)
    {
        $data=doctor::find($id);
        return view('admin.update_doctor', compact('data'));
    }

    public function editdoctor(Request $request, $id)
    {
        $doctor=doctor::find($id);
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->room = $request->room;
        $doctor->speciality = $request->speciality;
        
    $image=$request->file;
    if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();
    $request->file->move('doctorimage',$imagename);
    $doctor->$image=$imagename;        
    }
    
    $doctor->save();    
    return redirect('showdoctor')->with('message', 'Medico actualizado com sucesso!');
    }

    public function emailview($id){
        $data=appointment::find($id);
        return view('admin.email_view', compact('data'));
    }
    public function sendemail(Request $request, $id){
        $data=appointment::find($id);
        $details=[
            'greeting'=>$request->greeting,
            'body'=>$request->body,
            'actiontext'=>$request->actiontext,
            'actionurl'=>$request->actionurl,
            'endpart'=>$request->endpart

        ];
        Notification::send($data, new SendEmailNotification($details));
        return redirect('admin.showappointment')->with('message', 'Notificação enviada com sucesso!');
    }
    
}
