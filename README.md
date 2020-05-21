# employee_portal
An mini HRIS app

# Set up locally

1. First you need to copy the .env.example.php file to .env.php. There you can initialise the environmental variables of the project, including the local database credentials you are going to use and the project root (the root url of the app, eg: http://localhost)
2. Run the code in db/create_tables_and_insert_admin.sql on your local database. An administrator will be automatically added with the following credentials:

> email: john_smith@example.com
> password: 12345678

You can sign in as him and then create more employees, admins and requests through the app for further testing.
