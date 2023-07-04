 <style>
     .img {
         width: 80%;
         height: auto;

     }

     .img2 {
         width: 70%;
         height: auto;
         border-radius: 10px;
         margin-top: 14%;
     }


     .img3 {
         width: 80%;
         height: auto;
         border-radius: 10px;
     }

     .mt-div {
         margin-top: 38px;
         margin-left: 0%;
         padding: -2px 0px 0px 50px;

     }

     .maring-div {
         margin-right: -3% !important;
     }

     .div-left {
         padding: 0px 0px;
         margin-left: 36%;
     }

     .strong {
         /* margin: 30px; */
         color: white;
         font-size: 10px;
         /* margin-left: 80px; */
         margin-top: 25px;

         display: inline-block;
         text-align: center;
         white-space: nowrap;
     }

     .banner {
         width: 66%;
         height: auto;
     }



     @media only screen and (max-width: 300px) {
        #logo1{
            margin-right: -5% !important;
        }

         .img {
             width: 40px;
             height: auto;
         }

         .img2 {
             width: 45px;
             height: auto;
             border-radius: 10px;
         }

         .img3 {
             width: 40%;
             height: auto;
             border-radius: 10px;
         }

         .div-left {
             padding: 0px 0px;
             margin-left: 0%;
         }

         .mt-div {
             margin-top: 14px;
             margin-left: 0%;
             padding: -2px 0px 0px 50px;
         }

         i {
             display: none;
         }

         .strong {
             /* margin: 30px; */
             color: white;
             font-size: 10px;
             /* margin-left: 80px; */
             margin-top: 25px;

             display: inline-block;
             text-align: center;
             white-space: nowrap;
         }
     }


     @media only screen and (max-width: 390px) {
        #logo1{
            margin-right: -5% !important;
        }

         .img {
             width: 40px;
             height: auto;
         }

         .img2 {
             width: 45px;
             height: auto;
             border-radius: 10px;
         }

         .img3 {
             width: 40%;
             height: auto;
             border-radius: 10px;
         }

         .div-left {
             padding: 0px 0px;
             margin-left: 0%;
         }

         .mt-div {
             margin-top: 14px;
             margin-left: 0%;
             padding: -2px 0px 0px 50px;
         }

         i {
             display: none;
         }

         .strong {
             /* margin: 30px; */
             color: white;
             font-size: 10px;
             /* margin-left: 80px; */
             margin-top: 25px;

             display: inline-block;
             text-align: center;
             white-space: nowrap;
         }
     }

     @media only screen and (max-width: 400px) {
        #logo1{
            margin-right: -5% !important;
        }
         .img {
             width: 40px;
             height: auto;
         }

         .img2 {
             width: 45px;
             height: auto;
             border-radius: 10px;
         }

         .img3 {
             width: 40%;
             height: auto;
             border-radius: 10px;
         }

         .div-left {
             padding: 0px 0px;
             margin-left: 0%;
         }

         .mt-div {
             margin-top: 14px;
             margin-left: 0%;
             padding: -2px 0px 0px 50px;
         }

         i {
             display: none;
         }

         .strong {
             color: white;
             font-size: 8px;
             margin-top: 20px;
             display: inline-block;
             text-align: center;
             white-space: nowrap;
         }


     }

     @media only screen and (max-width: 600px) {

        #logo1{
            margin-right: -5% !important;
        }
         .img {
             width: 40px;
             height: auto;
         }

         .img2 {
             width: 45px;
             height: auto;
             border-radius: 10px;
         }

         .img3 {
             width: 40%;
             height: auto;
             border-radius: 10px;
         }

         .div-left {
             padding: 0px 0px;
             margin-left: 0%;
         }

         .mt-div {
             margin-top: 14px;
             margin-left: 0%;
             padding: -2px 0px 0px 50px;
         }

         i {
             display: none;
         }

         .strong {
             color: white;
             font-size: 8px;
             margin-top: 20px;
             display: inline-block;
             text-align: center;
             white-space: nowrap;
         }

     }
 </style>
 <div>
     <div class="container-fluid" style="background-color: #44525f;">
         <div class="d-flex justify-content-start" id="row">
             <div class="col-sm-1 md-1 lg-1 xl-1 xxl-1" id="logo1">
                 <img class="img2" src="{{ asset('img/images.jpg') }}">
             </div>
             <div class="col-sm-1 md-1 lg-1 xl-1 xxl-1 offset-1 mt-2 maring-div">
                 <a href="{{ route('DashboardComponent') }}" title="Dashboard">
                     <img class="img" src="{{ asset('img/V2/dashbord.png') }}" alt="Dashboard">
                 </a>
             </div>

             <div class="col-sm-1 md-1 lg-1 xl-1 xxl-1 mt-2  maring-div">
                 <a href="{{ route('Patients') }}" title="Pacientes">
                     <img class="img" src="{{ asset('img/V2/pacientes.png') }}" alt="Pacientes">
                 </a>
             </div>
             <div class="col-sm-1 md-1 lg-1 xl-1 xxl-1 mt-2 maring-div">
                 <a href="{{ route('Diary') }}" title="Agenda">
                     <img class="img" src="{{ asset('img/V2/agenda.png') }}" alt="Agenda">
                 </a>
             </div>
             <div class="col-sm-1 md-1 lg-1 xl-1 xxl-1 mt-2 maring-div">
                 <a href="{{ route('Centers') }}" title="Clínica">
                     <img class="img" src="{{ asset('img/V2/clinica.png') }}" alt="Clínica">
                 </a>
             </div>
             <div class="col-sm-1 md-1 lg-1 xl-1 xxl-1 mt-2 maring-div">
                 <a href="{{ route('Setting') }}" title="Configuración">
                     <img class="img" src="{{ asset('img/V2/configuracion.png') }}" alt="Configuración">
                 </a>
             </div>
             <div class="col-sm-1 md-1 lg-1 xl-1 xxl-1 mt-2">
                 <a href="{{ route('Statistics') }}" title="Estadistica">
                     <img class="img" src="{{ asset('img/V2/estadisticas.png') }}" alt="Estadistica">
                 </a>
             </div>

             <div class=" d-flex col-sm-1 md-1 lg-1 xl-1 xxl-1  div-left">
                 <h6 class="strong"> {{ Auth::user()->name }} {{ Auth::user()->last_name }} <i class="bi bi-person-fill"></i> <strong><i onclick="logout();" class="bi bi-escape"></i></strong></h6>
             </div>
         </div>
     </div>

     <div class="container-fluid">
         <div class="d-flex justify-content-center mt-3">
             <img class="banner" src="{{ asset('img/leaderboard-banner (1).gif') }}" alt="">
         </div>
     </div>
 </div>

 <script>
   function logout(){

    console.log("sdd");
        // var url = "{{ route('UserEdit', ':id') }}";
        var url = "/";
        // url = url.replace(':id', id);
        location.href = url;
    }
 </script>