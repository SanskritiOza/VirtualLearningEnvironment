CREATE DATABASE educational_platform;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,    -- Unique identifier for each user
    username VARCHAR(100) NOT NULL,       -- Username (e.g., for login purposes)
    password VARCHAR(255) NOT NULL,       -- Password (hashed for security)
    name VARCHAR(100) NOT NULL,           -- Full name of the user
    email VARCHAR(100) NOT NULL,          -- Email address
    role ENUM('student', 'teacher') NOT NULL,  -- Role of the user (student or teacher)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- Automatically stores when the user was created
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Unique ID for each course
    title VARCHAR(255) NOT NULL,                -- The title of the course
    description TEXT,                           -- A description of the course
    teacher_id INT NOT NULL,                    -- The teacher who created the course
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp of when the course was created
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE  -- References the teacher in the users table
);

CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Unique ID for each enrollment
    user_id INT NOT NULL,                       -- The user who is enrolling in the course
    course_id INT NOT NULL,                     -- The course being enrolled in
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp for when the enrollment occurred
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,  -- Links to users table
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE  -- Links to courses table
);

CREATE TABLE likes_dislikes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    liked TINYINT(1) NOT NULL,  -- 1 for like, 0 for dislike
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,  -- Links to users table
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE  -- Links to courses table
);

