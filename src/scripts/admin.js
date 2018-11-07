document.addEventListener('DOMContentLoaded', function () {

    var formatSelector = document.getElementById('post-formats-select');

    if(formatSelector != null) {

        var video_meta_box = document.getElementById('post_video_meta');
        var inputs = formatSelector.querySelector('fieldset').querySelectorAll('input');

        for(var i = 0; i < inputs.length; i++) {
            var input = inputs[i];
            if( input.checked === true && input.value === 'video') {
                video_meta_box.style.display = 'block';
            }else{
                video_meta_box.style.display = 'none';
            }
        }

        formatSelector.querySelector('fieldset').addEventListener('change', function( event ) {
            if(event.target.value === 'video') {
                video_meta_box.style.display = 'block';
            }else{
                video_meta_box.style.display = 'none';
            }
        });
    }
});



