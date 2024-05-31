<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Character encoding and viewport settings -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Title of the webpage -->
    <title> PHP Enhancements | Auris AI</title>
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="./styles/style.css" />
</head>

<body>
    <!-- Header section -->
    <?php
    include_once("header.inc") ?>

    <!-- Introduction section -->
    <section class="intro-content">
        <div class="intro-content-wrapper">
            <!-- Main heading and background video -->
            <h1 class="intro-content-heading">
                Use Auris for <br />
                AI-Assisted <br />
                Enterprise <br />
                Architecture
            </h1>
            <video autoplay muted loop class="intro-content-video">
                <source src="./media/bgvideo.mp4" type="video/mp4" />
                <track kind="captions" />
            </video>
            <!-- Subheading description -->
            <h2 class="content-subheading">
                Auris's Generative Augmented Retrieval (GAR) <br />
                toolkit allows LLMs to generate queries through text generation to
                <br />
                accurately generate responses and solve tasks using enterprise data
                <br />
                without external resources as supervision.
            </h2>
        </div>
    </section>

    <!-- Navigation section -->
    <?php
    include_once("menu.inc")
    ?>


    <br /><br />
    <!-- Content section -->
    <section class="content-container">
        <div class="content-wrapper">
            <!-- Main heading -->
            <h1 class="content-heading"> PHP Enhancements</h1>
            <!-- First enhancement -->
            <h2 class="enhancement">Login page</h2>
            <!-- Description of first enhancement -->
            <p class="para1">
            The enhancement I have done is achieved a login/logout page that serves as a gateway to the manage.php that allows the manager to display and modify the mysqltable.
            </p>
            <!-- Button to view the login page -->
            <a href="login.php">See the LOGIN page</a>
            <!-- <h2 class="enhancement">Sort based on field.</h2>
            <p class="para2">
            The second enhancement I have done is achieved a sort by field in displaying the table .
            </p>
            <!-- Button to view the login page -->
            <a href="manage1.php">See the manage page</a> -->
        </div>
    </section>

    <!-- Footer section -->
    <?php
    include_once("footer.inc")
    ?>
</body>

</html>