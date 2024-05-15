<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SymptomList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Intolerancia al calor')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Radioterapia en tejidos irradiados previamente')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infecciones bacterianas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Reflujo gastroesofágico')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas respiratorios en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Evaluación médica en casos legales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Rehabilitación post-lesiones traumáticas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Tratamiento con oxígeno hiperbárico')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Entumecimiento y hormigueo')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Rehabilitación post-accidente cerebrovascular')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Determinación de capacidad mental')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Quistes')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en la visión')),
            ],

            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Estreñimiento')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Depresión')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infecciones pediátricas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía de contorno corporal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Otorrinolaringología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Embarazo y atención prenatal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de voz')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cuidados a largo plazo')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Genética prenatal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sangrado anormal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Ojos secos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Nutrición infantil')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía de vesícula biliar')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Gastroscopia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Movimientos anormales durante el sueño')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Hernias')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Planificación de dietas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cáncer de sangre (leucemia, linfoma)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Intolerancia al frío')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Pólipos nasales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Ojos rojos y picazón')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Lesiones deportivas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en la percepción de colores')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Erupciones cutáneas en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infectología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastornos de ansiedad social')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de equilibrio')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Efectos secundarios de tratamientos oncológicos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Asma alérgica')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Narcolepsia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en la micción')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Nutrición en el envejecimiento')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Anemia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Abuso de sustancias y adicciones')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Rosácea y enrojecimiento facial')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía General')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Incontinencia urinaria')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Envenenamiento por monóxido de carbono')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Investigación de negligencia médica')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dificultad para orinar')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedades cardíacas congénitas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Mejora de la funcionalidad')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Autopsias forenses')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Medicina Deportiva')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Diarrea')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en el flujo de orina')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía Plástica y Estética')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Planificación de cuidados avanzados')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Tos persistente')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Evaluación de la condición física')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Criopreservación de óvulos y embriones')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en el peso')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Fatiga')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Esquizofrenia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Convulsiones')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infecciones cutáneas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Fracturas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía de bypass coronario')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('VIH/SIDA')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor en los ojos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de concepción')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sangrado vaginal anormal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Neurología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Diabetes')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Colonoscopia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor en el pecho')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedades infecciosas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Documentación y testimonio pericial')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Oftalmología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Medicina del Sueño')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Vómitos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastornos hematológicos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Moretones')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sangrado gastrointestinal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infecciones respiratorias en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Síntomas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedad inflamatoria intestinal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sibilancias en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Determinación de la hora de la muerte')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedades neuromusculares')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Polifarmacia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor abdominal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Tos en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Estiramiento facial (ritidectomía)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Vacunación infantil')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dificultad para respirar en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infecciones fúngicas (micosis)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en el flujo vaginal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Úlceras por presión')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sed excesiva')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Ortopedia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dificultad respiratoria severa')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Genética Médica')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Investigación de causas de muerte')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Piedras en el riñón')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Fatiga extrema')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Evaluación de la salud reproductiva')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Rigidez')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de la piel')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Angioplastia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Medicina Interna')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Análisis de árbol genealógico')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Terapias dirigidas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dermatitis')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedades pulmonares')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Tos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Aneurismas aórticos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infecciones respiratorias frecuentes')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trasplante de corazón')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor al orinar')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Colectomía (cirugía de colon)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor en los huesos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Shock')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Entumecimiento')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Rehabilitación postoperatoria')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Inmunodeficiencias primarias')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Meningitis')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Asma en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Mejora del rendimiento deportivo')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de alimentación en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Osteomielitis refractaria')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Gangrena gaseosa')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Medicina Forense')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía de tiroides')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Adaptación al entorno')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Endocrinología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Diabetes y nutrición')),
            ],

            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en el ciclo menstrual')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor en las articulaciones')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Menopausia y trastornos hormonales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Esclerosis múltiple')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedades de transmisión sexual')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía Cardiovascular')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en los hábitos intestinales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Alergias a medicamentos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Fatiga extrema en atletas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Marcapasos y desfibriladores')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Genética del cáncer')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Metástasis')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sibilancias')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infecciones urinarias frecuentes')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Artritis')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor en la parte baja del abdomen')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Monitorización de la función sanguínea')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Terapia génica')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Fertilización in vitro (FIV)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastornos del ritmo circadiano')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor durante las relaciones sexuales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Caídas y fracturas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infartos de miocardio')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Expectoración de moco')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sangrado entre periodos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Mareos y vértigo')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Evaluación de abuso y negligencia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor en las articulaciones y huesos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sangre en la orina')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Informes periciales médicos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de columna vertebral')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Insuficiencia cardíaca')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Inmunología y Alergias')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Manejo del dolor crónico')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infecciones virales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Abscesos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Tratamientos de infertilidad')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Parálisis del sueño')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastornos de coagulación')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Lesiones neuromusculoesqueléticas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedades renales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Tos persistente en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Toxicología forense')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Pediatría')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Diplopía (visión doble)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Hinchazón')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Conjuntivitis')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Paro cardíaco')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Lesiones por descompresión (buceo)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Fibrosis quística')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de fertilidad')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Pruebas de alergia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastorno de estrés postraumático (TEPT)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas visuales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Identificación de víctimas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía de orejas (otoplastia)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Ginecología y Obstetricia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastornos gastrointestinales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Retinopatía diabética')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Accidentes cerebrovasculares')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Malformaciones pulmonares en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trombocitopenia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Urticaria')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Deformidades musculoesqueléticas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Análisis de evidencia en casos criminales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Medicina del ejercicio')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trasplante de médula ósea')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cáncer')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sinusitis')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Artritis y enfermedades autoinmunes')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Alergias respiratorias (rinitis alérgica)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Planificación de entrenamiento')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Úlceras estomacales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastornos de cicatrización')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Picazón en los ojos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Infecciones urinarias recurrentes')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Alergias alimentarias')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Identificación de víctimas de desastres')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Evaluación de daños personales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Hematología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Urología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedades cardíacas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedades de transmisión sexual (ETS)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor oncológico')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor en la espalda baja')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Medicina Legal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastornos del sueño en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Equipos de asistencia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastornos electrolíticos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Apnea del sueño en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Picazón genital')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía de mama')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Alergias respiratorias')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Medicina de Urgencias')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Tratamiento de trastornos alimentarios')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Síndrome de ovario poliquístico (SOP)')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Genética pediátrica')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Prevención de lesiones')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Ronquidos y apnea del sueño')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Migrañas')),
            ],

            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Intoxicaciones')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Pérdida de visión periférica')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Fotofobia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Secreción vaginal anormal')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Anafilaxia')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enfermedad coronaria')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Liposucción')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Apendicitis')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor abdominal en niños')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de comportamiento')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Asesoramiento genético')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Debilidad')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Seguimiento post-tratamiento')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cuidados paliativos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Hambre excesiva')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Lesiones en tejidos blandos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Sensibilidad')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas en el embarazo')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dermatología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Medicina Reproductiva')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Náuseas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Dolor pélvico')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Apnea del sueño')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de sueño')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Oncología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Alergias cutáneas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Evaluación de lesiones traumáticas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Acidez')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastorno bipolar')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas de espalda')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Trastornos alimentarios')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Control de peso')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Reacciones alérgicas graves')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cirugía de reemplazo valvular')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Pérdida de apetito')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Urgencias pediátricas')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Quistes y tumores cutáneos')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Enrojecimiento ocular')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Problemas renales')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en la piel')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Hipertensión')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Cambios en los lunares')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Gastroenterología')),
            ],
            [
                'cod_symptoms' => 'SQ-SY-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('Recuperación de espermatozoides')),
            ],

        ];

        Symptom::insert($data);
    }
}
