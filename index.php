<?php
// Start a session to manage user login
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to the Course Management Portal</h1>
        <?php
        if(isset($_SESSION['username'])) {
            echo "<p>Logged in as " . $_SESSION['username'] . "</p>";
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo '<a href="login.php">Login</a> | <a href="register.php">Register</a>';
        }
        ?>
    </header>

    <nav>
        <ul>
            <li><a href="courses.php">View Courses</a></li>
            <li><a href="attendance.php">Attendance</a></li>
            <li><a href="schedule.php">Class Schedules</a></li>
            <li><a href="enroll.php">Enroll in a Course</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>Current Courses</h2>
            <p>Below are the available courses that you can enroll in:</p>
            <!-- List of courses will be fetched from the database -->
            <?php
            // Example to fetch and display courses (you need to set up a database connection)
            $db = new mysqli('localhost', 'root', '', 'course_management');
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

            $query = "SELECT * FROM courses";
            $result = $db->query($query);

            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . $row['course_name'] . " - " . $row['course_code'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No courses available at the moment.</p>";
            }
            ?>
        </section>

        <section>
            <h2>Your Enrollment Status</h2>
            <p>Check your current course enrollments, attendance, and schedules:</p>
            <!-- Display student's enrollment status -->
            <?php
            if (isset($_SESSION['username'])) {
                // Fetch student's enrolled courses and attendance
                $username = $_SESSION['username'];
                $query = "SELECT courses.course_name, attendance.status FROM enrollments 
                          JOIN courses ON enrollments.course_id = courses.id
                          JOIN attendance ON attendance.course_id = courses.id 
                          WHERE enrollments.student_username = '$username'";
                
                $result = $db->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<p>" . $row['course_name'] . " - Attendance: " . $row['status'] . "</p>";
                    }
                } else {
                    echo "<p>You are not enrolled in any courses yet.</p>";
                }
            } else {
                echo "<p>Please log in to view your enrollment status.</p>";
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Course Management Portal. All rights reserved.</p>
    </footer>
</body>
</html>



