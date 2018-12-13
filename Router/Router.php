<?php


    class Router extends Controller{

 


        function getPage($route){
            if(sizeof($route) == 0){
                $route = ["page_id"=>"home"];
            }
                // require_once $this->prettyFileName($this->route_map->Home);
                Controller::inflateContents($route);
                
        }
    }