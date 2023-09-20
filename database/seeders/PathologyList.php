<?php

namespace Database\Seeders;

use App\Models\Pathology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PathologyList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'description' => 'Accidente cerebrovascular',
            ],
            [
                'description' => 'Acné',
            ],
            [
                'description' => 'Afasia',
            ],
            [
                'description' => 'Afta bucal',
            ],
            [
                'description' => 'Agujetas',
            ],
            [
                'description' => 'Alergia Alimentaria',
            ],
            [
                'description' => 'Alopecia areata',
            ],
            [
                'description' => 'Amigdalitis',
            ],
            [
                'description' => 'Anemias',
            ],
            [
                'description' => 'Aneurisma',
            ],
            [
                'description' => 'Angina de pecho',
            ],
            [
                'description' => 'Angioma',
            ],
            [
                'description' => 'Anorexia',
            ],
            [
                'description' => 'Anquiloglosia',
            ],
            [
                'description' => 'Ansiedad',
            ],
            [
                'description' => 'Apendicitis',
            ],
            [
                'description' => 'Apnea del sueño',
            ],
            [
                'description' => 'Arritmias',
            ],
            [
                'description' => 'Arterioesclerosis',
            ],
            [
                'description' => 'Arteriopatía periférica oclusiva',
            ],
            [
                'description' => 'Artritis',
            ],
            [
                'description' => 'Asma',
            ],
            [
                'description' => 'Asperger',
            ],
            [
                'description' => 'Astigmatismo',
            ],
            [
                'description' => 'Autismo',
            ],
            [
                'description' => 'Balanitis',
            ],
            [
                'description' => 'Bronquiolitis',
            ],
            [
                'description' => 'Bronquitis crónica',
            ],
            [
                'description' => 'Bruxismo',
            ],
            [
                'description' => 'Bulimia',
            ],
            [
                'description' => 'Cálculos biliares',
            ],
            [
                'description' => 'Cáncer de mama',
            ],
            [
                'description' => 'Cáncer de ovario',
            ],
            [
                'description' => 'Cáncer de páncreas',
            ],
            [
                'description' => 'Cáncer de próstata',
            ],
            [
                'description' => 'Cáncer de útero',
            ],
            [
                'description' => 'Cancer pulmonar',
            ],
            [
                'description' => 'Cardiopatía coronaria',
            ],
            [
                'description' => 'Cardiopatía Isquémica',
            ],
            [
                'description' => 'Caries',
            ],
            [
                'description' => 'Cataratas',
            ],
            [
                'description' => 'Celiaquía',
            ],
            [
                'description' => 'Cirrosis',
            ],
            [
                'description' => 'Coartación de la aorta',
            ],
            [
                'description' => 'Codo de tenista',
            ],
            [
                'description' => 'Colelitiasis',
            ],
            [
                'description' => 'Colesterol',
            ],
            [
                'description' => 'Colitis ulcerosa',
            ],
            [
                'description' => 'Coma',
            ],
            [
                'description' => 'Complejo de Carney',
            ],
            [
                'description' => 'Conjuntivitis',
            ],
            [
                'description' => 'Contracepción',
            ],
            [
                'description' => 'Covid-19',
            ],
            [
                'description' => 'Cuidados paliativos',
            ],
            [
                'description' => 'Daltonismo',
            ],
            [
                'description' => 'Degeneración macular asociada a la edad',
            ],
            [
                'description' => 'Demencia',
            ],
            [
                'description' => 'Dengue',
            ],
            [
                'description' => 'Depresión',
            ],
            [
                'description' => 'Dermatitis',
            ],
            [
                'description' => 'Derrame cerebral',
            ],
            [
                'description' => 'Desprendimiento de retina',
            ],
            [
                'description' => 'Diabetes',
            ],
            [
                'description' => 'Diarrea',
            ],
            [
                'description' => 'Disfasia',
            ],
            [
                'description' => 'Disfunción eréctil',
            ],
            [
                'description' => 'Dislexia',
            ],
            [
                'description' => 'Disminución movimientos fetales',
            ],
            [
                'description' => 'Distrofia',
            ],
            [
                'description' => 'Diverticulitis',
            ],
            [
                'description' => 'Ductus arterioso',
            ],
            [
                'description' => 'Embarazo de alto riesgo',
            ],
            [
                'description' => 'Embolia',
            ],
            [
                'description' => 'Embolia pulmonar',
            ],
            [
                'description' => 'Endodoncia',
            ],
            [
                'description' => 'Endometriosis',
            ],
            [
                'description' => 'Enfermedad de Alzheimer',
            ],
            [
                'description' => 'Enfermedad de Crohn',
            ],
            [
                'description' => 'Enfermedad de Huntington',
            ],
            [
                'description' => 'Enfermedad de Parkinson',
            ],
            [
                'description' => 'Enfermedad del hígado graso no alcohólico',
            ],
            [
                'description' => 'Enfermedad inflamatoria intestinal',
            ],
            [
                'description' => 'Enfermedades de la tiroides',
            ],
            [
                'description' => 'Enfisema',
            ],
            [
                'description' => 'Epilepsia',
            ],
            [
                'description' => 'Epitelioma',
            ],
            [
                'description' => 'EPOC',
            ],
            [
                'description' => 'Esclerosis lateral amiotrófica (ELA)',
            ],
            [
                'description' => 'Escoliosis',
            ],
            [
                'description' => 'Esguince',
            ],
            [
                'description' => 'Espina bífida',
            ],
            [
                'description' => 'Estenosis de canal',
            ],
            [
                'description' => 'Estrabismo',
            ],
            [
                'description' => 'Faringitis',
            ],
            [
                'description' => 'Fibrilación auricular',
            ],
            [
                'description' => 'Fibromialgia',
            ],
            [
                'description' => 'Fibrosis quística',
            ],
            [
                'description' => 'Fiebre',
            ],
            [
                'description' => 'Fimosis',
            ],
            [
                'description' => 'Flacidez facial',
            ],
            [
                'description' => 'Fractura de cadera',
            ],
            [
                'description' => 'Fractura de muñeca',
            ],
            [
                'description' => 'Gastritis',
            ],
            [
                'description' => 'Gingivitis',
            ],
            [
                'description' => 'Glaucoma',
            ],
            [
                'description' => 'Glosolalia',
            ],
            [
                'description' => 'Gota',
            ],
            [
                'description' => 'Granulomas',
            ],
            [
                'description' => 'Gripe',
            ],
            [
                'description' => 'Halitosis',
            ],
            [
                'description' => 'Heloma',
            ],
            [
                'description' => 'Hemiangioma capilar',
            ],
            [
                'description' => 'Hemofilia',
            ],
            [
                'description' => 'Hemorragia interna',
            ],
            [
                'description' => 'Hemorroides',
            ],
            [
                'description' => 'Hepatitis vírica',
            ],
            [
                'description' => 'Herida',
            ],
            [
                'description' => 'Hermaturia',
            ],
            [
                'description' => 'Hernia de hiato',
            ],
            [
                'description' => 'Hernia inguinal',
            ],
            [
                'description' => 'Herpes oral',
            ],
            [
                'description' => 'Hiperdrosis',
            ],
            [
                'description' => 'Hipermetropia',
            ],
            [
                'description' => 'Hipertensión arterial',
            ],
            [
                'description' => 'Hipertensión pulmonar',
            ],
            [
                'description' => 'Hipertrofia prostática',
            ],
            [
                'description' => 'Hipoacusia',
            ],
            [
                'description' => 'Hongos en las uñas',
            ],
            [
                'description' => 'Ictericia infantil',
            ],
            [
                'description' => 'Inclusión dentaria',
            ],
            [
                'description' => 'Incontinencia urinaria',
            ],
            [
                'description' => 'Infarto de miocardio',
            ],
            [
                'description' => 'Infertilidad',
            ],
            [
                'description' => 'Insuficiencia cardíaca',
            ],
            [
                'description' => 'Insuficiencia renal',
            ],
            [
                'description' => 'Isquemia intestinal',
            ],
            [
                'description' => 'Lesión de menisco',
            ],
            [
                'description' => 'Lesiones medulares',
            ],
            [
                'description' => 'Leucemia',
            ],
            [
                'description' => 'Ligadura de trompas',
            ],
            [
                'description' => 'Linfedema',
            ],
            [
                'description' => 'Linfoma',
            ],
            [
                'description' => 'Listeriosis',
            ],
            [
                'description' => 'Litiasis renal',
            ],
            [
                'description' => 'Lumbalgia',
            ],
            [
                'description' => 'Lupus',
            ],
            [
                'description' => 'Malformación de Chiari',
            ],
            [
                'description' => 'Meningitis',
            ],
            [
                'description' => 'Menopausia',
            ],
            [
                'description' => 'Miastenia gravis',
            ],
            [
                'description' => 'Microtia',
            ],
            [
                'description' => 'Mieloma',
            ],
            [
                'description' => 'Mielopatía cervical',
            ],
            [
                'description' => 'Migraña',
            ],
            [
                'description' => 'Mioma Uterino',
            ],
            [
                'description' => 'Miopatías',
            ],
            [
                'description' => 'Miopía',
            ],
            [
                'description' => 'Mononucleosis',
            ],
            [
                'description' => 'Muñeca abierta',
            ],
            [
                'description' => 'Neoplasia endocrina múltiple',
            ],
            [
                'description' => 'Neumonia',
            ],
            [
                'description' => 'Neuralgia del trigémino',
            ],
            [
                'description' => 'Obesidad',
            ],
            [
                'description' => 'Ojeras oscuras',
            ],
            [
                'description' => 'Ojo vago',
            ],
            [
                'description' => 'Orquidopexia',
            ],
            [
                'description' => 'Ortorexia',
            ],
            [
                'description' => 'Orzuelo',
            ],
            [
                'description' => 'Osteoporosis',
            ],
            [
                'description' => 'Otitis',
            ],
            [
                'description' => 'Oxiuriasis',
            ],
            [
                'description' => 'Paperas',
            ],
            [
                'description' => 'Papiloma',
            ],
            [
                'description' => 'Parálisis cerebral',
            ],
            [
                'description' => 'Periodontitis',
            ],
            [
                'description' => 'Pie de atleta',
            ],
            [
                'description' => 'Pie de diabético',
            ],
            [
                'description' => 'Pielonefritis',
            ],
            [
                'description' => 'Poliposis nasal',
            ],
            [
                'description' => 'Prediabetes',
            ],
            [
                'description' => 'Preeclampsia',
            ],
            [
                'description' => 'Presbicia',
            ],
            [
                'description' => 'Problemas metabólicos',
            ],
            [
                'description' => 'Quemadura',
            ],
            [
                'description' => 'Quistes ováricos',
            ],
            [
                'description' => 'Radiculopatía',
            ],
            [
                'description' => 'Rellenos faciales',
            ],
            [
                'description' => 'Resfriado común',
            ],
            [
                'description' => 'Retinopatía',
            ],
            [
                'description' => 'Rinitis Alérgica',
            ],
            [
                'description' => 'Sincope',
            ],
            [
                'description' => 'Síndrome de Brugada',
            ],
            [
                'description' => 'Sindrome de intestino irritable',
            ],
            [
                'description' => 'Síndrome de la persona rígida',
            ],
            [
                'description' => 'Síndrome de las piernas inquietas',
            ],
            [
                'description' => 'Síndrome de Sjögren',
            ],
            [
                'description' => 'Síndrome de TAKO-TSUBO',
            ],
            [
                'description' => 'Síndrome de Tourette',
            ],
            [
                'description' => 'Síndrome de Wolff Parkinson White',
            ],
            [
                'description' => 'Síndrome del impostor',
            ],
            [
                'description' => 'Síndrome del túnel carpiano',
            ],
            [
                'description' => 'Síndrome metabólico',
            ],
            [
                'description' => 'Soplo inocente',
            ],
            [
                'description' => 'Suelo pélvico',
            ],
            [
                'description' => 'TDAH',
            ],
            [
                'description' => 'Tendinitis',
            ],
            [
                'description' => 'Tiña',
            ],
            [
                'description' => 'Tinoma',
            ],
            [
                'description' => 'TOC',
            ],
            [
                'description' => 'Tórax en embudo',
            ],
            [
                'description' => 'Trastorno de oposición desafiante',
            ],
            [
                'description' => 'Trastorno por atracón',
            ],
            [
                'description' => 'Trastornos de crecimiento',
            ],
            [
                'description' => 'Trastornos glándulas salivales',
            ],
            [
                'description' => 'Trastornos plaquetarios',
            ],
            [
                'description' => 'Traumatismo craneoencefálico',
            ],
            [
                'description' => 'Trombocitopenia',
            ],
            [
                'description' => 'Trombosis',
            ],
            [
                'description' => 'Tuberculosis',
            ],
            [
                'description' => 'Tumor cardiaco',
            ],[
                'description' => 'Tumor maxilar',
            ],
            [
                'description' => 'Úlcera péptica',
            ],
            [
                'description' => 'Urticaria Crónica',
            ],
            [
                'description' => 'Valvulopatías',
            ],
            [
                'description' => 'Varicela',
            ],
            [
                'description' => 'Varices',
            ],
            [
                'description' => 'VIH/ SIDA',
            ],
            [
                'description' => 'Viruela del mono',
            ],
            [
                'description' => 'Vitiligo',
            ]
        ];
        
        Pathology::insert($data);
    }
}
