<?php



    class Controller{

        protected $route_map;

        function Controller(){
            $route_map = file_get_contents(BASE_URL.'Router/routes.json');
            $this->route_map = json_decode($route_map);
        }

        public function inflateContents($route){
            $page_id = $route["page_id"];
            $route_map = $this->route_map;
            try{
                include $route_map->$page_id;
            } catch(Exception $e){
                echo "Error is ".$e->getMessage();
            }
        }
    }