<script>
        $(document).ready(function() {
        $.uploadPreview({
            input_field: "#image-upload",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "Upload Foto",
            label_selected: "Ganti Foto"
        });
    });

    ! function(e) {
        e.extend({
            uploadPreview: function(l) {
                var i = e.extend({
                    input_field: ".image-input",
                    preview_box: ".image-preview",
                    label_field: ".image-label",
                    label_default: "Choose File",
                    label_selected: "Change File",
                    no_label: !1,
                    success_callback: null
                }, l);
                return window.File && window.FileList && window.FileReader ? void(void 0 !== e(i.input_field) && null !== e(i.input_field) && e(i.input_field).change(function() {
                    var l = this.files;
                    if (l.length > 0) {
                        var a = l[0],
                            o = new FileReader;
                        o.addEventListener("load", function(l) {
                            var o = l.target;
                            a.type.match("image") ? (e(i.preview_box).css("background-image", "url(" + o.result + ")"), e(i.preview_box).css("background-size", "cover"), e(i.preview_box).css("background-position", "center center")) : a.type.match("audio") ? e(i.preview_box).html("<audio controls><source src='" + o.result + "' type='" + a.type + "' />Your browser does not support the audio element.</audio>") : alert("This file type is not supported yet.")
                        }), 0 == i.no_label && e(i.label_field).html(i.label_selected), o.readAsDataURL(a), i.success_callback && i.success_callback()
                    } else 0 == i.no_label && e(i.label_field).html(i.label_default), e(i.preview_box).css("background-image", "none"), e(i.preview_box + " audio").remove()
                })) : (alert("You need a browser with file reader support, to use this form properly."), !1)
            }
        })
    }(jQuery);
</script>