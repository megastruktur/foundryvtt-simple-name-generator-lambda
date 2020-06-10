<?php

$path = './names/';
$path_library = './application/library/';
$files = scandir($path);
$names = [];

// Each Language Type contains the following array:
// $output_array = [
//   'male' => [],
//   'female' => [],
//   'surname' => [],
//   'surname_male' => [],
//   'surname_female' => [],
// ];

foreach ($files as $file_name) {
  
  if (!in_array($file_name, ['.', '..'])) {

    $output_array = [
      'male' => [],
      'female' => [],
      'surname' => [],
      'surname_male' => [],
      'surname_female' => [],
    ];

    $gender = '';
    $is_surname = FALSE;

    $list = str_replace('.txt', '', $file_name);
    $filename_expl = explode(' ', $list);


    // Check for Surname.
    if ($filename_expl[count($filename_expl) - 1] === 'Surname') {
      $is_surname = TRUE;
    }

    // Name
    $name_type = strtolower($filename_expl[0]);

    // Gender
    if (in_array($filename_expl[1], ['Male', 'Female'])) {
      $gender = strtolower($filename_expl[1]);
    }

    $names_from_file = file($path . $file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    if ($is_surname) {
      $names[$name_type][($gender ? $gender . '_' : '') . 'surname'] = $names_from_file;
    }
    else {
      $names[$name_type][$gender] = $names_from_file;
    }
  }
}

# Save Files.
foreach ($names as $name_type => $name_list) {

  foreach ($name_list as $key => $list) {
    $name_list[$key] = array_map('utf8_encode', $list);
  }

  $json = json_encode($name_list);
  $filename = $path_library . $name_type . '.json';
  $export_file = fopen($filename, 'w');
  fwrite($export_file, $json);
  fclose($export_file);
}
