
    <div class="contents" id="freelancer-contents">
    <?php

     // Check if jobs array exists and has items
     if (isset($freelancers) && is_array($freelancers) && count($freelancers) > 0) {
        foreach ($freelancers as $freelancer) {
            // Ensure these variables are set - either from the $job array or with default values
            $FullName = $job['firstname'] . ' ' . $job['lastname'];
            $picture = $job['picture'] ?? '../image/prof.jpg';
            $Project_Category = $job['Project_Category'] ?? 'Job Category';
          
            echo '<section class="freelancers">';
            echo '<div class="freelancer-list">';
            echo  '<div class="cards">';
            echo  '<img src="' . htmlspecialchars($picture) . '" alt="company logo">';
            echo '<strong>' . htmlspecialchars($FullName) . '</strong>';
            echo '<p>' . htmlspecialchars($Project_Category) . '</p>';
            echo '<a href="clientview-freelancerprofile.php">See more</a>';
            echo '</div>';
            echo '</section>';
        }}
            ?>
    </div>
