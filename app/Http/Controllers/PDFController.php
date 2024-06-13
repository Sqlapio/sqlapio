<?php

namespace App\Http\Controllers;

use App\Models\DoctorCenter;
use App\Models\History;
use App\Models\User;
use App\Models\MedicalRecord;
use App\Models\MedicalReport;
use App\Models\Reference;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Spatie\Browsershot\Browsershot;

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
        $doctor_center = DoctorCenter::where('user_id', $MedicalRecord->user_id)->where('center_id', $MedicalRecord->center_id)->first();
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode('SQ-16007868-543', $generator::TYPE_CODE_128));
        $data = [
            'date' => date('m/d/Y'),
            'MedicalRecord' => $MedicalRecord,
            'doctor_center' => $doctor_center,
            'barcode' => $barcode,
        ];
        return view("pdf.PDF_medical_record", compact('MedicalRecord', 'generator', 'barcode', 'data', 'doctor_center'));
        // return $pdf->stream('consulta-medica.pdf');
        Browsershot::url('https://system.sqlapio.com/pdf/medical-record-pp/'.$id)
        ->setNodeBinary('/usr/bin/node')
    	->setNpmBinary('/usr/bin/npm')
        ->setChromePath('/usr/bin/chromium')
        ->landscape()
        ->save($id.'_example.pdf');
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

    public function PDF_medical_prescription($id){

        $medical_prescription = MedicalRecord::where('id', $id)->first();
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode('SQ-16007868-543', $generator::TYPE_CODE_128));
        $data = [
            'date' => date('m/d/Y'),
            'medical_prescription' => $medical_prescription,
            'barcode' => $barcode,
        ];
        $pdf = PDF::loadView('pdf.PDF_medical_prescription', $data);
        return $pdf->stream('medical-prescription.pdf');

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

    public function PDF_informe_medico($id)
    {
        $MedicalReport = MedicalReport::where('id', $id)->first();
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode('SQ-16007868-543', $generator::TYPE_CODE_128));
        $data = [
            'date' => date('m/d/Y'),
            'MedicalReport' => $MedicalReport ,
            'barcode' => $barcode,

        ];
        $pdf = PDF::loadView('pdf.PDF_medical_report', $data);
        return $pdf->stream('Refencia.pdf');
    }
}
