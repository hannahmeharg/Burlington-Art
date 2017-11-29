<nav>
    <ol>
        <?php
        print '<li class="';
        if ($path_parts['filename'] == "Home") {
            print ' activePage ';
        }
        print '">';
        print '<a href="home.php">Home</a>';
        print '</li>';
        
          print '<li class="';
        if ($path_parts['filename'] == "About us") {
            print ' activePage ';
        }
        print '">';
        print '<a href="aboutus.php">About us</a>';
        print '</li>';
        
          print '<li class="';
        if ($path_parts['filename'] == "Contact") {
            print ' activePage ';
        }
        print '">';
        print '<a href="contact.php">Contact</a>';
        print '</li>';
        
          print '<li class="';
        if ($path_parts['filename'] == "Local Artists") {
            print ' activePage ';
        }
        print '">';
        print '<a href="artists.php">Local Artists</a>';
        print '</li>';
        
          print '<li class="';
        if ($path_parts['filename'] == "Local Galleries") {
            print ' activePage ';
        }
        print '">';
        print '<a href="galleries.php">Local Galleries</a>';
        print '</li>';
        
          print '<li class="';
        if ($path_parts['filename'] == "Featured Art") {
            print ' activePage ';
        }
        print '">';
        print '<a href="featured.php">Featured Art</a>';
        print '</li>';
          ?>
    </ol>
</nav>
