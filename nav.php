<nav>
    <ol>
        <?php
        print '<li class="';
        if ($path_parts['filename'] == "Art") {
            print ' activePage ';
        }
        print '">';
        print '<a href="art.php">Art</a>';
        print '</li>';
          ?>
    </ol>
</nav>
