<style>
    .shadow-div {
        box-shadow: 0 0 0 64em rgba(0,0,0,0.75);
        position: absolute;
        z-index: 1;
        
    }

    /* .section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("../img/fondo.jpg");
    }    */

    .spinnner {
        width: 9%;
        height: auto;
        position: fixed;
        text-align: center;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 3;
        margin: auto;
    }

    @media only screen and (max-width: 768px) {
        .spinnner {
            width: 40%;
        }
    } 
    
</style>
<div class="container shadow-div">
    <div class="row justify-content-center form-sq">
        <img class="spinnner" src="{{ asset('img/SQ.gif') }}" alt="">
    </div>
</div>
