#SALES MANAGEMENT

###USERS
- Manager

###USER FUNCTIONS
1.MANAGER
- add,edit,delete product inventory
- suggest product selling price
- manage product loss
- add,edit,delete expenses category
- manage discount rate per product
- view income statement
- view report per specific time period
- manager system users (add,edit/delete)


###SYSTEM FUNCTIONS
- generate transaction/receipt number for each sale
- update sales product table after each sale
- can generate barcode for particular product

###MODELS
1.USER
-id
-fname
-lname
-role_id
-active(bool)

2.ROLE
-id
-name

3.CUSTOMER
-id
-name

4.PRODUCT
-id
-product
-quantity
-sellingPrice
-buyingPrice
-hasDifferentSize

5.DISCOUNT
-id
-product_id
-greaterThan	eg. >3 rate=5% (for 30,000/= shoes will be 28,500/= per item)
-rate

6.INVENTORY
-id
-product_id
-quantity
-cost
-sellingPrice

7.LOSS
-id
-product_id
-quantity
-amount //can manualy be typed

8.EXPENSETYPE
-id
-name

9.EXPENSE
-id
-type
-amount
-description //optional
-issuer

10.PAYMENTTYPE
-id
-name

11.SALE
-id
-product_id
-quantity
-sellingPrice	//before discount
-buyingPrice
-discount	//discount amount/can be manually typed
-receipt_id

12.RECEIPT
-id
-number
-paymentType
-customer_id	//nullable
