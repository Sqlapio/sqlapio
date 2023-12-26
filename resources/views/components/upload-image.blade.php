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
        $("#file").change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                if (file.type.substring(file.type.lastIndexOf("/") + 1) == "pdf") {
                    img = '{{ URL::asset('/img/V2/descarga.png') }}';
                    reader.onload = function(event) {
                        $("#imgPreview")
                            .attr("src", img);
                        $('#img').val(event.target.result)

                    };
                    reader.readAsDataURL(file);
                    $(".holder").show();
                } else {
                    reader.onload = function(event) {
                        $("#imgPreview")
                            .attr("src", event.target.result);
                        $('#img').val(event.target.result)

                    };
                    reader.readAsDataURL(file);
                    $(".holder").show();
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
                <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 8px; margin-top: 4px">{{ $title }}</label>
                <input type="file" class="form-control" id="file" name="file"  accept=".jpg, .jpeg, .png">
                <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 8px; margin-top: 4px">Ingrese una imagen de max 256kb</label>
                <input type="hidden" name="img" id="img">
            </div>
        </div>
        <div class="{{ $class_one }}">
            <div class="holder" style="display: none">
                <img width="100" height="100" id="imgPreview" src="#" alt="pic" style="border-radius: 9%; object-fit: cover;" />
            </div>
        </div>
    </div>
</div>