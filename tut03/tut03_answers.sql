
-- 1
  SELECT first_name, last_name FROM students;
-- 2
  SELECT course_name, credit_hours FROM courses;
-- 3
  SELECT first_name, last_name, email FROM instructors;
-- 4
  SELECT c.course_name, e.grade 
  FROM enrollments e
  JOIN courses c ON e.course_id = c.course_id;
-- 5
  SELECT first_name, last_name, city FROM students;
-- 6
  SELECT c.course_name, CONCAT(i.first_name, ' ', i.last_name) AS instructor_name
  FROM courses c
  JOIN instructors i ON c.instructor_id = i.instructor_id;
-- 7
  SELECT first_name, last_name, age FROM students;
-- 8
  SELECT c.course_name, e.enrollment_date 
  FROM enrollments e
  JOIN courses c ON e.course_id = c.course_id;
-- 9
  SELECT first_name, last_name, email FROM instructors;
-- 10
  SELECT course_name, credit_hours FROM courses;
-- 11
  SELECT i.first_name, i.last_name, i.email 
  FROM instructors i
  JOIN courses c ON i.instructor_id = c.instructor_id
  WHERE c.course_name = 'Mathematics';
-- 12
  SELECT c.course_name, e.grade 
  FROM enrollments e
  JOIN courses c ON e.course_id = c.course_id
  WHERE e.grade = 'A';
-- 13
 SELECT s.first_name, s.last_name, s.state 
 FROM students s
 JOIN enrollments e ON s.student_id = e.student_id
 JOIN courses c ON e.course_id = c.course_id
 WHERE c.course_name = 'Computer Science';
-- 14
 SELECT c.course_name, e.enrollment_date 
 FROM enrollments e
 JOIN courses c ON e.course_id = c.course_id
 WHERE e.grade = 'B+';
-- 15
 SELECT i.first_name, i.last_name, i.email 
 FROM instructors i
 JOIN courses c ON i.instructor_id = c.instructor_id
 WHERE c.credit_hours > 3;





-- General Instructions
-- 1.	The .sql files are run automatically, so please ensure that there are no syntax errors in the file. If we are unable to run your file, you get an automatic reduction to 0 marks.
-- Comment in MYSQL 
