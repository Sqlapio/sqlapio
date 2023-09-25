<style>
    .shadow-div {
        box-shadow: 0 0 0 64em rgba(8, 42, 73, 0.144);
    }

    .spinnner {
        width: 52px;
        height: auto;
        position: absolute;
        text-align: center;
        top: 64%;
        z-index: 3;
    }

    @media only screen and (max-width: 768px) {
        .spinnner {
            top: 70%;
        }
    } 
    
</style>
<div class="container shadow-div">
    <div class="row justify-content-center">
        <img class="spinnner" src="{{ asset('img/carga sqlapio.gif') }}" alt="">
    </div>
</div>
