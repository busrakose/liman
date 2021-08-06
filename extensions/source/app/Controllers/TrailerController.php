<?php
namespace App\Controllers;
use Liman\Toolkit\Shell\Command;

class TrailerController
{
        public function set(){

            $cmd = Command::runSudo("ls -da  /liman/*/ | grep @{:filename}",[
                "filename" => request("filename")
            ]);

        $files = explode("liman", $cmd);
        array_splice($files,0,1);
        $list = [];

        
        foreach ($files as &$file){
           $file = preg_replace('/\+s/',' ',$file);
           $file= explode(" ",$file);
            array_push($list,[
                "name" => $file[0]
                
                
            ]);           
        }
    
        #return respond($cmd, 200);
        return view("table",
        [
         "value" => $list,
         "title" => ["Dosya Adı"],
         "display" => ["name" ]               
     
        ]);
    

    }
    
    public function get()
    {
        $cmd = Command::runSudo("ls -da  /liman/*/ | grep @{:filename}",[
            "filename" => request("filename")
        ]);
        $files = explode("\n", $cmd);
        array_splice($files,0,1);
        $list = [];

        
        foreach ($files as &$file){
           $file = preg_replace('/\+s/',' ',$file);
           $file= explode(" ",$file);
            array_push($list,[
               
                "permissions" => $file[1],
                "owner" =>$file[2],
                "group" =>$file[3],
                "size" =>$file[4],
                "date" =>$file[5] . " " .$file[6] . " " .$file[7],
                "name" => $file[0]
                
            ]);

           
        }
     
    
        return view("table",
        [
         "value" => $list,
         "title" => ["Dosya Adı",  "İzinler", "Sahibi", "Grup", "Dosya Boyutu", "Son Değiştirilme"],
         "display" => ["name","permissions", "owner", "group", "size", "date"]               
     
        ]);
        
        
       

    }
 }