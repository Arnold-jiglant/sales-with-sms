#SALES MANAGEMENT

###TEAM PARTICIPANTS
1. Arnold Jifike  arnoldjifike@gmail.com
2. Hans Nzali   hansnzali@gmail.com
3. Kalla Giga   kallagiga@gmai.com

###Description
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
    
###API Used
    - Beem SMS API
    
###Other info

Live demo at https://secret-chamber-55018.herokuapp.com/
- email: mamanger@manager.com
- Password: manager

###Using the SMS APi Steps
1. After logging in go to customers area
2. You will see all customers, if you wish you can add one. Important info "Customer name" and phone number with this pattern "+xxx xxx xxx"
3. In order to notify the customer he or she must have sales debt, so open sales-> new sales and choose the products you want to sell.
4. On the right side a small panel will appear showing the selected products, choose payment type to debt.
5. At the top of the panel choose the customer you are selling to then click confirm.
6. Back again to customers area you will see that the previously sold to customer is having a debt amount.
7. Click view customer you will see the notify button. NOTE this button appears if the customer has debt
8. Clicking the button will show a modal containing the name, phone number and message showing list of receipts with debts and a total amount of debt.
9. Click send button and message will be sent to the customer phone number specified earlier.
Thats it!


            


