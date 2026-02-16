<!-- "hi" -->
<?php 
	require_once(__DIR__ . '/../../config.php');

    // include_once(INCLUDES_PATH . 'public\Includes\header.php');
    include_once('../includes/header.php');
    require_once(LIB_PATH . '/functions.class.php');

	$fcObj = new DataFunctions();
?>

<div class="box1">
    <div class="wrapper">

        <article class="col1">
            <div id="index_cont">
                <div id="content">

                    <div class="post">
                        <span class="alignCenter">
                            <h4>About AIML Department</h4>
                        </span>
                    </div>

                    <div id="content_desc">

                        <div class="boldDiv">AIML :</div>
                        <p>
                            The Department of Artificial Intelligence and Machine Learning (AIML) at 
                            <strong>Narsimha Reddy Engineering College</strong> is committed to advancing intelligent technologies that are shaping the future of industries worldwide. The department focuses on developing strong foundations in mathematics, programming, data science, and algorithm design to enable students to build smart, data-driven systems.
                        </p>

                        <p>
                            With the rapid evolution of Artificial Intelligence across healthcare, finance, robotics, automation, cybersecurity, and smart infrastructure, the AIML department prepares students to meet modern technological demands. The curriculum blends theoretical knowledge with practical exposure through real-world projects, internships, research initiatives, and industry collaboration.
                        </p>

                        <div class="boldDiv">Faculty :</div>
                        <p>
                            The department is supported by experienced and research-oriented faculty members specializing in Machine Learning, Deep Learning, Data Science, Natural Language Processing (NLP), Computer Vision, Artificial Neural Networks, and Intelligent Systems. Faculty members actively mentor students in research activities, technical competitions, and innovation-driven projects.
                        </p>

                        <div class="boldDiv">Undergraduate Program :</div>
                        <p>
                            The undergraduate program in Artificial Intelligence and Machine Learning is designed to equip students with essential technical expertise in programming, statistical modeling, AI algorithms, data analytics, and system design. Students gain hands-on experience through laboratories, coding challenges, hackathons, industrial visits, and collaborative projects.
                        </p>

                        <p>
                            The AIML Department at Narsimha Reddy Engineering College emphasizes innovation, research culture, entrepreneurship, and ethical AI development. With modern infrastructure, advanced computing facilities, and strong placement support, the department aims to produce industry-ready engineers capable of driving intelligent digital transformation.
                        </p>

                    </div>

                    <br class="clearfix" />

                </div>
            </div>
        </article>

        <article class="col2 pad_left2">
            <?php include_once('../includes/sidebar.php'); ?>
        </article>

    </div>
</div>

<?php include_once('../includes/footer.php'); ?>
