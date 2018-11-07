<?php
if(!empty(get_post_meta($post->ID)['_video_meta_key'][0])) {
    $url = get_post_meta($post->ID)['_video_meta_key'][0];
    if( strpos($url, 'vimeo') || strpos($url, 'youtube') ): ?>

        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="<?php echo $url; ?>" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>

        <?php if(strpos($url, 'vimeo')): ?>
            <script src="https://player.vimeo.com/api/player.js"></script>
        <?php endif;?>

    <?php else: ?>

        <video src="<?php echo $url; ?>" width="100%" height="auto" autoplay="true"></video>

    <?php endif;
} ?>