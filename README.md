# StaticSquish - Data - For DataPortals.org


See http://dataportals.jmbtechnology.co.uk/ - this is a demo of the data from http://dataportals.org/ rendered by different software.

To discuss more, please see https://discuss.okfn.org/t/i-did-a-data-portals-site-for-you/1604/2

## To build

Download https://github.com/StaticSquish/StaticSquish-Core and run 

    composer install


to get all the libraries needed.


Download this repository and run

    php buildData.php

to get the CSV from the DataPortals repository and build data files this software understands.


Run 

    php software/bin/StaticSquish.php --build --site . --out out --baseurl /



  *  The site parameter should be the root folder of this repository - the same folder the config.ini file is in.
  *  Out is where you want your web site files to appear.
  *  BaseURL is the base URL the site will be served from.
