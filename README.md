Solution for a Technical Challenge using PHP and/or Javascript

To Solve this challege, it was decided to use Laravel 9 framework, as the backend and for it's front end, it was decided to use Vue.js , using  Vite it was also used Axios and Jquery libraries. For sending emails, it was used the Mailable class of Laravel. Despite the front end was created, using Vue.js,  the template for the email, was created using Laravel's own blade file.


The objective of this challenge was to create a simple app, that allow us to choose products (and their quantity) from a list, add it to a table (with both infos, and how much each costs, in total, depending of the quantity chosen) and they fill a form, with name, email, and select transport service from another list,  and then press a button to finish the deal, and receive an automatic email with a resume of the deal.

Blue button is only clickable when quantity and product are defined and  green button is clickable only, when there are products on the the table,  and the name and email (with correct email format) are filled. Since transport service has a default value for one the services, the program assumes the user wants to use that transport service

Since when adding products to the table, when it tries to update to total value the user needs to pay, it updates the sum, ignoring the value of the last added product (the sum initially happened at the same time the button was pressed), it was decided to turn the method that makes the sum happening, a timed method. So thanks to Jquery, it was created a method, that each 1000 milliseconds, it sums all values of the products added on the table. So when a new product is added to the table, the total value is uptaded immediately 


