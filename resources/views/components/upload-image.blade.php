<style>
    .collapseBtn {
        color: #428bca;
    }

    /* img {
        margin-left: 10px;
        margin-bottom: 15px;
    } */

    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 2px 15px;
        cursor: pointer;
        font-size: 11px;
        border-radius: 15px
    }
</style>
<script>
    $(document).ready(() => {
        let img;
        // let img2 = '{{ URL::asset('/img/V2/combinado.png') }}';
        // $("#imgPreview").attr("src", img2);
        $("#file").change(function() {
            const file = this.files[0];

            if (file) {
                let reader = new FileReader();
                if (file.type.substring(file.type.lastIndexOf("/") + 1) == "pdf") {

                    img = '{{ URL::asset('/img/V2/file.png') }}';
                    reader.onload = function(event) {
                        $("#imgPreview").attr("src", img);
                        $('#img').val(event.target.result)

                    };
                    reader.readAsDataURL(file);
                    $(".holder").show();
                } else {
                    reader.onload = function(event) {
                        $("#imgPreview").attr("src", event.target.result);
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
    {{-- <div class="mt-2"> --}}
        {{-- <h5 class="collapseBtn">{{ $title }}</h5> --}}
    {{-- </div> --}}
    <div class="row mt-3" style="display: flex; flex-direction: column; align-items: center;">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="text-align: center">
            <div class="holder">
                <img width="95" height="95" id="imgPreview" src="#" alt="pic" style="border-radius: 9%; object-fit: cover;" />

            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-2" style="text-align: center">
            <div style="padding-top: 6px;">
                {{-- <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 8px; margin-top: 4px">{{ $title }}</label> --}}
                {{-- <input type="file" class="form-control" id="file" name="file" accept=".jpg, .jpeg, .png"> --}}
                <label for="file" class="custom-file-upload"> {{ $title }} </label>
                <br>
                {{-- <label for="name" class="form-label" style="font-size: 11px; margin-top: 4px; margin-bottom: 0">@lang('messages.label.info_2')</label> --}}
                <input id="file" type="file" name="file" accept=".jpg, .jpeg, .png"/>
                <input type="hidden" name="img" id="img" >

            </div>
        </div>
    </div>
</div>
