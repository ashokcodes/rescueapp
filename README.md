PURPLETREE PHP Framework
=======================

PHP framework for quickly building websites and apps 
Also, a boiler plate for php projects


Requirements
-----------
    -   PHP 7.0 >
    -   Apache Server


Getting Started
--------------

    -   Paste the files into web root ad we are good to go
    -   Inside "Config/const.config.json" file provide the BASE URl value with "/" at the end
        ex. if the url is "http://purpletree.local", make sure it is written as "http://purpletree.local/", i.e. with a "/" to the end


Adding Routes
------------

    -   Within Router folder find the json file named "routes.json"
    -   Add the page's url term as key and the correspoding controller's filename as value
    -   Create a file with the controller's filename inside Controlled folder
    -   The key for homepage is "home" by default setting
 