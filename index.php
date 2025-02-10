<?php
// No database integration, purely static website example
?>

<!DOCTYPE html>
<html lang="en">
<head>
    $host = '127.0.0.1';
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
        <form method="POST" action="#">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" required>

            <label for="course_id">Select Course:</label>
            <select id="course_id" name="course_id" required>
                <option value="">-- Select a Course --</option>
                <option value="1">Mathematics 101</option>
                <option value="2">Introduction to Programming</option>
                <option value="3">Physics Basics</option>
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
                <tr>
                    <td>Mathematics 101</td>
                    <td>Monday & Wednesday, 9:00 AM - 10:30 AM</td>
                </tr>
                <tr>
                    <td>Introduction to Programming</td>
                    <td>Tuesday & Thursday, 11:00 AM - 12:30 PM</td>
                </tr>
                <tr>
                    <td>Physics Basics</td>
                    <td>Friday, 2:00 PM - 4:00 PM</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>


