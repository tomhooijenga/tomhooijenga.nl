<article class="container">
    <h1>Hack This Site</h1>
    <p>
        No, not my site. I'm talking about <a href="https://hackthissite.org/">this one</a>. I did some of the
        challenges and one cought my attention: Programming Challenge #9.
    </p>
    <h2>Programming Challenge 9</h2>
    <p>
        The challenge consists of multiple steps.
    </p>
    <ol>
        <li>Take a 9x9 sudoku in comma-delimited form</li>
        <li>Parse the string and solve the sudoku</li>
        <li>
            Return the solved sudoku to the comma-delimited form and
            hash the string with SHA1
        </li>
        <li>Decrypt the ciphertext with the password we just got</li>
    </ol>
    <p>
        The sudoku part was solved by <a href="http://nhum.com">Nick Hummel</a>.
    </p>
    <p>
        Now, about the decryption part. The description states that the answer
        is encrypted with CBC-mode, 64bit-block-size Blowfish. The ciphertext is then encoded with base64.
        The description also contains a link to the encryption algorithm, written in PHP.
    </p>
    <p>
        The encryption used is, in fact, a sligtly modified version of Blowfish. PHP on Windows doesn't have 64 bit
        integers. That's why I wrote the decryption in C#.
    </p>
    <p>
        <a href="https://gist.github.com/tomhooijenga/c4030ca6d7efb406105a">
            Check the source code at GitHub
        </a>
    </p>
</article>

