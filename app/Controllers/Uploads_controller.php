<?php

namespace App\Controllers;

define('DS' , DIRECTORY_SEPARATOR);

class Uploads_controller extends BaseController
{
	public function index()
	{
		$dir =
            "assets"
            . DS . "uploads"
            . DS . "images"
        ;
        $data = [];
        $files = null;
        $files = $this ->__getDirContents($dir);
        
        if (( isset($files)) && (is_array($files)))
        {
            foreach ($files as $k => $v ){
                $file = null;
                $file = pathinfo($v);
                
                if ((isset($file)) && (is_array($file))) {
                    if (array_key_exists('extension' , $file)) {
                        $pos = 0;
                        $pos = strpos($v , $dir);
                        $data['images'][] = base_url('public' . DS . substr($v , $pos));
                    }    
                }
            }
        }
        return view('form_upload' , $data);
	}
    
    public function store()
    {  
        helper(['form', 'url']);
        
        $dir =
            'assets'
            . DS . 'uploads'
            . DS . 'images'
            . DS . date("Y")
            . DS . date("m")
            . DS . date("d")
        ;
        
        $this -> __checkCreateDir($dir);
        
        $validated = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[file,4096]',
            ],
        ]);
 
        $msg = 'Please select a valid file';
  
        if ($validated) {
            $file = $this->request->getFile('file');
            //$avatar->move(WRITEPATH . 'uploads');
            $file -> move ($dir);
            $msg = 'File has been uploaded';
        }
 
       return redirect()->to( base_url('public/index.php/form') )->with('msg', $msg);
 
    }

	/**
     *
     * __getDirContents
     * @return: array of files dir/subdir
     *
     */
    private function __getDirContents($dir = null, &$results = array()) {
        if ((isset($dir)) && (is_dir($dir))) {
            $files = scandir($dir);

            foreach ($files as $key => $value) {
                $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
                if (!is_dir($path)) {
                    $results[] = $path;
                } else if ($value != "." && $value != "..") {
                    $this -> __getDirContents($path, $results);
                    $results[] = $path;
                }
            }

            return $results;
        }
    }
    
    private function __checkCreateDir($dir = null ) {
        $arrDir = null;
		$arrDir = explode('/', $dir);	
		if ((isset($arrDir)) && (is_array($arrDir))) {
			$d = '';
			foreach ($arrDir as $key => $value) {
				if ($value !== '') {
					$d .= $value . '/';
					if (!is_dir ( $d ) ) {
						mkdir($d , 0777, TRUE);
					}		
				}
			}
        }
    }
}
