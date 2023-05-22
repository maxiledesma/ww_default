# Deviget WW Theme Challenge
## Description
A theme based on luma theme with these features:
- Set color schema based on "The Mandalorian" series.
- Set custom logo
- Set styles for PDP
- Set custom menu item for CMS page

## Installation
1) Download the repository content and place it into a Magento folder.
2) Run the following commands
```
> composer install
> bin/magento setup:di:compile 
> bin/magento setup:upgrade
> bin/magento setup:static-content:deploy -f --theme=Deviget/ww_default
```
3) Access the site

## Notes
- I was unable to create a working script to create a configurable product without intervention and no such code is included on this repo.


   
    
