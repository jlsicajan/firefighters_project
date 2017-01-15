<div class="modal fade" id="unityDetailModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Channel</h4>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#unityDetailModal").on("show.bs.modal", function (e) {
//        var link = $(e.relatedTarget);
//        var modal_function = link.data("func");
//        var channel_id = link.data("inf");
//        $('#name, #description').val("");
//        $("#thumbnail").attr("src", "");
//        if (modal_function == 'edit') {
//            $.ajax({
//                type: "GET",
//                url: "/channel/find",
//                data: {id: channel_id},
//                success: function (data) {
//                    obj = JSON.parse(data);
//                    $("#channel_id").val(data.id);
//                    $('#name').val(obj.name);
//                    $('#description').val(obj.description);
//                    $('#thumbnail').attr("src", obj.thumbnail_url);
//                }
//            });
//        }
    });
</script>