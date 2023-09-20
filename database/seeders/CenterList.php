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
            ],
            [
                'description' => 'Centro Medico Zambrano',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Fast Medical Globe Salud, C.A.',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Unidad Pediatrica De Oriente, C.A.',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Centro Medico Odontologico Gs Oriente, C.A.',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Centro Medico Total Lecheria C.A (Meditotal) ',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Oriental De Salud Integral C.A (Lecheria)',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Centro Clinico Santa Ana C.A.',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Centro De Especialidades Medicas Virgen Del Valle, C.A.',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Centro Medico Total, C.A.',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Proteccion Integral A Su Salud S.A.',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Centro Clinico Cientifico Esperanza Paraco, C.A',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Clinica Santa Rosa C.A',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Unidad Quirurgica Anzoategui, C.A',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Hospital Clinico Metropolitano C.A',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Grupo De Especialidades Endovascular, C.A. (Policlinica Del Sur)',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Centro Clinico Divino Niño, C.A.',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Venezolana De Salud Integral (Apure)',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Asociación Cooperativa Servimed, 85 R.L.',
                'state' => 'Anzoategui',
            ],
            [
                'description' => 'Grupo Medico Integral Vida & Salud',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Instituto Integral Medico Quirúrgico, C.A.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Policlinica Centro C.A.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Unidad Medica Quirurgica Dra Haidee Rodriguez',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Hospital De Clinicas Las Delicias',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Centro Medico Ocupacional Victoria, C.A.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Hospital De Clinicas Aragua, C.A',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Salud Y Bienestar Victoria, C.A',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Cemat Centro Médico De Alta Tecnología, C.A.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Clinica Calicanto',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Clinica Lugo, C.A.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Inversiones Virgen De Guadalupe, C.A.(Clinica Guadalupe)',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Unidad Medico Integral La Maestranza, C.A.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Centro Clinico La Fontana',
                'state' => 'Aragua',
            ],
            [
                'description' => 'C.D.M. Girardot, C.A',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Presalud C.A.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Centro Medico Maracay, C.A',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Prevaler Maracay, C.A.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Especialidades Medicas Turmero, C.A.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Instituto Policlinico De Turmero, C.A',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Asociaciòn Coop. Tucutunemo R.L.',
                'state' => 'Aragua',
            ],
            [
                'description' => 'Grupo Corp Clinica Ntra Sra Del Pilar, C.A.',
                'state' => 'Barinas',
            ],
            [
                'description' => 'Instituto Diagnostico Varyna, C.A.',
                'state' => 'Barinas',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A',
                'state' => 'Barinas',
            ],
            [
                'description' => 'Unidad Quirurgica Del Centro. C.A.',
                'state' => 'Barinas',
            ],
            [
                'description' => 'Hospital Luis Razetti',
                'state' => 'Barinas',
            ],
            [
                'description' => 'Entro Médico Orinoco, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Corporacion Clinica Universitaria De Oriente, A.C.(Ccudo) Bolivar',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Centro Clinico Andres Bello, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Instituto Cardiovascular De Guayana, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Laboratorios Rizzi, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Centro Avanzado De Cirugia Avanza',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Unidad Cardiovascular No Invasiva Cardiosalud, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Clinica Chilemex, C.A',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Clinica La Esperanza, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Clinica Puerto Ordaz, C.A',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Clinica Quirugica Razetti',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Hospital De Clinicas Caroní, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Hospital De Clinicas De Ceciamb, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Instituto Clinico Unare, C.A',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Centro Hospitalario Guayana, C.A. (Clinica Humana)',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Instituto Clinico Primero De Mayo, C.A. ',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Centro De Especialidades Medicas Upata, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Clinica Van Praag, C.A.',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Hospital Ruíz Y Páez',
                'state' => 'Bolivar',
            ],
            [
                'description' => 'Policlinico Bejuma, C. A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Unidad Médica Por Su Salud, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro Clinico Flor Amarillo ',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Policlinicas Las Industrias, C. A. Amazo',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro De Especialidades Quirurgicas Guacara, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro Clinico Santa Paula, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro Clinico La Isabelica, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Policlinicas Elohim Valencia C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro De Estudios Clinicos Movilab, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Atenprisa, C.A',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Clinica El Viñedo',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Clinica Los Colorados, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro De Especialidades Quirurgicas San Antonio De Padua',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Policlinica Los Guayos, C.A',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Instituto De Especialidades Quirurgicas Los Mangos, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro De Especialidades Panamericano',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro Clinico Naguanagua C.A',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Servicios Medicos Asistenciales, C.A. (Sermeca-Hosp. Metrop Del Norte)',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro Clinico Cmb 2017, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro Clinico Genesis',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Hospital De Clinicas San Agustin De Puerto Cabello, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Unidad Medico Laboral N.C, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Clinica Guerra Mas, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Hospital De Clinicas San Agustin De Puerto Cabello, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Policlinica Urdaneta, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro Medico Valles De San Diego, C.A',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Grupo Medico Docente B & Pro, C.A',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Policlinica El Morro, Ca',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'La Gloria Centro Clinico Maternidad, S.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Prevaler C.A (Valencia)',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'C.A. Esculapio',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Central Salud Integral C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Instituto Docente De Urologia, C.A',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Presalud Nacional, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Puntosalud Valencia, C.A',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Reinmed Valencia C&C C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Integra Valencia Servicios Medicos, C.A.',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Diagnoimagen Valencia, C.A. ',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Ciudad Hospitalaria “Dr. Enrique Tejera”',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Hospital Central “Dr. Ramón Madariaga”',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Hospital De Clínica “San Agustín”',
                'state' => 'Carabobo',
            ],
            [
                'description' => 'Centro Medico Quirurgico Fernandez & Rodriguez, C.A',
                'state' => 'Cojedes',
            ],
            [
                'description' => 'Centro Medico Quirurgico La Milagrosa, C.A.',
                'state' => 'Cojedes',
            ],
            [
                'description' => 'Centro Medico Quirurgico Maternidad Santa Ana. C.A.',
                'state' => 'Cojedes',
            ],
            [
                'description' => 'Hospital Clinica Cojedes, C.A',
                'state' => 'Cojedes',
            ],
            [
                'description' => 'Policlinica Delta, C.A.',
                'state' => 'Delta Amacuro',
            ],
            [
                'description' => 'Clinica Idet, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica El Avila, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Grupo Medico Perfilab, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Instituto Medico La Floresta',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Inversiones Lopcymaster 2008, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Instituto De Retina Y Vitreo, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Piedra Azul, C.A. ',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Materno Infantil, C.A. (Leopoldo Aguerrevere)',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Unidad Medica Humboldt, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Sanatrix, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Ambulatorio Tanamo, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Servicios Medicos Integra Sxxi, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Medico Integra',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Bello Campo, C.A..',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Servicios Clinicos U.M.Q. Nueva Caracas, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Medico Quirurgico Virgen Milagrosa, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Policlinica Metropolitana, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Medico Beta',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Servicios Oseo 28 C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Organizacion De Servic. Especializados Tutoriales Oset, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Cemedifa Centro Medico, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro De Fisiatria Cenfis, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro De Rehabilitacion Hernandez Almeida, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Vidamed',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Ccct',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinicas Rescarven, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Policlinica De Coche, S.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Santiago De León, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Grupo Medico Santa Paula, S.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Aps Centro Médico Paraíso, C.A. C',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Amay, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinicas Rescarven, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Unidad De Especialidades Gastroenterologicas "El Paraiso" C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Policlinica Cabisoguarnac ',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Instituto Clinico La Florida, C.A. ',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Medicos Unidos Los Jabillos, C.A. (Policlinica Mendez Gimon) ',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Provectus Salud Imagenes M&O, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Servicios Diagnosticos Integrales S.D.I. C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Clinico Fenix Salud, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Cmq Mediprot, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Servicios Médicos Asis-Med, C.A. (Centro Clínico La Urbina)',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Grupo Medico Perfilab, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Medico Integral Careli, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Policlinica Las Mercedes, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Grupo Cefemi, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Serviascorp',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Las Ciencias, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Medymed Salud, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Contusalud 2016, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Capital De Salud Integral, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Atias Hospitalizacion Y Servicios, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Ortopedico Y Podologico C.O.P., C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Heart Guard Solutions, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Medico Odontologico Gs Oriente, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Unidad Quirurgica Los Sauces C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Mederi Equipos Y Servicios Medicos, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Grupo Medis Santa Fe, C A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Servicios Clinicos Santa Monica, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Vista Alegre, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'General De Salud Integral,Ca (Gsi)',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Medkar Nivel Parque, C.A. C',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Laboratorio Clinico Bioelectronico Hct, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Diagnoimagen Centro Caracas, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'B.O.Medical C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Medico Orituco',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Clinica Perez Guillen, C. A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Laboratorio Clinico Layre Ii, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Quirurgico Ambulatorio Maria Rosa Mistica, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Saludsonrisa, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Medialfa, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Policlinica San Juan, S.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Santa Rosalia U.E.M., C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Maternidad 5 De Julio, C.A.',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Mlc Centro Medico, C.A',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Materno Infantil Zaraza',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Hospital De Clinicas Caracas',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Hospital Dr.José María Vargas',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Hospital Clínico Universitario',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Hospital De Niños Jm De Los Ríos',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Hospital Domingo Luciani',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Hospital Dr. José Gregorio Hernández',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Hospital “Miguel Pérez Carreño”',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Hospital Médico Quirúrgico “Dr. Ricardo Baquero González”',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Medico De Caracas',
                'state' => 'Distrito Capital',
            ],
            [
                'description' => 'Centro Clinico Los Cedros, C.A',
                'state' => 'Portuguesa',
            ],
            [
                'description' => 'Diagnocentro Acarigua, C.A.',
                'state' => 'Portuguesa',
            ],
            [
                'description' => 'Clinica De Especialidades Medicas Los Llanos (Cemel) ',
                'state' => 'Portuguesa',
            ],
            [
                'description' => 'Previmedica Idb',
                'state' => 'Portuguesa',
            ],
            [
                'description' => 'Clinica Santa Maria',
                'state' => 'Portuguesa',
            ],
            [
                'description' => 'Clinica San Jose ',
                'state' => 'Portuguesa',
            ],
            [
                'description' => 'Policlinica Dr. José María Vargas, C.A.',
                'state' => 'Portuguesa',
            ],
            [
                'description' => 'Fundacion Medicos Y Enfermeras Venezolanos Con Conciencia',
                'state' => 'Portuguesa',
            ],
            [
                'description' => 'Clinica Santa Fe, C.A',
                'state' => 'Portuguesa',
            ],
            [
                'description' => 'Aps Centro Medico San Juan ',
                'state' => 'Lara',
            ],
            [
                'description' => 'San Javier Del Arca, C.A.',
                'state' => 'Lara',
            ],
            [
                'description' => 'Unidad De Atención Médica Primaria Santa Mónica, C.A.',
                'state' => 'Lara',
            ],
            [
                'description' => 'Atencion Medica Primaria Las Mercedes',
                'state' => 'Lara',
            ],
            [
                'description' => 'C.A. Policlinica Barquisimeto P',
                'state' => 'Lara',
            ],
            [
                'description' => 'Centro Medico De Oncologia, C.A.',
                'state' => 'Lara',
            ],
            [
                'description' => 'Centro Clinico Valentina Canabal, C.A',
                'state' => 'Lara',
            ],
            [
                'description' => 'Centro Medico San Juan',
                'state' => 'Lara',
            ],
            [
                'description' => 'Clinica Acosta Ortiz, C.A.',
                'state' => 'Lara',
            ],
            [
                'description' => 'Clinica Idet Barquisimeto C.A. ',
                'state' => 'Lara',
            ],
            [
                'description' => 'Clinica Razetti De Barquisimeto',
                'state' => 'Lara',
            ],
            [
                'description' => 'Unidad Quirurgica Los Leones, C.A.',
                'state' => 'Lara',
            ],
            [
                'description' => 'Policlinica Cabudare',
                'state' => 'Lara',
            ],
            [
                'description' => 'Policlinica Carora, C.A',
                'state' => 'Lara',
            ],
            [
                'description' => 'Clinica Ejido, C.A. A',
                'state' => 'Merida',
            ],
            [
                'description' => 'Centro Clinico Vargas ',
                'state' => 'Merida',
            ],
            [
                'description' => 'Hospital Clinico Panamericano',
                'state' => 'Merida',
            ],
            [
                'description' => 'Centro Clinico Vidasalu,C.A.',
                'state' => 'Merida',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A',
                'state' => 'Merida',
            ],
            [
                'description' => 'Clinisalud Medicina Prepagada, S.A. ',
                'state' => 'Merida',
            ],
            [
                'description' => 'Hospital Clinico Del Valle C.A',
                'state' => 'Merida',
            ],
            [
                'description' => 'Hospital Clinico Panamericano',
                'state' => 'Merida',
            ],
            [
                'description' => 'Policlinica Santa Fe S.A.',
                'state' => 'Merida',
            ],
            [
                'description' => 'Centro Clinico Dr. Marcial Rios Morillo, C.A',
                'state' => 'Merida',
            ],
            [
                'description' => 'Centro Medico Docente Los Altos, C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Unidad De Diagnostico Avanzado Su Salud, C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Cenimat Centro Integral De Imagenes Del Tuy, C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro Medico Paso Real, S.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro De Rehab. Fisiosalud Marlene Bolivar, C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Rehamedic Add Unidad De Rehabilitacion C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro Medico La Candelaria De Cua, C.A',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro De Especialidades Medico Quirugicas Guatire C.A',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro Medico Asistencial Federico Ozanam ',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro Medico Hospital Privado San Martin De Porres C.A ',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Servicio De Atencion Medica Totalsalud 3000 C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Clinica Coralia 2a, C.A',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Policlinica Los Altos Mirandinos, C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro Medico Docente El Paso, C.A',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Instituto Medico Quirurgico Ribas, C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Policlinica El Retiro, C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Ips Carrizal',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro Clinico De Especialidades Bethania C.A',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Especialidades Medicas Atina, C.A.. ',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro Clinico Samar, C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Cenimat Centro Integral De Imagenes Del Tuy, C.A.',
                'state' => 'Miranda',
            ],
            [
                'description' => 'Centro Medico C.A',
                'state' => 'Monagas',
            ],
            [
                'description' => 'Centro Medico Oriental De Salud Cemos C.A.',
                'state' => 'Monagas',
            ],
            [
                'description' => 'Clínica Tierra Santa, C.A.',
                'state' => 'Monagas',
            ],
            [
                'description' => 'Instituto Medico Especializado Victoria C.A',
                'state' => 'Monagas',
            ],
            [
                'description' => 'Hospital Metropolitano Maturin, C.A.',
                'state' => 'Monagas',
            ],
            [
                'description' => 'Instituto De Salud Y Atencion Medica Integral, C.A (Isamica)',
                'state' => 'Monagas',
            ],
            [
                'description' => 'Oriental De Salud Integral Del Estado Monagas ',
                'state' => 'Monagas',
            ],
            [
                'description' => 'Unidad Medica Integral Jasiel, C.A',
                'state' => 'Monagas',
            ],
            [
                'description' => 'Hospital Rafael Zamora Arévalo',
                'state' => 'Guarico',
            ],
            [
                'description' => 'Hospital General Guillermo Lara',
                'state' => 'Guarico',
            ],
            [
                'description' => 'Hospital Dr. Israel Ranuarez Balza- Guárico',
                'state' => 'Guarico',
            ],
            [
                'description' => 'C.M.X. Venezuela, C.A',
                'state' => 'Nueva Esparta',
            ],
            [
                'description' => 'Centro Clinico Del Caribe, C. A. (Porlamar) ',
                'state' => 'Nueva Esparta',
            ],
            [
                'description' => 'Centro Medico El Valle, C.A.',
                'state' => 'Nueva Esparta',
            ],
            [
                'description' => 'Inversiones Medicas De Venezuela Mrk 2011, C.A. (Prevaler)',
                'state' => 'Nueva Esparta',
            ],
            [
                'description' => 'Inversiones 7495, Clinica Juangriego, C.A',
                'state' => 'Nueva Esparta',
            ],
            [
                'description' => 'Centro Medico Quirurgico La Fe, C.A.',
                'state' => 'Nueva Esparta',
            ],
            [
                'description' => 'Clinica Bello Monte, C.A. ',
                'state' => 'Sucre',
            ],
            [
                'description' => 'Corporativa Cias, C.A. (Centro Integral Y Adm. De La Salud)',
                'state' => 'Sucre',
            ],
            [
                'description' => 'Gamma Salud, C.A.',
                'state' => 'Sucre',
            ],
            [
                'description' => 'Mv Medical, C.A. ',
                'state' => 'Sucre',
            ],
            [
                'description' => 'Policlinica Sucre, C.A. (Emergencias)',
                'state' => 'Sucre',
            ],
            [
                'description' => 'Proequip Salud, A.C.',
                'state' => 'Sucre',
            ],
            [
                'description' => 'Servicios Medivolt, C.A.',
                'state' => 'Sucre',
            ],
            [
                'description' => 'Centro Medico Rubio, C.A.',
                'state' => 'Tachira',
            ],
            [
                'description' => 'Centro Clinico San Cristobal Hospital Privado, C.A.',
                'state' => 'Tachira',
            ],
            [
                'description' => 'Policlinica Tachira Hospitalizacion, C.A',
                'state' => 'Tachira',
            ],
            [
                'description' => 'Centro De Cirugia San Sebastian, C.A',
                'state' => 'Tachira',
            ],
            [
                'description' => 'Centro Medico Quirurgico La Trinidad, C.A.',
                'state' => 'Tachira',
            ],
            [
                'description' => 'Hospital Materno Infantil Los Andes, C.A.',
                'state' => 'Tachira',
            ],
            [
                'description' => 'Especialidades Medicas De Occidente (Esmedoca)',
                'state' => 'Tachira',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A',
                'state' => 'Tachira',
            ],
            [
                'description' => 'Clinica Tariba, C.A.',
                'state' => 'Tachira',
            ],
            [
                'description' => 'Centro Clinico Maria Edelmira Araujo, S.A',
                'state' => 'Trujillo',
            ],
            [
                'description' => 'Previmedica Idb',
                'state' => 'Trujillo',
            ],
            [
                'description' => 'Centro Médico Las Acacias, C.A',
                'state' => 'Trujillo',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A.',
                'state' => 'Trujillo',
            ],
            [
                'description' => 'Unidad Medico Quirurgica General Andina U.G.A., C.A.',
                'state' => 'Trujillo',
            ],
            [
                'description' => 'Centro Medico Camuribe, C.A.',
                'state' => 'Vargas',
            ],
            [
                'description' => 'Unidad Quirurgica San Antonio, C.A',
                'state' => 'Vargas',
            ],
            [
                'description' => 'Integra Aps Vargas C.A.',
                'state' => 'Vargas',
            ],
            [
                'description' => 'Centro Clínico Pediátrico Glamar',
                'state' => 'Vargas',
            ],
            [
                'description' => 'Centro Medico Siempre, C.A.',
                'state' => 'Vargas',
            ],
            [
                'description' => 'Ctro. Obstetrico Ginecologico Dr. Luis F. Marcano, S.R.L.',
                'state' => 'Vargas',
            ],
            [
                'description' => 'Siempre Salud',
                'state' => 'Vargas',
            ],
            [
                'description' => 'Unidad De Atencion Respiratoria Sjm, C.A',
                'state' => 'Vargas',
            ],
            [
                'description' => 'Clinica Alfa, C.A',
                'state' => 'Vargas',
            ],
            [
                'description' => 'A.C.Hospital San Jose De Las Hermanitas De Los Pobres',
                'state' => 'Vargas',
            ],
            [
                'description' => 'Centro Medico De Atencion Integral Diagnostico C.A.',
                'state' => 'Yaracuy',
            ],
            [
                'description' => 'Unidad Clinica Sagrado Corazón De Jesus, C.A. ',
                'state' => 'Yaracuy',
            ],
            [
                'description' => 'Yara Salud ',
                'state' => 'Yaracuy',
            ],
            [
                'description' => 'Policlinica Yaracuy',
                'state' => 'Yaracuy',
            ],
            [
                'description' => 'Clinica De Especialidades Medico Quirurgicas',
                'state' => 'Yaracuy',
            ],
            [
                'description' => 'Unidad Medica Quirurgica Yurubi, C.A ( Previmedica Idb )',
                'state' => 'Yaracuy',
            ],
            [
                'description' => 'Clinica Imd San Felipe',
                'state' => 'Yaracuy',
            ],
            [
                'description' => 'Instituto De Especialidades Quirurgicas San Ignacio',
                'state' => 'Yaracuy',
            ],
            [
                'description' => 'Policlinica San Felipe, C.A.',
                'state' => 'Yaracuy',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Clinico De Cabimas C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Medico De Cabimas, S.A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Hospital Privado El Rosario',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Prima Salud C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Hospital Privado El Rosario',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Policlinica San Antonio, C.A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro De Cirugia San Jose, C.A. ',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Servicios Medicos Colon C.A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Medico Machiques',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Venezolana De Salud Integral, C.A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Medico Machiques',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Servicios Medicos San Rafael C.A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Policlínica Dr. Adolfo D Empaire',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A. (Sede Principal)',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro De Diagnostico Los Olivos, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Medico Paraiso, C.A. ',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Clinica Sierra Maestra, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Clinica Sucre, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Hospital Privado El Rosario, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Laboratorio Clinico La Milagrosa C.A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Sermeca Servicios Medicos De Emergencia, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Meds Paraiso Venezuela, C.A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Medico De Occidente',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Venemedica 24h, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Clinico Medisur C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'General De Salud Integral,Ca (Gsi)',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Clinica Metropolitana De Maracaibo, S.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A. ',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Hospital Privado El Rosario ',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Centro Clinico La Sagrada Familia, C.A.',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Policlinica San Francisco, C.A',
                'state' => 'Zulia',
            ],
            [
                'description' => 'Hospital Universitario De Maracibo',
                'state' => 'Zulia',
            ]
];

        Center::insert($data);
    }
}
