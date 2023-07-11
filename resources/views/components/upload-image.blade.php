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
    <hr>
    <div>
        <h5 class="collapseBtn">{{$title}}</h5>
    </div>
    <hr>
    <div class="row">
        <div class="{{$class_one}}">
            <div class="holder" style="display: none">
                <img width="100" height="100" id="imgPreview" src="#" alt="pic" />
            </div>
        </div>

        <div class="{{$class_two}}">
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="photo">
            </div>
        </div>

    </div>
</div>
