<div id="photo-popup" class="photo-popup mfp-hide zoom-anim-dialog">
    <form action="/change_avatar" method="post" enctype="multipart/form-data" class="photo-form">
        {{ csrf_field() }}
        <input name="input_img" type="file">
        <button type="submit" class="purple-btn">Load</button>
    </form>
</div>