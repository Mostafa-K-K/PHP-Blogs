# PHP Project

Over the next week, you will be working on this supplementary PHP project.
The main topics we will be focusing on are: Object Oriented Programming, PDO,
and composer autoloading and package management. You will have 9 days from
tomorrow. You are only allowed to use HTML, CSS, PHP and MySQL.

The main idea behind this project is creating a dashboard with fully functional authentication system and validation. This dashboard will have the following features:

#### Authentication
1. A user can register using email, username and password.
2. A user can login using either a username or password.

The user email and username must be unique.
The password must be a strong password

#### Blog
1. A logged in user can view a table containing paginated (10 per page)
articles with the option to change pages backwards and forwards.
2. A logged in user can create an article, edit it, and delete it.
3. A logged in user can only see, edit, and delete their own articles.
4. A logged in user can export their data as an excel sheet.
5. The fields should be: <br>
  a. title (required max 255 chars)<br>
  b. overview (required max 255 chars)<br>
  c. content (WYSIWYG editor)<br>
  d. date of publishing (timestamp)

#### File Manager
1. A logged in user can view all their uploaded files (10 per page).
2. A logged in user can upload a file under a specific name.
3. A logged in user can rename any of their files.
4. A logged in user can delete any of their files.
5. A logged in user can download any of their files.
6. A logged in user can only access their own files.
7. The fields should be: <br>
  a. name (required max 255 chars) <br>
  b. size (required double) <br>
  c. format (required max 10 chars) <br>
  d. path (required) <br>

A user must have unique file names, but the name does not have to be unique with other users.

Make sure your project is set up to use composer PSR-4 composer autoloading(it will make your life easier trust me). The use of MySQLi is not allowed. Everything must me done using OOP. The structure may differ as there is no single right way to do it.

## Bonus:

You can do one of two things:
1. Do unit/integration tests using PHPUnit.
2. Convert all your functions to API end points with proper documentations and authentication.
