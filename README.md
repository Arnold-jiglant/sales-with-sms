#SALES MANAGEMENT

Is a point of sale management system that will help retail shops or businesses manage daily
sales process including recording sales record, generating receipt, manage loss, managing and 
tracking inventory or stock etc.

The system is made with PHP laravel framework version 6.2



###USER FUNCTIONS
#####MANAGER - Have all the access in the system
Also the manager can add other user roles and assign different access such as:-
- add,edit,delete product inventory
- suggest product selling price
- manage product loss
- add,edit,delete expenses category
- manage discount rate per product
- view income statement
- view report per specific time period
- manager system users (add,edit, delete and assigning role)
- add, edit, delete customers
- receive customer debts and notify customers

###DEPLOYMENT
1. Clone the git repo from https://github.com/Arnold-jiglant/sales-with-sms.git
2. Inside the project folder run
    - run composer install
    - run php artisan key:generate
    - inside .env file set up other environmental variables such as database connection etc..
    - in the .env file add two variables BEEM_API_KEY and BEEM_SECRET which are essential or using the SMS Api
        - BEEM_API=my_beem_message_api_key
        - BEEM_SECRET=my_beem_secret
    - finally run php artisan migrate --seed to to initialize the database
    - run php artisan serve to host the project locally
    - when you open the project for the first time you will be asked for the manager info
    
    Thats it!


            


