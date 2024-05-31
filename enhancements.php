<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Character encoding and viewport settings -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Title of the webpage -->
    <title>Enhancements | Auris AI</title>
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
            <h1 class="content-heading">Enhancements</h1>
            <!-- First enhancement -->
            <h2 class="enhancement">• Image Gallery CSS</h2>
            <!-- Description of first enhancement -->
            <p class="para1">
                Our first enhancement focuses on the homepage of the website, offering
                an interactive gallery through the implementation of scrollable
                buttons. Unlike static galleries, this enhancement adds dynamism and
                engagement, enriching the user experience. It was accomplished using
                &lt;img&gt; tags and referencing the different images based on IDs
                using the "#" character. The navigation buttons used to scroll between
                the images also animate and change their opacity based on which one is
                selected.
            </p>
            <!-- Button to view the image gallery -->
            <a href="./index.html#feature-image-gallery" class="button-black special-button-black">See the Image Gallery on the Homepage</a>

            <!-- Second enhancement -->
            <h2 class="enchancement2">• Implement Responsive Design</h2>
            <!-- Description of second enhancement -->
            <p class="para2">
                To implement responsive design on the required web pages, we utilized
                variable CSS values to adjust layout and styling based on screen size,
                ensuring optimal display on various devices; enhancing user experience
                across platforms. Third-party sources like the
                <a href="https://developer.mozilla.org/en-US/docs/Learn/CSS/CSS_layout/Responsive_Design">MDN Documentation for Responsive Design</a>
                were consulted for best practices. You can view this enhancement in
                action by resizing the browser window or accessing the site from a
                mobile device.
            </p>
        </div>
    </section>

    <!-- Footer section -->
    <?php
    include_once("footer.inc")
    ?>
</body>

</html>