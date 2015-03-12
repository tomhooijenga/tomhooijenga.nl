(function ()
{

    window.requestAnimationFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.msRequestAnimationFrame || debounce(function (callback)
    {
        callback();
    }, 33);

    var canvas = document.getElementById('background'),
        ctx = canvas.getContext('2d'),
        segments = [],
        mouse = {x: 1, y: 1};

    var menu = document.querySelector('.nav-main'),
        content = document.querySelector('.container-small');

    var shapes = [
        // Polygon #1
        [{x0: 0, y0: 100, x1: 20, y1: 0},
            {x0: 20, y0: 0, x1: 100, y1: 30},
            {x0: 100, y0: 30, x1: 40, y1: 160},
            {x0: 40, y0: 160, x1: 0, y1: 100}],
        // Polygon #2
        [{x0: 0, y0: 0, x1: 20, y1: 50},
            {x0: 20, y0: 50, x1: -40, y1: 100},
            {x0: -40, y0: 100, x1: 0, y1: 0}],
        // Polygon #3
        /*[{x0: 0, y0: 110, x1: 20, y1: 0},
         {x0: 20, y0: 0, x1: 100, y1: 50},
         {x0: 100, y0: 50, x1: 150, y1: 170},
         {x0: 150, y0: 170, x1: 0, y1: 110}],
         // Polygon #4
         [{x0: 0, y0: 20, x1: 20, y1: 0},
         {x0: 20, y0: 0, x1: 30, y1: 30},
         {x0: 30, y0: 30, x1: 0, y1: 20}],
         // Polygon #5
         [{x0: 0, y0: 20, x1: 110, y1: 0},
         {x0: 110, y0: 0, x1: 90, y1: 100},
         {x0: 90, y0: 100, x1: -30, y1: 120},
         {x0: -30, y0: 120, x1: 0, y1: 20}],*/
        // Polygon #6
        [{x0: 0, y0: 45, x1: 180, y1: 0},
            {x0: 180, y0: 0, x1: 80, y1: 100},
            {x0: 80, y0: 100, x1: 0, y1: 45}]
    ];

    function debounce(fn, delay)
    {
        var last = Date.now();

        return function ()
        {
            var now = Date.now();

            if (now - last >= delay)
            {
                fn.apply(this, arguments);
                last = now;
            }
        };
    }

    function getSegments()
    {
        var segs = getSquareSegments(canvas),
            x, y;

        segs = segs.concat(getSquareSegments(menu));
        segs = segs.concat(getSquareSegments(content));

        shapes.forEach(function (shape)
        {
            x = 100;
            y = rand(50, canvas.height - 50);

            shape.forEach(function (line)
            {
                line.x0 += x;
                line.x1 += x;
                line.y0 += y;
                line.y1 += y;
            });

            segs = segs.concat(shape);
        });

        return segs;
    }

    function getSquareSegments(el)
    {
        return [{
            x0: el.offsetLeft,
            x1: el.offsetLeft + el.clientWidth,
            y0: el.offsetTop,
            y1: el.offsetTop
        }, {
            x0: el.offsetLeft + el.clientWidth,
            x1: el.offsetLeft + el.clientWidth,
            y0: el.offsetTop,
            y1: el.offsetTop + el.clientHeight
        }, {
            x0: el.offsetLeft + el.clientWidth,
            x1: el.offsetLeft,
            y0: el.offsetTop + el.clientHeight,
            y1: el.offsetTop + el.clientHeight
        }, {
            x0: el.offsetLeft,
            x1: el.offsetLeft,
            y0: el.offsetTop + el.clientHeight,
            y1: el.offsetTop
        }];
    }

    function getIntersection(ray, segment)
    {
        // RAY in parametric: Point + Delta*T1
        var r_px = ray.x0;
        var r_py = ray.y0;
        var r_dx = ray.x1 - ray.x0;
        var r_dy = ray.y1 - ray.y0;

        // SEGMENT in parametric: Point + Delta*T2
        var s_px = segment.x0;
        var s_py = segment.y0;
        var s_dx = segment.x1 - segment.x0;
        var s_dy = segment.y1 - segment.y0;

        // Are they parallel? If so, no intersect
        var r_mag = Math.sqrt(r_dx * r_dx + r_dy * r_dy);
        var s_mag = Math.sqrt(s_dx * s_dx + s_dy * s_dy);
        if (r_dx / r_mag == s_dx / s_mag && r_dy / r_mag == s_dy / s_mag)
        {
            // Unit vectors are the same.
            return null;
        }

        // SOLVE FOR T1 & T2
        // r_px+r_dx*T1 = s_px+s_dx*T2 && r_py+r_dy*T1 = s_py+s_dy*T2
        // ==> T1 = (s_px+s_dx*T2-r_px)/r_dx = (s_py+s_dy*T2-r_py)/r_dy
        // ==> s_px*r_dy + s_dx*T2*r_dy - r_px*r_dy = s_py*r_dx + s_dy*T2*r_dx - r_py*r_dx
        // ==> T2 = (r_dx*(s_py-r_py) + r_dy*(r_px-s_px))/(s_dx*r_dy - s_dy*r_dx)
        var T2 = (r_dx * (s_py - r_py) + r_dy * (r_px - s_px)) / (s_dx * r_dy - s_dy * r_dx);
        var T1 = (s_px + s_dx * T2 - r_px) / r_dx;

        // Must be within parametic whatevers for RAY/SEGMENT
        if (T1 < 0)
        {
            return null;
        }
        if (T2 < 0 || T2 > 1)
        {
            return null;
        }

        // Return the POINT OF INTERSECTION
        return {
            x: r_px + r_dx * T1,
            y: r_py + r_dy * T1,
            param: T1
        };
    }

    function getSightPolygon(sightX, sightY)
    {
        // Get all unique points
        var points = (function (segments)
        {
            var a = [];
            segments.forEach(function (seg)
            {
                a.push({
                    x: seg.x0,
                    y: seg.y0
                }, {
                    x: seg.x1,
                    y: seg.y1
                });
            });
            return a;
        })(segments);

        var uniquePoints = (function (points)
        {
            var set = {};
            return points.filter(function (p)
            {
                var key = p.x + "," + p.y;
                if (key in set)
                {
                    return false;
                }
                else
                {
                    set[key] = true;
                    return true;
                }
            });
        })(points);

        // Get all angles
        var uniqueAngles = [];
        for (var j = 0; j < uniquePoints.length; j++)
        {
            var uniquePoint = uniquePoints[j];
            var angle = Math.atan2(uniquePoint.y - sightY, uniquePoint.x - sightX);
            uniquePoint.angle = angle;
            uniqueAngles.push(angle - 0.00001, angle, angle + 0.00001);
        }

        // RAYS IN ALL DIRECTIONS
        var intersects = [];
        for (var j = 0; j < uniqueAngles.length; j++)
        {
            var angle = uniqueAngles[j];

            // Calculate dx & dy from angle
            var dx = Math.cos(angle);
            var dy = Math.sin(angle);

            // Ray from center of screen to mouse
            var ray = {
                x0: sightX,
                y0: sightY,
                x1: sightX + dx,
                y1: sightY + dy
            };

            // Find CLOSEST intersection
            var closestIntersect = null;
            for (var i = 0; i < segments.length; i++)
            {
                var intersect = getIntersection(ray, segments[i]);
                if (!intersect)
                {
                    continue;
                }
                if (!closestIntersect || intersect.param < closestIntersect.param)
                {
                    closestIntersect = intersect;
                }
            }

            // Intersect angle
            if (!closestIntersect)
            {
                continue;
            }
            closestIntersect.angle = angle;

            // Add to list of intersects
            intersects.push(closestIntersect);
        }

        // Sort intersects by angle
        intersects = intersects.sort(function (a, b)
        {
            return a.angle - b.angle;
        });

        // Polygon is intersects, in order of angle
        return intersects;

    }

    function setup()
    {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        segments = getSegments();
        draw();
    }

    function draw()
    {
        // Clear canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        var fuzzyRadius = 10;
        var polygons = [getSightPolygon(mouse.x, mouse.y)];

        for (var angle = 0; angle < Math.PI * 2; angle += (Math.PI * 2) / 10)
        {
            var dx = Math.cos(angle) * fuzzyRadius;
            var dy = Math.sin(angle) * fuzzyRadius;

            polygons.push(getSightPolygon(mouse.x + dx, mouse.y + dy));
        }

        for (var i = 1; i < polygons.length; i++)
        {
            drawPolygon(polygons[i], "rgba(255,255,255,0.2)");
        }

        drawPolygon(polygons[0], "#fff");

        ctx.save();
        ctx.fillStyle = '#f5f5f5';
        ctx.strokeStyle = '#ddd'
        shapes.forEach(function (shape)
        {
            ctx.beginPath();
            ctx.moveTo(shape[0].x0, shape[0].y0);

            shape.forEach(function (line)
            {
                ctx.lineTo(line.x0, line.y0);
            });
            ctx.closePath();
            ctx.stroke();
            ctx.fill();
        });
        ctx.restore();
    }

    function drawPolygon(polygon, fillStyle)
    {
        ctx.fillStyle = fillStyle;
        ctx.beginPath();
        ctx.moveTo(polygon[0].x, polygon[0].y);
        for (var i = 1; i < polygon.length; i++)
        {
            var intersect = polygon[i];

            ctx.lineTo(intersect.x, intersect.y);
        }
        ctx.fill();
    }

    function rand(min, max)
    {
        if (max === undefined)
        {
            max = min;
            min = 0;
        }

        return Math.floor(Math.random() * (max - min) + min);
    }

    window.addEventListener('resize', function (e)
    {
        setup();
    });

    window.addEventListener('mousemove', function (e)
    {
        mouse.x = e.clientX;
        mouse.y = e.clientY;

        requestAnimationFrame(draw);
    });

    setup();

})();