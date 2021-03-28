### Laravel Admin Panel
A simple Laravel Admin Panel application with Laravel.

#### Installation
It's a Laravel 7.22.4 application with a very little functionality. You can install it as any other laravel 7 application. Here are the commands you need to run one by one-
```text
git clone git@github.com:CodeMechanix/Laravel-Admin-Panel.git admin-panel
cd admin-panel
composer install
php artisan key:generate
php artisan storage:link
```
Then you need to put your database credentials in the .env file. I used MySQL in this project, but any Eloquent supported relational database can be used. After that run these-
```text
php artisan migrate
php artisan serve
```
Then you can visit the url shortener in this url- http://127.0.0.1:8000

#### Uses
This application can be used both in logged in or logged out state. But for using the full potential, you should logged in.

This project has following features-
- Full fledged registration and login system
- Proper validation for each form
- Dynamic Category, Sub-Category, Product
- Live Search
- Filter Product
 
#### Task Requirements:
   1.	Create an Admin Panel with proper user authentication.
   2.	Product Category & Subcategory (CRUD operations)
   3.	Product (CRUD operations)
   4.	Search product using category, subcategory, name
   5.	Filter products by price and date range.
   6.	Use MySQL Database with proper indexing.
   7.	Use Laravel & React.
   8.	Must use race condition.
   9.	Use all of GET, POST, PUT, PATCH and DELETE.

#### Table Requirements:
- Category data contains category_id, category_name and category_slug.

- Product data contains product_id, Product name, category, sub category, description, price, featured/thumbnail image, products multiple images.

#### Screenshots
- Login Page:

![Login-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/login.PNG)

- Signup Page

![signup-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/signup.PNG)

- Dashboard

![dashboard-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/dashboard.PNG)

- Category-List

![category-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/category.PNG)

- Add Category

![add-category-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/add_category.PNG)

- Sub-Category-List

![sub-category-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/list_sub_category.PNG)

- Add Sub-Category

![sub-category-list-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/add_sub_category.PNG)

- Product-List

![product-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/list_product.PNG)

- Add Product

![add-product-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/add_product.PNG)

- Before Live Search

![before-live-search-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/before_search.PNG)

- After Live Search

![after Live Search -Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/after_search.PNG)

-Not Found

![Not Found](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/No_Data.PNG)

- Before Filter

![before-live-search-Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/before_filter.PNG)

- After Filter

![after Live Search -Page](https://github.com/CodeMechanix/Laravel-Admin-Panel/blob/master/img/after_filter.PNG)

#### Developer
Mohammad Nabavi
