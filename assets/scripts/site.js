
/* Packery Settings
---------------------------------------------------------------------------------------------------- */

new Packery( '.grid--packery', {
    itemSelector: '.grid-item',
    layoutMode: 'packery'
});

/* Panel Toggles
---------------------------------------------------------------------------------------------------- */

jQuery(document).ready(function( $ ) {
    $(document).on('click', '.open', function() {
        $('body').addClass('no-scroll');

        var panel = $(this).attr('href');

        $(panel).removeClass('inactive animated fast slow fadeOut').addClass('active animated fast fadeIn');

        if ($('#panels .active')[0]) {
            $('#panels .active').not(panel).removeClass('animated fast slow fadeIn').addClass('animated slow fadeOut');

            setTimeout(function(){
                $('#panels .active').not(panel).removeClass('active').addClass('inactive');
            }, 500);
        }

        return false;
    });

    function panel_close() {
        $('body').removeClass('no-scroll');

        var panel = '.panel.active';

        $('.panel').removeClass('animated fast slow fadeIn');
        $(panel).addClass('animated fast fadeOut');

        setTimeout(function(){
            $('.panel').removeClass('active').addClass('inactive');
        }, 250);
    }

    $(document).on('click', '.panel', function() {
        panel_close();

        return false;
    });

    $(document).on('keyup',function(evt) {
        if (evt.keyCode == 27) {
            panel_close();
        }
    });
});

/* Video Toggles
---------------------------------------------------------------------------------------------------- */

jQuery(document).ready(function( $ ) {
    $(document).on('click', '.start', function() {

        // Gather video variables.
        var videoType = $(this).data('video-type');
        var videoID = $(this).data('video-id');

        // YouTube embeds.
        if (videoType === 'youtube') {
            $('#video .content').empty().append('<iframe src="//www.youtube.com/embed/'+videoID+'?rel=0&autoplay=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
        }

        // Vimeo embeds.
        if (videoType === 'vimeo') {
            $('#video .content').empty().append('<iframe src="https://player.vimeo.com/video/'+videoID+'?autoplay=1" frameborder="0" autoplay="true" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
        }

        // Return false.
        return false;
    });

    $(document).on('click', '.stop', function() {
        setTimeout(function() {
            $('#video .content').empty();
        }, 200);

        // Return false.
        return false;
    });
});
