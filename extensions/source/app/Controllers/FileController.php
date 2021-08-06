<?php
namespace App\Controllers;
use Liman\Toolkit\Shell\Command;

class FileController
{

    
        public function add()
        {
            Command::runSudo("touch /home/liman/@{:fileName} ",[
                "fileName" => request("fileName")
    
            ]);
           
            return respond(__("Başarıyla eklendi"), 200);
        }
        public function get()
        {

            $cmd = Command::runSudo("ls -lah /home/liman");
            $files = explode("\n", $cmd);
            array_splice($files,0,1);
            $list = [];
    
            
            foreach ($files as &$file){
               $file = preg_replace('/\s+/',' ',$file);
               $file= explode(" ",$file);
                array_push($list,[      
                    "name"=> $file[8] ,          
                    "permissions" => $file[0],
                    "owner" =>$file[2],
                    "group" =>$file[3],
                    "size" =>$file[4],
                    "date" =>$file[5] . " " .$file[6] . " " .$file[7]
                 
                ]);
              
            }
            
            return view("table",
            [
             "value" => $list,
             "title" => ["Dosya Adı", "İzinler", "Sahibi", "Grup", "Dosya Boyutu", "Son Değiştirilme"],  
             "display" => ["name", "permissions", "owner", "group", "size", "date"]            
         
            ]);
                         
        }

    
}