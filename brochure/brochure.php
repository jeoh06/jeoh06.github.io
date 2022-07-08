<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Paul Preparatory Seoul</title>
    <link rel="stylesheet" href="brochure.css">
</head>

<body>
    <div id="intro">
        <div>
            <span class="bigLetter delay-1">S</span>
        </div>
        <div class="oppositeEnds">
            <span class="bigLetter delay-2">P</span>
            <span class="bigLetter borderRight delay-1">P</span>
        </div>
        <div class="oppositeEnds">
            <span class="tagLine delay-3">Write your story at SPPS</span>
            <span class="bigLetter borderRightS delay-2">S</span>
        </div>
    </div>
    <?php 
    include('brochure_reusable/navbar.php');
    ?>
    <div id="aboutSPPS">
        <h1 class="missionStatement sectionTitle">Vision & Mission</h1>
        <p class="contentSpace">
            SPPS stands on a mission of independent learning. By providing a rigorous curriculum in a caring
            atmosphere touting small teacher-to- student ratio, students grow up to be independent thinkers. It
            is our foremost goal to prepare students in every aspect so that they can develop the confidence
            necessary for success in their next stage of learning.
        </p>
        <div id="statistics">
            <div class="context">
                <p>Teaching Faculty: 38</p>
                <p>Faculty with Advanced Degrees</p>
            </div>
            <div>
                <img src="images/54percent.png" alt="circular % graphic">
            </div>
            <p class="context">Student to Faculty Ratio</p>
            <div>
                <img src="images/6to1.png" alt="circular % graphic">
            </div>
        </div>
    </div>
    <div id="academics">
        <div class="banner">
            <img class="sizing" src="images/study.png" alt="student studying">
            <h1 class="bannerTitle sectionTitle">Academics</h1>
        </div>
        <h2 class="tableHeader">Course Offerings</h2>
        <div id="tableDiv">
            <?php
            include('brochure_reusable/table.php');
            ?>
        </div>
    </div>
    <div id="studentLife">
        <h1 class="sectionTitle">Student Life</h1>
        <h2 class="sectionHeader">Student Organizations</h2>
        <p class="spaceContent">
            Alongside their academic exploration, the students at SPPS participate in diverse clubs and various
            student
            organizations. Students can have the opportunity to participate in a wide variety of activities that
            will
            enhance their educational experience.
        </p>
        <p id="schoolClubs" class="spaceContent">
            Within the principles of building independence and responsibility, student clubs at SPPS are completely
            student-led, thus creating a community that thinks spontaneously, moves ambitiously, and plays
            responsibly.
            More than 50 clubs plan numerous school-wide events each school year and work closely with the faculty
            and
            staffs to host meaningful activities that are inclusive of the entire SPPS community. In learning how to
            balance academic pursuits and extracurricular interests, students develop various organizational skills
            that
            are critical to their social development. The school's intimate size facilitates student ownership and,
            therefore, deepens their commitment.
        </p>
        <div id="clubPhotos">
            <img id="img1" src="images/science.png" alt="lab experiment">
            <img id="img2" src="images/sports.png" alt="basketball team">
            <img id="img3" src="images/art.png" alt="student painting">
            <img id="img4" src="images/sports2.png" alt="soccer">
            <img id="img5" src="images/pingPong.jpeg" alt="table tennis club">
            <img id="img6" src="images/writing.png" alt="survey club">
            <img id="img7" src="images/sports3.png" alt="volleyball team">
            <img id="img8" src="images/art2.jpeg" alt="art table">
            <img id="img9" src="images/music.jpeg" alt="student playing flute">
            <img id="img10" src="images/dance.jpeg" alt="students dancing">
        </div>
        <h2 class="sectionHeader">Support for Student Life: Homeroom System</h2>
        <p class="spaceContent">
            The SPPS Homeroom system provides a strong network of support to make students feel connected and
            engaged
            while providing opportunities in leadership. Accomplishing various homeroom projects and competitions
            cooperatively throughout the year, each homeroom builds a unique identity that enhances a stronger sense
            of
            cohesion and belongingness to the community.
        </p>
    </div>
    <div id="counseling">
        <div class="banner2">
            <img class="sizing" src="images/counseling.png" alt="counseling session">
            <h1 class="bannerTitle2 sectionTitle">Counseling</h1>
        </div>
        <h2 class="sectionHeader">Regular Advisor Meetings</h2>
        <p class="spaceContent specialPadding">
            All students are assigned to a Grade Advisor. These advisors are valuable resource for both parents and
            students regarding any concerns or questions they may have. Meetings regarding a student's daily life,
            academic struggles, personal issues, or general adjustment issues take place when they are necessary.
            Parents may freely contact the Grade Advisor to discuss any questions or issues they have.
        </p>
        <p class="spaceContent specialPadding">
            In addition to daily interactions, each Grade Advisor conducts a standardized counselling curriculum
            throughout the academic year. Counseling Programs have been developed to enhance college preparation by
            each
            grade level and composed of various formats including individual session, workshop, and seminar.
        </p>
    </div>
    <div id="art">
        <h1 class="sectionTitle">Art</h1>
        <p class="artText">
            The visual arts curriculum at SPPS is designed to meet each student's desire to pursue various levels
            and forms of creativity. Students are taught perspective and the basics of composition and encouraged to
            develop their own personal styles. With guidance, beginners gain self-confidence while serious artists
            work to build portfolios.
        </p>
        <h2 class="sectionHeader">Students' works</h2>
        <div class="horizontalGallery">
            <img id="work1" src="gallery/gallery1.jpeg" alt="student artwork">
            <img id="work2" src="gallery/gallery2.jpeg" alt="student artwork">
            <img id="work3" src="gallery/gallery3.jpeg" alt="student artwork">
            <img id="work4" src="gallery/gallery4.jpeg" alt="student artwork">
            <img id="work5" src="gallery/gallery5.jpeg" alt="student artwork">
            <img id="work6" src="gallery/gallery6.jpeg" alt="student artwork">
            <div>
                <img id="work7" src="gallery/gallery7.jpeg" alt="student artwork">
                <img id="work8" src="gallery/gallery8.jpeg" alt="student artwork">
            </div>
            <img id="work9" src="gallery/gallery9.jpeg" alt="student artwork">
            <img id="work10" src="gallery/gallery10.jpeg" alt="student artwork">
            <img id="work11" src="gallery/gallery11.jpeg" alt="student artwork">
            <img id="work12" src="gallery/gallery12.jpeg" alt="student artwork">
        </div>
    </div>
</body>

</html>