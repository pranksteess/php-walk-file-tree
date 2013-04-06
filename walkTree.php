<?php   
 main();   
  
 function main(){   
 //Set Variables   
 $testDirName = "./zhoz/";   
 $fileListArray = array();   
 $dirListArray = array();   
  
$aDirectory = new DirReader($testDirName);   
  
// Store File List in Array   
$fileListArray = $aDirectory->getFileList();   
$dirListArray = $aDirectory->getDirList();   
  
echo "<html><body>\n";   
echo "<pre>\n";   
  
  
echo "Reading Directory: ".  $aDirectory->getDirPath() ."\n";   
echo "Current Directory: ". getcwd() ."\n";   
  
echo "-- Files in Directory --\n";   
foreach ($fileListArray as $filename) {   
    echo "File: $filename\n";   
}   
  
echo "\n-- Sub Directories --\n";   
foreach ($dirListArray as $filename){   
    echo "Sub dir: $filename\n";   
}   
echo "</pre></body></html>\n";   
}   
  
class DirReader{   
  private $dh;   
  private $basedir;   
  private $fileNameArray=array();   
  private $dirNameArray=array();   
  
  function __construct($dirname){   
    $this->basedir = $dirname;   
    $this->dh = dir($dirname) or die($php_errormsg);   
    $this->parseDirectory();   
  }   
  
  function parseDirectory(){   
    $filename = "";   
    while (false !== ($filename = $this->dh->read())){   
      $fullpath = $this->basedir . '/' . $filename;   
      if (is_file($fullpath)){   
        array_push($this->fileNameArray, $filename);   
      }else{   
        array_push($this->dirNameArray, $filename);   
      }   
    }   
  }   
  
  
  // Get all the files in the directory   
  function getFileList(){   
    return $this->fileNameArray;   
  }   
  
  // Get all the sub directories in the directory   
  function getDirList(){   
    return $this->dirNameArray;   
  }   
  
  function getDirPath(){   
    return $this->dh->path;   
  }   
}  
