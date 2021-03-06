# FinancialModeling
Contributors: Hari Annam
Requires at least: 4.9.6
Tested up to: 5.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This theme is designed to display stock data by consuming financialmodeling api's

### == Description ==
```
 This theme is designed to display stock data by consuming financialmodeling api's with the help of Advanced Custom Fields 
 and Bootstrap for layout. It features custom output of the api data and mainly dependent on these two API's.
 https://financialmodelingprep.com/api/v3/profile/AAPL?apikey=demo
 https://financialmodelingprep.com/api/v3/quote/AAPL?apikey=demo
 
 API key can be generated from https://financialmodelingprep.com/ and include it in the wp-config.php file.
 define( 'API_KEY', 'YOUR API KEY');
  ```

#### Built-in
```
The themes comes with two custom post types "News Articles", "Stock Articles" and a template "Company" 
which is used to create Company pages. Any posts created under these post types can be assigned a stock 
ticker symbol using the short code [symbol name="SBUX"](sbux is the symbol for Starbucks) 
which would output as ( NASDAQ : SBUX) . Company template can be used to display related 
stock articles or news articles that are tagged with company symbol(SBUX) and then adding 
then adding it under the "company symbol" field while creating the page in the CMS.

```
![image](https://user-images.githubusercontent.com/22259868/98998304-29b03a00-24f3-11eb-9f41-a7c87309dc11.png)
![image](https://user-images.githubusercontent.com/22259868/98998405-52d0ca80-24f3-11eb-9209-b3f4533a13f7.png)


### Installation
Clone this repo:
```
https://github.com/hari25/wordpress-financialmodeling.git
```
```
Or you can download the Archive folder which contains zip files of theme and plugins and 
can upload them directly using "Upload Theme" and "Upload Plugin" functionality from the CMS.
Import financialmodeling.WordPress.2020-11-12.xml(Tools->Settings->import) file from 
the archive folder( https://github.com/hari25/wordpress-financialmodeling/tree/master/wp-content/archive) 
to get started with basic posts, pages and menus.

Activate Advanced Custom Fields and FinancialModelingPrep plugins.
```
