<?php 

  class Upload
  {
    //valids formats
    private  static $availablesFormat;
    public static $uploadedFile;
    //to have not a instance of the class
    private function __construct(){}
    //upload a generic file to a certain destiny
    public static function Upload($file,$destiny,$position=null)
    {
      if($position===null)
        return Upload::UploadSingle($file,$destiny);
      else
      {
        if(is_integer($position))
          return Upload::UploadMultiple($file,$destiny,$position);
        else
          return "The Position Of The File To Upload Must Be An Integer";
      }
    }
    //Upload Multiple file
    private static function UploadMultiple($file,$destiny,$position)
    {
      if($_FILES[$file]['name'][$position]!='')
      {
        $targetFile=time();
        //take the file extension
        $targetFileType=strtolower(pathinfo($_FILES[$file]['name'][$position],PATHINFO_EXTENSION));
        $targetFile.='.'.$targetFileType;
        $targetDir=$destiny.'/'.$targetFile;
        Upload::$uploadedFile=$targetFile;
        //check if file extension is available
        if(!in_array($targetFileType,Upload::$availablesFormat))
          return 'File Type Not Supported, attach a '.Upload::$availablesFormat;
        $contentLength=$_FILES[$file]['size'][$position];
        //check if content length is too big or not
        if($contentLength<41943040):
          //make upload
          if(move_uploaded_file($_FILES[$file]['tmp_name'][$position],$targetDir))
            return true;
          else 
            return false;
        endif;

      }
      else
        return 'No File Selected, Select one file or two, if is required';
    }
    //Upload Single File
    private static function UploadSingle($file,$destiny)
    {
      
      if($_FILES[$file]['name']!='')
      {
        $targetFile=time();
        //take the file extension
        $targetFileType=strtolower(pathinfo($_FILES[$file]['name'],PATHINFO_EXTENSION));
        $targetFile.='.'.$targetFileType;
        $targetDir=$destiny.'/'.$targetFile;
        Upload::$uploadedFile=$targetFile;
        //check if file extension is available
        if(!in_array($targetFileType,Upload::$availablesFormat))
          return 'File Type Not Supported';
        $contentLength=$_FILES[$file]['size'];
        //check if content length is too big or not
        if($contentLength<41943040):
          //make upload
          if(move_uploaded_file($_FILES[$file]['tmp_name'],$targetDir))
            return true;
          else 
            return false;
        endif;

      }
      else
        return 'No File Selected, Select one';
    }
    public static function SetAvailablesFormat()
    {
      Upload::$availablesFormat=func_get_args();
    }
  }



?>