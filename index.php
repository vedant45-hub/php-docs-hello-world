<?php
// Initialize the course data (static for this example)
$courses = [
    ['id' => 1, 'name' => 'Introduction to Programming'],
    ['id' => 2, 'name' => 'Web Development'],
    ['id' => 3, 'name' => 'Data Structures'],
];

$enrollments = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle course enrollment
    if (isset($_POST['enroll'])) {
        $studentName = $_POST['student_name'];
        $courseId = $_POST['course_id'];

        $enrollments[] = [
            'student_name' => $studentName,
            'course_id' => $courseId
        ];
    }

    // Handle attendance marking
    if (isset($_POST['attendance'])) {
        $attendance = $_POST['attendance'];
        // For simplicity, just show the attendance data
        echo "<div class='alert'>Attendance Marked: " . htmlspecialchars($attendance) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Enrollment and Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f7fc;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
        }
        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Course Enrollment and Attendance Portal</h1>
</header>

<div class="container">
    <!-- Enrollment Form -->
    <div class="form-container">
        <h2>Enroll in a Course</h2>
        <form method="POST">
            <input type="text" name="student_name" placeholder="Enter student name" required>
            <select name="course_id" required>
                <option value="">Select Course</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?= $course['id']; ?>"><?= $course['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="enroll">Enroll</button>
        </form>
    </div>

    <!-- Enrolled Students List -->
    <div class="form-container">
        <h2>Enrolled Students</h2>
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($enrollments as $enrollment): ?>
                    <tr>
                        <td><?= htmlspecialchars($enrollment['student_name']); ?></td>
                        <td>
                            <?php
                            $course = array_filter($courses, fn($course) => $course['id'] == $enrollment['course_id']);
                            $courseName = current($course)['name'];
                            echo htmlspecialchars($courseName);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Attendance Form -->
    <div class="form-container">
        <h2>Mark Attendance</h2>
        <form method="POST">
            <select name="attendance" required>
                <option value="">Select Student</option>
                <?php foreach ($enrollments as $enrollment): ?>
                    <option value="<?= htmlspecialchars($enrollment['student_name']); ?>">
                        <?= htmlspecialchars($enrollment['student_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="attendance">Mark Attendance</button>
        </form>
    </div>
</div>

</body>
</html>




