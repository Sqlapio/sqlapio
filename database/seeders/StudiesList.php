<?php

namespace Database\Seeders;

use App\Models\Study;
use App\Models\StudyList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudiesList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            //RADIOLOGIA GENERAL DE CRANEO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE CRANEO SIMPLE')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CRANEO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE BASE DE CRANEO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CRANEO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE SILLA TURCA')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CRANEO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE MASTOIDES COMPARATIVAS')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CRANEO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE PEÑASCOS')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CRANEO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE CONDUCTO AUDITIVO INTERNO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CRANEO')),
            ],

            //RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE CARA (PERFILOGRAMA)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ORBITAS')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE AGUJEROS OPTICOS')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE MALAR')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ARCO CIGOMATICO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE HUESOS NASALES')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE SENOS PARANASALES')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE MAXILAR SUPERIOR')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE MAXILAR INFERIOR')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ARTICULACION TEMPOROMAXILAR [ATM]')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CARA O HUESOS FACIALES')),
            ],

            //RADIOLOGIA GENERAL DE CUELLO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE TEJIDOS BLANDOS DE CUELLO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE CAVUM FARINGEO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CUELLO')),
            ],

            //RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL 11

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE COLUMNA CERVICAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE COLUMNA UNION CERVICO DORSAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE COLUMNA TORACICA')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE COLUMNA DORSOLUMBAR')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE COLUMNA LUMBOSACRA')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE SACRO COCCIX')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE COLUMNA VERTEBRAL TOTAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  PANORAMICA DE COLUMNA (GONIOMETRIA U ORTOGRAMA) FORMATO 14″ X 36″ (ADULTOS)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  PANORAMICA DE COLUMNA (GONIOMETRIA U ORTOGRAMA) FORMATO 14″ X 17″ (NIÑOS)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DINAMICA DE COLUMNA VERTEBRAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ARTICULACIONES SACROILIACAS')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE COLUMNA VERTEBRAL')),
            ],

            //RADIOLOGIA GENERAL DE TORAX 5

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE REJA COSTAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ESTERNON')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE TORAX (PA O AP Y LATERAL DECUBITO LATERAL OBLICUAS O LATERAL) CON BARIO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ARTICULACIONES ESTERNOCLAVICULARES')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('MOVILIDAD DIAFRAGMATICA POR FLUOROSCOPIA PULMONAR')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE TORAX')),
            ],

            //RADIOLOGIA GENERAL DE CORAZON Y GRANDES VASOS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('APICOGRAMA')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CORAZON Y GRANDES VASOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  PARA SERIE CARDIOVASCULAR (CORAZON Y GRANDES VASOS SILUETA CARDIACA) CON BARIO EN ESOFAGO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE CORAZON Y GRANDES VASOS')),
            ],

            //RADIOLOGIA GENERAL DE MEDIASTINO Y ORGANOS RELACIONADOS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ESOFAGO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE MEDIASTINO Y ORGANOS RELACIONADOS')),
            ],

            //RADIOLOGIA GENERAL DE ABDOMEN

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ABDOMEN SIMPLE')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ABDOMEN')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ABDOMEN SIMPLE CON PROYECCIONES ADICIONALES (SERIE DE ABDOMEN AGUDO)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ABDOMEN')),
            ],

            //RADIOLOGIA GENERAL DE VIA DIGESTIVA 7

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE TRANSITO INTESTINAL CONVENCIONAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE VIA DIGESTIVA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE TRANSITO INTESTINAL DOBLE CONTRASTE')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE VIA DIGESTIVA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE COLON POR ENEMA O COLON POR INGESTA')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE VIA DIGESTIVA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE COLON POR ENEMA CON DOBLE CONTRASTE')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE VIA DIGESTIVA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE VIAS DIGESTIVAS ALTAS (ESOFAGO ESTOMAGO Y DUODENO)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE VIA DIGESTIVA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE VIAS DIGESTIVAS ALTAS (ESOFAGO ESTOMAGO Y DUODENO) CON DOBLE CONTRASTE')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE VIA DIGESTIVA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE VIAS DIGESTIVAS ALTAS (ESOFAGO ESTOMAGO Y DUODENO) Y TRANSITO INTESTINAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE VIA DIGESTIVA')),
            ],

            //RADIOLOGIA GENERAL DE VASOS INTRABDOMINALES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('AORTOGRAMA ABDOMINAL POR CATETERISMO BRAQUIAL RETROGRADO O POR CATETERISMO FEMORAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE VASOS INTRABDOMINALES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('AORTOGRAMA ABDOMINAL Y ESTUDIO DE MIEMBROS INFERIORES')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE VASOS INTRABDOMINALES')),
            ],

            //RADIOLOGIA GENERAL DE EXTREMIDADES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  PARA SERIE ESQUELETICA')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE HUESOS LARGOS SERIE COMPLETA (ESQUELETO AXIAL Y APENDICULAR)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  PARA ESTUDIOS DE LONGITUD DE LOS HUESOS (ORTORRADIOGRAFÍA  Y ESCANOGRAMA)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  PARA DETECTAR EDAD OSEA [CARPOGRAMA]')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES')),
            ],

            //RADIOLOGIA GENERAL DE EXTREMIDADES SUPERIORES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE OMOPLATO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES SUPERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE CLAVICULA')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES SUPERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE HUMERO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES SUPERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ANTEBRAZO')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES SUPERIORES')),
            ],

            //RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES 11

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  PARA MEDICION DE MIEMBROS INFERIORES [ESTUDIO DE FARILL U OSTEOMETRIA] ESTUDIO DE PIE PLANO (PIES CON APOYO)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  PANORAMICA DE MIEMBROS INFERIORES (GONIOMETRIA U ORTOGRAMA) EN FORMATO 14″ X 36″ (ADULTOS)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  PANORAMICA DE MIEMBROS INFERIORES (GONIOMETRIA U ORTOGRAMA) EN FORMATO 14″ X 17″ (NIÑOS)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DIGITAL DE MIEMBROS INFERIORES (ESTUDIO DE LONGITUD)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ANTEVERSION FEMORAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE FEMUR (AP LATERAL)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE PIERNA (AP LATERAL)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ANTEVERSION TIBIAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE PIE (AP LATERAL)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE CALCANEO (AXIAL Y LATERAL)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE MIEMBRO INFERIOR (AP LATERAL)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE EXTREMIDADES INFERIORES')),
            ],

            //RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE CADERA O ARTICULACION COXO-FEMORAL (AP LATERAL)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE CADERA COMPARATIVA')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE RODILLA (AP LATERAL)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE RODILLAS COMPARATIVAS POSICION VERTICAL (UNICAMENTE VISTA ANTEROPOSTERIOR)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  TANGENCIAL DE ROTULA')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA S AXIALES DE ROTULA O LONGITUD DE MIEMBROS INFERIORES')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE TOBILLO (AP LATERAL Y ROTACION INTERNA)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA  DE ANTEPIE (AP OBLICUA)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA S COMPARATIVAS DE EXTREMIDADES INFERIORES')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RADIOGRAFÍA S EN EXTREMIDADES PROYECCIONES ADICIONALES (STRESS TUNEL OBLICUAS)')),
                'category' => ucfirst(strtolower('RADIOLOGIA GENERAL DE ARTICULACIONES DE MIEMBRO INFERIOR')),
            ],

            //FLUOROSCOPIA COMO GUIA

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLUOROSCOPIA COMO GUIA PARA PROCEDIMIENTOS')),
                'category' => ucfirst(strtolower('FLUOROSCOPIA COMO GUIA')),
            ],

            //ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO 14

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE CAROTIDA EXTERNA BILATERAL SELECTIVA EXTRACRANENANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE CAROTIDA EXTERNA BILATERAL SELECTIVA INTRACRANEANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE CAROTIDA EXTERNA UNILATERAL SELECTIVA EXTRACRANEANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE CAROTIDA EXTERNA UNILATERAL SELECTIVA INTRACRANEANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE CAROTIDA INTERNA BILATERAL SELECTIVA EXTRACRANENANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE CAROTIDA INTERNA BILATERAL SELECTIVA INTRACRANENANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE CAROTIDA INTERNA UNILATERAL SELECTIVA EXTRACRANEANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE CAROTIDA INTERNA UNILATERAL SELECTIVA INTRACRANEANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE CAROTIDA BILATERAL SELECTIVA EXTRACRANEANA CON AORTOGRAMA DE CAYADO')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA VERTEBRAL')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA VERTEBRAL SELECTIVA EXTRACRANEANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA VERTEBRAL SELECTIVA INTRACRANEANA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA VERTEBRAL BILATERAL SELECTIVA CON CAROTIDAS (PANANGIOGRAFIA)')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA VERTEBRAL BILATERAL SELECTIVA EXTRACRANEANA CON AORTOGRAMA DE CAYADO')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS DE LA CABEZA CARA Y CUELLO')),
            ],

            //RADIOGRAFÍA S DE CONTRASTE EN CEREBRO Y CRANEO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('CISTERNOGRAFIA SOD')),
                'category' => ucfirst(strtolower('RADIOGRAFÍA S DE CONTRASTE EN CEREBRO Y CRANEO')),
            ],

            //FLEBOGRAFIA DE VASOS DE CABEZA Y CUELLO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('VENOGRAFIA SELECTIVA DIAGNOSTICA DE CABEZA Y CUELLO (UNO O MAS VASOS)')),
                'category' => ucfirst(strtolower('FLEBOGRAFIA DE VASOS DE CABEZA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA DE SENO SAGITAL SUPERIOR')),
                'category' => ucfirst(strtolower('FLEBOGRAFIA DE VASOS DE CABEZA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA EPIDURAL')),
                'category' => ucfirst(strtolower('FLEBOGRAFIA DE VASOS DE CABEZA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA ORBITARIA')),
                'category' => ucfirst(strtolower('FLEBOGRAFIA DE VASOS DE CABEZA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA YUGULAR CON CATETER')),
                'category' => ucfirst(strtolower('FLEBOGRAFIA DE VASOS DE CABEZA Y CUELLO')),
            ],

            //ARTROGRAFIA EN CABEZA CARA Y CUELLO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTROGRAFIA DE ARTICULACION TEMPORO MANDIBULAR')),
                'category' => ucfirst(strtolower('ARTROGRAFIA EN CABEZA CARA Y CUELLO')),
            ],

            //DACRIOCISTOGRAFIA
            
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DACRIOCISTOGRAFIA UNILATERAL')),
                'category' => ucfirst(strtolower('DACRIOCISTOGRAFIA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DACRIOCISTOGRAFIA BILATERAL')),
                'category' => ucfirst(strtolower('DACRIOCISTOGRAFIA')),
            ],

            //SIALOGRAFIA

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('SIALOGRAFIA (CUALQUIER GLANDULA) SOD')),
                'category' => ucfirst(strtolower('SIALOGRAFIA')),
            ],

            //RADIOLOGIA ESPECIAL EN CUELLO FARINGE LARINGE

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FARINGOLARINGOGRAFIA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL EN CUELLO FARINGE LARINGE')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FARINGOLARINGOGRAFIA DINAMICA (CON CINE O VIDEO)')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL EN CUELLO FARINGE LARINGE')),
            ],

            //ARTERIOGRAFIA DE VASOS ESPINALES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ANGIOGRAFIA ESPINAL POR SEGMENTO (CERVICAL TORACICO O LUMBAR) SOD')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIA DE VASOS ESPINALES')),
            ],

            //FLEBOGRAFIA DE VASOS ESPINALES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA DE VASOS ESPINALES SOD')),
                'category' => ucfirst(strtolower('FLEBOGRAFIA DE VASOS ESPINALES')),
            ],

            //MIELOGRAFIAS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('MIELOGRAFIA TOTAL DE COLUMNA')),
                'category' => ucfirst(strtolower('MIELOGRAFIAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('MIELOGRAFIA CERVICAL')),
                'category' => ucfirst(strtolower('MIELOGRAFIAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('MIELOGRAFIA TORACICA')),
                'category' => ucfirst(strtolower('MIELOGRAFIAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('MIELOGRAFIA LUMBAR')),
                'category' => ucfirst(strtolower('MIELOGRAFIAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('MIELOGRAFIA DINAMICA LUMBAR')),
                'category' => ucfirst(strtolower('MIELOGRAFIAS')),
            ],

            //ARTERIOGRAFIAS EN VASOS DEL TORAX

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('AORTOGRAMA TORACICO')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS EN VASOS DEL TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA PULMONAR')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS EN VASOS DEL TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA PULMONAR BILATERAL SELECTIVA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS EN VASOS DEL TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA PULMONAR UNILATERAL SELECTIVA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS EN VASOS DEL TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA PULMONAR NO SELECTIVA O POR INYECCION VENOSA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS EN VASOS DEL TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA TORACICA DE ARTERIA MAMARIA INTERNA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS EN VASOS DEL TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA SELECTIVA TORACICA DE OTROS VASOS')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS EN VASOS DEL TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ANGIOGRAFIA DE VENAS CAVAS O CAVOGRAFIA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS EN VASOS DEL TORAX')),
            ],

            //MAMOGRAFIA

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('GALACTOGRAFIA DE UN CONDUCTO')),
                'category' => ucfirst(strtolower('MAMOGRAFIA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('MAMOGRAFIA BILATERAL')),
                'category' => ucfirst(strtolower('MAMOGRAFIA')),
            ],

            //GALACTOGRAFIA

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('GALACTOGRAFIA DE MULTIPLES CONDUCTOS')),
                'category' => ucfirst(strtolower('GALACTOGRAFIA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('GALACTOGRAFIA DE MULTIPLES CONDUCTOS')),
                'category' => ucfirst(strtolower('GALACTOGRAFIA')),
            ],

            //ARTERIOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('AORTOGRAMA ABDOMINAL')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('AORTOGRAMA ABDOMINAL POR SERIOGRAFIA')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA DE VASOS ABDOMINALES (SELECTIVA)')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ESPLENOPORTOGRAFIA ARTERIAL')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA PELVICA (SELECTIVA)')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS')),
            ],

            //FLEBOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA [VENOGRAFIA] ABDOMINAL O PELVICA (SELECTIVA)')),
                'category' => ucfirst(strtolower('FLEBOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA ABDOMINAL (SISTEMA DE LA VENA PORTA)')),
                'category' => ucfirst(strtolower('FLEBOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('PORTOGRAFIA TRANSHEPATICA')),
                'category' => ucfirst(strtolower('FLEBOGRAFIAS DE VASOS ABDOMINALES Y PELVICOS')),
            ],

            //FISTULOGRAFIA DE PARED ABDOMINAL

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FISTULOGRAFIA DE PARED ABDOMINAL SOD')),
                'category' => ucfirst(strtolower('FISTULOGRAFIA DE PARED ABDOMINAL')),
            ],

            //RADIOLOGIA ESPECIAL E INTERVENCIONISTA EN VIAS BILIARES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('COLANGIOGRAFIA POR TUBO O CATETER EN LA VIA BILIAR')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA EN VIAS BILIARES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('COLANGIOGRAFIA PERCUTANEA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA EN VIAS BILIARES')),
            ],

            //RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('UROGRAFIA INTRAVENOSA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('PIELOGRAFIA A TRAVES DE TUBO DE NEFROSTOMIA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('PIELOGRAFIA RETROGRADA A TRAVES DE CATETER DEJADO EN EL URETER O A TRAVES DE URETEROSTOMIA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('PIELOGRAFIA RETROGRADA O ANTEROGRADA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('URETEROGRAFIA RETROGRADA A TRAVES DE CATETER O URETEROSTOMIA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('CISTOGRAFIA CON PROYECCIONES OBLICUAS')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('URETROCISTOGRAFIA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('URETROCISTOGRAFIA MICCIONAL')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('URETROCISTOGRAFIA RETROGRADA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('URETROGRAFIA RETROGRADA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA URINARIO')),
            ],

            //RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA GENITAL

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('HISTEROSALPINGOGRAFIA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA GENITAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('CAVERNOGRAFIA Y CAVERNOMETRIA')),
                'category' => ucfirst(strtolower('RADIOLOGIA ESPECIAL E INTERVENCIONISTA DE SISTEMA GENITAL')),
            ],

            //ARTERIOGRAFIA EN VASOS DE EXTREMIDADES SUPERIORES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA PERIFERICA DE UNA EXTREMIDAD SUPERIOR')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIA EN VASOS DE EXTREMIDADES SUPERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA PERIFERICA DE MIEMBROS SUPERIORES BILATERAL CON AORTOGRAMA TORACICO')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIA EN VASOS DE EXTREMIDADES SUPERIORES')),
            ],

            //ARTROGRAFIA O NEUMOARTROGRAFIA DE EXTREMIDADES SUPERIORES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTROGRAFIA DE HOMBRO')),
                'category' => ucfirst(strtolower('ARTROGRAFIA O NEUMOARTROGRAFIA DE EXTREMIDADES SUPERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTROGRAFIA DE CODO')),
                'category' => ucfirst(strtolower('ARTROGRAFIA O NEUMOARTROGRAFIA DE EXTREMIDADES SUPERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTROGRAFIA DE MUÑECA')),
                'category' => ucfirst(strtolower('ARTROGRAFIA O NEUMOARTROGRAFIA DE EXTREMIDADES SUPERIORES')),
            ],

            //FLEBOGRAFIA EN VASOS DE EXTREMIDADES INFERIORES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA DE MIEMBRO INFERIOR')),
                'category' => ucfirst(strtolower('FLEBOGRAFIA EN VASOS DE EXTREMIDADES INFERIORES')),
            ],

            //ARTROGRAFIA O NEUMOARTROGRAFIA DE EXTREMIDADES INFERIORES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTROGRAFIA DE CADERA')),
                'category' => ucfirst(strtolower('ARTROGRAFIA O NEUMOARTROGRAFIA DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTROGRAFIA DE RODILLA')),
                'category' => ucfirst(strtolower('ARTROGRAFIA O NEUMOARTROGRAFIA DE EXTREMIDADES INFERIORES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTROGRAFIA DE TOBILLO')),
                'category' => ucfirst(strtolower('ARTROGRAFIA O NEUMOARTROGRAFIA DE EXTREMIDADES INFERIORES')),
            ],

            //TOMOGRAFIA COMPUTADA (TC) DE COLUMNA

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE COLUMNA SEGMENTOS CERVICAL TORACICO LUMBAR O SACRO POR CADA NIVEL (TRES ESPACIOS)')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE COLUMNA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE COLUMNA SEGMENTOS CERVICAL TORACICO LUMBAR O SACRO COMPLEMENTO A MIELOGRAFIA (CADA SEGMENTO)')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE COLUMNA')),
            ],

            //TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO 13

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE CRANEO SIMPLE')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE CRANEO CON CONTRASTE')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE CRANEO SIMPLE Y CON CONTRASTE')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('CISTERNOGRAFIA POR TOMOGRAFIA COMPUTADA (TC)')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE SILLA TURCA (HIPOFISIS)')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE ORBITAS')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE OIDO PEÑASCO Y CONDUCTO AUDITIVO INTERNO')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE SENOS PARANASALES O CARA')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE RINOFARINGE')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE MAXILARES (ESTUDIO IMPLANTOLOGIA)')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE ARTICULACION TEMPORO MANDIBULAR (BILATERAL)')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE CUELLO')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE LARINGE')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE CABEZA CARA Y CUELLO')),
            ],

            //TOMOGRAFIA COMPUTADA (TC) DE TORAX

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE TORAX')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE TORAX EXTENDIDO AL ABDOMEN SUPERIOR CON SUPRARRENALES')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE TORAX')),
            ],

            //TOMOGRAFIA COMPUTADA (TC) DE ABDOMEN Y PELVIS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE ABDOMEN SUPERIOR')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE ABDOMEN Y PELVIS (ABDOMEN TOTAL)')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE CADERA')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE VIAS URINARIAS [UROTAC]')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE PELVIS')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE ABDOMEN Y PELVIS')),
            ],

            //TOMOGRAFIA COMPUTADA (TC) DE EXTREMIDADES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE MIEMBROS SUPERIORES Y ARTICULACIONES')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE MIEMBROS INFERIORES Y ARTICULACIONES')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE MIEMBROS INFERIORES (ANTEVERSION FEMORAL O TORSION TIBIAL)')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE MIEMBROS INFERIORES (AXIALES DE ROTULA O LONGITUD DE MIEMBROS INFERIORES)')),
                'category' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA (TC) DE EXTREMIDADES')),
            ],

            //OTROS ESTUDIOS CON TOMOGRAFIA COMPUTADA

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA DE VASOS')),
                'category' => ucfirst(strtolower('OTROS ESTUDIOS CON TOMOGRAFIA COMPUTADA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA EN RECONSTRUCCION TRIDIMENSIONAL')),
                'category' => ucfirst(strtolower('OTROS ESTUDIOS CON TOMOGRAFIA COMPUTADA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA RECONSTRUCCION VIRTUAL')),
                'category' => ucfirst(strtolower('OTROS ESTUDIOS CON TOMOGRAFIA COMPUTADA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA CON MODALIDAD DINAMICA (SECUENCIA RAPIDA)')),
                'category' => ucfirst(strtolower('OTROS ESTUDIOS CON TOMOGRAFIA COMPUTADA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('TOMOGRAFIA COMPUTADA COMO GUIA PARA PROCEDIMIENTOS')),
                'category' => ucfirst(strtolower('OTROS ESTUDIOS CON TOMOGRAFIA COMPUTADA')),
            ],

            //ECOGRAFIA DE CABEZA CARA O CUELLO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA CEREBRAL TRANSFONTANELAR CON TRANSDUCTOR DE 7MHZ O MAS')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE CABEZA CARA O CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA CEREBRAL TRANSFONTANELAR CON ANALISIS DOPPLER')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE CABEZA CARA O CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE GLANDULAS SALIVALES CON TRANSDUCTOR DE 7 MHZ O MAS')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE CABEZA CARA O CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE TIROIDES CON TRANSDUCTOR DE 7 MHZ O MAS')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE CABEZA CARA O CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE GLANGLIOS CERVICALES (MAPEO)')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE CABEZA CARA O CUELLO')),
            ],

            //ECOGRAFIA DEL TORAX Y ORGANOS TORACICOS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE MAMA CON TRANSDUCTOR DE 7 MHZ O MAS')),
                'category' => ucfirst(strtolower('ECOGRAFIA DEL TORAX Y ORGANOS TORACICOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE TORAX (PERICARDIO O PLEURA)')),
                'category' => ucfirst(strtolower('ECOGRAFIA DEL TORAX Y ORGANOS TORACICOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE OTROS SITIOS TORACICOS')),
                'category' => ucfirst(strtolower('ECOGRAFIA DEL TORAX Y ORGANOS TORACICOS')),
            ],

            //ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE TEJIDOS BLANDOS DE PARED ABDOMINAL Y DE PELVIS')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN TOTAL (HIGADO PANCREAS VESICULA VIAS BILIARES RIÑONES BAZO GRANDES VASOS PELVIS Y FLANCOS)')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN SUPERIOR (HIGADO PANCREAS VIAS BILIARES RIÑONES BAZO Y GRANDES VASOS)')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE HIGADO PANCREAS VIA BILIAR Y VESICULA')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN (PILORO)')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE RIÑONES BAZO AORTA O ADRENALES')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE VIAS URINARIAS (RIÑONES VEJIGA Y PROSTATA TRANSABDOMINAL)')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN (MASAS ABDOMINALES Y DE RETROPERITONEO)')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA PELVICA CON ANALISIS DOPPLER')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE TEJIDOS BLANDOS DE ABDOMEN CON ANALISIS DOPPLER')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DEL ABDOMEN Y PELVIS COMO GUIA DE PROCEDIMIENTO QUIRURGICO O INTERVENCIONISTA')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE ABDOMEN PELVIS Y ORGANOS O ESTRUCTURAS CONEXAS')),
            ],

            //ECOGRAFIA DE PELVIS Y DE GENITALES FEMENINOS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA PELVICA GINECOLOGICA TRANSVAGINAL')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE PELVIS Y DE GENITALES FEMENINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA PELVICA GINECOLOGICA TRANSABDOMINAL')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE PELVIS Y DE GENITALES FEMENINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA PELVICA GINECOLOGICA (ESTUDIO INTEGRAL FOLICULAR CON ECO VAGINAL) (TRANSDUCTOR DE 7 MHZ O MAS)')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE PELVIS Y DE GENITALES FEMENINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA PELVICA GINECOLOGICA (HISTEROSONOGRAFIA O HISTEROSALPINGOSONOGRAFIA)')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE PELVIS Y DE GENITALES FEMENINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA OBSTETRICA TRANSABDOMINAL')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE PELVIS Y DE GENITALES FEMENINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA OBSTETRICA TRANSVAGINAL')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE PELVIS Y DE GENITALES FEMENINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA OBSTETRICA CON PERFIL BIOFISICO')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE PELVIS Y DE GENITALES FEMENINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA OBSTETRICA CON EVALUACION DE CIRCULACION PLACENTARIA Y FETAL')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE PELVIS Y DE GENITALES FEMENINOS')),
            ],

            //ECOGRAFIA PELVICA Y DE GENITALES MASCULINOS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE PROSTATA TRANSABDOMINAL')),
                'category' => ucfirst(strtolower('ECOGRAFIA PELVICA Y DE GENITALES MASCULINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE PROSTATA TRANSRECTAL')),
                'category' => ucfirst(strtolower('ECOGRAFIA PELVICA Y DE GENITALES MASCULINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA TESTICULAR CON TRANSDUCTOR DE 7 MHZ O MAS')),
                'category' => ucfirst(strtolower('ECOGRAFIA PELVICA Y DE GENITALES MASCULINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA TESTICULAR CON ANALISIS DOPPLER')),
                'category' => ucfirst(strtolower('ECOGRAFIA PELVICA Y DE GENITALES MASCULINOS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE PENE CON TRANSDUCTOR DE 7 MHZ O MAS')),
                'category' => ucfirst(strtolower('ECOGRAFIA PELVICA Y DE GENITALES MASCULINOS')),
            ],

            //ECOGRAFIA DE LAS EXTREMIDADES Y ARTICULACIONES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE TEJIDOS BLANDOS EN LAS EXTREMIDADES SUPERIORES CON TRANSDUCTOR DE 7 MHZ O MAS')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE LAS EXTREMIDADES Y ARTICULACIONES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE TEJIDOS BLANDOS EN LAS EXTREMIDADES INFERIORES CON TRANSDUCTOR DE 7 MHZ O MAS')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE LAS EXTREMIDADES Y ARTICULACIONES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE ALTA RESOLUCION EN NERVIOS DE EXTREMIDADES')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE LAS EXTREMIDADES Y ARTICULACIONES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA ARTICULAR DE HOMBRO')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE LAS EXTREMIDADES Y ARTICULACIONES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA ARTICULAR DE RODILLA')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE LAS EXTREMIDADES Y ARTICULACIONES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA ARTICULAR DE CADERA')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE LAS EXTREMIDADES Y ARTICULACIONES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DE CALCANEO')),
                'category' => ucfirst(strtolower('ECOGRAFIA DE LAS EXTREMIDADES Y ARTICULACIONES')),
            ],

            //OTRAS ECOGRAFIAS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA COMO GUIA PARA PROCEDIMIENTOS')),
                'category' => ucfirst(strtolower('OTRAS ECOGRAFIAS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA COMO GUIA PARA PROCEDIMIENTOS CON MARCACION')),
                'category' => ucfirst(strtolower('OTRAS ECOGRAFIAS')),
            ],

            //ESTUDIOS VASCULARES NO INVASIVOS DE LA CABEZA CARA Y CUELLO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER TRANSCRANEAL')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER TRANSCRANEAL A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE VASOS DEL CUELLO')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE VASOS DEL CUELLO A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE LA CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE OTROS VASOS PERIFERICOS DEL CUELLO A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE LA CABEZA CARA Y CUELLO')),
            ],

            //ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE VASOS ABDOMINALES O PELVICOS')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE VASOS ABDOMINALES O PELVICOS A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE AORTA ABDOMINAL A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE VASOS RENALES')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE ARTERIAS RENALES A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE ARTERIAS MESENTERICAS')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE ARTERIAS MESENTERICAS A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE TRONCO CELIACO')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE TRONCO CELIACO A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE VENA CAVA')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE VENA CAVA A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE ARTERIAS ILIACAS')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE ARTERIAS ILIACAS A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE VASOS DEL PENE A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE VASOS ESCROTALES A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER CON EVALUACION DE FLUJO SANGUINEO EN MASAS ABDOMINALES A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER CON EVALUACION DE FLUJO SANGUINEO EN MASAS PELVICAS A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER CON EVALUACION DE FLUJO SANGUINEO EN HIPERTENSION PORTAL A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER OBSTETRICO CON EVALUACION DE CIRCULACION PLACENTARIA')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DEL ABDOMEN Y PELVIS')),
            ],

            //ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE VASOS ARTERIALES DE MIEMBROS SUPERIORES')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE VASOS VENOSOS DE MIEMBROS SUPERIORES')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE VASOS ARTERIALES DE MIEMBROS SUPERIORES A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE VASOS VENOSOS DE MIEMBROS SUPERIORES A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE VASOS ARTERIALES DE MIEMBROS INFERIORES')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('DOPPLER DE VASOS VENOSOS DE MIEMBROS INFERIORES')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE VASOS ARTERIALES DE MIEMBROS INFERIORES A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE VASOS VENOSOS DE MIEMBROS INFERIORES A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA DE IMPEDANCIA')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('MEDICION DE PRESIONES SEGMENTARIAS E INDICES ARTERIALES CON DOPPLER')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE EXTREMIDADES')),
            ],

            //ESTUDIOS VASCULARES NO INVASIVOS DE TRASPLANTES (ORGANOS TRASPLANTADOS)

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE OTROS ORGANOS TRASPLANTADOS A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE TRASPLANTES (ORGANOS TRASPLANTADOS)')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ECOGRAFIA DOPPLER DE RIÑON TRASPLANTADO A COLOR')),
                'category' => ucfirst(strtolower('ESTUDIOS VASCULARES NO INVASIVOS DE TRASPLANTES (ORGANOS TRASPLANTADOS)')),
            ],

            //RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CEREBRO')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE BASE DE CRANEO-SILLA TURCA')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ORBITAS')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ARTICULACION TEMPOROMANDIBULAR')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA PARA EVALUACION DINAMICA DE LIQUIDO CEFALORRAQUIDEO')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE PARES CRANEANOS')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE OIDOS')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE SENOS PARANASALES O CARA')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CUELLO')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CABEZA CARA Y CUELLO')),
            ],

            //RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA CERVICAL SIMPLE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA CERVICAL CON CONTRASTE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA TORACICA SIMPLE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA TORACICA CON CONTRASTE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA LUMBOSACRA SIMPLE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA LUMBAR CON CONTRASTE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA SACROILIACA SIMPLE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA SACROILIACA CON CONTRASTE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA SACROCOXIGEA SIMPLE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA SACROCOXIGEA CON CONTRASTE')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE COLUMNA VERTEBRAL Y CANAL ESPINAL')),
            ],

            //RESONANCIA MAGNETICA DE TORAX

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE TORAX')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ANGIORRESONANCIA DE TORAX (SIN INCLUIR CORAZON)')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE MAMA')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE TORAX')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE OTRAS ESTRUCTURAS NO ESPECIFICADAS DEL TORAX Y SISTEMA CARDIOVASCULAR')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE TORAX')),
            ],

            //RESONANCIA MAGNETICA DE ABDOMEN Y PELVIS

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ABDOMEN')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE VIAS BILIARES')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('COLANGIORESONANCIA')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE VIA URINARIA [URORRESONANCIA]')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE PELVIS')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DINAMICA DE PISO PELVICO')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA OBSTETRICA')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ABDOMEN Y PELVIS')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE PLACENTA')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ABDOMEN Y PELVIS')),
            ],

            //RESONANCIA MAGNETICA DE EXTREMIDADES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE MIEMBRO SUPERIOR SIN INCLUIR ARTICULACIONES')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ARTICULACIONES DE MIEMBRO SUPERIOR')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE MIEMBRO INFERIOR SIN INCLUIR ARTICULACIONES')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ARTICULACIONES DE MIEMBRO INFERIOR')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE ARTICULACIONES COMPARATIVA')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE PLEJO BRAQUIAL')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE EXTREMIDADES')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE SISTEMA MUSCULO ESQUELETICO')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE EXTREMIDADES')),
            ],

            //RESONANCIA MAGNETICA DE MEDULA OSEA

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE MEDULA OSEA (ESTUDIO DE SUPLENCIA VASCULAR)')),
                'category' => ucfirst(strtolower('RESONANCIA MAGNETICA DE MEDULA OSEA')),
            ],

            //ESTUDIOS DE RESONANCIA MAGNETICA NO CLASIFICADOS BAJO OTRO CONCEPTO

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE CUERPO ENTERO')),
                'category' => ucfirst(strtolower('ESTUDIOS DE RESONANCIA MAGNETICA NO CLASIFICADOS BAJO OTRO CONCEPTO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE SITIO NO ESPECIFICADO')),
                'category' => ucfirst(strtolower('ESTUDIOS DE RESONANCIA MAGNETICA NO CLASIFICADOS BAJO OTRO CONCEPTO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA COMO GUIA PARA PROCEDIMIENTOS')),
                'category' => ucfirst(strtolower('ESTUDIOS DE RESONANCIA MAGNETICA NO CLASIFICADOS BAJO OTRO CONCEPTO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA CON PERFUSION')),
                'category' => ucfirst(strtolower('ESTUDIOS DE RESONANCIA MAGNETICA NO CLASIFICADOS BAJO OTRO CONCEPTO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ESPECTROSCOPIA')),
                'category' => ucfirst(strtolower('ESTUDIOS DE RESONANCIA MAGNETICA NO CLASIFICADOS BAJO OTRO CONCEPTO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA DE VASOS')),
                'category' => ucfirst(strtolower('ESTUDIOS DE RESONANCIA MAGNETICA NO CLASIFICADOS BAJO OTRO CONCEPTO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA CON ANGIOGRAFIA')),
                'category' => ucfirst(strtolower('ESTUDIOS DE RESONANCIA MAGNETICA NO CLASIFICADOS BAJO OTRO CONCEPTO')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('RESONANCIA MAGNETICA CON ESTUDIO DINAMICO (CINE RESONANCIA)')),
                'category' => ucfirst(strtolower('ESTUDIOS DE RESONANCIA MAGNETICA NO CLASIFICADOS BAJO OTRO CONCEPTO')),
            ],

            //ESTUDIOS DE DENSIDAD MINERAL OSEA

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('OSTEODENSITOMETRIA POR TC')),
                'category' => ucfirst(strtolower('ESTUDIOS DE DENSIDAD MINERAL OSEA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('OSTEODENSITOMETRIA POR ABSORCION DUAL')),
                'category' => ucfirst(strtolower('ESTUDIOS DE DENSIDAD MINERAL OSEA')),
            ],
            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('OSTEODENSITOMETRIA Y COMPOSICION CORPORAL (TEJIDOS BLANDOS)')),
                'category' => ucfirst(strtolower('ESTUDIOS DE DENSIDAD MINERAL OSEA')),
            ],

            //FLEBOGRAFIA EN VASOS DE EXTREMIDADES SUPERIORES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('FLEBOGRAFIA DE MIEMBRO SUPERIOR')),
                'category' => ucfirst(strtolower('FLEBOGRAFIA EN VASOS DE EXTREMIDADES SUPERIORES')),
            ],

            //ARTERIOGRAFIA EN VASOS DE EXTREMIDADES INFERIORES

            [   
                'cod_study' => 'SQ-ST-'.random_int(11111111, 99999999),
                'description' => ucfirst(strtolower('ARTERIOGRAFIA PERIFERICA DE UNA EXTREMIDAD INFERIOR POR PUNCION')),
                'category' => ucfirst(strtolower('ARTERIOGRAFIA EN VASOS DE EXTREMIDADES INFERIORES')),
            ],


        ];

        Study::insert($data);

        //
    }
}
