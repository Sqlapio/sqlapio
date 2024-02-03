<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CenterList extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'description' => 'Centro Medico Amazonas, C.A',
                'state' => 'Amazonas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Zambrano',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Fast Medical Globe Salud, C.A.',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Pediatrica de Oriente, C.A.',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Odontologico GS Oriente, C.A.',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Total Lecheria C.A (Meditotal) ',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Oriental de Salud Integral C.A (Lecheria)',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Santa Ana C.A.',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Especialidades Medicas Virgen Del Valle, C.A.',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Total, C.A.',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Proteccion Integral a su Salud S.A.',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Cientifico Esperanza Paraco, C.A',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Santa Rosa C.A',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Quirurgica Anzoategui, C.A',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Clinico Metropolitano C.A',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Grupo de Especialidades Endovascular, C.A. (Policlinica Del Sur)',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Divino Niño, C.A.',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Venezolana de Salud Integral (Apure)',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Asociación Cooperativa Servimed, 85 R.L.',
                'state' => 'Anzoategui',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Grupo Medico Integral Vida & Salud',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Integral Medico Quirúrgico, C.A.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Centro C.A.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Medica Quirurgica Dra Haidee Rodriguez',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital de Clinicas Las Delicias',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Ocupacional Victoria, C.A.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital de Clinicas Aragua, C.A',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Salud Y Bienestar Victoria, C.A',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Cemat Centro Médico De Alta Tecnología, C.A.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Calicanto',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Lugo, C.A.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Inversiones Virgen de Guadalupe, C.A.(Clinica Guadalupe)',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Medico Integral La Maestranza, C.A.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Fontana',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'C.D.M. Girardot, C.A',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Presalud C.A.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Maracay, C.A',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Prevaler Maracay, C.A.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Especialidades Medicas Turmero, C.A.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Policlinico de Turmero, C.A',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Asociaciòn Coop. Tucutunemo R.L.',
                'state' => 'Aragua',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Grupo Corp Clinica Ntra Sra Del Pilar, C.A.',
                'state' => 'Barinas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Diagnostico Varyna, C.A.',
                'state' => 'Barinas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A',
                'state' => 'Barinas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Quirurgica Del Centro. C.A.',
                'state' => 'Barinas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Luis Razetti',
                'state' => 'Barinas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Entro Médico Orinoco, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Corporacion Clinica Universitaria de Oriente, A.C.(Ccudo) Bolivar',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Andres Bello, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Cardiovascular de Guayana, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Laboratorios Rizzi, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Avanzado de Cirugia Avanza',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Cardiovascular no Invasiva Cardiosalud, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Chilemex, C.A',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica La Esperanza, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Puerto Ordaz, C.A',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Quirugica Razetti',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital De Clinicas Caroní, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital De Clinicas De Ceciamb, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Clinico Unare, C.A',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Hospitalario Guayana, C.A. (Clinica Humana)',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Clinico Primero de Mayo, C.A. ',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro De Especialidades Medicas Upata, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Van Praag, C.A.',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Ruíz Y Páez',
                'state' => 'Bolivar',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinico Bejuma, C. A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Médica Por Su Salud, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Flor Amarillo ',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinicas Las Industrias, C. A. Amazo',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Especialidades Quirurgicas Guacara, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Santa Paula, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Isabelica, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinicas Elohim Valencia C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Estudios Clinicos Movilab, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Atenprisa, C.A',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica El Viñedo',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Los Colorados, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Especialidades Quirurgicas San Antonio De Padua',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Los Guayos, C.A',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto de Especialidades Quirurgicas Los Mangos, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Especialidades Panamericano',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Naguanagua C.A',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Medicos Asistenciales, C.A. (Sermeca-Hosp. Metrop del Norte)',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Cmb 2017, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Genesis',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital De Clinicas San Agustin de Puerto Cabello, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Medico Laboral N.C, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Guerra Mas, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital de Clinicas San Agustin de Puerto Cabello, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Urdaneta, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Valles De San Diego, C.A',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Grupo Medico Docente B & Pro, C.A',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica El Morro, C.A',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'La Gloria Centro Clinico Maternidad, S.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Prevaler C.A (Valencia)',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'C.A. Esculapio',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Central Salud Integral C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Docente de Urologia, C.A',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Presalud Nacional, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Puntosalud Valencia, C.A',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Reinmed Valencia C&C C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Integra Valencia Servicios Medicos, C.A.',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Diagnoimagen Valencia, C.A. ',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Ciudad Hospitalaria “Dr. Enrique Tejera”',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Central “Dr. Ramón Madariaga”',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital de Clínica “San Agustín”',
                'state' => 'Carabobo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Quirurgico Fernandez & Rodriguez, C.A',
                'state' => 'Cojedes',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Quirurgico La Milagrosa, C.A.',
                'state' => 'Cojedes',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Quirurgico Maternidad Santa Ana. C.A.',
                'state' => 'Cojedes',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Clinica Cojedes, C.A',
                'state' => 'Cojedes',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Delta, C.A.',
                'state' => 'Delta Amacuro',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Idet, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica El Avila, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Grupo Medico Perfilab, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Medico La Floresta',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Inversiones Lopcymaster 2008, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto de Retina Y Vitreo, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Piedra Azul, C.A. ',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Materno Infantil, C.A. (Leopoldo Aguerrevere)',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Medica Humboldt, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Sanatrix, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Ambulatorio Tanamo, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Médicos Integra Sxxi, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Médico Integra',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Bello Campo, C.A..',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Clinicos U.M.Q. Nueva Caracas, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Medico Quirurgico Virgen Milagrosa, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Metropolitana, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Médico Beta',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Oseo 28 C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Organizacion De Servic. Especializados Tutoriales Oset, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Cemedifa Centro Médico, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro De Fisiatria Cenfis, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Rehabilitacion Hernandez Almeida, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Vidamed',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica CCCT',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinicas Rescarven, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica de Coche, S.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Santiago De León, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Grupo Médico Santa Paula, S.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Aps Centro Médico Paraíso, C.A. C',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Amay, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinicas Rescarven, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad De Especialidades Gastroenterologicas "El Paraiso" C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Cabisoguarnac ',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Clinico La Florida, C.A. ',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Médicos Unidos Los Jabillos, C.A. (Policlinica Mendez Gimon) ',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Provectus Salud Imagenes M&O, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Diagnosticos Integrales S.D.I. C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Fenix Salud, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Cmq Mediprot, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Médicos Asis-Med, C.A. (Centro Clínico La Urbina)',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Grupo Médico Perfilab, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Médico Integral Careli, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Las Mercedes, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Grupo Cefemi, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Serviascorp',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Las Ciencias, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Medymed Salud, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Contusalud 2016, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Capital De Salud Integral, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Atias Hospitalizacion Y Servicios, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Ortopedico Y Podologico C.O.P., C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Heart Guard Solutions, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Médico Odontologico GS Oriente, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Quirurgica Los Sauces C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Mederi Equipos y Servicios Medicos, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Grupo Medis Santa Fe, C A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Clinicos Santa Monica, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Vista Alegre, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'General de Salud Integral,Ca (GSI)',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Medkar Nivel Parque, C.A. C',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Laboratorio Clinico Bioelectronico HCT, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Diagnoimagen Centro Caracas, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'B.O.Medical C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Orituco',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Perez Guillen, C. A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Laboratorio Clinico Layre II, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Quirurgico Ambulatorio Maria Rosa Mistica, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Saludsonrisa, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica San Juan, S.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Santa Rosalia U.E.M., C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Maternidad 5 De Julio, C.A.',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Mlc Centro Medico, C.A',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Materno Infantil Zaraza',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital De Clinicas Caracas',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Dr.José María Vargas',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Clínico Universitario',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital De Niños JM de Los Ríos',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Domingo Luciani',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Dr. José Gregorio Hernández',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital “Miguel Pérez Carreño”',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Médico Quirúrgico “Dr. Ricardo Baquero González”',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico de Caracas',
                'state' => 'Distrito Capital',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Los Cedros, C.A',
                'state' => 'Portuguesa',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Diagnocentro Acarigua, C.A.',
                'state' => 'Portuguesa',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica de Especialidades Medicas Los Llanos (CEMEL) ',
                'state' => 'Portuguesa',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Previmedica IDB',
                'state' => 'Portuguesa',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Santa Maria',
                'state' => 'Portuguesa',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica San Jose ',
                'state' => 'Portuguesa',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Dr. José María Vargas, C.A.',
                'state' => 'Portuguesa',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Fundacion Medicos Y Enfermeras Venezolanos Con Conciencia',
                'state' => 'Portuguesa',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Santa Fe, C.A',
                'state' => 'Portuguesa',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Aps Centro Medico San Juan ',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'San Javier Del Arca, C.A.',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad De Atención Médica Primaria Santa Mónica, C.A.',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Atencion Medica Primaria Las Mercedes',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'C.A. Policlinica Barquisimeto P',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico De Oncologia, C.A.',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Valentina Canabal, C.A',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico San Juan',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Acosta Ortiz, C.A.',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica IDET Barquisimeto C.A. ',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Razetti de Barquisimeto',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Quirurgica Los Leones, C.A.',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Cabudare',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Carora, C.A',
                'state' => 'Lara',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Ejido, C.A. A',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Vargas ',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Clinico Panamericano',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Vidasalu,C.A.',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinisalud Medicina Prepagada, S.A. ',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Clinico Del Valle C.A',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Clinico Panamericano',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Santa Fe S.A.',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Dr. Marcial Rios Morillo, C.A',
                'state' => 'Merida',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Docente Los Altos, C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad De Diagnostico Avanzado su Salud, C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Cenimat Centro Integral De Imagenes del Tuy, C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Paso Real, S.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Rehab. Fisiosalud Marlene Bolivar, C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Rehamedic Add Unidad de Rehabilitacion C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico La Candelaria de Cua, C.A',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Especialidades Medico Quirugicas Guatire C.A',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Asistencial Federico Ozanam ',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Hospital Privado San Martin de Porres C.A ',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicio de Atencion Medica Totalsalud 3000 C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Coralia 2a, C.A',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Los Altos Mirandinos, C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Docente El Paso, C.A',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Medico Quirurgico Ribas, C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica El Retiro, C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'IPS Carrizal',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico de Especialidades Bethania C.A',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Especialidades Medicas Atina, C.A.. ',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Samar, C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Cenimat Centro Integral de Imagenes del Tuy, C.A.',
                'state' => 'Miranda',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico C.A',
                'state' => 'Monagas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Oriental de Salud Cemos C.A.',
                'state' => 'Monagas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clínica Tierra Santa, C.A.',
                'state' => 'Monagas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto Medico Especializado Victoria C.A',
                'state' => 'Monagas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Metropolitano Maturin, C.A.',
                'state' => 'Monagas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto de Salud Y Atencion Medica Integral, C.A (Isamica)',
                'state' => 'Monagas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Oriental de Salud Integral Del Estado Monagas ',
                'state' => 'Monagas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Medica Integral Jasiel, C.A',
                'state' => 'Monagas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Rafael Zamora Arévalo',
                'state' => 'Guarico',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital General Guillermo Lara',
                'state' => 'Guarico',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Dr. Israel Ranuarez Balza- Guárico',
                'state' => 'Guarico',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'C.M.X. Venezuela, C.A',
                'state' => 'Nueva Esparta',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico del Caribe, C. A. (Porlamar) ',
                'state' => 'Nueva Esparta',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico El Valle, C.A.',
                'state' => 'Nueva Esparta',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Inversiones Medicas de Venezuela Mrk 2011, C.A. (Prevaler)',
                'state' => 'Nueva Esparta',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Inversiones 7495, Clinica Juangriego, C.A',
                'state' => 'Nueva Esparta',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Quirurgico La Fe, C.A.',
                'state' => 'Nueva Esparta',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Bello Monte, C.A. ',
                'state' => 'Sucre',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Corporativa Cias, C.A. (Centro Integral Y Adm. De La Salud)',
                'state' => 'Sucre',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Gamma Salud, C.A.',
                'state' => 'Sucre',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'MV Medical, C.A. ',
                'state' => 'Sucre',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Sucre, C.A. (Emergencias)',
                'state' => 'Sucre',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Proequip Salud, A.C.',
                'state' => 'Sucre',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Medivolt, C.A.',
                'state' => 'Sucre',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Rubio, C.A.',
                'state' => 'Tachira',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico San Cristobal Hospital Privado, C.A.',
                'state' => 'Tachira',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Tachira Hospitalizacion, C.A',
                'state' => 'Tachira',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Cirugia San Sebastian, C.A',
                'state' => 'Tachira',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Quirurgico La Trinidad, C.A.',
                'state' => 'Tachira',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Materno Infantil Los Andes, C.A.',
                'state' => 'Tachira',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Especialidades Medicas de Occidente (Esmedoca)',
                'state' => 'Tachira',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Venezolana de Salud Integral, C.A',
                'state' => 'Tachira',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Tariba, C.A.',
                'state' => 'Tachira',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Maria Edelmira Araujo, S.A',
                'state' => 'Trujillo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Previmedica IBD',
                'state' => 'Trujillo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Médico Las Acacias, C.A',
                'state' => 'Trujillo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A.',
                'state' => 'Trujillo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Medico Quirurgica General Andina U.G.A., C.A.',
                'state' => 'Trujillo',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Camuribe, C.A.',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Quirurgica San Antonio, C.A',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Integra Aps Vargas C.A.',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clínico Pediátrico Glamar',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Siempre, C.A.',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'CTRO. Obstetrico Ginecologico Dr. Luis F. Marcano, S.R.L.',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Siempre Salud',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad De Atencion Respiratoria SJM, C.A',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Alfa, C.A',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'A.C.Hospital San Jose de Las Hermanitas De Los Pobres',
                'state' => 'Vargas',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico de Atencion Integral Diagnostico C.A.',
                'state' => 'Yaracuy',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Clinica Sagrado Corazón de Jesus, C.A. ',
                'state' => 'Yaracuy',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Yara Salud ',
                'state' => 'Yaracuy',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica Yaracuy',
                'state' => 'Yaracuy',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica De Especialidades Medico Quirurgicas',
                'state' => 'Yaracuy',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Unidad Medica Quirurgica Yurubi, C.A ( Previmedica IDB )',
                'state' => 'Yaracuy',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica IMD San Felipe',
                'state' => 'Yaracuy',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Instituto de Especialidades Quirurgicas San Ignacio',
                'state' => 'Yaracuy',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica San Felipe, C.A.',
                'state' => 'Yaracuy',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico de Cabimas C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico de Cabimas, S.A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Privado El Rosario',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Prima Salud C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Venezolana de Salud Integral, C.A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Privado El Rosario',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica San Antonio, C.A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Cirugia San Jose, C.A. ',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Medicos Colon C.A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Venezolana de Salud Integral, C.A A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Machiques',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Venezolana de Salud Integral, C.A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Machiques',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Servicios Medicos San Rafael C.A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlínica Dr. Adolfo Dempaire',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A. (Sede Principal)',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro de Diagnostico Los Olivos, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico Paraiso, C.A. ',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Sierra Maestra, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Sucre, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Privado El Rosario, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Laboratorio Clinico La Milagrosa C.A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Sermeca Servicios Medicos de Emergencia, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Meds Paraiso Venezuela, C.A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Medico de Occidente',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Venemedica 24h, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico Medisur C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'General de Salud Integral,Ca (Gsi)',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Clinica Metropolitana de Maracaibo, S.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A. ',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Privado El Rosario ',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Policlinica San Francisco, C.A',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],
            [
                'description' => 'Hospital Universitario de Maracibo',
                'state' => 'Zulia',
                'country' => 'Venezuela',
            ],

            /**Centros Republica Dominicana */
            [
                'description' => 'CONSULTORIO MEDICO GUACHUPITA',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
            [
                'description' => 'COMUNAL LA ZURZA',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
            [
                'description' => 'SAN CARLOS',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
            [
                'description' => 'OFICINAS GUBERNAMENTALES',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
            [
                'description' => 'NUESTRA SENORA DEL CARMEN',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
            [
                'description' => 'CONSULTORIO MEDICO ESCUELA AMELIA RICART CALVENTI',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
            [
                'description' => 'CONSULTORIO MEDICO ESCUELA ROSA DUARTE',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
            [
                'description' => 'CONSULTORIO MEDICO ESCUELA FRANCISCO ULISES DOMINGUEZ',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
            [
                'description' => 'INSTITUTO DE SEXUALIDAD HUMANA',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
            [
                'description' => 'ESCUELA FRANCISCO XAVIER BILLINI',
                'state' => 'DISTRITO NACIONAL',
                'country' => 'República Dominicana',
            ],
];

        Center::insert($data);
    }
}
