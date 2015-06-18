var content = document.querySelector('.content'),
    animated = document.querySelector('.animated'),
    selected = document.querySelector('.page.open'),
    isOpen = !!selected,
    requestAnimationFrame = Modernizr.prefixed('requestAnimationFrame', window) || function (callback) {
            callback()
        };

if (!selected) {
    selected = document.querySelector('.page');
    cleanClone(selected, animated);
    cleanClone(selected, content);
}

Evt('.menu-button').on('click', function (e) {
    e.preventDefault();
    toggle();
    navigate();
});

Evt('.menu-content').on('click', '.page', function (e) {
    e.preventDefault();

    isOpen = true;

    if (selected !== this) {
        selected = this;
        cleanClone(selected, animated);
        cleanClone(selected, content);
    }

    big();
    navigate();
});

animated.addEventListener('transitionend', transitionEnd);

window.addEventListener('popstate', function (e) {
    var page = window.location.pathname.slice(1);

    if (page === 'projects')
    {
        isOpen = false;
        small();
    }
    else
    {
        small();
        isOpen = true;
        selected = document.getElementById(page || 'contact');
        cleanClone(selected, animated);
        cleanClone(selected, content);
        big();
    }
});

function transitionEnd() {
    animated.classList.remove('show');

    var toggle = isOpen ? "add" : "remove";

    content.classList[toggle]('show');
}

function toggle() {
    if (!animated.firstElementChild) {
        cleanClone(selected, animated);
    }

    if (isOpen) {
        isOpen = false;
        small();
    }
    else {
        isOpen = true;
        big();
    }
}

function big() {
    var position = selected.getBoundingClientRect();

    animated.style.transform = 'translate(' + position.left + 'px, ' + position.top + 'px) scale(0.5)';
    animated.style.width = window.getComputedStyle(selected).width;

    animated.classList.add('show');

    requestAnimationFrame(function () {
        animated.style.transform = 'translate(0, 0) scale(1)';
        animated.style.width = '';

        if (!Modernizr.csstransitions) {
            transitionEnd();
        }
    });
}

function small() {
    var position = selected.getBoundingClientRect();

    animated.classList.add('show');
    content.classList.remove('show');

    requestAnimationFrame(function () {
        animated.style.transform = 'translate(' + position.left + 'px, ' + position.top + 'px) scale(0.5)';
        animated.style.width = window.getComputedStyle(selected).width;

        if (!Modernizr.csstransitions) {
            transitionEnd();
        }
    });
}

/**
 *
 * @param contentEl
 * @param targetEl
 */
function cleanClone(contentEl, targetEl) {
    while (targetEl.firstChild) {
        targetEl.removeChild(targetEl.firstChild);
    }

    targetEl.appendChild(contentEl.firstElementChild.cloneNode(true));
}

function navigate() {
    var link = document.querySelector('#' + selected.id + ' > a');
    window.history.pushState(null, null, (isOpen) ? link.href : '/projects');
}