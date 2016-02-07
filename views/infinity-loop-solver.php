<article class="infinity container">
    <h1>&infin; Loop Solver</h1>
    <p>
        After playing solving a couple of puzzles of <a href="https://play.google.com/store/apps/details?id=com.balysv.loop">&infin; Loop</a>,
        I started to wonder. Is it possible to automate this?
    </p>
    <p>
        So, I took a shot at programming a solver. My first try was to brute-force it. If I had done the math
        before, I could have skipped that stage. A medium puzzle is 5 by 8, so it has 40 tiles. Each tile has
        4 options. This gives us 4<sup>40</sup> possibilities. With a rate of 30.000 per second, that would take
        3.0667829e+13 years.
    </p>
    <p>
        I ended up with defining each tile and how they should behave with respect to other tiles. For example,
        a line always points towards it's neighbours open sides and away from closed ones. If you know one neighbour,
        you can determine the direction of the line.
    </p>
    <p>
        That way, the unknown tiles are greatly reduced. The biggest puzzle in the demo goes from 4<sup>54</sup> to 4<sup>11</sup>.
    </p>
    <p>
        <a href="https://github.com/tomhooijenga/Infinity-loop-solver">
            Check the source code at GitHub
        </a>
        &mdash;
        <a href="http://tomhooijenga.github.io/Infinity-loop-solver/">
            Full-page demo
        </a>
    </p>
    <iframe src="http://tomhooijenga.github.io/Infinity-loop-solver/"></iframe>
</article>