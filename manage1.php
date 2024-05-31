 <?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?> 



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Character encoding and viewport settings -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Title of the webpage -->
    <title>Manage | Auris AI</title>
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
        <h1 class="intro-content-heading">Manage Job Applications</h1>
        <video autoplay muted loop class="intro-content-video">
          <source src="./media/bgvideo.mp4" type="video/mp4" />
          <track kind="captions" />
        </video>
      </div>
    </section>

    <!-- Navigation section -->

    <?php
    include_once("menu.inc")
    ?>
    <!-- manager form section-->
    <section class="application-content">
      <div class="apply-container">
        <div class="apply-container-content">
          <form
            method="post"
            action="manage.php"
            id="form"
            novalidate="”novalidate”"
          >
            <fieldset>
              <legend>MANAGER Form</legend>

              <p>
                <!-- for list all EOIs -->
                <input
                  type="checkbox"
                  id="allEOIs"
                  name="allEOIs"
                  value="true"
                />
                <label for="allEOIs"> LIST ALL EOIs</label>
              </p>
              <p>
                <!-- for list all eois for a particular position -->
                <input
                  type="checkbox"
                  id="allEOIsp"
                  name="allEOIsp"
                  value="true"
                />
                <label for="allEOIsp">
                  LIST ALL EOIs for a particular position</label
                >
                <br />
              </p>

              <p>
                <!-- for DELETE all eois for a particular position -->
                <input
                  type="checkbox"
                  id="delallEOIsp"
                  name="delallEOIsp"
                  value="true"
                />
                <label for="delallEOIsp">
                  DELETE ALL EOIs for a particular position</label
                >
                <br />
              </p>
              <p>
                <label for="position">POSITIONS</label>
                <select name="position" id="position">
                  <option value="">Please Select</option>
                  <option value="GD-44">GRAPHICS DESIGNER</option>
                  <option value="CS-72">CUSTOMER SERVICE</option>
                  <option value="MD-01">MANAGING DIRECTOR</option>
                  <option value="SE-20">SOFTWARE ENGINEER</option>
                </select>
              </p>
              <p>
                <input
                  type="checkbox"
                  id="listallEOIsname"
                  name="listallEOIsname"
                  value="true"
                />
                <label for="listallEOIsname"
                  >LIST ALL EOIs BY FIRST NAME AND/OR LAST NAME</label
                >
                <br />
                <br />
                <label for="first_Name">FIRST NAME</label>
                <textarea
                  name="first_Name"
                  id="first_Name"
                  cols="5"
                  rows="1"
                ></textarea>
                <label for="last_Name">LAST NAME</label>
                <textarea
                  name="last_Name"
                  id="last_Name1"
                  cols="5"
                  rows="1"
                ></textarea>
              </p>
              


              <p>
                <!-- change the status of an EOI -->
                <input
                  type="checkbox"
                  id="changeEOIstatus"
                  name="changeEOIstatus"
                  value="true"
                />
                <label for="changeEOIstatus">CHANGE STATUS OF AN EOI</label>
                <br />
                <br />
                <label for="Job_Number">Job Reference number</label>
                <textarea
                  name="Job_Number"
                  id="Job_Number"
                  cols="5"
                  rows="1"
                ></textarea>

                <label for="status">STATUS</label>
                <select name="status" id="status">
                  <option value="">Please Select</option>
                  <option value="new">NEW</option>
                  <option value="current">CURRENT</option>
                  <option value="final">FINAL</option>
                </select>
              </p>
            </fieldset>

            <!-- Form buttons -->
            <div class="formButtons">
              <!-- Button to reset form -->
              <input
                class="button-black"
                type="reset"
                value="Restart Application"
              />
              <!-- Button to submit form -->
              <input
                class="button-black"
                type="submit"
                value="Submit Application"
              />
              <a href="logout.php">
              <input
                class="button-black"
                type="logout"
                value="LOGOUT"
              />
</a>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Footer section -->

    <?php
    include_once("footer.inc")
    ?>

  </body>
</html>
