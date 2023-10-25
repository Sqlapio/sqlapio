<style>
    .collapseBtn {
        color: #428bca;
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
                if (file.type.substring(file.type.lastIndexOf("/") + 1) == "pdf") {
                    img = '{{ URL::asset('/img/V2/descarga.png') }}';
                    reader.onload = function(event) {
                        $("#seal_img_preview")
                            .attr("src", img);
                        $('#img').val(event.target.result)

                    };
                    reader.readAsDataURL(file);
                    $(".holder_seal").show();
                } else {
                    reader.onload = function(event) {
                        $("#seal_img_preview")
                            .attr("src", event.target.result);
                        $('#seal_img').val(event.target.result)

                    };
                    reader.readAsDataURL(file);
                    $(".holder_seal").show();
                }
            }
        });
    });
</script>

<div>
    <div class="mt-2">
        {{-- <h5 class="collapseBtn">{{ $title }}</h5> --}}
    </div>
    <div class="row mt-3">
        <div class="{{ $class_two }}">
            <div class="mb-3">
                <label for="seal" class="form-label" style="font-size: 13px; margin-bottom: 8px; margin-top: 4px">Cargar Sello</label>
                <input type="file" class="form-control" id="seal" name="seal"  accept=".jpg, .jpeg, .png">
                <label for="seal_img" class="form-label" style="font-size: 13px; margin-bottom: 8px; margin-top: 4px">Ingrese una imagen de max 256kb</label>
                <input type="hidden" name="seal_img" id="seal_img">
            </div>
        </div>
        <div class="{{ $class_one }}">
            <div class="holder_seal" style="display: none">
                <img width="200" height="200" id="seal_img_preview" src="#" alt="pic" style="border-radius: 9%; object-fit: cover;" />
            </div>
        </div>
    </div>
</div>