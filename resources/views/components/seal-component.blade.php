<style>
    .collapseBtn {
        color: #428bca;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        font-size: 12px;
        border-radius: 15px
    }

    /* img {
        margin-left: 10px;
        margin-bottom: 15px;
    } */
</style>
<script>
    $(document).ready(() => {
        let img;
        $("#seal").change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#seal_img_preview")
                        .attr("src", event.target.result);
                    $('#seal_img').val(event.target.result)

                };
                reader.readAsDataURL(file);
                $(".holder_seal").show();

            }
        });
    });

    const handler = () => {
        $('#modalCenter').modal('show');
    }
</script>

<div>
    {{-- <div class="mt-2"> --}}
        {{-- <h5 class="collapseBtn">{{ $title }}</h5> --}}
    {{-- </div> --}}
    <div class="row mt-2" style="display: flex; flex-direction: column; align-items: center;">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4" style="text-align: center">
            <div class="mb-3">
                <label for="seal" class="form-label custom-file-upload" style="font-size: 13px; margin-bottom: 8px; margin-top: 4px">Cargar Sello</label>
                <input type="file" class="form-control" id="seal" name="seal" accept=".jpg, .jpeg, .png"><i onclick="handler();" class="bi bi-info-circle"></i>
                <label for="seal_img" class="form-label" style="font-size: 13px; margin-bottom: 8px; margin-top: 4px">Ingrese una imagen de max 256kb</label>
                <input type="hidden" name="seal_img" id="seal_img" class="seal_img">
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4" style="text-align: center">
            <div class="holder_seal" style="display: none">
                <img width="200" height="130" id="seal_img_preview" src="#" alt="pic" style="border-radius: 9%; object-fit: cover;" />
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="modalCenter" tabindex="-1" aria-labelledby="modalCenterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header title">
                        <i class="bi bi-info-circle"></i>
                        <span style="padding-left: 5px">Información importante</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd">
                                <img src="{{asset('img/sello.jpg')}}" alt="" srcset="">                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
