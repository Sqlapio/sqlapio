<?php

namespace App\Http\Controllers;

use App\Models\DoctorCenter;
use App\Models\ExamPatient;
use App\Models\History;
use App\Models\User;
use App\Models\MedicalRecord;
use App\Models\MedicalReport;
use App\Models\Reference;
use App\Models\StudyPatient;
use App\Models\Treatment;
use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorPNG;

use Spatie\LaravelPdf\Enums\Format;
use Spatie\Browsershot\Browsershot;
use \Spatie\LaravelPdf\Enums\Orientation;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * PDF CONSULTAS
     */
    public function PDF_medical_record($id)
    {

        try {

            $MedicalRecord  = MedicalRecord::where('id',$id)->with('get_paciente')->first();
            $file           = $MedicalRecord->get_paciente->ci.'_'.date('YmdHms').'.pdf';
            $doctor_center  = DoctorCenter::where('user_id', $MedicalRecord->user_id)->where('center_id', $MedicalRecord->center_id)->first();
            $generator      = new BarcodeGeneratorPNG();
            $barcode        = base64_encode($generator->getBarcode($MedicalRecord->get_paciente->patient_code, $generator::TYPE_CODE_128));

            $data = [
                'date'          => date('m/d/Y'),
                'MedicalRecord' => $MedicalRecord,
                'doctor_center' => $doctor_center,
                'barcode'       => $barcode,
            ];

            $pdf = Pdf::loadView('pdf.PDF_medical_record', [
                'data'              => $data,
                'MedicalRecord'     => $MedicalRecord,
                'doctor_center'     => $doctor_center,
                'generator'         => $generator,
                'barcode'           => $barcode,
                'bg'                => Auth::user()->background_pdf == '' ? 'white.png' : Auth::user()->background_pdf,
                'nombre'            => Auth::user()->name.' '.Auth::user()->last_name,
                'especialidad'      => Auth::user()->specialty,
                'mpps'              => Auth::user()->cod_mpps,
                'ci'                => Auth::user()->ci,
                'direccion'         => $doctor_center->address,
                'piso'              => $doctor_center->number_floor,
                'consultorio_num'   => $doctor_center->number_consulting_room,
                'consultorio_tel'   => $doctor_center->phone_consulting_room,
                'personal_tel'      => Auth::user()->phone,
            ]);

            return $pdf->download($file);
            //code...
        } catch (\Throwable $th) {
            dd($th);
        }

    }

    /**
     * PDF RECIPES
     */
    public function PDF_medical_prescription($id)
    {
        try {

            $medical_prescription   = MedicalRecord::where('id', $id)->with('get_paciente')->first();
            $medicamentos           = Treatment::where('record_code', $medical_prescription->record_code)->get();
            $file                   = $medical_prescription->get_paciente->ci.'_'.date('YmdHms').'.pdf';
            $doctor_center          = DoctorCenter::where('user_id', $medical_prescription->user_id)->where('center_id', $medical_prescription->center_id)->first();
            $generator              = new BarcodeGeneratorPNG();
            $barcode                = base64_encode($generator->getBarcode($medical_prescription->get_paciente->patient_code, $generator::TYPE_CODE_128));

            $data = [
                'date'                  => date('m/d/Y'),
                'medical_prescription'  => $medical_prescription,
                'barcode'               => $barcode,
            ];

            $pdf = Pdf::loadView('pdf.PDF_medical_prescription', [

                        'data'                  => $data,
                        'medical_prescription'  => $medical_prescription,
                        'doctor_center'         => $doctor_center,
                        'medicamentos'          => $medicamentos,
                        'generator'             => $generator,
                        'barcode'               => $barcode,
                        'bg'                    => Auth::user()->background_pdf == '' ? 'white_horizontal.png' : Auth::user()->background_pdf,
                        'nombre'                => Auth::user()->name.' '.Auth::user()->last_name,
                        'especialidad'          => Auth::user()->specialty,
                        'mpps'                  => Auth::user()->cod_mpps,
                        'ci'                    => Auth::user()->ci,
                        'direccion'             => $doctor_center->address,
                        'piso'                  => $doctor_center->number_floor,
                        'consultorio_num'       => $doctor_center->number_consulting_room,
                        'consultorio_tel'       => $doctor_center->phone_consulting_room,
                        'personal_tel'          => Auth::user()->phone,

            ])->setPaper('letter', 'landscape');

            return $pdf->download($file);

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    /**
     * PDF INFORME MEDICO
     */
    public function PDF_informe_medico($id)
    {

        try {
            $MedicalReport  = MedicalReport::where('id', $id)->with('get_paciente')->first();
            $file           = $MedicalReport->get_paciente->ci.'_'.date('YmdHms').'.pdf';
            $generator      = new BarcodeGeneratorPNG();
            $doctor_center  = DoctorCenter::where('user_id', $MedicalReport->user_id)->where('center_id', $MedicalReport->center_id)->first();
            $barcode        = base64_encode($generator->getBarcode($MedicalReport->get_paciente->patient_code, $generator::TYPE_CODE_128));

            $data = [
                'date' => date('m/d/Y'),
                'MedicalReport' => $MedicalReport ,
                'barcode' => $barcode,

            ];
            $pdf = Pdf::loadView('pdf.PDF_medical_report', [
                        'data' => $data,
                        'MedicalReport' => $MedicalReport,
                        'barcode' => $barcode,
                        'bg' => Auth::user()->background_pdf == '' ? 'white.png' : Auth::user()->background_pdf,
                        'nombre'        => Auth::user()->name.' '.Auth::user()->last_name,
                        'especialidad'  => Auth::user()->specialty,
                        'mpps'          => Auth::user()->cod_mpps,
                        'ci'            => Auth::user()->ci,
                        'direccion'         => $doctor_center->address,
                        'piso'              => $doctor_center->number_floor,
                        'consultorio_num'   => $doctor_center->number_consulting_room,
                        'consultorio_tel'   => $doctor_center->phone_consulting_room,
                        'personal_tel'      => Auth::user()->phone,
            ]);

            return $pdf->download($file);

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    /**
     * PDF INFORME EXAMENES
     */
    public function PDF_exam($id)
    {

        try {

            $MedicalRecord  = MedicalRecord::where('id', $id)->with('get_paciente')->first();
            $file           = $MedicalRecord->get_paciente->ci.'_'.date('YmdHms').'.pdf';
            $generator      = new BarcodeGeneratorPNG();
            $doctor_center  = DoctorCenter::where('user_id', $MedicalRecord->user_id)->where('center_id', $MedicalRecord->center_id)->first();
            $barcode        = base64_encode($generator->getBarcode($MedicalRecord->get_paciente->patient_code, $generator::TYPE_CODE_128));

            $data = [
                'date' => date('m/d/Y'),
                'MedicalRecord' => $MedicalRecord ,
                // 'barcode' => $barcode,

            ];

            $pdf = Pdf::loadView('pdf.PDF_exam', [
                        'data'              => $data,
                        'MedicalRecord'     => $MedicalRecord,
                        'barcode'           => $barcode,
                        'bg'                => Auth::user()->background_pdf == '' ? 'white.png' : Auth::user()->background_pdf,
                        'data_exam'         => ExamPatient::where('record_code', $MedicalRecord->record_code)->get(),
                        'nombre'            => Auth::user()->name.' '.Auth::user()->last_name,
                        'especialidad'      => Auth::user()->specialty,
                        'mpps'              => Auth::user()->cod_mpps,
                        'ci'                => Auth::user()->ci,
                        'direccion'         => $doctor_center->address,
                        'piso'              => $doctor_center->number_floor,
                        'consultorio_num'   => $doctor_center->number_consulting_room,
                        'consultorio_tel'   => $doctor_center->phone_consulting_room,
                        'personal_tel'      => Auth::user()->phone,
            ]);

            return $pdf->download($file);

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    /**
     * PDF INFORME ESTUDIO
     */
    public function PDF_study($id)
    {
        try {

            $MedicalRecord  = MedicalRecord::where('id', $id)->with('get_paciente')->first();
            $file           = $MedicalRecord->get_paciente->ci.'_'.date('YmdHms').'.pdf';
            $generator      = new BarcodeGeneratorPNG();
            $doctor_center  = DoctorCenter::where('user_id', $MedicalRecord->user_id)->where('center_id', $MedicalRecord->center_id)->first();
            $barcode        = base64_encode($generator->getBarcode($MedicalRecord->get_paciente->patient_code, $generator::TYPE_CODE_128));

            $data = [
                'date' => date('m/d/Y'),
                'MedicalRecord' => $MedicalRecord ,
                'barcode' => $barcode,

            ];

            $pdf = Pdf::loadView('pdf.PDF_study', [
                        'data'              => $data,
                        'MedicalRecord'     => $MedicalRecord,
                        'barcode'           => $barcode,
                        'bg'                => Auth::user()->background_pdf == '' ? 'white.png' : Auth::user()->background_pdf,
                        'data_exam'         => StudyPatient::where('record_code', $MedicalRecord->record_code)->get(),
                        'nombre'            => Auth::user()->name.' '.Auth::user()->last_name,
                        'especialidad'      => Auth::user()->specialty,
                        'mpps'              => Auth::user()->cod_mpps,
                        'ci'                => Auth::user()->ci,
                        'direccion'         => $doctor_center->address,
                        'piso'              => $doctor_center->number_floor,
                        'consultorio_num'   => $doctor_center->number_consulting_room,
                        'consultorio_tel'   => $doctor_center->phone_consulting_room,
                        'personal_tel'      => Auth::user()->phone,
            ]);

            return $pdf->download($file);
            //code...
        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
