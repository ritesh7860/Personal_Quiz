-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 19, 2025 at 09:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qid` int(10) DEFAULT NULL,
  `ans` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `qid` int(10) NOT NULL,
  `qns` varchar(100) DEFAULT NULL,
  `OptA` varchar(50) DEFAULT NULL,
  `OptB` varchar(75) DEFAULT NULL,
  `OptC` varchar(50) DEFAULT NULL,
  `OptD` varchar(50) DEFAULT NULL,
  `ans` varchar(10) DEFAULT NULL,
  `technology` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`qid`, `qns`, `OptA`, `OptB`, `OptC`, `OptD`, `ans`, `technology`) VALUES
(1, 'Which of the following is not a valid C variable name ?', 'int number;', 'float rate;', 'int variable_count;', 'int $main;', 'OptD', 'C'),
(2, 'Which of the following is the correct syntax to declare a pointer in C?', 'int p;', 'int *p;', 'pointer int p;', 'int p*;', 'OptB', 'C'),
(3, 'What is the size of an int data type in C (on a 32-bit system)?', '2 bytes', '4 bytes', '8 bytes', 'Depends on the compiler', 'OptB', 'C'),
(4, 'Which of the following is used to read a character from the console in C?', 'scanf()', 'getchar()', 'gets()', 'read()', 'OptB', 'C'),
(5, 'Which keyword is used to define a constant in C?', 'const', '#define', 'constant', 'Both const and #define', 'OptD', 'C'),
(6, 'Which format specifier is used to print a float in C?', '%d', '%c', '%f', '%s', 'OptC', 'C'),
(7, 'Which header file is required for printf() and scanf() functions?', 'stdlib.h', 'stdio.h', 'conio.h', 'string.h', 'OptB', 'C'),
(8, 'What will the expression 5/2 return in C?', '2.5', '2', '3', 'Error', 'OptB', 'C'),
(9, 'Which operator is used to access the value stored at an address in C?', '&', '*', '->', 'sizeof', 'OptB', 'C'),
(10, 'Which keyword is used to return control from a function in C?', 'exit', 'break', 'return', 'continue', 'OptC', 'C'),
(11, 'Which loop is guaranteed to execute at least once in C?', 'for', 'while', 'do-while', 'None', 'OptC', 'C'),
(12, 'Which of the following is not a storage class in C?', 'auto', 'static', 'mutable', 'extern', 'OptC', 'C'),
(13, 'What is the default return type of a C function if not specified?', 'void', 'int', 'float', 'double', 'OptB', 'C'),
(14, 'Which operator is used to allocate memory dynamically in C?', 'malloc', 'alloc', 'new', 'calloc', 'OptA', 'C'),
(15, 'Which function is used to compare two strings in C?', 'strcmp()', 'strcpy()', 'strcat()', 'strlen()', 'OptA', 'C'),
(16, 'In C, what is the index of the first element in an array?', '0', '1', '-1', 'Depends on compiler', 'OptA', 'C'),
(17, 'Which function is used to release dynamically allocated memory in C?', 'free()', 'delete()', 'remove()', 'clear()', 'OptA', 'C'),
(18, 'What will be the value of x after executing: int x=10; x+=5;', '5', '10', '15', '20', 'OptC', 'C'),
(19, 'Which operator is used to get the memory address of a variable?', '*', '&', '->', '%', 'OptB', 'C'),
(20, 'Which function is used to calculate the length of a string in C?', 'strlen()', 'size()', 'strsize()', 'count()', 'OptA', 'C'),
(21, 'Which of the following is a valid declaration of a main function in C?', 'int main()', 'void main()', 'main()', 'All of the above', 'OptD', 'C'),
(22, 'Which operator is known as the conditional operator in C?', '??', '::', '?:', 'if-else', 'OptC', 'C'),
(23, 'What is the size of a char data type in C?', '1 byte', '2 bytes', '4 bytes', 'Depends on compiler', 'OptA', 'C'),
(24, 'Which of the following is not a valid storage class specifier in C?', 'auto', 'register', 'volatile', 'mutable', 'OptD', 'C'),
(25, 'Which keyword is used to prevent modification of a variable in C?', 'static', 'final', 'const', 'immutable', 'OptC', 'C'),
(26, 'What will printf(\"%d\", 10<5); output?', '1', '0', '10', 'Error', 'OptB', 'C'),
(27, 'Which keyword is used to jump to a labeled statement in C?', 'break', 'goto', 'continue', 'switch', 'OptB', 'C'),
(28, 'Which of the following is the correct syntax for a for loop in C?', 'for(i=0;i<n;i++)', 'for(i<n;i=0)', 'for(i++;i<n;i=0)', 'for(i=0;i<n;i+)', 'OptA', 'C'),
(29, 'Which function is used to open a file in C?', 'fread()', 'fopen()', 'fileopen()', 'open()', 'OptB', 'C'),
(30, 'Which symbol is used to denote preprocessor directives in C?', '#', '$', '&', '@', 'OptA', 'C'),
(31, 'Which function is used to write a character to the console in C?', 'putchar()', 'printf()', 'puts()', 'write()', 'OptA', 'C'),
(32, 'Which of the following is not a valid data type in C?', 'int', 'float', 'real', 'char', 'OptC', 'C'),
(33, 'Which keyword is used to define a structure in C?', 'struct', 'structure', 'define', 'class', 'OptA', 'C'),
(34, 'Which function is used to allocate zero-initialized memory in C?', 'malloc()', 'calloc()', 'alloc()', 'realloc()', 'OptB', 'C'),
(35, 'Which loop is best when the number of iterations is known in advance?', 'while', 'do-while', 'for', 'goto', 'OptC', 'C'),
(36, 'Which function is used to copy one string into another in C?', 'strcat()', 'strcpy()', 'strcmp()', 'strlen()', 'OptB', 'C'),
(37, 'Which of the following is not a keyword in C?', 'enum', 'typedef', 'friend', 'volatile', 'OptC', 'C'),
(38, 'Which operator has the highest precedence in C?', '++', '*', '()', 'sizeof', 'OptC', 'C'),
(39, 'What will be the value of 7 % 3 in C?', '1', '2', '0', '3', 'OptB', 'C'),
(40, 'Which function is used to read a string from the console in C?', 'scanf()', 'gets()', 'fgets()', 'Both gets() and fgets()', 'OptD', 'C'),
(41, 'Which of the following is used to define a macro in C?', '#macro', '#define', 'macro()', 'def', 'OptB', 'C'),
(42, 'Which function is used to reposition the file pointer in C?', 'fseek()', 'rewind()', 'ftell()', 'fmove()', 'OptA', 'C'),
(43, 'Which function is used to concatenate two strings in C?', 'strcat()', 'strcpy()', 'strcmp()', 'strlen()', 'OptA', 'C'),
(44, 'Which of the following is not a logical operator in C?', '&&', '||', '!', '==', 'OptD', 'C'),
(45, 'Which header file is required for string functions in C?', 'stdio.h', 'stdlib.h', 'string.h', 'memory.h', 'OptC', 'C'),
(46, 'What will be the output of printf(\"%d\", 4==5);', '1', '0', '4', '5', 'OptB', 'C'),
(47, 'Which keyword is used to declare a global variable in C?', 'global', 'extern', 'static', 'volatile', 'OptB', 'C'),
(48, 'Which function is used to allocate memory that can be resized in C?', 'malloc()', 'calloc()', 'realloc()', 'resize()', 'OptC', 'C'),
(49, 'Which symbol is used to represent a single-line comment in C?', '//', '/* */', '#', '--', 'OptA', 'C'),
(50, 'Which function is the starting point of execution in a C program?', 'start()', 'init()', 'main()', 'run()', 'OptC', 'C'),
(51, 'Which symbol is used to declare a variable in PHP?', '@', '#', '$', '&', 'OptC', 'PHP'),
(52, 'Which of the following is the correct way to start a PHP block?', '<script>', '<php>', '<?php', '<?', 'OptC', 'PHP'),
(53, 'Which function is used to output text in PHP?', 'echo', 'print', 'write', 'Both echo and print', 'OptD', 'PHP'),
(54, 'Which of the following is not a valid PHP data type?', 'String', 'Integer', 'Float', 'Character', 'OptD', 'PHP'),
(55, 'Which function is used to get the length of a string in PHP?', 'strlen()', 'strsize()', 'count()', 'size()', 'OptA', 'PHP'),
(56, 'Which operator is used for concatenation in PHP?', '+', '&', '.', '::', 'OptC', 'PHP'),
(57, 'Which function is used to include a file in PHP?', 'require()', 'include()', 'import()', 'Both require() and include()', 'OptD', 'PHP'),
(58, 'Which variable is used to access form data sent using POST method in PHP?', '$_GET', '$_POST', '$_FORM', '$_REQUEST', 'OptB', 'PHP'),
(59, 'Which of the following is used to start a session in PHP?', 'session_create()', 'start_session()', 'session_start()', 'begin_session()', 'OptC', 'PHP'),
(60, 'Which function is used to terminate script execution in PHP?', 'exit()', 'end()', 'die()', 'Both exit() and die()', 'OptD', 'PHP'),
(61, 'Which of the following is the correct way to define a constant in PHP?', 'define(\"PI\", 3.14);', 'const PI = 3.14;', 'constant PI = 3.14;', 'Both define() and const', 'OptD', 'PHP'),
(62, 'Which superglobal is used to access cookie values in PHP?', '$_SESSION', '$_COOKIE', '$_GET', '$_POST', 'OptB', 'PHP'),
(63, 'Which of the following is used to check if a variable is empty in PHP?', 'isset()', 'is_null()', 'empty()', 'is_empty()', 'OptC', 'PHP'),
(64, 'What is the default file extension for PHP files?', '.html', '.php', '.phtml', '.ph', 'OptB', 'PHP'),
(65, 'Which function is used to get the current date in PHP?', 'date()', 'time()', 'current_date()', 'get_date()', 'OptA', 'PHP'),
(66, 'Which of the following is the correct way to write comments in PHP?', '// comment', '# comment', '/* comment */', 'All of the above', 'OptD', 'PHP'),
(67, 'Which function is used to destroy a session in PHP?', 'session_end()', 'session_destroy()', 'session_unset()', 'unset_session()', 'OptB', 'PHP'),
(68, 'Which function is used to count all elements in an array in PHP?', 'sizeof()', 'count()', 'length()', 'array_count()', 'OptB', 'PHP'),
(69, 'Which of the following is the correct way to connect to a MySQL database in PHP (MySQLi)?', 'mysqli_connect()', 'mysql_connect()', 'db_connect()', 'pdo_connect()', 'OptA', 'PHP'),
(70, 'Which error control operator is used to suppress errors in PHP?', '@', '#', '!', '$', 'OptA', 'PHP'),
(71, 'Which function is used to hash a string in PHP?', 'md5()', 'sha1()', 'password_hash()', 'All of the above', 'OptD', 'PHP'),
(72, 'Which function is used to check the type of a variable in PHP?', 'gettype()', 'var_type()', 'typeof()', 'checktype()', 'OptA', 'PHP'),
(73, 'Which of the following is the correct way to declare an array in PHP?', '$arr = array(1,2,3);', '$arr = [1,2,3];', 'array arr = (1,2,3);', 'Both array() and []', 'OptD', 'PHP'),
(74, 'Which superglobal is used to get environment variables in PHP?', '$_GET', '$_POST', '$_ENV', '$_SERVER', 'OptC', 'PHP'),
(75, 'What will be the output of echo 10 . 20; in PHP?', '30', '1020', 'Error', 'None', 'OptB', 'PHP'),
(76, 'Which function is used to redirect a page in PHP?', 'redirect()', 'goto()', 'header()', 'location()', 'OptC', 'PHP'),
(77, 'Which function is used to encode data in JSON format in PHP?', 'json_encode()', 'json_decode()', 'encode_json()', 'toJSON()', 'OptA', 'PHP'),
(78, 'Which function is used to decode a JSON string in PHP?', 'json_encode()', 'json_decode()', 'decode_json()', 'fromJSON()', 'OptB', 'PHP'),
(79, 'Which operator is used for strict comparison in PHP?', '==', '=', '===', '!==', 'OptC', 'PHP'),
(80, 'Which function is used to remove whitespace from the beginning and end of a string in PHP?', 'strip()', 'trim()', 'cut()', 'remove()', 'OptB', 'PHP'),
(81, 'Which of the following is a PHP loop structure?', 'for', 'while', 'foreach', 'All of the above', 'OptD', 'PHP'),
(82, 'Which of the following functions is used to include a file only once in PHP?', 'include()', 'require()', 'include_once()', 'require_once()', 'OptC', 'PHP'),
(83, 'Which function returns the last error message in PHP?', 'error_get_last()', 'last_error()', 'get_error()', 'error_message()', 'OptA', 'PHP'),
(84, 'Which function is used to split a string by a delimiter in PHP?', 'split()', 'explode()', 'str_split()', 'Both explode() and str_split()', 'OptD', 'PHP'),
(85, 'Which of the following is true about PHP variables?', 'They are case-sensitive', 'They start with $ sign', 'They do not need explicit declaration', 'All of the above', 'OptD', 'PHP'),
(86, 'Which function is used to check if a file exists in PHP?', 'is_exist()', 'file_exists()', 'exist()', 'check_file()', 'OptB', 'PHP'),
(87, 'What will be the output of var_dump(true and false); in PHP?', 'true', 'false', '1', '0', 'OptB', 'PHP'),
(88, 'Which PHP function is used to get the type and value of a variable?', 'gettype()', 'var_dump()', 'print_r()', 'typeof()', 'OptB', 'PHP'),
(89, 'Which function is used to generate a random number in PHP?', 'rand()', 'random()', 'mt_rand()', 'Both rand() and mt_rand()', 'OptD', 'PHP'),
(90, 'Which PHP function is used to get the IP address of the client?', '$_SERVER[\"REMOTE_ADDR\"]', 'get_ip()', 'client_ip()', 'request_ip()', 'OptA', 'PHP'),
(91, 'Which function is used to get the current date and time in PHP?', 'date()', 'time()', 'now()', 'getdate()', 'OptA', 'PHP'),
(92, 'Which function is used to terminate script execution in PHP?', 'stop()', 'end()', 'exit()', 'terminate()', 'OptC', 'PHP'),
(93, 'Which superglobal is used to store session variables in PHP?', '$_COOKIE', '$_SERVER', '$_SESSION', '$_POST', 'OptC', 'PHP'),
(94, 'Which function is used to destroy a session in PHP?', 'end_session()', 'delete_session()', 'session_destroy()', 'session_end()', 'OptC', 'PHP'),
(95, 'Which operator is used for concatenation in PHP?', '+', '.', '&&', '::', 'OptB', 'PHP'),
(96, 'What is the default session timeout in PHP?', '10 minutes', '20 minutes', '24 minutes', 'Depends on server configuration', 'OptD', 'PHP'),
(97, 'Which of the following is true about PHP constants?', 'They are defined using define()', 'They are case-sensitive by default', 'They cannot be changed once set', 'All of the above', 'OptD', 'PHP'),
(98, 'Which function is used to open a file in PHP?', 'file_open()', 'open()', 'fopen()', 'fileopen()', 'OptC', 'PHP'),
(99, 'Which function is used to read a file line by line in PHP?', 'fread()', 'fgets()', 'file_get_contents()', 'readline()', 'OptB', 'PHP'),
(100, 'Which function is used to close an open file in PHP?', 'close()', 'fclose()', 'endfile()', 'stop()', 'OptB', 'PHP'),
(242, 'Which keyword is used to declare a global variable inside a function?', 'static', 'global', 'extern', 'shared', 'OptB', 'Python'),
(241, 'Which operator is used for string concatenation in Python?', '+', '&', 'concat', '.', 'OptA', 'Python'),
(240, 'Which of these is a mutable data type in Python?', 'tuple', 'list', 'string', 'frozenset', 'OptB', 'Python'),
(239, 'Which function is used to sort a list in Python?', 'sort()', 'order()', 'sorted()', 'arrange()', 'OptC', 'Python'),
(238, 'Which of the following is the correct way to open a file for reading in Python?', 'open(\"file.txt\",\"r\")', 'open(\"file.txt\",\"w\")', 'open(\"file.txt\",\"rw\")', 'open(\"file.txt\",\"a\")', 'OptA', 'Python'),
(237, 'Which function is used to get the current Python version?', 'sys.version', 'python.version()', 'get.version()', 'version()', 'OptA', 'Python'),
(236, 'Which of these is not a valid Python loop?', 'for', 'while', 'do-while', 'nested for', 'OptC', 'Python'),
(235, 'Which function is used to return the Unicode character of an integer?', 'ord()', 'ascii()', 'chr()', 'unicode()', 'OptC', 'Python'),
(234, 'Which keyword is used to exit a loop in Python?', 'stop', 'exit', 'break', 'end', 'OptC', 'Python'),
(233, 'Which function is used to convert a string into an integer in Python?', 'str()', 'float()', 'int()', 'eval()', 'OptC', 'Python'),
(232, 'What is the output of type([])?', 'list', 'dict', 'tuple', 'set', 'OptA', 'Python'),
(231, 'Which keyword is used to inherit a class in Python?', 'this', 'extends', 'inherits', 'class Child(Parent):', 'OptD', 'Python'),
(230, 'Which function is used to find the maximum value in Python?', 'largest()', 'max()', 'maximum()', 'top()', 'OptB', 'Python'),
(229, 'Which built-in function is used to get the ASCII value of a character?', 'ord()', 'ascii()', 'chr()', 'ordvalue()', 'OptA', 'Python'),
(228, 'Which keyword is used to define a generator function in Python?', 'def', 'yield', 'gen', 'async', 'OptB', 'Python'),
(227, 'Which module in Python is used for regular expressions?', 'regex', 'pyregex', 're', 'regexp', 'OptC', 'Python'),
(226, 'Which of these operators is used for floor division in Python?', '/', '%', '//', '^', 'OptC', 'Python'),
(225, 'What is the output of \"Python\".lower()?', 'PYTHON', 'python', 'Python', 'Error', 'OptB', 'Python'),
(224, 'Which of these is used to create an anonymous function in Python?', 'lambda', 'def', 'func', 'inline', 'OptA', 'Python'),
(223, 'Which keyword is used for exception handling in Python?', 'try', 'catch', 'throws', 'error', 'OptA', 'Python'),
(222, 'Which method is used to remove the last element from a list?', 'delete()', 'pop()', 'remove()', 'discard()', 'OptB', 'Python'),
(221, 'What is the output of len(\"Python\")?', '5', '6', '7', 'Error', 'OptB', 'Python'),
(220, 'Which function is used to return the absolute value in Python?', 'abs()', 'absolute()', 'fabs()', 'value()', 'OptA', 'Python'),
(219, 'Which loop in Python is used to iterate over a sequence?', 'for', 'while', 'do-while', 'repeat-until', 'OptA', 'Python'),
(218, 'Which of the following is not a valid Python keyword?', 'pass', 'eval', 'assert', 'nonlocal', 'OptB', 'Python'),
(217, 'Which method is used to add an element to a list in Python?', 'append()', 'add()', 'insert()', 'push()', 'OptA', 'Python'),
(216, 'Which of these is the correct way to import a module in Python?', 'include math', 'import math', 'using math', 'require math', 'OptB', 'Python'),
(215, 'What is the output of 2//3 in Python?', '0', '0.66', '1', 'Error', 'OptA', 'Python'),
(214, 'Which of the following creates a set in Python?', '{1,2,3}', '[1,2,3]', '(1,2,3)', '{\"a\":1,\"b\":2}', 'OptA', 'Python'),
(212, 'Which operator is used for exponentiation in Python?', '^', '**', 'exp()', 'pow()', 'OptB', 'Python'),
(213, 'Which of the following is used to define a docstring in Python?', '// comment', '# comment', '\"\"\"docstring\"\"\"', '<!-- docstring -->', 'OptC', 'Python'),
(211, 'Which function is used to display output in Python?', 'print()', 'output()', 'display()', 'echo()', 'OptA', 'Python'),
(209, 'Which of the following is an immutable data type in Python?', 'List', 'Dictionary', 'Tuple', 'Set', 'OptC', 'Python'),
(210, 'Which keyword is used to create a class in Python?', 'function', 'class', 'object', 'define', 'OptB', 'Python'),
(208, 'What is the correct file extension for Python files?', '.py', '.python', '.pyt', '.pt', 'OptA', 'Python'),
(207, 'Which of the following functions is used to find the length of a list in Python?', 'count()', 'size()', 'len()', 'length()', 'OptC', 'Python'),
(205, 'What is the output of bool(0) in Python?', 'True', 'False', '0', 'Error', 'OptB', 'Python'),
(206, 'Which symbol is used for comments in Python?', '//', '#', '/* */', '--', 'OptB', 'Python'),
(204, 'Which of the following is used to take input from the user in Python 3?', 'scanf()', 'cin>>', 'input()', 'read()', 'OptC', 'Python'),
(203, 'Which keyword is used to define a function in Python?', 'func', 'define', 'def', 'function', 'OptC', 'Python'),
(202, 'Which of the following is not a Python data type?', 'List', 'Tuple', 'Dictionary', 'Character', 'OptD', 'Python'),
(201, 'What is the output of type(3)?', 'float', 'str', 'int', 'bool', 'OptC', 'Python'),
(200, 'Which of the following is used to define a block of code in Python?', 'Braces {}', 'Indentation', 'Parentheses ()', 'Semicolon ;', 'OptB', 'Python'),
(150, 'Which of the following is not a Java feature?', 'Object-Oriented', 'Platform Independent', 'Use of Pointers', 'Dynamic', 'OptC', 'Java'),
(151, 'What is the size of int data type in Java?', '2 bytes', '4 bytes', '8 bytes', 'Depends on OS', 'OptB', 'Java'),
(152, 'Which of the following is the default value of a boolean variable in Java?', 'true', 'false', '0', 'null', 'OptB', 'Java'),
(153, 'Which keyword is used to inherit a class in Java?', 'this', 'super', 'extends', 'implements', 'OptC', 'Java'),
(154, 'Which of the following is a reserved keyword in Java?', 'main', 'goto', 'next', 'string', 'OptB', 'Java'),
(155, 'Which of these is not an OOP concept in Java?', 'Inheritance', 'Encapsulation', 'Polymorphism', 'Compilation', 'OptD', 'Java'),
(156, 'Which method is the entry point of a Java program?', 'start()', 'main()', 'run()', 'init()', 'OptB', 'Java'),
(157, 'Which of the following is not a Java access modifier?', 'public', 'private', 'protected', 'friendly', 'OptD', 'Java'),
(158, 'Which operator is used to compare two values in Java?', '=', '==', '!=', 'equals()', 'OptB', 'Java'),
(159, 'Which package contains the Scanner class in Java?', 'java.io', 'java.util', 'java.lang', 'java.sql', 'OptB', 'Java'),
(160, 'Which of the following is used to create an object in Java?', 'new', 'malloc', 'alloc', 'create', 'OptA', 'Java'),
(161, 'Which method is used to find the length of a string in Java?', 'len()', 'size()', 'length()', 'getLength()', 'OptC', 'Java'),
(162, 'Which of the following is not a wrapper class in Java?', 'Integer', 'Float', 'String', 'Character', 'OptC', 'Java'),
(163, 'Which keyword is used to prevent inheritance in Java?', 'stop', 'final', 'static', 'constant', 'OptB', 'Java'),
(164, 'Which keyword is used to define an interface in Java?', 'class', 'interface', 'implements', 'abstract', 'OptB', 'Java'),
(165, 'Which collection class allows key-value pairs in Java?', 'List', 'Set', 'Map', 'Queue', 'OptC', 'Java'),
(166, 'Which exception is thrown when dividing by zero in Java?', 'NullPointerException', 'ArithmeticException', 'NumberFormatException', 'DivideByZeroException', 'OptB', 'Java'),
(167, 'Which of the following is true about constructors in Java?', 'They have a return type', 'They are called automatically when an object is created', 'They can be static', 'They must be private', 'OptB', 'Java'),
(168, 'Which of these is not a primitive data type in Java?', 'int', 'float', 'String', 'char', 'OptC', 'Java'),
(169, 'Which keyword is used to refer to the current object in Java?', 'this', 'self', 'super', 'object', 'OptA', 'Java'),
(170, 'Which keyword is used to inherit an interface in Java?', 'extends', 'implements', 'inherit', 'interface', 'OptB', 'Java'),
(171, 'Which of these cannot be declared as static in Java?', 'Variable', 'Method', 'Constructor', 'Block', 'OptC', 'Java'),
(172, 'Which method is used to start a thread in Java?', 'start()', 'run()', 'execute()', 'init()', 'OptA', 'Java'),
(173, 'Which of the following is not part of Java exception hierarchy?', 'Throwable', 'Error', 'Exception', 'Problem', 'OptD', 'Java'),
(174, 'Which keyword is used to create a subclass in Java?', 'extends', 'inherits', 'super', 'implements', 'OptA', 'Java'),
(175, 'Which of these is used to handle exceptions in Java?', 'try-catch', 'do-while', 'for-each', 'if-else', 'OptA', 'Java'),
(176, 'Which of these is not a Java loop?', 'for', 'foreach', 'do-while', 'repeat-until', 'OptD', 'Java'),
(177, 'Which keyword is used to define a package in Java?', 'package', 'namespace', 'module', 'import', 'OptA', 'Java'),
(178, 'Which method is called automatically when an object is garbage collected in Java?', 'final()', 'delete()', 'finalize()', 'destroy()', 'OptC', 'Java'),
(179, 'Which Java statement is used to stop a loop?', 'stop', 'break', 'exit', 'terminate', 'OptB', 'Java'),
(180, 'Which of the following is the parent class of all Java classes?', 'Object', 'Class', 'Base', 'Super', 'OptA', 'Java'),
(181, 'Which Java keyword is used to import other classes?', 'include', 'import', 'using', 'require', 'OptB', 'Java'),
(182, 'Which operator is used for logical AND in Java?', '&&', '&', 'and', 'Both && and &', 'OptA', 'Java'),
(183, 'Which of the following is used to create a constant variable in Java?', 'const', 'final', 'static', 'immutable', 'OptB', 'Java'),
(184, 'Which Java collection does not allow duplicate elements?', 'List', 'Set', 'Map', 'Queue', 'OptB', 'Java'),
(185, 'Which of these is the correct way to declare an array in Java?', 'int arr[];', 'array int arr;', 'int arr;', 'int[] arr;', 'OptD', 'Java'),
(186, 'Which keyword is used to call the parent class constructor in Java?', 'super', 'this', 'parent', 'extends', 'OptA', 'Java'),
(187, 'Which Java keyword is used to define a subclass method that replaces a parent class method?', 'extends', 'override', 'overload', '@Override annotation', 'OptD', 'Java'),
(188, 'Which method is used to compare two strings in Java for equality?', '==', 'equals()', 'compare()', 'match()', 'OptB', 'Java'),
(189, 'Which of the following is used to handle runtime errors in Java?', 'try-catch', 'if-else', 'switch-case', 'for loop', 'OptA', 'Java'),
(190, 'Which Java feature allows multiple methods with the same name but different parameters?', 'Overriding', 'Overloading', 'Encapsulation', 'Polymorphism', 'OptB', 'Java'),
(191, 'Which keyword is used to define an abstract class in Java?', 'virtual', 'abstract', 'interface', 'base', 'OptB', 'Java'),
(192, 'Which Java collection class allows duplicate elements?', 'Set', 'List', 'Map', 'HashSet', 'OptB', 'Java'),
(193, 'Which Java keyword is used to explicitly free memory?', 'delete', 'free', 'None (handled by Garbage Collector)', 'clear', 'OptC', 'Java'),
(194, 'Which method is used to get the character at a specific index in a Java string?', 'get()', 'charAt()', 'indexOf()', 'substring()', 'OptB', 'Java'),
(195, 'Which of these keywords is used to create a thread in Java?', 'thread', 'process', 'extends Thread / implements Runnable', 'run', 'OptC', 'Java'),
(196, 'Which Java statement is used to skip the current iteration of a loop?', 'exit', 'break', 'continue', 'skip', 'OptC', 'Java'),
(197, 'Which keyword is used to inherit exceptions in Java?', 'extends', 'implements', 'throws', 'try', 'OptA', 'Java'),
(198, 'Which of these methods is called when a thread is started in Java?', 'execute()', 'run()', 'start()', 'init()', 'OptC', 'Java'),
(199, 'Which Java keyword is used to handle multiple exceptions in a single block?', 'multi-catch', 'union', 'or', 'catch()', 'OptA', 'Java'),
(243, 'Which of the following functions is used to get user input in Python 3?', 'input()', 'raw_input()', 'scan()', 'read()', 'OptA', 'Python'),
(244, 'Which of these is the correct way to write a list comprehension in Python?', '[x for x in range(5)]', '(x for x in range(5))', '{x for x in range(5)}', '<x for x in range(5)>', 'OptA', 'Python'),
(245, 'What is the output of 3 * \"Python\"?', 'Error', 'PythonPythonPython', '3Python', 'Python*3', 'OptB', 'Python'),
(246, 'Which method is used to convert a string to uppercase in Python?', 'toUpperCase()', 'upper()', 'uppercase()', 'capitals()', 'OptB', 'Python'),
(247, 'Which statement is used to handle exceptions in Python?', 'try-except', 'do-catch', 'throw-catch', 'try-throw', 'OptA', 'Python'),
(248, 'Which function is used to return the minimum value in Python?', 'min()', 'smallest()', 'minimum()', 'low()', 'OptA', 'Python'),
(249, 'Which library is used for data manipulation and analysis in Python?', 'numpy', 'pandas', 'matplotlib', 'scipy', 'OptB', 'Python'),
(250, 'Which of the following colors contains equal amounts of RGB?', 'White', 'Gray', 'Black', 'All of the mentioned', 'OptD', 'Html');

-- --------------------------------------------------------

--
-- Table structure for table `regis`
--

CREATE TABLE `regis` (
  `name` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `regis`
--

INSERT INTO `regis` (`name`, `email`, `password`, `role`) VALUES
('Ritesh singh', 'riteshsinghran@gmail.com', '12345', 'user'),
('Deepali', 'deepali@mightcode.com', '$2y$10$QdDBlmOXEd.kC910b9vRoOgntWargdTS7oUleXBTkuNm1DPhtMZAu', 'user'),
('Ritesh singh', 'ritesh@mightcode.com', '$2y$10$iiY1XSlT5sNcrbO3TPau5.SiCZ/uxCDXDcfKZQKSJB2BGnwKvb.yS', 'user'),
('Admin', 'admin@mightcode.com', '$2y$10$xdQsTeFaA8A5.p0o97utIedpns8e2K47TSwMfUozOO9AN.ujGfgGS', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `email`, `score`, `total`, `created_at`, `name`) VALUES
(1, 'riteshsinghran@gmail.com', 3, 3, '2025-09-04 13:36:11', 'Ritesh'),
(2, 'riteshsinghran@gmail.com', 3, 3, '2025-09-05 05:36:55', 'Ritesh'),
(3, 'riteshsinghran@gmail.com', 3, 3, '2025-09-05 06:02:35', 'Ritesh'),
(4, 'riteshsinghran@gmail.com', 3, 3, '2025-09-05 06:32:22', NULL),
(5, 'riteshsinghran@gmail.com', 2, 3, '2025-09-05 06:36:22', NULL),
(6, 'deepali@mightcode.com', 1, 3, '2025-09-08 12:11:15', NULL),
(7, 'deepali@mightcode.com', 2, 3, '2025-09-08 13:11:15', NULL),
(8, 'deepali@mightcode.com', 4, 4, '2025-09-08 13:14:20', NULL),
(9, 'deepali@mightcode.com', 2, 4, '2025-09-09 04:35:41', NULL),
(10, 'ritesh@mightcode.com', 3, 4, '2025-09-09 05:31:13', NULL),
(11, 'ritesh@mightcode.com', 0, 1, '2025-09-09 05:58:16', NULL),
(12, 'ritesh@mightcode.com', 0, 0, '2025-09-09 05:59:31', NULL),
(13, 'ritesh@mightcode.com', 3, 4, '2025-09-09 06:02:37', NULL),
(14, 'ritesh@mightcode.com', 2, 4, '2025-09-09 06:23:48', NULL),
(15, 'ritesh@mightcode.com', 2, 4, '2025-09-09 06:25:32', NULL),
(16, 'ritesh@mightcode.com', 1, 1, '2025-09-09 09:42:47', NULL),
(17, 'ritesh@mightcode.com', 12, 20, '2025-09-09 11:56:41', NULL),
(18, 'ritesh@mightcode.com', 2, 2, '2025-09-11 12:45:51', NULL),
(19, 'ritesh@mightcode.com', 1, 1, '2025-09-16 08:59:47', NULL),
(20, 'ritesh@mightcode.com', 0, 1, '2025-09-16 09:55:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `regis`
--
ALTER TABLE `regis`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `qid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
