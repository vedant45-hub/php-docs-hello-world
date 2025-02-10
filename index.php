<?php
// Database configuration
$host = 'localhost';
$dbname = 'course_management';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch courses
$courses = $pdo->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);

// Handle enrollment form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enroll'])) {
    $studentName = $_POST['student_name'];
    $courseId = $_POST['course_id'];

    $stmt = $pdo->prepare("INSERT INTO enrollments (student_name, course_id) VALUES (?, ?)");
    $stmt->execute([$studentName, $courseId]);

    echo "<p>Enrollment successful for $studentName!</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management Portal</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 600px; margin: auto; }
        form { margin-top: 20px; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 15px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Course Management Portal</h1>

        <h2>Enroll in a Course</h2>
        <form method="POST" action="">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required>

            <label for="course_id">Select Course:</label>
            <select id="course_id" name="course_id" required>
                <option value="">-- Select a Course --</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?php echo $course['id']; ?>">
                        <?php echo htmlspecialchars($course['course_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="enroll">Enroll</button>
        </form>

        <h2>Course Schedule</h2>
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Schedule</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($course['schedule']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

