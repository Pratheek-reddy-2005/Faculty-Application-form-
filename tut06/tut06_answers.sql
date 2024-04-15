-- General Instructions
-- 1.	The .sql files are run automatically, so please ensure that there are no syntax errors in the file. If we are unable to run your file, you get an automatic reduction to 0 marks.
-- Comment in M-- 1
SELECT s.first_name, s.last_name, c.course_name
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
JOIN courses c ON e.course_id = c.course_id;
-- 2
SELECT c.course_name, e.grade
FROM courses c
JOIN enrollments e ON c.course_id = e.course_id;
-- 3
SELECT s.first_name, s.last_name, c.course_name, i.first_name AS instructor_first_name, i.last_name AS instructor_last_name
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
JOIN courses c ON e.course_id = c.course_id
JOIN instructors i ON c.instructor_id = i.instructor_id;
-- 4 
SELECT s.first_name, s.last_name, s.age, s.city
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
JOIN courses c ON e.course_id = c.course_id
WHERE c.course_name = 'Mathematics';
-- 5
SELECT c.course_name, CONCAT(i.first_name, ' ', i.last_name) AS instructor_name
FROM courses c
JOIN instructors i ON c.instructor_id = i.instructor_id;
-- 6
SELECT s.first_name, s.last_name, e.grade, c.course_name
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
JOIN courses c ON e.course_id = c.course_id;
-- 7
SELECT s.first_name, s.last_name, s.age
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
GROUP BY s.student_id
HAVING COUNT(e.course_id) > 1;
-- 8
SELECT c.course_name, COUNT(e.student_id) AS num_students_enrolled
FROM courses c
LEFT JOIN enrollments e ON c.course_id = e.course_id
GROUP BY c.course_id, c.course_name;
-- 9
SELECT first_name, last_name, age
FROM students
WHERE student_id NOT IN (SELECT student_id FROM enrollments);
-- 10
SELECT c.course_name, AVG(grade) AS average_grade
FROM courses c
JOIN enrollments e ON c.course_id = e.course_id
GROUP BY c.course_id, c.course_name;
-- 11
SELECT s.first_name, s.last_name, c.course_name
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
JOIN courses c ON e.course_id = c.course_id
WHERE e.grade > 'B';
-- 12
SELECT c.course_name, CONCAT(i.first_name, ' ', i.last_name) AS instructor_name
FROM courses c
JOIN instructors i ON c.instructor_id = i.instructor_id
WHERE i.last_name LIKE 'S%';
-- 13
SELECT s.first_name, s.last_name, s.age
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
JOIN courses c ON e.course_id = c.course_id
JOIN instructors i ON c.instructor_id = i.instructor_id
WHERE CONCAT(i.first_name, ' ', i.last_name) = 'Dr. Akhil';
-- 14
SELECT c.course_name, MAX(e.grade) AS max_grade
FROM courses c
JOIN enrollments e ON c.course_id = e.course_id
GROUP BY c.course_id, c.course_name;
-- 15
SELECT s.first_name, s.last_name, s.age, c.course_name
FROM students s
JOIN enrollments e ON s.student_id = e.student_id
JOIN courses c ON e.course_id = c.course_id
ORDER BY c.course_name ASC;

YSQL 
