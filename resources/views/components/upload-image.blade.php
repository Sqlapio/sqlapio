<style>
    .collapseBtn {
        color: #428bca;
    }

    img {
        margin-left: 10px;
        margin-bottom: 15px;
    }
</style>
<script>
    $(document).ready(() => {
        $("#photo").change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#imgPreview")
                        .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
                $(".holder").show();
            }
        });
    });
</script>

<div>
    @if($showHeader === true)
    <hr>
    <div>
        <h5 class="collapseBtn">{{$titlle}}</h5>
    </div>
    <hr>
    @endif
    <div class="row">
        <div class="{{$classOne}}">
            <div class="holder" style="display: none">
                <img width="100" height="100" id="imgPreview" src="#" alt="pic" />
            </div>
        </div>

        <div class="{{$classTwo}}">
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="photo">
            </div>
        </div>

    </div>
</div>
