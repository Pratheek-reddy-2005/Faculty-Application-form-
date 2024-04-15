
-- 1)
CREATE PROCEDURE CalculateAverageSalary (IN dept_id INT)
BEGIN
    SELECT AVG(salary) AS average_salary
    FROM employees
    WHERE department_id = dept_id;
END;

-- 2)
CREATE PROCEDURE UpdateEmployeeSalary (IN emp_id INT, IN percentage DECIMAL)
BEGIN
    UPDATE employees
    SET salary = salary * (1 + percentage/100)
    WHERE emp_id = emp_id;
END;

-- 3)
CREATE PROCEDURE ListEmployeesInDepartment (IN dept_id INT)
BEGIN
    SELECT *
    FROM employees
    WHERE department_id = dept_id;
END;

-- 4)
CREATE PROCEDURE CalculateProjectBudget (IN proj_id INT)
BEGIN
    SELECT budget
    FROM projects
    WHERE project_id = proj_id;
END;

-- 5)
CREATE PROCEDURE FindHighestSalaryEmployee (IN dept_id INT)
BEGIN
    SELECT *
    FROM employees
    WHERE department_id = dept_id
    ORDER BY salary DESC
    LIMIT 1;
END;

-- 6)
CREATE PROCEDURE ListProjectsDueToEnd (IN num_days INT)
BEGIN
    SELECT *
    FROM projects
    WHERE DATEDIFF(end_date, CURDATE()) <= num_days;
END;

-- 7)
CREATE PROCEDURE CalculateDepartmentSalaryExpenditure (IN dept_id INT)
BEGIN
    SELECT SUM(salary) AS total_salary_expenditure
    FROM employees
    WHERE department_id = dept_id;
END;

-- 8)
CREATE PROCEDURE GenerateEmployeeReport ()
BEGIN
    SELECT e.*, d.department_name, d.location
    FROM employees e
    JOIN departments d ON e.department_id = d.department_id;
END;

-- 9)
CREATE PROCEDURE FindProjectWithHighestBudget ()
BEGIN
    SELECT *
    FROM projects
    ORDER BY budget DESC
    LIMIT 1;
END;

-- 10)
CREATE PROCEDURE CalculateOverallAverageSalary ()
BEGIN
    SELECT AVG(salary) AS average_salary
    FROM employees;
END;

-- 11)
CREATE PROCEDURE AssignNewManager (IN dept_id INT, IN new_manager_id INT)
BEGIN
    UPDATE departments
    SET manager_id = new_manager_id
    WHERE department_id = dept_id;
END;

-- 12)
CREATE PROCEDURE CalculateRemainingBudget (IN proj_id INT,IN expense INT)
BEGIN
    SELECT budget - expense AS remaining_budget
    FROM projects
    WHERE project_id = proj_id;
END;

-- 13)
-- incomplete data

-- 14)
CREATE PROCEDURE UpdateProjectEndDate (IN proj_id INT, IN duration INT)
BEGIN
    UPDATE projects
    SET end_date = DATE_ADD(start_date, INTERVAL duration DAY)
    WHERE project_id = proj_id;
END;

-- 15)
CREATE PROCEDURE CalculateDepartmentEmployeeCount ()
BEGIN
    SELECT department_id, COUNT(emp_id) AS employee_count
    FROM employees
    GROUP BY department_id;
END;
-- General Instructions
-- 1.	The .sql files are run automatically, so please ensure that there are no syntax errors in the file. If we are unable to run your file, you get an automatic reduction to 0 marks.
-- Comment in MYSQL 
