
<style>
    .btn {
        font-size: 15px;
    }
    
</style>
<div>
    <div class="accordion" id="accordionExample">
        @foreach ($btns as $item)
            <div class="card z-depth-0 bordered">
                <div class="card-header" id="headingThree">
                    <a href="{{ route($item['router']) }}" title="MedicalHistory">
                        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree"
                            aria-expanded="false" aria-controls="collapseThree">
                            <i class="bi bi-blockquote-left"></i>
                            {{ $item['text'] }} </button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
