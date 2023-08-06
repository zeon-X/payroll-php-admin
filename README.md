

# Admin Dashboard 

![Screenshot 2023-07-15 at 05-49-11 https __localhost](https://github.com/zeon-X/payroll-php-admin/assets/73699852/57a99d92-363c-45d9-b9d9-c29b1ff5dd38)
![Screenshot 2023-07-15 at 05-49-17 Admin Create Depratment](https://github.com/zeon-X/payroll-php-admin/assets/73699852/bcde89f2-e5d3-4810-aea6-4f61c168d33a)
![Screenshot 2023-07-15 at 05-48-48 Admin Create Salary](https://github.com/zeon-X/payroll-php-admin/assets/73699852/65f5d6ea-c70d-40f9-9cb9-e3de4a4354d3)
![Screenshot 2023-07-15 at 05-48-54 https __localhost](https://github.com/zeon-X/payroll-php-admin/assets/73699852/93f47421-1662-4287-a646-26648c9cdd57)
![Screenshot 2023-07-15 at 05-49-04 Admin Create Depratment](https://github.com/zeon-X/payroll-php-admin/assets/73699852/d8d3ad56-08b6-4cd6-a5f1-ab0ccf64e641)

![Screenshot 2023-07-15 at 05-48-28 https __localhost](https://github.com/zeon-X/payroll-php-admin/assets/73699852/4c6ea5b0-fb23-48f5-993a-79e6d422044c)
![Screenshot 2023-07-15 at 05-48-35 https __localhost](https://github.com/zeon-X/payroll-php-admin/assets/73699852/781f2421-e987-4920-9bf5-072481b4128e)
![Screenshot 2023-07-15 at 05-48-41 https __localhost](https://github.com/zeon-X/payroll-php-admin/assets/73699852/7e79b65d-55fa-431c-a2b6-00ff9cb5bf28)


# User/Employees Dashboard

![Screenshot 2023-07-15 at 05-52-08 https __localhost](https://github.com/zeon-X/payroll-php-admin/assets/73699852/502d176e-8ff4-4c26-86aa-4be0d65e6c75)


# Landing Page and Basics!
[Screenshot 2023-07-15 at 05-49-28 Employee Salary](https://github.com/zeon-X/payroll-php-admin/assets/73699852/3df4d210-5553-40ff-8d0d-f0cfc7a75541)
![Screenshot 2023-07-15 at 05-49-40 https __localhost](https://github.com/zeon-X/payroll-php-admin/assets/73699852/cff48f9c-e6c2-4416-a5e6-c6755e93c102)
![Screenshot 2023-07-15 at 05-49-52 https __localhost](https://github.com/zeon-X/payroll-php-admin/assets/73699852/aa0c15ac-7181-4aa9-b7c7-62f0a95a8b05)

# Database Codes 
// Salary Trigger
DELIMITER $$
CREATE TRIGGER gen_salary
AFTER INSERT ON ft_pt_work
FOR EACH ROW
BEGIN
    -- Perform actions or insert statements here
    -- This trigger will be executed after a new row is inserted into 'your_table_name'

    -- Example action: Update a column in another table
    DECLARE emp_id VARCHAR(100);
    DECLARE basic NUMERIC(8, 2);
    DECLARE allowance NUMERIC(8, 2);
  DECLARE deduction NUMERIC(8, 2);
    DECLARE net_salary NUMERIC(8, 2);
    
    SET emp_id = NEW.emp_id;
    SET basic = ( SELECT hourly_rate FROM employee WHERE employee.emp_id = NEW.emp_id ) * NEW.num_of_hours;        
    SET deduction = basic * 0.09 + basic * 0.25;
    SET allowance = basic * 0.45;
    SET net_salary = basic + allowance - deduction;
    
    INSERT INTO salary (salary.emp_id, salary.basic, salary.allowance, salary.deduction, salary.net_salary)
    VALUES (emp_id, basic, allowance, deduction, net_salary);
END$$
DELIMITER ;





//NEW TRY

-- Create employee table
CREATE TABLE employee (
  emp_id INT PRIMARY KEY,
  emp_name VARCHAR(100),
  dept_id INT,
  type_of_work VARCHAR(20),
  hourly_rate DECIMAL(10, 2),
  basic DECIMAL(10, 2)
);

-- Create dept table
CREATE TABLE dept (
  dept_id INT PRIMARY KEY,
  dept_name VARCHAR(100),
  dept_location VARCHAR(100)
);

-- Create address table
CREATE TABLE address (
  emp_id INT PRIMARY KEY,
  street_no VARCHAR(100),
  street_name VARCHAR(100),
  city VARCHAR(100),
  zip_code VARCHAR(20)
);

-- Create project table
CREATE TABLE project (
  project_id INT PRIMARY KEY,
  project_name VARCHAR(100),
  project_location VARCHAR(100)
);

-- Create ft_pt_work table
CREATE TABLE ft_pt_work (
  project_id INT,
  emp_id INT,
  dept_id INT,
  num_of_hours DECIMAL(10, 2),
  FOREIGN KEY (project_id) REFERENCES project(project_id),
  FOREIGN KEY (emp_id) REFERENCES employee(emp_id),
  FOREIGN KEY (dept_id) REFERENCES dept(dept_id)
);

-- Create salary table
CREATE TABLE salary (
  emp_no INT PRIMARY KEY,
  basic DECIMAL(10, 2),
  allowance DECIMAL(10, 2),
  deduction DECIMAL(10, 2),
  net_salary DECIMAL(10, 2) GENERATED ALWAYS AS (basic + (0.45 * basic) - (0.09 * basic) - (0.25 * basic)) VIRTUAL,
  salary_date DATE
);

-- Create trigger for enforcing full-time basic salary constraint
DELIMITER //
CREATE TRIGGER tr_employee_full_time_basic
BEFORE INSERT ON employee
FOR EACH ROW
BEGIN
  IF NEW.type_of_work = 'full time' AND NEW.basic < 5000 THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Full-time employees must have a basic salary greater than or equal to 5000.';
  END IF;
END //
DELIMITER ;

-- Create trigger for enforcing part-time hourly rate constraint
DELIMITER //
CREATE TRIGGER tr_employee_part_time_hourly_rate
BEFORE INSERT ON employee
FOR EACH ROW
BEGIN
  IF NEW.type_of_work = 'part time' AND (NEW.hourly_rate < 25 OR NEW.hourly_rate > 60) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Part-time employees must have an hourly rate between 25 and 60.';
  END IF;
END //
DELIMITER ;


//ENTRY

INSERT INTO employee (emp_id, emp_name, dept_id, type_of_work, hourly_rate, basic)
VALUES
  (1, 'John Doe', 1, 'full time', 50, 7500),
  (2, 'Jane Smith', 2, 'full time', 60, 6500),
  (3, 'David Johnson', 1, 'part time', 35, NULL),
  (4, 'Sarah Williams', 3, 'full time', 55, 6000),
  (5, 'Michael Brown', 2, 'part time', 40, NULL),
  (6, 'Emily Davis', 1, 'part time', 45, NULL),
  (7, 'Christopher Wilson', 3, 'full time', 55, 5500),
  (8, 'Olivia Taylor', 1, 'full time', 60, 8000),
  (9, 'Daniel Anderson', 2, 'part time', 50, NULL),
  (10, 'Sophia Martinez', 3, 'part time', 55, NULL);



  INSERT INTO dept (dept_id, dept_name, dept_location)
VALUES
  (1, 'Engineering', 'Googong city'),
  (2, 'Foreman', 'Googong city'),
  (3, 'Labor', 'Burton Canberra'),
  (4, 'IT', 'Canberra'),
  (5, 'Marketing', 'Sydney'),
  (6, 'Finance', 'Sydney'),
  (7, 'Human Resources', 'Melbourne'),
  (8, 'Operations', 'Melbourne'),
  (9, 'Sales', 'Brisbane'),
  (10, 'Customer Service', 'Brisbane');



INSERT INTO address (emp_id, street_no, street_name, city, zip_code)
VALUES
  (1, '123', 'Main Street', 'Googong city', '12345'),
  (2, '456', 'First Avenue', 'Googong city', '23456'),
  (3, '789', 'Oak Road', 'Googong city', '34567'),
  (4, '321', 'Elm Street', 'Burton Canberra', '45678'),
  (5, '654', 'Cedar Lane', 'Burton Canberra', '56789'),
  (6, '987', 'Pine Avenue', 'Burton Canberra', '67890'),
  (7, '555', 'Maple Drive', 'Googong city', '09876'),
  (8, '777', 'Spruce Road', 'Googong city', '98765'),
  (9, '999', 'Birch Street', 'Googong city', '87654'),
  (10, '111', 'Ash Lane', 'Burton Canberra', '76543');



INSERT INTO project (project_id, project_name, project_location)
VALUES
  (1, 'Googong Subdivision', 'Googong city'),
  (2, 'Burton Highway', 'Burton Canberra'),
  (3, 'Canberra Bridge', 'Canberra'),
  (4, 'Sydney Tower', 'Sydney'),
  (5, 'Melbourne Park', 'Melbourne'),
  (6, 'Brisbane Riverwalk', 'Brisbane'),
  (7, 'Adelaide Mall Renovation', 'Adelaide'),
  (8, 'Perth Airport Expansion', 'Perth'),
  (9, 'Darwin Waterfront Development', 'Darwin'),
  (10, 'Hobart Harbor Redevelopment', 'Hobart');



INSERT INTO ft_pt_work (project_id, emp_id, dept_id, num_of_hours)
VALUES
  (1, 1, 1, 40),
  (1, 2, 2, 40),
  (1, 3, 1, 20),
  (2, 4, 3, 40),
  (2, 5, 2, 30),
  (2, 6, 1, 15),
  (3, 7, 3, 40),
  (3, 8, 1, 40),
  (3, 9, 2, 25),
  (3, 10, 3, 35);



INSERT INTO salary (emp_no, basic, allowance, deduction, salary_date)
VALUES
  (1, 7000, 2000, 1000, '2023-07-01'),
  (2, 6000, 1500, 800, '2023-07-01'),
  (3, 0, 0, 0, '2023-07-01'),
  (4, 5500, 1800, 900, '2023-07-01'),
  (5, 0, 0, 0, '2023-07-01'),
  (6, 0, 0, 0, '2023-07-01'),
  (7, 5000, 1600, 850, '2023-07-01'),
  (8, 7500, 2200, 1200, '2023-07-01'),
  (9, 0, 0, 0, '2023-07-01'),
  (10, 0, 0, 0, '2023-07-01');




// Random QUERRY

1)

SELECT e.emp_name
FROM employee e 
JOIN ft_pt_work fpw ON e.emp_id = fpw.emp_id
JOIN project p ON fpw.project_id = p.project_id
JOIN dept d ON d.dept_id = e.dept_id
WHERE p.project_name = 'Googong Subdivision' AND p.project_location = 'Googong city' AND 
d.dept_name = 'Engineering'


2)

SELECT e.emp_name
FROM employee e
JOIN ft_pt_work fpw ON e.emp_id = fpw.emp_id
JOIN project p ON fpw.project_id = p.project_id 
JOIN dept d ON d.dept_id = fpw.dept_id
WHERE p.project_name = 'Googong Subdivision' AND p.project_location = 'Googong city' AND
d.dept_name = 'Labour' AND fpw.num_of_hours > 20;


3)

SELECT e.emp_name, a.street_no, a.street_name, a.city, a.zip_code
FROM employee e
JOIN ft_pt_work fpw ON e.emp_id = fpw.emp_id
JOIN project p ON fpw.project_id = p.project_id
JOIN address a ON e.emp_id = a.emp_id
WHERE p.project_location = 'Burton Canberra' AND e.dept_id NOT IN (SELECT dept_id FROM dept WHERE dept_location = 'Canberra');


4)

SELECT e.emp_name
FROM employee e
JOIN ft_pt_work fpw ON e.emp_id = fpw.emp_id
JOIN project p ON fpw.project_id = p.project_id
WHERE p.project_name IN ('Googong Subdivision', 'Burton Highway')
GROUP BY e.emp_name
HAVING COUNT(DISTINCT p.project_id) = 2;



5)

CREATE VIEW employee_salary_view_mod AS
SELECT e.emp_name, d.dept_name, e.type_of_work,
  CASE 
    WHEN e.type_of_work = 'full time' THEN e.basic
    WHEN e.type_of_work = 'part time' THEN (e.hourly_rate * ft.num_of_hours)
  END AS basic,
  (0.09 * e.basic + 0.25 * e.basic) AS deduction,
  (CASE 
    WHEN e.type_of_work = 'full time' THEN (e.basic + (0.45 * e.basic) - (0.09 * e.basic) - (0.25 * e.basic))
    WHEN e.type_of_work = 'part time' THEN ((e.hourly_rate * ft.num_of_hours) + (0.45 * (e.hourly_rate * ft.num_of_hours)) - (0.09 * (e.hourly_rate * ft.num_of_hours)) - (0.25 * (e.hourly_rate * ft.num_of_hours)))
  END) AS net_salary
FROM employee e
JOIN dept d ON e.dept_id = d.dept_id
LEFT JOIN ft_pt_work ft ON e.emp_id = ft.emp_id;

SELECT * FROM employee_salary_view_mod;


5)


CREATE VIEW employee_salary_view_prime AS
SELECT e.emp_name, d.dept_name, e.type_of_work,
  CASE 
    WHEN e.type_of_work = 'full time' THEN e.basic
    WHEN e.type_of_work = 'part time' THEN (e.hourly_rate * ft.num_of_hours)
  END AS basic,
  (CASE 
    WHEN e.type_of_work = 'full time' THEN (0.09 * e.basic + 0.25 * e.basic)
    WHEN e.type_of_work = 'part time' THEN (0.09 * (e.hourly_rate * ft.num_of_hours) + 0.25 * (e.hourly_rate * ft.num_of_hours))
   END) AS deduction,
  (CASE 
    WHEN e.type_of_work = 'full time' THEN (e.basic + (0.45 * e.basic) - (0.09 * e.basic) - (0.25 * e.basic))
    WHEN e.type_of_work = 'part time' THEN ((e.hourly_rate * ft.num_of_hours) + (0.45 * (e.hourly_rate * ft.num_of_hours)) - (0.09 * (e.hourly_rate * ft.num_of_hours)) - (0.25 * (e.hourly_rate * ft.num_of_hours)))
  END) AS net_salary
FROM employee e
JOIN dept d ON e.dept_id = d.dept_id
LEFT JOIN ft_pt_work ft ON e.emp_id = ft.emp_id;

SELECT * FROM employee_salary_view_prime;
