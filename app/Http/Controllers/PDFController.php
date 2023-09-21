<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use App\Models\MedicalRecord;
use App\Models\Reference;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $users = User::get();
  
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users
        ]; 
            
        $pdf = PDF::loadView('pdf.myPDF', $data);
     
        return $pdf->download('itsolutionstuff.pdf');
    }

    public function PDF_medical_record($id)
    {
        $MedicalRecord = MedicalRecord::where('id',$id)->first();
        $data = [
            'date' => date('m/d/Y'),
            'MedicalRecord' => $MedicalRecord,
        ];            
        $pdf = PDF::loadView('pdf.PDF_medical_record', $data);
        return $pdf->stream('consulta-medica.pdf');
    }

    public function PDF_history($id)
    {
        $history = History::where('id', $id)->first();
            
        $data = [
            'date' => date('m/d/Y'),
            'history' => $history,
        ];    
        // dd( $history);     
        $pdf = PDF::loadView('pdf.PDF_history', $data);
        return $pdf->stream('historia-clinica.pdf');
    }

    public function PDF_ref($id)
    {
        $reference = Reference::where('id', $id)->first();
        $data = [
            'date' => date('m/d/Y'),
            'reference' => $reference ,
        ];    
        $pdf = PDF::loadView('pdf.PDF_ref', $data);
        return $pdf->stream('Refencia.pdf');
    }
}
