var showIcon = new ui.Tween({
    values: {
        opacity: 1,
        length: {
            to: 65,
            ease: 'easeIn'
        }
    }
});

var spinIcon = new ui.Simulate({
    values: {
        rotate: -400
    }
});

var progressCompleteOutline = new ui.Tween({
    values: {
        rotate: '-=200',
        length: 100
    }
});

var progressCompleteTick = new ui.Tween({
    delay: 50,
    values: {
        length: 100,
        opacity: 1
    }
});

function showTick() {
    var progressIcon = document.querySelector('.progress-icon');
    
    var progressOutline = new ui.Actor({
        element: progressIcon.getElementById('tick-outline-path')
    });
    var progressTick = new ui.Actor({
        element: progressIcon.getElementById('tick-path')
    });

    progressOutline.start(showIcon)
        .then(spinIcon);

    setTimeout(function() {
        progressOutline.start(progressCompleteOutline);
        progressTick.start(progressCompleteTick);
    }, 500)
    
}

if (document.readyState != 'loading') {
    showTick();
    //setTimeout(function(){window.location.href="index.php";}, 5000);
} else {
    document.addEventListener('DOMContentLoaded', showTick);
}