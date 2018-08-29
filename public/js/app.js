$(document).ready(function () {

    toggleAnimation();

    setInterval(toggleAnimation, 8500);

    function toggleAnimation() {

        const banner_01 = $('#banner_01');
        const banner_02 = $('#banner_02');
        const banner_03 = $('#banner_03');

        if (banner_01.css('animation-name') === 'cycle_in')
        {
            setTimeout(function () {
                $('#banner_01 .banner-text').css('display', 'none');
                banner_01.css('animation', 'cycle_out 2s linear 0s 1 alternate forwards');
            }, 6000);
        } else {
            setTimeout(function () {
                setTimeout(function () {
                    $('#banner_01 .banner-text').css('display', 'inline');
                }, 2000);
                banner_01.css('animation', 'cycle_in 2s linear 0s 1 alternate forwards');
            }, 2000);
        }

        if (banner_02.css('animation-name') === 'cycle_in')
        {
            setTimeout(function () {
                $('#banner_02 .banner-text').css('display', 'none');
                banner_02.css('animation', 'cycle_out 2s linear 0s 1 alternate forwards');
            }, 4000);
        } else {
            setTimeout(function () {
                setTimeout(function () {
                    $('#banner_02 .banner-text').css('display', 'inline');
                }, 2000);
                banner_02.css('animation', 'cycle_in 2s linear 0s 1 alternate forwards');
            }, 4000);
        }

        if (banner_03.css('animation-name') === 'cycle_in')
        {
            setTimeout(function () {
                $('#banner_03 .banner-text').css('display', 'none');
                banner_03.css('animation', 'cycle_out 2s linear 0s 1 alternate forwards');
            }, 2000);
        } else {
            setTimeout(function () {
                setTimeout(function () {
                    $('#banner_03 .banner-text').css('display', 'inline');
                }, 2000);
                banner_03.css('animation', 'cycle_in 2s linear 0s 1 alternate forwards');
            }, 6000);
        }

    }

    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });

});

