<?php
$host = 'localhost';
$dbname = 'course_management';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'addCourse') {
        $courseName = $_POST['courseName'];
        $stmt = $pdo->prepare("INSERT INTO courses (name) VALUES (:name)");
        $stmt->execute(['name' => $courseName]);
        echo json_encode(["status" => "success"]);
        exit;
    } elseif ($action === 'deleteCourse') {
        $courseId = $_POST['courseId'];
        $stmt = $pdo->prepare("DELETE FROM courses WHERE id = :id");
        $stmt->execute(['id' => $courseId]);
        echo json_encode(["status" => "success"]);
        exit;
    }
}

$courses = $pdo->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);
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
  <div class="container">
    <h1 class="title">Course Management Portal</h1>

    <!-- Add Course Section -->
    <div class="card">
      <h2>Add Course</h2>
      <div class="input-group">
        <input type="text" id="course-name" placeholder="Enter course name">
        <button id="add-course-btn">Add Course</button>
      </div>
    </div>

    <!-- Course List Section -->
    <div class="course-list">
      <h2>Courses</h2>
      <table id="course-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($courses as $course): ?>
            <tr>
              <td><?= htmlspecialchars($course['id']) ?></td>
              <td><?= htmlspecialchars($course['name']) ?></td>
              <td><button class="delete-btn" data-id="<?= $course['id'] ?>">Delete</button></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    document.getElementById('add-course-btn').addEventListener('click', async () => {
      const courseName = document.getElementById('course-name').value.trim();
      if (courseName) {
        const response = await fetch('', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({ action: 'addCourse', courseName })
        });
        const result = await response.json();
        if (result.status === 'success') {
          location.reload();
        }
      }
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
      button.addEventListener('click', async () => {
        const courseId = button.getAttribute('data-id');
        const response = await fetch('', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({ action: 'deleteCourse', courseId })
        });
        const result = await response.json();
        if (result.status === 'success') {
          location.reload();
        }
      });
    });
  </script>
</body>
</html>

/* styles.css */

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f8f9fa;
  padding: 20px;
}

.container {
  max-width: 800px;
  margin: 0 auto;
}

.title {
  font-size: 2rem;
  text-align: center;
  margin-bottom: 20px;
}

.card {
  background: #ffffff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

.input-group {
  display: flex;
  gap: 10px;
}

input[type="text"] {
  flex: 1;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

th, td {
  padding: 12px;
  text-align: left;
  border: 1px solid #ddd;
}

th {
  background-color: #f1f1f1;
}
