<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamsList extends Seeder
{
    /**
     Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            //Hematología y Coagulación

            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Conteo de Eosinófilos en Sangre Nasal',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Conteo de Leucocitos y Plaquetas',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Conteo de Reticulocitos',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Dimero D',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Fibrinogeno',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Frotis de sangre periférica',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Hematocrito y hemoglobina',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Hematología completa',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Hemoglobina Glicada A1C',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Hemoparásitos',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Prueba de Coombs directo/ indirecto',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Tiempo de coagulación',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Tiempo de Protrombina (TP)',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Tiempo de sangría de duke',
                'category' => 'Hematología y Coagulación',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Tiempo de Tromboplastina (TPT)',
                'category' => 'Hematología y Coagulación',
            ],

            //Hormonales

            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => '17-OH Progesterona',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Androstenediona',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cortisol: am pm',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Sulfato DHEA',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Estradiol',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'FSH',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Gonadotropina Coriónica Cuantitativa',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Gonadotropina Coriónica Cualitativa',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Hormona de Crecimiento Basal',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Insulina Basal',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Insulina post prandial',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Insulina post carga',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Péptico C',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'LH',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Paratohormona',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Prolactina Pool',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Progesterona',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Testosterona total',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Testosterona libre',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Perfil androgénico (Testosterona total, SHBG, albúmina, testosterona libre calculada)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Anticuerpos anti-tiroglobulina (TGB)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Anticuerpos anti-microsomal (TPO)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'T3 libre',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'T4 libre',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'TSH ultrasensible',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Tiroglobulina',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IGF-1 (factor insulinoide)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Screening pre natal l trimestre (anexar al eco el formato Screening)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Screening pre natal ll trimestre (anexar al eco el formato Screening)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Alfafetoproteína (Hígado)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'CEA (vejiga/mama/pulmón/otros)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Ca 125 (mama/ovario)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Ca 15-3 (hígado/pulmón/mama)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Ca 19-9 (páncreas/gastrointestinal)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'PSA Libre',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'PSA Total',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'HGC cuant. (gónada/pulmón/páncreas)',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'He4',
                'category' => 'Hormonales',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cyfra 21-1',
                'category' => 'Hormonales',
            ],

            //Orina

            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Nitrógeno Ureico en Orina de 24 horas',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Osmolaridad en Orina',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Ácido Úrico 24h. parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Albuminómetria 24 h parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Amilasa 24h. Parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Calcio 24h o parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Creatinina 24 h parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Depuracion de creatinina (orina 24 h)',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Fósforo 24h. Parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Microalbuminuria 24 h. Parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Orina completa',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Microalbuminuria 24 h. Parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Potasio 24h Parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Proteina de Bence Jones',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Sodio 24 h Parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Magnesio 24 h Parcial',
                'category' => 'Orina',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Urea 24h',
                'category' => 'Orina',
            ],

            //Heces

            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Adenovirus (antígeno)',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Rotavirus (antígeno)',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Coloración de Cryptosporidium',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Triple Test parasitario: Cryptosporidium sp (antígeno) Entamoeba histolytica (antígeno) Giardia lamblia (antígeno)',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Examen de heces / Concentrado',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Grasa neutras (Sudán)',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Helicobacter pylori (antígeno)',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Recuento de polimorfonucleares',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Sangre oculta / Transferrina',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Azúcares reductores',
                'category' => 'Heces',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Test de sacarosa',
                'category' => 'Heces',
            ],

            //Microbiológico

            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Baciloscopia',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Antígeno Streptococcus pyogenes',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Coprocultivo',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cultivo de ambiente',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cultivo de hongos',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cultivo de Koch (esputo/Orina)',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cultivo de Mycoplasma (M. hominis, ureaplasma)',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cultivo de secreción faringea',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cultivo de secreción vaginal',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cultivo de secreción uretreal',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Directo de hongos',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Espermocultivo',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Estreptococcus grupo A',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Hemocultivo',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Serología de hongos',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Serología para Leptospira (lgM)-(lgG)',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Tinta china para LCR',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Tinción de Gram',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Tinción de Ziehl Neelsen',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Urocultivo',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Serología para Salmonella',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Serología para Escherichia coli',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Brucela Rosa de Bengala',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Análisis Microbiológico del Agua',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Análisis Parasitológico del Agua',
                'category' => 'Microbiológico',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Cultivo de Leche',
                'category' => 'Microbiológico',
            ],

            //Inmunológicos

            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM anti-C. pneumoniae',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM anti-M. pneumoniae',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Antiestreptolisina (ASTO)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Anticuerpos anti – Trypanosoma cruzi (Chagas)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Chlamydia trachomatis (Antígeno)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM C. trachomatis',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM anti Citomegalovirus',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Crioglobulinas',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Complemento 3 (C3)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Complemento 4 (C4)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Complemento total (Ch50)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Dengue IgG/lgM',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM anti Virus Epstein Barr',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM anti-Helicobacter pylori',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM anti Virus Hepatitis A',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Antígeno de superficie Hepatitis B',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Antígeno E. Virus Hepatitis B',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Anti-antígeno E. Virus Hepatitis B',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM Anti-Core Virus Hepatitis B',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG Anti-Core Virus Hepatitis B',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Anti-Core Total Virus Hepatitis B',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Anticuerpos anti-virus Hepatitis C',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM Herpes simples l',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM Herpes simples ll',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'H.I.V. Antígeno p24/(HIV-1/HIV-2)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'H.I.V. ELISA 4ta. Generación',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'H.I.V. Prueba Rápida',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Inmunoglobulina E (IgE total)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Inmunoglobulina A (IgA total)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Inmunoglobulina G (IgG total)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Inmunoglobulina M (IgM total)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'L.E. Test',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Monotest',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Proteína C. Reactiva (PCR)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Factor Reumatoideo cuantificado',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Reacción de Widai (Antig. Febriles)',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM anti-Virus de la Rubéola',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgG IgM anti-Toxoplasma gondii',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'V.D.R.L',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Virus del sarampión',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Virus Sincitial Respiratorio',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Antígeno Virus Sincitial Respiratorio',
                'category' => 'Inmunológicos',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Influenza A y B hisopado nasofaringeo',
                'category' => 'Inmunológicos',
            ],

            //Química Clínica

            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Ácido Úrico sérico',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Amilasa sérica',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Apolipoproteínas A1 B',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Bilirrubina total y fraccionada',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Calcio sérico',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Creatinina sérica',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'CK TOTAL',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'CK – MB',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Colesterol total',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Colesterol Fraccionado',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Colinesterasa',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Deshidrogenasa láctica (LDH)',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Fosfatasa ácida total prostática',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Fosfatasa alcalina',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Fósforo sérico',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Gamma Glutamil Transferasa (GGT)',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Glicemia basal',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Glicmia pre y post carga',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Glicemia Pre y Post Prandial',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Hierro sérico',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Lipasa',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Magnesio',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Nitrógeno uréico (BUN)',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Electrolitos (Sodio, Potasio, Cloro)',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Proteínas totales y fraccionadas',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Prueba de Tolerancia a la Glucosa de ____ Horas',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Transferrina ___ % saturación',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Transaminasa oxalacética (TGO-AST)',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Transaminasa Pirúvica (TGP-ALT)',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Triglicéridos',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Úrea',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Acido fólico sérico',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Acido fólico intraeritrócitario',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Vitamina B12',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Troponina l',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Troponina T',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Gases Venosos',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Gases Arteriales',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Análisis de cálculo renal',
                'category' => 'Química Clínica',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Amonio',
                'category' => 'Química Clínica',
            ],

            //Inmunofluorescencia

            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Anticuerpos anti-ADN de doble hebra (Crithidia luciliae)',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'Anticuerpos Antinucleares (ANA - HEP-2)',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'FTA-ABS (Anti Treponema pallidum)',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Legionella pneumophila',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Mycoplasma pneumoniae',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Coxiella burnetii',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Chlamydophila pneumoniae',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Adenovirus',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Virus Sincitial respiratorio',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Influenza A',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Influenza B',
                'category' => 'Inmunofluorescencia',
            ],
            [   
                'cod_exam' => 'SQ-EX-'.random_int(11111111, 99999999),
                'description' => 'IgM anti-Parainfluenza serotipos 1,2 y 3',
                'category' => 'Inmunofluorescencia',
            ],

        ];

        Exam::insert($data);

    }
}
