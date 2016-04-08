var router = new Navigo(window.location.origin),
    selected = document.querySelector('.page.open'),
    content = document.querySelector('.content'),
    animated = document.querySelector('.animated'),
    transitionDuration = 500;

router.on('/projects/', function () {
    if (selected) {
        var position = selected.getBoundingClientRect();

        animated.classList.add('show');

        window.setTimeout(function () {
            animated.style.transitionDuration = transitionDuration + 'ms';
            animated.style.transform = 'translate(' + position.left + 'px, ' + position.top + 'px) scale(0.5)';
            animated.style.width = window.getComputedStyle(selected).getPropertyValue('width');

            window.setTimeout(function () {
                animated.classList.remove('show');
            }, 510);
        }, 0);
    }

    content.classList.remove('show');
});

router.on({
    '/:project/': project,
    '*': project
});

function project(params) {
    var project = params && params.project || 'contact';

    selected = document.querySelector('#' + project + ' > .page-content');

    var position = selected.getBoundingClientRect();

    clone(selected, content);
    clone(selected, animated);

    animated.classList.add('show');

    animated.style.transitionDuration = '0ms';
    animated.style.transform = 'translate(' + position.left + 'px, ' + position.top + 'px) scale(0.5)';
    animated.style.width = window.getComputedStyle(selected).getPropertyValue('width');

    window.setTimeout(function () {
        animated.style.transitionDuration = transitionDuration + 'ms';
        animated.style.transform = 'translate(0, 0) scale(1)';
        animated.style.width = '';

        window.setTimeout(function () {
            animated.classList.remove('show');
            content.classList.add('show');
        }, 510);
    }, 0);
}

document.querySelector('.menu').addEventListener('click', function (e) {
    e.preventDefault();

    if (window.location.href === this.href) {
        window.history.back();
    } else {
        router.navigate(this.pathname.slice(1));
    }
});

var links = document.querySelectorAll('.page-link');
for (var i = 0; i < links.length; i++) {
    var link = links[i];

    link.addEventListener('click', function (e) {
        e.preventDefault();
        router.navigate(this.pathname.slice(1));
    });
}

function clone(from, to) {
    while (to.firstChild) {
        to.removeChild(to.firstChild);
    }

    var node = from.firstChild;

    while (node) {
        if (node.nodeType !== 8) {
            to.appendChild(node.cloneNode(true));
        }

        node = node.nextSibling;
    }
}