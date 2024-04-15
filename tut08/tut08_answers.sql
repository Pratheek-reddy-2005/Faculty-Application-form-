-- General Instructions
-- 1.	The .sql files are run automatically, so pl-- 1
CREATE TRIGGER increase_salary_trigger
BEFORE INSERT ON employees
FOR EACH ROW
BEGIN
    IF NEW.salary < 60000 THEN
        SET NEW.salary = NEW.salary * 1.1;
    END IF;
END;


-- 2
CREATE TRIGGER prevent_delete_departments_trigger
BEFORE DELETE ON departments
FOR EACH ROW
BEGIN
    DECLARE employee_count INT;
    SELECT COUNT(*)
    INTO employee_count
    FROM employees
    WHERE department_id = OLD.department_id;
    
    IF employee_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot delete department with assigned employees';
    END IF;
END;


-- 3
CREATE TRIGGER log_salary_updates_trigger
AFTER UPDATE ON employees
FOR EACH ROW
BEGIN
    IF OLD.salary != NEW.salary THEN
        INSERT INTO salary_audit (emp_id, old_salary, new_salary, employee_name, updated_date)
        VALUES (OLD.emp_id, OLD.salary, NEW.salary, CONCAT(NEW.first_name, ' ', NEW.last_name), NOW());
    END IF;
END;


-- 4
CREATE TRIGGER assign_department_trigger
BEFORE INSERT ON employees
FOR EACH ROW
BEGIN
    DECLARE department_id_to_assign INT;

    IF NEW.salary <= 60000 THEN
        SET department_id_to_assign = 3; -- Department ID for the specified salary range
    -- Add additional conditions for other salary ranges here if needed
    ELSE
        -- Default department assignment if salary range doesn't match any specified conditions
        SET department_id_to_assign = 1; -- Default department ID
    END IF;

    SET NEW.department_id = department_id_to_assign;
END;


-- 5
CREATE TRIGGER update_manager_salary_trigger
AFTER INSERT ON employees
FOR EACH ROW
BEGIN
    DECLARE highest_salary DECIMAL;
    DECLARE manager_id_to_update INT;
    
    -- Get the highest salary in the department of the newly inserted employee
    SELECT MAX(salary) INTO highest_salary
    FROM employees
    WHERE department_id = NEW.department_id;

    -- Get the manager ID of the department
    SELECT manager_id INTO manager_id_to_update
    FROM departments
    WHERE department_id = NEW.department_id;

    -- Update the manager's salary
    UPDATE employees
    SET salary = highest_salary
    WHERE emp_id = manager_id_to_update;
END;


-- 6
CREATE TRIGGER prevent_update_department_trigger
BEFORE UPDATE ON employees
FOR EACH ROW
BEGIN
    DECLARE project_count INT;
    
    -- Check if the employee has worked on any projects
    SELECT COUNT(*)
    INTO project_count
    FROM works_on
    WHERE emp_id = OLD.emp_id;

    IF project_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot update department ID of employee with project assignments';
    END IF;
END;


-- 7
CREATE TRIGGER update_average_salary_trigger
AFTER UPDATE ON employees
FOR EACH ROW
BEGIN
    DECLARE department_avg_salary DECIMAL;

    -- Calculate the average salary for the department of the updated employee
    SELECT AVG(salary)
    INTO department_avg_salary
    FROM employees
    WHERE department_id = NEW.department_id;

    -- Update the average salary for the department in the departments table
    UPDATE departments
    SET average_salary = department_avg_salary
    WHERE department_id = NEW.department_id;
END;


-- 8 
CREATE TRIGGER delete_works_on_trigger
AFTER DELETE ON employees
FOR EACH ROW
BEGIN
    DELETE FROM works_on WHERE emp_id = OLD.emp_id;
END;


-- 9
CREATE TRIGGER prevent_insert_employee_trigger
BEFORE INSERT ON employees
FOR EACH ROW
BEGIN
    DECLARE min_salary DECIMAL;

    -- Get the minimum salary for the department
    SELECT MIN(min_salary)
    INTO min_salary
    FROM departments
    WHERE department_id = NEW.department_id;

    -- Check if the new employee's salary is less than the minimum salary for the department
    IF NEW.salary < min_salary THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Employee salary is less than the minimum salary for the department';
    END IF;
END;


-- 10
CREATE TRIGGER update_department_salary_budget_trigger
AFTER UPDATE ON employees
FOR EACH ROW
BEGIN
    DECLARE total_salary DECIMAL;

    -- Calculate the total salary for the department
    SELECT SUM(salary)
    INTO total_salary
    FROM employees
    WHERE department_id = NEW.department_id;

    -- Update the total salary budget for the department in the departments table
    UPDATE departments
    SET total_salary_budget = total_salary
    WHERE department_id = NEW.department_id;
END;


-- 11
CREATE TRIGGER notify_hr_new_employee_trigger
AFTER INSERT ON employees
FOR EACH ROW
BEGIN
    -- Replace 'your_email@example.com' with the HR email address
    DECLARE email_content VARCHAR(255);
    SET email_content = CONCAT('New employee hired: ', NEW.first_name, ' ', NEW.last_name, '. Employee ID: ', NEW.emp_id);

    -- Call a stored procedure or function to send an email
    CALL send_email('your_email@example.com', 'New Employee Hired', email_content);
END;


-- 12
CREATE TRIGGER prevent_insert_department_trigger
BEFORE INSERT ON departments
FOR EACH ROW
BEGIN
    IF NEW.location IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Location must be specified for the department';
    END IF;
END;


-- 13
CREATE TRIGGER update_employee_department_name_trigger
AFTER UPDATE ON departments
FOR EACH ROW
BEGIN
    UPDATE employees
    SET department_name = NEW.department_name
    WHERE department_id = NEW.department_id;
END;


-- 14
CREATE TRIGGER employees_audit_trigger
AFTER INSERT, UPDATE, DELETE ON employees
FOR EACH ROW
BEGIN
    DECLARE action VARCHAR(10);

    -- Determine the action type
    IF INSERTING THEN
        SET action = 'INSERT';
    ELSEIF UPDATING THEN
        SET action = 'UPDATE';
    ELSE
        SET action = 'DELETE';
    END IF;

    -- Insert audit record into the audit table
    INSERT INTO employees_audit (action_type, emp_id, first_name, last_name, salary, department_id, action_timestamp)
    VALUES (action, COALESCE(NEW.emp_id, OLD.emp_id), COALESCE(NEW.first_name, OLD.first_name),
            COALESCE(NEW.last_name, OLD.last_name), COALESCE(NEW.salary, OLD.salary),
            COALESCE(NEW.department_id, OLD.department_id), NOW());
END;


-- 15
CREATE TRIGGER generate_employee_id_trigger
BEFORE INSERT ON employees
FOR EACH ROW
BEGIN
    DECLARE next_employee_id INT;
    
    -- Retrieve the next value from the sequence
    SELECT NEXTVAL('employee_id_sequence') INTO next_employee_id;
    
    -- Set the new employee ID
    SET NEW.emp_id = next_employee_id;
END;

ease ensure that there are no syntax errors in the file. If we are unable to run your file, you get an automatic reduction to 0 marks.
-- Comment in MYSQL 
