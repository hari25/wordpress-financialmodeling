=== Plugin Name ===
 Plugin Name: FinancialModelingPrep
 Description: Description: Retrieve Stock Info such as stock symbol, logo and company information.
 Author: Hari Annam
 Version: 1.0
 Text Domain: financialModeling
 Domain Path: /languages
 License: GPL v2 or later
 License URI: https://www.gnu.org/licenses/gpl-2.0.txt

This plugin is used to display a ticker symbol for a stock(eg:NASDAQ:SBUX), get company info and stock info. 

== Description ==
```
This plugin uses Financial Modeling Prep API(https://financialmodelingprep.com/) to display the company and stock information. 
In order to use this plugin, generate an API key by heading to https://financialmodelingprep.com/ and include 
it in your wp-config.php file eg(define( 'API_KEY', 'Your API Key'))

It mainly registers three short codes "Symbol", "Profile", "Company" which accpets name as a parameter and can be used as 
[symbol name='SBUX']
[profile name="SBUX"]
[company name="SBUX"]
where SBUX is the company symbol for StarBucks. 
 ```
