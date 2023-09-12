# WebTransactionFormatter
This project utilizes PHP to read a CSV file of transactions and format them neatly on an HTML page.

The file structure is as follows:

### the app folder contains the app.php and helper.php files
app.php contains the business logic functions responsible for reading the csv files, parsing them, and manipulating the data
helpers.php contains the non-business functions like formatting the data to standardize the output

### the public folder contains the index.php file
index.php defines the paths to the other files in the app, and does the initial calls to read and parse the files

### the transaction_files folder contains the csv data file
the transaction format is as such: 
Date, Check #, Description, Amount

### the views folder contains the transactions.php file
transactions.php contains the HTML to display the data in a table



