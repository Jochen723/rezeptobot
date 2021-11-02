<?php



header('Content-Type: application/json; charset=utf-8');

  function createLog($msg){ //function parameters, two variables.
      
      
      $log_msg = date('Y-m-d H:i:s') . ' ' . $msg;
      
      $log_filename = "log";
      if (!file_exists($log_filename))
      {
          // create directory/folder uploads.
          mkdir($log_filename, 0777, true);
      }
      $log_file_data = $log_filename.'/' . date('Y-m-d') . '.log';
      file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
       
      
  }
?>