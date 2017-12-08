<!-- ######################     Start of Nav   ############################# -->
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
        print '<a href="art.php">Featured Art</a>';
        print '</li>';
        
            print '<li class="';
        if ($path_parts['filename'] == "Events") {
            print ' activePage ';
        }
        print '">';
        print '<a href="events.php">Events</a>';
        print '</li>';
        
            print '<li class="';
        if ($path_parts['filename'] == "Contact") {
            print ' activePage ';
        }
        print '">';
        print '<a href="form.php">Contact</a>';
        print '</li>';
          ?>
    </ol>
</nav>
<!-- #########################    End of Nav   ############################# -->
